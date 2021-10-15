<?php
/**
 * Template Name: Contact
 **/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header(); ?>
<div class="container-fluid cntct py-2">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-9">
        <h2>Vragen of vrijblijvende offerte?</h2>
        <p>Vul onderstaand contactformulier in om contact met ons op te nemen.</p>
        <?php echo do_shortcode('[gravityform id="2" title="false" description="false" ajax="true" tabindex="87484944"]'); ?>
			</div>
			<div class="col-12 col-md-3">
				<img src="<?php the_field('foto_contactblok','options');?>" alt="Contact Xantara-it" />
				<br/><br/>
				<?php dynamic_sidebar( 'footer_vier' ); ?>
			</div>
		</div>
  </div>
</div>
<div class="container-fluid cntnt  py-2">
	<div class="container">
	    <div class="row">
	        <div class="col-12">
	            <?php

	            if ( have_posts() ) :
	                while ( have_posts() ) : the_post();
	                    the_content();
	                endwhile;
	            else :
	                _e( 'Er is niets te vinden.', 'wbmz' );
	            endif;
	            ?>
	        </div>
	    </div>
	</div>
</div>
<?php get_footer();
