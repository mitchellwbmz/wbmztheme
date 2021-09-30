<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function my_custom_js() {
    ?>
    <script type="text/javascript">// <![CDATA[
			jQuery(document).ready(function($){
			    $('a[href]:not([href^="<?php echo site_url(); ?>"]):not([href^="#"]):not([href^="/"])').attr( 'target', '_blank' );
			});
			// ]]></script>
    <?php
}

//add_action('wp_head', 'my_custom_js');

remove_action('wp_head', 'wp_generator');

add_action('wp_head', 'add_wbmz');

function add_wbmz()
{
echo '<meta name="web_author" content="Webmazing" />';
}

function my_login_logo() { ?>
   <style type="text/css">
       #login h1 a, .login h1 a {
           background-image: url('<?php the_field('logo','options');?>');
           padding-bottom: 0px;
           background-size: 80%;
            width: 120px;
            height: 120px;
       }
       #login h1 {
            background: #fff;
            padding-top: 20px;
       }
       .login form {
            margin-top: 0px!important;
            padding: 25px !important;
       }
       #login h1 a {
             margin: 0 auto!important;
       }
       p#backtoblog { display: none;}
       .login label {color: #000 !important; font-weight: bold;}
       .wp-core-ui .button-primary {
           background: #1888bc!important;
		   border: none!important;
		   -webkit-box-shadow: none!important;
		   box-shadow: none!important;
		   color: #fff;
		   text-decoration: none!important;
		   text-shadow: none!important;
       }
       .login #backtoblog a, .login #nav a{
            color: #1888bc !important;
       }
   </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function wbmz_create_post_type() {
	register_post_type('diensten',
        array(
        'labels' => array(
            'name' => __('Diensten', 'wbmz'),
            'singular_name' => __('Dienst', 'wbmz'),
            'add_new' => __('Nieuwe dienst', 'wbmz'),
            'add_new_item' => __('Voeg nieuwe dienst toe', 'wbmz'),
            'edit' => __('Wijzig', 'wbmz'),
            'edit_item' => __('Wijzig dienst', 'wbmz'),
            'new_item' => __('Nieuwe dienst', 'wbmz'),
            'view' => __('Bekijk dienst', 'wbmz'),
            'view_item' => __('Bekijk dienst', 'wbmz'),
            'search_items' => __('Zoek dienst', 'wbmz'),
            'not_found' => __('Geen dienst gevonden', 'wbmz'),
            'not_found_in_trash' => __('Geen dienst gevonden in de prullenbak', 'wbmz')
        ),
        'public' => true,
        'hierarchical' => true,
        'has_archive' => false,
        "rewrite" => array( 'slug' => false, 'with_front'	=> false ),
        'show_in_rest' => true,
        'supports' => array(
          'title',
          'editor',
          'author',
          'excerpt',
          'thumbnail',
          'revisions',
          'title-tag',
          'page-attributes'
        ),
        'can_export' => true
    ));

    register_post_type('producten',
          array(
          'labels' => array(
              'name' => __('Producten', 'wbmz'),
              'singular_name' => __('Product', 'wbmz'),
              'add_new' => __('Nieuw product', 'wbmz'),
              'add_new_item' => __('Voeg nieuw product toe', 'wbmz'),
              'edit' => __('Wijzig', 'wbmz'),
              'edit_item' => __('Wijzig product', 'wbmz'),
              'new_item' => __('Nieuw product', 'wbmz'),
              'view' => __('Bekijk product', 'wbmz'),
              'view_item' => __('Bekijk product', 'wbmz'),
              'search_items' => __('Zoek product', 'wbmz'),
              'not_found' => __('Geen product gevonden', 'wbmz'),
              'not_found_in_trash' => __('Geen product gevonden in de prullenbak', 'wbmz')
          ),
          'public' => true,
          'hierarchical' => true,
          'has_archive' => false,
          'show_in_rest' => true,
          "rewrite" => array( 'slug' => false, 'with_front'	=> false ),
          'supports' => array(
            'title',
            'editor',
            'author',
            'excerpt',
            'thumbnail',
            'revisions',
            'title-tag',
            'page-attributes'
          ),
          'can_export' => true
      ));

      register_post_type('software',
            array(
            'labels' => array(
                'name' => __('Software', 'wbmz'),
                'singular_name' => __('Software', 'wbmz'),
                'add_new' => __('Nieuwe software', 'wbmz'),
                'add_new_item' => __('Voeg nieuwe software toe', 'wbmz'),
                'edit' => __('Wijzig', 'wbmz'),
                'edit_item' => __('Wijzig software', 'wbmz'),
                'new_item' => __('Nieuwe software', 'wbmz'),
                'view' => __('Bekijk software', 'wbmz'),
                'view_item' => __('Bekijk software', 'wbmz'),
                'search_items' => __('Zoek software', 'wbmz'),
                'not_found' => __('Geen software gevonden', 'wbmz'),
                'not_found_in_trash' => __('Geen software gevonden in de prullenbak', 'wbmz')
            ),
            'public' => true,
            'hierarchical' => true,
            'has_archive' => false,
            'show_in_rest' => true,
            "rewrite" => array( 'slug' => false, 'with_front'	=> false ),
            'supports' => array(
              'title',
              'editor',
              'author',
              'excerpt',
              'thumbnail',
              'revisions',
              'title-tag',
              'page-attributes'
            ),
            'can_export' => true
        ));

        register_post_type('trainingen',
              array(
              'labels' => array(
                  'name' => __('Trainingen', 'wbmz'),
                  'singular_name' => __('Training', 'wbmz'),
                  'add_new' => __('Nieuwe training', 'wbmz'),
                  'add_new_item' => __('Voeg nieuwe training toe', 'wbmz'),
                  'edit' => __('Wijzig', 'wbmz'),
                  'edit_item' => __('Wijzig training', 'wbmz'),
                  'new_item' => __('Nieuwe training', 'wbmz'),
                  'view' => __('Bekijk training', 'wbmz'),
                  'view_item' => __('Bekijk training', 'wbmz'),
                  'search_items' => __('Zoek training', 'wbmz'),
                  'not_found' => __('Geen training gevonden', 'wbmz'),
                  'not_found_in_trash' => __('Geen training gevonden in de prullenbak', 'wbmz')
              ),
              'public' => true,
              'hierarchical' => true,
              'has_archive' => false,
              'show_in_rest' => true,
              "rewrite" => array( 'slug' => false, 'with_front'	=> false ),
              'supports' => array(
                'title',
                'editor',
                'author',
                'excerpt',
                'thumbnail',
                'revisions',
                'title-tag',
                'page-attributes'
              ),
              'can_export' => true
          ));

        register_post_type('vacatures',
              array(
              'labels' => array(
                  'name' => __('Vacatures', 'wbmz'),
                  'singular_name' => __('Vacatures', 'wbmz'),
                  'add_new' => __('Nieuwe vacature', 'wbmz'),
                  'add_new_item' => __('Voeg nieuwe vacature toe', 'wbmz'),
                  'edit' => __('Wijzig', 'wbmz'),
                  'edit_item' => __('Wijzig vacature', 'wbmz'),
                  'new_item' => __('Nieuwe vacature', 'wbmz'),
                  'view' => __('Bekijk vacature', 'wbmz'),
                  'view_item' => __('Bekijk vacature', 'wbmz'),
                  'search_items' => __('Zoek vacature', 'wbmz'),
                  'not_found' => __('Geen vacature gevonden', 'wbmz'),
                  'not_found_in_trash' => __('Geen vacature gevonden in de prullenbak', 'wbmz')
              ),
              'public' => true,
              'hierarchical' => true,
              'has_archive' => false,
              'show_in_rest' => true,
              "rewrite" => array( 'slug' => false, 'with_front'	=> false ),
              'supports' => array(
                'title',
                'editor',
                'author',
                'excerpt',
                'thumbnail',
                'revisions',
                'title-tag',
                'page-attributes'
              ),
              'can_export' => true
          ));

          register_post_type('team',
                array(
                'labels' => array(
                    'name' => __('Team', 'wbmz'),
                    'singular_name' => __('Collega', 'wbmz'),
                    'add_new' => __('Nieuwe collega', 'wbmz'),
                    'add_new_item' => __('Voeg nieuwe collega toe', 'wbmz'),
                    'edit' => __('Wijzig', 'wbmz'),
                    'edit_item' => __('Wijzig collega', 'wbmz'),
                    'new_item' => __('Nieuwe collega', 'wbmz'),
                    'view' => __('Bekijk collega', 'wbmz'),
                    'view_item' => __('Bekijk collega', 'wbmz'),
                    'search_items' => __('Zoek collega', 'wbmz'),
                    'not_found' => __('Geen collega gevonden', 'wbmz'),
                    'not_found_in_trash' => __('Geen collega gevonden in de prullenbak', 'wbmz')
                ),
                'public' => true,
                'hierarchical' => true,
                'has_archive' => false,
                'show_in_rest' => true,
                "rewrite" => array( 'slug' => false, 'with_front'	=> false ),
                'supports' => array(
                  'title',
                  'editor',
                  'author',
                  'excerpt',
                  'thumbnail',
                  'revisions',
                  'title-tag',
                  'page-attributes'
                ),
                'can_export' => true
            ));

/*
    register_taxonomy("dienst_cats",
    array("diensten"),
    array(
    	"hierarchical" => true,
    	"label" => "Categorieën",
    	"singular_label" => "Categorie",
    	"rewrite" => array( 'slug' => 'diensten', 'hierarchical' => false ),
    	"show_admin_column" => true
    	));
 */
}
add_action('init', 'wbmz_create_post_type');

// Zet de widget block editor uit
function example_theme_support() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'example_theme_support' );
