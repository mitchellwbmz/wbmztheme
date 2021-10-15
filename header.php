<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


?><!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <?php if(get_the_post_thumbnail()):?>
		<link rel="preload" as="image" href="<?php the_post_thumbnail_url();?>" />
		<?php endif; ?>
		<?php if(get_field('header_afbeelding')): ?>
		<link rel="preload" as="image" href="<?php the_field('header_afbeelding');?>" />
		<?php else: ?>
		<link rel="preload" as="image" href="<?php the_field('vervolg_header','options');?>" />
		<?php endif; ?>
  </head>
  <body <?php body_class(); ?> >
    <?php wp_body_open(); ?>
    <?php if(get_field('contactblok_tonen','options')):?>
      <a class="cntctlnk" data-bs-toggle="offcanvas" href="#contactblok" role="button" aria-controls="contactblok"><i class="fas fa-phone-alt"></i></a>
      <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="contactblok" aria-labelledby="ContactBlok">
        <div class="offcanvas-header">
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="offcanvas-body">
          <img src="<?php the_field('foto_contactblok','options');?>" alt="Contact Xantara-it"/>
          <div class="p-1">
            <?php the_field('titel_contactblok','options');?>
            <div class="mt-1 btns">
              <a href="tel:<?php the_field('telefoon_contactblok','options');?>"><i class="fas fa-phone-alt"></i> <?php the_field('telefoon_contactblok','options');?></a> <a href="mailto:<?php the_field('email_contactblok','options');?>"><i class="fas fa-envelope"></i> <?php the_field('email_contactblok','options');?></a>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <?php if(function_exists('lc_custom_header')) lc_custom_header(); else {

      if (get_theme_mod("enable_topbar") ) : ?>
        <div id="wrapper-topbar" class="py-2 <?php echo get_theme_mod('topbar_bg_color_choice','bg-light') ?> <?php echo get_theme_mod('topbar_text_color_choice','text-dark') ?>">
          <div class="container">
            <div class="row">
              <div id="topbar-content" class="col-md-12 text-left text-center text-md-left small"> <?php echo do_shortcode(get_theme_mod('topbar_content')) ?>	</div>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">

          <a class="skip-link visually-hidden-focusable" href="#theme-main"><?php esc_html_e( 'Skip to content', 'wbmz' ); ?></a>


          <nav class="navbar navbar-expand-lg <?php echo get_theme_mod('wbmz_header_navbar_position')." ". get_theme_mod('wbmz_header_navbar_color_scheme','navbar-dark').' '. get_theme_mod('wbmz_header_navbar_color_choice','bg-dark'); ?>" aria-label="Main Navigation" >
            <div class="container">
              <div id="logo-tagline-wrap">

                  <?php if ( ! has_custom_logo() ) { ?>

                    <?php if ( is_front_page() && is_home() ) : ?>

                      <div class="navbar-brand mb-0 h3"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></div>

                    <?php else : ?>

                      <a class="navbar-brand h3" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

                    <?php endif; ?>


                  <?php } else {
                    the_custom_logo();
                  } ?>


                  <?php if (!get_theme_mod('header_disable_tagline')): ?>
                    <small id="top-description" class="text-muted d-none d-md-inline-block">
                      <?php bloginfo("description") ?>
                    </small>
                  <?php endif ?>


                  </div>

              <button class="navbar-toggler" type="button" id="nav-icon3" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <?php  wp_nav_menu( array(
                    'theme_location'    => 'primary',
                    'depth'             => 2,
                    'container'         => '',
                    'container_class'   => '',
                    'container_id'      => '',
                    'menu_class'        => 'navbar-nav ms-auto mb-2 mb-lg-0',
                    'menu_id'         => 'main-menu',
                    'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                    'walker'            => new WP_Bootstrap_Navwalker(),
                ) );

                ?>
                <form hidden>
                  <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                </form>
              </div>
            </div>
          </nav> <!-- .site-navigation -->

        </div><!-- #wrapper-navbar end -->


    <?php
    } // END ELSE CASE
    ?>
<?php
				if(get_field('header_afbeelding')):
					$bghdr = get_field('header_afbeelding');
				else:
					$bghdr = get_field('vervolg_header','options');
				endif;
	    ?>
	    	 <div class="container-fluid hdr <?php if(is_page_template('page-templates/home.php')):?>py-2 py-md-10<?php else: ?>py-2 py-md-8<?php endif; ?>">
				    <div class="container">
					    <div class="row d-flex justify-content-center">
						    <div class="col-12 col-md-8">
									<?php if(get_field('aangepaste_titel')):?>
									<h1><?php the_field('titel_aangepast'); ?></h1>
									<?php else: ?>
									<h1><?php the_title(); ?></h1>
									<?php endif; ?>
									<?php if(get_field('intro_tekst')):?>
										<p><?php the_field('intro_tekst'); ?></p>
									<?php endif; ?>
									<?php if(get_field('button_tonen_header')):?>
										<a class="btn btn-primary" href="<?php the_field('button_link_header'); ?>"><?php the_field('button_tekst_header'); ?></a>
									<?php endif; ?>
						    </div>
					    </div>
				    </div>
						<div class="vrly" style="z-index: -2; background:url('<?php echo $bghdr; ?>') no-repeat center center; background-size: cover;"></div>
						<?php if(is_page_template('page-templates/home.php')):?>
 					 	<div class="vrly" style="z-index: -1; opacity: 0.9; background:url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/bg_header_home.png') no-repeat center center; background-size: cover;"></div>
					 <?php else: ?>
						 <div class="vrly" style="z-index: -1; opacity: 0.1; background:url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/bg_header.png') no-repeat center center; background-size: cover;"></div>
					 <?php endif; ?>
	      </div>
	      <?php if(!is_page_template('page-templates/home.php')):?>
		<div class="container-fluid brdcrmbs">
			<div class="container breadcrumbs-container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<?php
						if ( function_exists('yoast_breadcrumb') ) :
						if(is_singular( 'post' )):?>
							<div class="breadcrumbs">
							<p id="breadcrumbs"><span xmlns:v="http://rdf.data-vocabulary.org/#"><span typeof="v:Breadcrumb"><a href="/" rel="v:url" property="v:title">Home</a> &gt; <span rel="v:child" typeof="v:Breadcrumb"><a href="/nieuws/" rel="v:url" property="v:title">Nieuws</a> &gt; <span class="breadcrumb_last"><?php the_title();?></span></span></span></span></p>
						</div>
						<?php elseif(is_singular('podst')):?>
						<div class="breadcrumbs">
							<p id="breadcrumbs"><span xmlns:v="http://rdf.data-vocabulary.org/#"><span typeof="v:Breadcrumb"><a href="/" rel="v:url" property="v:title">Home</a> &gt; <span rel="v:child" typeof="v:Breadcrumb"><a href="/nieuws/" rel="v:url" property="v:title">Nieuws</a> &gt; <span class="breadcrumb_last"><?php the_title();?></span></span></span></span></p>
						</div>
						<?php
						else :
						yoast_breadcrumb('<p id="breadcrumbs">','</p>');
						endif;
						endif;
						?>
					</div>
				</div>
			</div>
		 </div>
		<?php endif; ?>
<main id='theme-main'>
