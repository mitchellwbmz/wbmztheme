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
              <?php $gekoppelde_software_posts = get_field('gekoppelde_software');
              if( $gekoppelde_software_posts ): ?>
                  <div class="text-center">
                  <?php foreach( $gekoppelde_software_posts as $post ):
                      setup_postdata($post); ?>
                      <img src="<?php the_field('logo');?>" alt="<?php the_title(); ?>" class="w-100 mt-n10"/> <?php
                      //the_post_thumbnail('medium', ['class' => 'w-100 mt-n10']);
                      //the_field('intro_tekst_software'); ?>
                          <a href="<?php the_permalink(); ?>" class="btn btn-primary-darkbg"><?php the_field('button_tekst'); ?></a>
                  <?php endforeach; ?>
                  </div>
                  <?php wp_reset_postdata();
                echo '<hr class="my-1 my-md-3"/>';
                endif; ?>
              <?php $gekoppelde_trainingen_posts = get_field('gekoppelde_trainingen');
              $extra_tekst_trainingen = get_field('extra_tekst_trainingen');
              if( $gekoppelde_trainingen_posts ):
                echo '<h3>'.get_the_title().' trainingen</h3>';
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
                  <hr class="my-1 my-md-3"/>
              <?php endif; ?>
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
 ?>
 <div class="container-fluid prdctnsngl py-2 bg-grey">
   <div class="container">
     <div class="row mb-2">
       <div class="col-12">
         <h2>Onze andere producten</h2>
       </div>
     </div>
     <?php
     $args = array(
       'post_type'		=> 'producten',
       'posts_per_page'	=> -1,
       'post__not_in' => array(get_the_ID())
     );
     $posts = new WP_Query($args);
     $count = 0;
     if($posts->have_posts()):?>
     <div class="row d-flex">
       <?php while($posts->have_posts()): $count++; $posts->the_post(); ?>
       <div class="col-12 col-sm-6 col-md-4 mb-2">
         <div class="whtblck py-2 px-1 h-100" id="prdct<?php echo get_the_ID(); ?>">
           <?php if(get_field('logo')):?>
             <div class="text-center">
               <img src="<?php the_field('logo'); ?>" alt="<?php the_title(); ?>" class="mb-1"/>
             </div>
           <?php endif; ?>
           <h3><?php the_title(); ?></h3>
           <div class="eq" style="margin-bottom: 15px;">
             <?php the_field('intro_tekst_product'); ?>
           </div>
           <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary">Lees verder</a>
         </div>
       </div>
       <?php endwhile; wp_reset_query(); $count = 0; ?>
     </div>
   <?php endif; ?>
   </div>
 </div>



<?php get_footer();
