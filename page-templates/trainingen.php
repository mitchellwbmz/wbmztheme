<?php
/**
 * Template Name: Trainingen
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
<div class="container-fluid py-2">
  <div class="container">
    <div class="row mb-2">
      <div class="col-12">
        <h2>Actuele trainingen</h2>
      </div>
    </div>
    <?php
    $args = array(
      'post_type'		=> 'trainingen',
      'posts_per_page'	=> 2
    );

    $posts = new WP_Query($args);
    $count = 0;
    if($posts->have_posts()):?>
    <?php while($posts->have_posts()): $count++; $posts->the_post(); ?>
    <div class="row mb-1">
      <div class="col-12 trng">
        <h3><?php the_title(); ?></h3>
        <?php the_excerpt(); ?>
      </div>
    </div>
      <?php endwhile; wp_reset_query(); ?>
    <?php endif; ?>
  </div>
</div>
<?php get_footer();