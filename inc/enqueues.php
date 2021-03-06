<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
/*
//ADD THE CSS BUNDLE
function wbmz_enqueue_styles() {

    ////// IF  RECOMPILED STYLE IS PRESENT, DISABLE THE ORDINARY STYLE AND ENQUEUE THE RECOMPILED ///
    $compiled_style_url=wbmz_get_compiled_css_url();
    //die($compiled_style_url);
    if($compiled_style_url) {
        wp_enqueue_style( 'wbmz-styles',  $compiled_style_url);
    } else {
        wp_enqueue_style( 'wbmz-styles',  "https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css");
    }


}
add_action( 'wp_enqueue_scripts', 'wbmz_enqueue_styles' );
*/

//SUPPORT FUNCTIONS FOR DETERMINING THE RIGHT CSS BUNDLE FILENAME AND LOCATION

function wbmz_get_css_url (){
    //onboarding
    if(get_theme_mod("wbmz_scss_last_filesmod_timestamp",0)==0) return get_stylesheet_directory_uri() . '/'. wbmz_get_css_optional_subfolder_name() . wbmz_get_base_css_filename();

    //standard case
    return get_stylesheet_directory_uri() . '/' . wbmz_get_css_optional_subfolder_name() . wbmz_get_complete_css_filename();

}

if (!function_exists('wbmz_get_css_optional_subfolder_name')):
    function wbmz_get_css_optional_subfolder_name() { return ""; }
endif;

if (!function_exists('wbmz_get_base_css_filename')):
    function wbmz_get_base_css_filename() { return "styles-bundle.css"; }
endif;

if (!function_exists('wbmz_get_complete_css_filename')):
    function wbmz_get_complete_css_filename() {
        $filename = wbmz_get_base_css_filename();
        if (is_multisite()) $filename = str_replace('.', '-' . get_current_blog_id() . '.', $filename );
        return $filename;
    }
endif;




//ADD THE MAIN CSS FILE
add_action( 'wp_enqueue_scripts',  function  () {

    //DETERMINE a VERSION NUMBER
    if (current_user_can("administrator")) $version=rand(1,9999); else
        $version = intval((get_theme_mod("wbmz_scss_last_filesmod_timestamp")) % 999);

    //ENQUEUE THE CSS FILE
    wp_enqueue_style( 'wbmz-styles', wbmz_get_css_url(), array(), $version); //would be more elegant

});

///ADD THE MAIN JS FILE
//enqueue js in footer, async
add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_script( 'bootstrap5',  "https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js#asyncload", array(), null, true );
  //wp_enqueue_script( 'slickslider',  "https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js#asyncload", array(), null, true );
} ,100);



//ADD THE CUSTOM HEADER CODE (SET IN CUSTOMIZER)
add_action( 'wp_head', 'wbmz_add_header_code' );
function wbmz_add_header_code() {
      if(! get_theme_mod("wbmz_fonts_header_code_disable")) echo get_theme_mod("wbmz_fonts_header_code")." ";
	  echo get_theme_mod("wbmz_header_code");
}

//ADD THE CUSTOM FOOTER CODE (SET IN CUSTOMIZER)
add_action( 'wp_footer', 'wbmz_add_footer_code' );
function wbmz_add_footer_code() {
	  //if (!current_user_can('administrator'))
      echo get_theme_mod("wbmz_footer_code");
}

//ADD THE CUSTOM CHROME COLOR TAG (SET IN CUSTOMIZER)
add_action( 'wp_head', 'wbmz_add_header_chrome_color' );
function wbmz_add_header_chrome_color() {
	 if (get_theme_mod('wbmz_header_chrome_color')!=""):
        ?><meta name="theme-color" content="<?php echo get_theme_mod('wbmz_header_chrome_color'); ?>" />
	<?php endif;
}


//JS ASYNC ENQUEUE: add an async load option as per https://ikreativ.com/async-with-wordpress-enqueue/
function wbmz_async_scripts($url){
    if ( strpos( $url, '#asyncload') === false )
        return $url;
    else if ( is_admin() )
        return str_replace( '#asyncload', '', $url );
    else
	return str_replace( '#asyncload', '', $url )."' async='async";
    }
add_filter( 'clean_url', 'wbmz_async_scripts', 11, 1 );
