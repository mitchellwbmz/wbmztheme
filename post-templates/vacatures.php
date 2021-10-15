<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( have_posts() ) :
    while ( have_posts() ) : the_post(); ?>
<div class="container-fluid cntnt py-2">
    <div class="container bg-light">
        <div class="row">
            <div class="col-md-8">
                <?php

                the_content();

                edit_post_link( __( 'Bewerken', 'wbmz' ), '<p class="text-right">', '</p>' );

                // If comments are open or we have at least one comment, load up the comment template.
                if (!get_theme_mod("singlepost_disable_comments")) if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }

                ?>

            </div>
            <div class="col-md-4">
              <div class="prdctnf p-2">
              <?php $gekoppelde_producten_posts = get_field('gekoppelde_producten');
              if( $gekoppelde_producten_posts ): ?>
                  <h3>Gerelateerde producten</h3>
                    <ul>
                    <?php foreach( $gekoppelde_producten_posts as $post ):
                        setup_postdata($post); ?>
                        <li>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                    <?php wp_reset_postdata(); ?>
                  <?php wp_reset_postdata();
                  echo '<hr class="my-1 my-md-1"/>';
              endif; ?>
              <?php $gekoppelde_diensten_posts = get_field('gekoppelde_diensten');
              if( $gekoppelde_diensten_posts ): ?>
              <h3>Gerelateerde diensten</h3>
                  <ul>
                  <?php foreach( $gekoppelde_diensten_posts as $post ):
                      setup_postdata($post); ?>
                      <li>
                          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                      </li>
                  <?php endforeach; ?>
                  </ul>
                  <?php wp_reset_postdata(); ?>
              <?php endif; ?>
            </div>
            </div>
        </div>
    </div>
</div>
<?php
    endwhile;
 else :
     _e( 'Sorry, no posts matched your criteria.', 'wbmz' );
 endif;
 if(get_field('functie_eisen')):
 ?>
<div class="container-fluid alt py-2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php the_field('functie_eisen'); ?>
            </div>
        </div>
    </div>
</div>
<?php endif; 
if(get_field('wat_bieden_wij_jou')):
 ?>
<div class="container-fluid py-2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php the_field('wat_bieden_wij_jou'); ?>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid vctrs py-2">
    <div class="container">
        <div class="row mt-1">
            <div class="col-12 col-md-8">
                <h3>Solliciteren</h3>
                <?php echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="true" tabindex="768783"]'); ?>
            </div>
            <div class="col-12 col-md-4 d-flex align-items-center">
                <figure>
                      <blockquote class="blockquote">
                        <p><?php the_field('quote_tekst');?></p>
                      </blockquote>
                      <figcaption class="blockquote-footer">
                        <cite title="Source Title"><?php the_field('quote_medewerker');?></cite>  <img src="<?php the_field('quote_foto');?>" style="max-width: 40px; border-radius: 50%; margin-left: 15px;" alt="<?php the_field('quote_medewerker');?>"/>
                      </figcaption>
                    </figure>
            </div>
        </div>
    </div>
</div>
<?php endif;
