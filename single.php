<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$posttype = get_post_type();
if ( false === get_template_part( "post-templates/{$posttype}" )) {

if ( have_posts() ) :
    while ( have_posts() ) : the_post(); ?>
<div class="container-fluid cntnt py-2">
    <div class="container bg-light">
        <div class="row text-center">

            <div class="col-md-12">
                <?php
                //CATS
                if (!get_theme_mod("singlepost_disable_entry_cats") &&  has_category() ) {
                        ?>
                        <div class="entry-categories">
                            <span class="screen-reader-text"><?php _e( 'Categories', 'wbmz' ); ?></span>
                            <div class="entry-categories-inner">
                                <?php the_category( ' ' ); ?>
                            </div>
                        </div>
                        <?php
                }

                ?>

                <?php if (!get_theme_mod("singlepost_disable_entry_meta") ): ?>
                    <div class="post-meta" id="single-post-meta">
                        <p class="display-5 text-secondary">
                            <span class="post-date"><?php the_date(); ?> </span>
                            <span class="text-secondary post-author"> <?php _e( 'by', 'wbmz' ) ?> <?php the_author(); ?></span>
                        </p>
                    </div>
                <?php endif; ?>

            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <?php

                the_content();

                edit_post_link( __( 'Edit this post', 'wbmz' ), '<p class="text-right">', '</p>' );

                // If comments are open or we have at least one comment, load up the comment template.
                if (!get_theme_mod("singlepost_disable_comments")) if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }

                ?>

            </div><!-- /col -->
        </div>
    </div>
</div>
<?php
    endwhile;
 else :
     _e( 'Sorry, no posts matched your criteria.', 'wbmz' );
 endif;
 };
get_footer();
