<?php
/**
 * Template Name: Vacatures
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
<div class="container-fluid vctrs py-2 py-md-5">
  <div class="container">
    <div class="row">
    <?php
    $args = array(
      'post_type'		=> 'vacatures',
      'posts_per_page'	=> 2
    );

    $posts = new WP_Query($args);
    $count = 0;
    if($posts->have_posts()):?>
    <?php while($posts->have_posts()): $count++; $posts->the_post(); ?>
      <div class="col-12 col-md-6 mb-1 mb-md-0">
        <div class="vctr p-1">
          <h3><a href="<?php the_permalink() ?>"><?php the_title() ?> <i class="fas fa-arrow-right float-end"></i></a></h3>
        </div>
      </div>
      <?php endwhile; wp_reset_query(); ?>
    <?php endif; ?>
    </div>
    <div class="row d-flex align-items-center justify-content-center mt-2">
      <div class="col-2">
        <img src="/wp-content/uploads/2021/09/Paul-xantara-it.jpg" alt="Paul Kaijser, Database specialst"/>
      </div>
      <div class="col-10 col-md-7 offset-md-1">
        <figure>
          <blockquote class="blockquote">
            <p>Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Nulla vitae elit libero, a pharetra augue. Maecenas faucibus mollis interdum. Donec ullamcorper nulla non metus auctor fringilla. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
          </blockquote>
          <figcaption class="blockquote-footer">
            Paul Kaijser<cite title="Source Title">Database specialist</cite>
          </figcaption>
        </figure>
      </div>
    </div>
  </div>
</div>
<?php get_footer();