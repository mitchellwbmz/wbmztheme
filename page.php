<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>
<div class="container-fluid cntnt">
	<div class="container">
	    <div class="row">
	        <div class="col-md-10 offset-md-1 py-5">
	            <?php 
	
	            if ( have_posts() ) : 
	                while ( have_posts() ) : the_post();
	                    the_content();
	                endwhile;
	            else :
	                _e( 'Sorry, no posts matched your criteria.', 'textdomain' );
	            endif;
	            ?>
	        </div>
	    </div>
	</div>
</div>

<?php get_footer();
