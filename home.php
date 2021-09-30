<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

?>
<div class="container-fluid cntnt">
  <div class="container">
    <div class="row">
    <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();

              get_template_part('loops/cards');

            endwhile;
        else :
            _e( 'Sorry, no posts matched your criteria.', 'textdomain' );
        endif;
        ?>
    </div>
  </div>
</div>

<?php get_footer();
