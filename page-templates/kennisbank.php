<?php
/**
 * Template Name: Kennisbank
 **/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header(); ?>

<div class="container-fluid cntnt py-2">
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
<div class="container-fluid knnsbnk py-2">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-9">
				<?php
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$args = array(
				  'post_type'		=> 'post',
				  'posts_per_page'	=> 5,
				  'paged' => $paged
				);
				$posts = new WP_Query($args);
				$count = 0;
				if($posts->have_posts()):?>
		  	  	<?php while($posts->have_posts()): $count++; $posts->the_post(); ?>
				<div class="knsrtl">
				  <a href="<?php the_permalink(); ?>"><i class="fas fa-circle"></i> <?php the_title(); ?></a>
				</div>
				<?php endwhile; wp_reset_query(); endif; 
				echo wbmz_pagination(); ?>
			</div>
			<div class="col-12 col-md-3">
				<?php dynamic_sidebar( 'sidebar' ); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer();
