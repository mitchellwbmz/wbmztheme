<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>
<div class="container-fluid py-2">
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
