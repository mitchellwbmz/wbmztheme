<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

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
                  <div class="text-center">
                  <?php foreach( $gekoppelde_producten_posts as $post ):
                      setup_postdata($post); ?>
                      <img src="<?php the_field('logo');?>" alt="<?php the_title(); ?>" class="w-100"/> <?php
                      //the_post_thumbnail('medium', ['class' => 'w-100 mt-n10']);
                      //the_field('intro_tekst_software'); ?>
                          <a href="<?php the_permalink(); ?>" class="btn btn-primary-darkbg">Meer informatie</a>
                  <?php endforeach; ?>
                  </div>
                  <?php wp_reset_postdata();
                  echo '<hr class="my-1 my-md-3"/>';
              endif; ?>
              <?php $gekoppelde_trainingen_posts = get_field('gekoppelde_trainingen');
              $extra_tekst_trainingen = get_field('extra_tekst_trainingen');
              if( $gekoppelde_trainingen_posts ):
                echo '<h3>Trainingen</h3>';
                echo $extra_tekst_trainingen;?>
                  <ul>
                  <?php foreach( $gekoppelde_trainingen_posts as $post ):
                      setup_postdata($post); ?>
                      <li>
                          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                      </li>
                  <?php endforeach; ?>
                  </ul>
                  <?php wp_reset_postdata(); ?>
              <?php endif; ?>
              <?php $gekoppelde_diensten_posts = get_field('gekoppelde_diensten');
              if( $gekoppelde_diensten_posts ): ?>
              <hr class="my-1 my-md-3"/>
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
 ?>




<?php get_footer();
