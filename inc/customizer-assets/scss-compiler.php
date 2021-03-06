<?php
/*
SCSS Compiler interface 
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

//CHECK URL PARAMETERS AND REACT ACCORDINGLY
add_action("admin_init", function (){
	if (!current_user_can("administrator")) return; //ADMINS ONLY
	
	if (isset($_GET['ps_compile_scss'])) {		wbmz_generate_css();		die();	}
	if (isset($_GET['ps_reset_theme'])) {		remove_theme_mods(); 	echo ("Theme Options Reset.<br>");	wbmz_generate_css();		die(); }
	if (isset($_GET['ps_show_mods'])){		print_r(get_theme_mods());		wp_die();	}
});

// USE LEAFO's SCSSPHP LIBRARY
use ScssPhp\ScssPhp\Compiler; //https://scssphp.github.io/scssphp/docs/


//SOME UTILITIES
function wbmz_get_active_parent_theme_slug(){ $style_parent_theme = wp_get_theme(get_template()); $theme_name = $style_parent_theme->get('Name'); return sanitize_title($theme_name);}

//function wbmz_get_upload_dir( $param, $subfolder = '' ) {    $upload_dir = wp_upload_dir();    $url = $upload_dir[ $param ];    if ( $param === 'baseurl' && is_ssl() )  $url = str_replace( 'http://', 'https://', $url );return $url . $subfolder; }
//function wbmz_get_active_theme_slug(){ return get_stylesheet(); } 


/////FUNCTION TO GET ACTIVE SCSS CODE FROM FILE ///////
function wbmz_get_active_scss_code(){
	
	//INIT WP FILESYSTEM 
	global $wp_filesystem;
	if (empty($wp_filesystem)) {
		require_once (ABSPATH . '/wp-admin/includes/file.php');
		WP_Filesystem();
	}
	
	//READ THE FILE
	$the_scss_code = $wp_filesystem->get_contents('../wp-content/themes/'.get_stylesheet().'/sass/main.scss');  

	//FOR STYLE PACKAGES
	if(function_exists("wbmz_alter_scss")) $the_scss_code = wbmz_alter_scss ($the_scss_code);	 
	
	return $the_scss_code;
}

 
/////FUNCTION TO RECOMPILE THE CSS ///////
function wbmz_generate_css(){
	
	//INITIALIZE COMPILER
	require_once "scssphp/scss.inc.php";
	$scss = new Compiler();
	
	try {
		//SET IMPORT PATH: CURRENTLY ACTIVE THEME's SASS FOLDER
		$scss->setImportPaths(WP_CONTENT_DIR.'/themes/'.get_stylesheet().'/sass/');

		//IF USING A CHILD THEME, add parent theme sass folder: picostrap
		if (is_child_theme()) $scss->addImportPath(WP_CONTENT_DIR.'/themes/'.wbmz_get_active_parent_theme_slug().'/sass/');
		
		//add extra path for style packages
		if(function_exists("wbmz_add_scss_import_path")) $scss->addImportPath(wbmz_add_scss_import_path());
		
		//SET OUTPUT FORMATTING
		$scss->setFormatter('ScssPhp\ScssPhp\Formatter\Crunched');
		
		// ENABLE SOURCE MAP // ADD OPTION
		//$scss->setSourceMap(Compiler::SOURCE_MAP_INLINE);
		
		//SET SCSS VARIABLES
		$scss->setVariables(wbmz_get_active_scss_variables_array());
		
		//NOW COMPILE
		$compiled_css = $scss->compile(wbmz_get_active_scss_code());
	
	} catch (Exception $e) {
		//COMPILER ERROR: TYPICALLY INVALID SCSS CODE
		die("<div id='compile-error' style='font-size:20px;background:#212337;color:lime;font-family:courier;border:8px solid red;padding:15px;display:block'><h1>SCSS error</h2>".$e->getMessage()."</div>");
   	}
	
	//CHECK CSS IS REALLY THERE
	if ($compiled_css=="") die("Compiled CSS is empty, aborting.");
	
	//ADD SOME COMMENT
	$compiled_css .= " /* DO NOT ADD YOUR CSS HERE. ADD IT TO SASS/_CUSTOM.SCSS */ ";

	//INIT WP FILESYSTEM 
	global $wp_filesystem;
	if (empty($wp_filesystem)) {
		require_once (ABSPATH . '/wp-admin/includes/file.php');
		WP_Filesystem();
	}

	//SAVE THE FILE
	$saving_operation = $wp_filesystem->put_contents('../wp-content/themes/'.get_stylesheet() . '/' . wbmz_get_css_optional_subfolder_name() . wbmz_get_complete_css_filename(), $compiled_css, FS_CHMOD_FILE ); // , 0644 ?
	
	if ($saving_operation) { // IF UPLOAD WAS SUCCESSFUL 

		//SET TIMESTAMP
		set_theme_mod("wbmz_scss_last_filesmod_timestamp",wbmz_get_scss_last_filesmod_timestamp());

		//GIVE POSITIVE FEEDBACK	
		if (isset($_GET['ps_compiler_api'])) {
			echo "New CSS bundle: " . wbmz_get_css_url();
		} else {		
			echo "File was successfully uploaded<br><br>";
			echo "<a href='".wbmz_get_css_url()."' target='new'>View File</a>";
			echo "<br><br><b>Size: </b><br>".round(mb_strlen($compiled_css, '8bit')/1000)." kB - ".round(mb_strlen(gzcompress($compiled_css), '8bit')/1000)." kB gzipped";
		}

	} else {
		//GIVE NEGATIVE FEEDBACK
		if (isset($_GET['ps_compiler_api'])) {
			echo  "<br><br><span id='saving-error'>Error saving CSS file "."</span>";
		} else {
			echo  "<div id='savingfile-error' style='font-size:20px;background:#212337;color:lime;font-family:courier;border:8px solid red;padding:15px;display:block'><h1>Error writing file</h1></div>";
		die();
		}
	}
 
	//PRINT A CLOSE BUTTON
	if (!isset($_GET['ps_compiler_api'])) echo  " <button style='font-size:30px;width:100%' class='cs-close-compiling-window'>OK </button>";
}



/////FUNCTION TO GET VARIABLES USED IN CUSTOMIZER /////
function wbmz_get_active_scss_variables_array(){
	$output_array=array();
	if (get_theme_mods()) foreach(get_theme_mods() as $theme_mod_name => $theme_mod_value):
		
		//check we are treating a scss variable, or skip
		if(substr($theme_mod_name,0,8) != "SCSSvar_") continue;
		
		//skip empty values, unless checkboxes that default to true
		if($theme_mod_value=="" && $theme_mod_name!='SCSSvar_enable-rounded') continue;
		
		$variable_name=str_replace("SCSSvar_","$",$theme_mod_name);
		
		//add to output array
		$output_array[$variable_name] = $theme_mod_value;
		
	endforeach;

	return $output_array; 
}


// FORCE CSS REBUILD UPON ENABLING CHILD THEME 
add_action( 'after_switch_theme', 'wbmz_force_css_rebuilding', 10, 2 ); 
function wbmz_force_css_rebuilding() {   
    remove_theme_mod("wbmz_scss_last_filesmod_timestamp");
}


// MIGRATE TO NEW SAVING MECHANISM:: FORCE CSS REBUILD UPON upgrading from <1.3 
add_action( 'init', 'wbmz_migrate_to_new_saving_check', 10, 2 ); 
function wbmz_migrate_to_new_saving_check() { 
	if ( get_theme_mod("wbmz_css_bundle_wp_relative_upload_path")):
    	remove_theme_mod("wbmz_scss_last_filesmod_timestamp");
		remove_theme_mod("wbmz_css_bundle_wp_relative_upload_path");
	endif;
}

