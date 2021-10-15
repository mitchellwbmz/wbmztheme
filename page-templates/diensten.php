<?php
/**
 * Template Name: Diensten
 **/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header(); ?>
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
<div class="container-fluid prdctnsngl py-2 py-md-5 bg-grey">
  <div class="container">
    <?php
    $args = array(
      'post_type'		=> 'diensten',
      'posts_per_page'	=> -1
    );
    $posts = new WP_Query($args);
    $count = 0;
    if($posts->have_posts()):?>
    <div class="row d-flex">
      <?php while($posts->have_posts()): $count++; $posts->the_post(); ?>
      <div class="col-12 col-sm-6 col-md-4 mb-2">
        <div class="whtblck py-2 px-1 h-100" id="dnst<?php echo get_the_ID(); ?>">
          <?php if(get_field('logo')):?>
            <div class="text-center">
              <img src="<?php the_field('logo'); ?>" alt="<?php the_title(); ?>" class="mb-1"/>
            </div>
          <?php endif; ?>
          <h3><?php the_title(); ?></h3>
          <div class="eq" style="margin-bottom: 15px;">
            <?php the_field('intro_tekst_dienst'); ?>
          </div>
          <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary">Lees verder</a>
        </div>
      </div>
      <?php endwhile; wp_reset_query(); $count = 0; ?>
    </div>
  <?php endif; ?>
  </div>
</div>
<div class="container-fluid cntct py-2 py-md-5">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-3">
        <img src="<?php the_field('foto_contactblok','options');?>" alt="Contact Xantara-it" />
			</div>
      <div class="col-12 col-md-7 offset-md-2 mt-1 mt-md-0">
        <h2>Vragen of vrijblijvende offerte?</h2>
        <h3>Bel of mail ons voor meer informatie</h3>
        <div class="row mt-1 mt-md-3 btns">
          <div class="col-12 col-sm-6 col-md-4">
            <a href="tel:<?php the_field('telefoon_contactblok','options');?>"><i class="fas fa-phone-alt"></i> <?php the_field('telefoon_contactblok','options');?></a>
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <a href="mailto:<?php the_field('email_contactblok','options');?>"><i class="fas fa-envelope"></i> <?php the_field('email_contactblok','options');?></a>
          </div>
        </div>
			</div>
		</div>
  </div>
</div>
<?php /*
<div class="container-fluid knnsbnk py-2 py-md-5">
  <div class="container">
    <div class="row d-flex align-items-center">
      <div class="col-12 col-md-8">
        <h2>Onze kennisbank</h2>
			</div>
      <div class="col-md-4 text-end d-none d-md-block">
        <a href="/kennisbank/"><u>Naar de volledige kennisbank</u></a>
			</div>
		</div>
    <?php
    $args = array(
      'post_type'		=> 'post',
      'posts_per_page'	=> 8
    );
    $posts = new WP_Query($args);
    $count = 0;
    if($posts->have_posts()):?>
    <div class="row mt-2">
      <?php while($posts->have_posts()): $count++; $posts->the_post(); ?>
      <div class="col-12 col-md-6">
        <div class="knsrtl">
          <a href="<?php the_permalink(); ?>"><i class="fas fa-circle"></i> <?php the_title(); ?></a>
        </div>
      </div>
    <?php endwhile; wp_reset_query(); ?>
    </div>
  <?php endif; ?>
  <div class="row mt-2 d-block d-md-none">
    <div class="col-12">
      <a href="/kennisbank/" class="btn btn-primary">Naar de kennisbank</a>
    </div>
  </div>
  </div>
</div>
*/
get_footer();
