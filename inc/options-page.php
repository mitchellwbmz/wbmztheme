<?php

function add_picostrap_theme_page() {
    add_theme_page( 'Thema admin opties', 'Thema admin', 'edit_theme_options', 'picostrap-theme-options', 'theme_option_page' );
}
add_action( 'admin_menu', 'add_picostrap_theme_page' );

function theme_option_page() {

    if (isset($_GET['successful-import'])){
        echo "<h1>Import compleet!</h1><p><a class='button button-primary button-hero' href='".get_site_url()."'>Bekijk website</a> </p>";
        return;
    }
    ?>
    <div class="wrap">

        <div class="welcome-panel">

            <div class="welcome-panel-content">
              <h2>Thema admin<?php

				//get active parent theme / framework information
				if (get_template_directory() === get_stylesheet_directory())  { $my_theme = wp_get_theme(); } else { $my_theme = wp_get_theme()->parent(); }

				//print theme version
				echo " - Versie ".$my_theme->get( 'Version' ) ?> </h2>

                <div class="welcome-panel-column-container">

					<div class="welcome-panel-column" style="width:55%;">
                            <h3>Beginnen</h3>
                            <a class="button button-primary button-hero" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>">Customize de website</a>
                    </div>

                    <div class="welcome-panel-column welcome-panel-last">

                        <h3>Extra mogelijkheden</h3>

						<style>

							ul#pico-utils li {
							margin-bottom: 10px;
							}
							ul#pico-utils li a svg {
								color:#007cba;
								width:20px;
								margin-right:10px;
								vertical-align: middle;
							}

							ul#pico-utils li a span {
								font-weight: 700;
							    text-decoration: underline;
							}


						</style>

                        <ul id="pico-utils">
                                    <li>
										<a onclick="jQuery('#ps-panel-actions-loading-target').load('<?php echo admin_url('?ps_compile_scss&ps_compiler_api') ?>');" href="#" class="">
											<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" style="" lc-helper="svg-icon">
												<path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"></path>
												<path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"></path>
											</svg>
											<span>Forceer CSS opbouw opnieuw</a> </span>
										<small>(Geen zorgen)</small>
									</li>


									<li>
										<a onclick="if(confirm('This will DESTROY all your Customizer settings. Are you sure?')) jQuery('#ps-panel-actions-loading-target').load('<?php echo admin_url('?ps_reset_theme&ps_compiler_api') ?>');"   href="#" >
											<svg viewBox="0 0 24 24">
    										<path fill="currentColor" d="M16.24,3.56L21.19,8.5C21.97,9.29 21.97,10.55 21.19,11.34L12,20.53C10.44,22.09 7.91,22.09 6.34,20.53L2.81,17C2.03,16.21 2.03,14.95 2.81,14.16L13.41,3.56C14.2,2.78 15.46,2.78 16.24,3.56M4.22,15.58L7.76,19.11C8.54,19.9 9.8,19.9 10.59,19.11L14.12,15.58L9.17,10.63L4.22,15.58Z" />
											</svg>
											<span>Herstel customizer opties</span>
										</a>
										<small style="color:red">(Vernietigend!)</small>

									</li>



									<li>

									</li>
                        </ul>
                        <div style="font-size:9px" id="ps-panel-actions-loading-target"></div>

				    </div>
				</div>
        	</div>
    	</div>
    </div> <!-- close wrap -->


    <div class="wrap">
		<h2> Import / Export thema instellingen</h2>

		<div class="metabox-holder">
			<div class="postbox">
				<h3><span><?php _e( 'Exporteer instellingen' ); ?></span></h3>
				<div class="inside">
					<p><?php _e( 'Exporteer naar .json bestand.' ); ?></p>
					<form method="post">
						<p><input type="hidden" name="pico_action" value="export_settings" /></p>
						<p>
							<?php wp_nonce_field( 'pico_export_nonce', 'pico_export_nonce' ); ?>
							<?php submit_button( __( 'Exporteren' ), 'secondary', 'submit', false ); ?>
						</p>
					</form>
				</div><!-- .inside -->
			</div><!-- .postbox -->

			<div class="postbox">
				<h3><span><?php _e( 'Importeer instellingen' ); ?></span></h3>
				<div class="inside">
					<p><?php _e( 'Import de thema instellingen als .json bestand.' ); ?></p>
					<form method="post" enctype="multipart/form-data">
						<p>
							<input type="file" name="import_file"/>
						</p>
						<p>
							<input type="hidden" name="pico_action" value="import_settings" />
							<?php wp_nonce_field( 'pico_import_nonce', 'pico_import_nonce' ); ?>
							<?php submit_button( __( 'Importeren' ), 'secondary', 'submit', false ); ?>
						</p>
					</form>
				</div><!-- .inside -->
			</div><!-- .postbox -->
		</div><!-- .metabox-holder -->

	</div><!--end .wrap-->




    <?php
}


///EXPORT AS JSON FILE
function pico_process_settings_export() {

	if( empty( $_POST['pico_action'] ) || 'export_settings' != $_POST['pico_action'] )
		return;

	if( ! wp_verify_nonce( $_POST['pico_export_nonce'], 'pico_export_nonce' ) )
		return;

	if( ! current_user_can( 'manage_options' ) )
		return;

	$settings = array();

    foreach (get_theme_mods() as $setting_name => $setting_value):
        if ($setting_name=="picostrap_scss_last_filesmod_timestamp") continue;
        if ($setting_name=="custom_css_post_id") continue;
        $settings[$setting_name]=$setting_value;
    endforeach;

	ignore_user_abort( true );

	nocache_headers();
	header( 'Content-Type: application/json; charset=utf-8' );
	header( 'Content-Disposition: attachment; filename=pico-settings-export-' . date( 'm-d-Y' ) . '.json' );
	header( "Expires: 0" );

	echo json_encode( $settings );
	exit;
}
add_action( 'admin_init', 'pico_process_settings_export' );




//IMPORT FROM JSON

function pico_process_settings_import() {

	if( empty( $_POST['pico_action'] ) || 'import_settings' != $_POST['pico_action'] )
		return;

	if( ! wp_verify_nonce( $_POST['pico_import_nonce'], 'pico_import_nonce' ) )
		return;

	if( ! current_user_can( 'manage_options' ) )
		return;

	@$extension = end( explode( '.', $_FILES['import_file']['name'] ) );

	if( $extension != 'json' ) {
		wp_die( __( 'Please upload a valid .json file' ) );
	}

	$import_file = $_FILES['import_file']['tmp_name'];

	if( empty( $import_file ) ) {
		wp_die( __( 'Please upload a file to import' ) );
	}

	// Retrieve the settings from the file and convert the json object to an array.
	$settings = (array) json_decode( file_get_contents( $import_file ) );

	$theme = get_option( 'stylesheet' );

	update_option( "theme_mods_$theme", $settings );
    wp_safe_redirect( admin_url( 'themes.php?page=picostrap-theme-options&successful-import' ) );

    exit;

}
add_action( 'admin_init', 'pico_process_settings_import' );
