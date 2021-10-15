<?php
/**
 * Template Name: Home
 **/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header(); ?>
<div class="container-fluid cntnt py-2 py-md-5">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2>Onze software</h2>
      </div>
    </div>
    <div class="row sldrsftwr">
    <?php

    the_content();
    $args = array(
      'post_type'		=> 'software',
      'posts_per_page'	=> 3
    );

    $posts = new WP_Query($args);
    $count = 0;
    if($posts->have_posts()):?>
    <?php while($posts->have_posts()): $count++; $posts->the_post(); ?>
      <div class="col-12 col-md-6">
        <div class="whtblck m-1">
          <div class="row">
            <div class="col-12 col-md-5">
              <?php the_post_thumbnail('medium', ['class' => 'w-100']); ?>
            </div>
            <div class="col-12 col-md-7">
              <div class="p-1">
                <h3><a class="stretched-link" href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                <p class="card-text"><?php the_field('intro_tekst_software'); ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile; wp_reset_query(); ?>
    <?php endif; ?>
    </div>
  </div>
</div>
<div class="container-fluid prdctn py-2 py-md-5">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2>Onze producten</h2>
			</div>
		</div>
    <?php
    $args = array(
      'post_type'		=> 'producten',
      'posts_per_page'	=> -1
    );
    $posts = new WP_Query($args);
    $count = 0;
    if($posts->have_posts()):?>
    <div class="row d-flex">
    <div class="sldr col-12 col-md-8 order-last order-md-first">
      <?php while($posts->have_posts()): $count++; $posts->the_post(); ?>
      <div class="sld" id="prdct<?php echo get_the_ID(); ?>">
        <?php if(get_field('logo')):?>
          <img src="<?php the_field('logo'); ?>" alt="<?php the_title(); ?>" class="mb-1"/>
        <?php endif; ?>
        <h3><?php the_title(); ?></h3>
        <?php the_field('intro_tekst_product'); ?>
        <a href="<?php the_permalink(); ?>" class="btn btn-primary">Lees verder</a>
      </div>
      <?php endwhile; wp_reset_query(); $count = 0; ?>
    </div>
    <div class="sldrnv col-12 col-md-4 order-first order-md-last">
      <?php while($posts->have_posts()): $count++; $posts->the_post(); ?>
        <div class="sld" id="prdct<?php echo get_the_ID(); ?>">
          <i class="fas fa-arrow-left d-none d-md-inline-block"></i><i class="fas fa-arrow-down d-inline-block d-md-none"></i> <?php the_title(); ?>
        </div>
      <?php endwhile; wp_reset_query(); ?>
    </div>
  </div>
  <?php endif; ?>
  <div class="vrly" style="z-index: -1; opacity: 1; background:url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/bg_producten.png') no-repeat center center; background-size: cover;"></div>
  </div>
</div>
<div class="container-fluid cntct py-2 py-md-5">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-3">
        <img src="<?php the_field('foto_contactblok','options');?>" alt="Contact Xantara-it" />
			</div>
      <div class="col-12 col-md-7 offset-md-2 mt-1 mt-md-0">
        <h2>Vragen of vrijblijvende offerte?</h2>
        <h3>Bel of mail ons voor meer informatie</h3>
        <div class="row mt-1 mt-md-3 btns">
          <div class="col-12 col-sm-6 col-md-4">
            <a href="tel:<?php the_field('telefoon_contactblok','options');?>"><i class="fas fa-phone-alt"></i> <?php the_field('telefoon_contactblok','options');?></a>
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <a href="mailto:<?php the_field('email_contactblok','options');?>"><i class="fas fa-envelope"></i> <?php the_field('email_contactblok','options');?></a>
          </div>
        </div>
			</div>
		</div>
  </div>
</div>
<div class="container-fluid dnstn py-2 py-md-5">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2>Onze diensten</h2>
			</div>
		</div>
    <?php
    $args = array(
      'post_type'		=> 'diensten',
      'posts_per_page'	=> -1
    );
    $posts = new WP_Query($args);
    $count = 0;
    if($posts->have_posts()):?>
    <div class="row d-flex">
    <div class="sldr col-12 col-md-8 order-last order-md-first">
      <?php while($posts->have_posts()): $count++; $posts->the_post(); ?>
      <div class="sld" id="prdct<?php echo get_the_ID(); ?>">
        <?php if(get_field('logo')):?>
          <img src="<?php the_field('logo'); ?>" alt="<?php the_title(); ?>" class="mb-1"/>
        <?php endif; ?>
        <h3><?php the_title(); ?></h3>
        <?php the_field('intro_tekst_dienst'); ?>
        <a href="<?php the_permalink(); ?>" class="btn btn-seconday">Lees verder</a>
      </div>
      <?php endwhile; wp_reset_query(); $count = 0; ?>
    </div>
    <div class="sldrnv col-12 col-md-4 order-first order-md-last">
      <?php while($posts->have_posts()): $count++; $posts->the_post(); ?>
        <div class="sld" id="prdct<?php echo get_the_ID(); ?>">
          <i class="fas fa-arrow-left d-none d-md-inline-block"></i><i class="fas fa-arrow-down d-inline-block d-md-none"></i> <?php the_title(); ?>
        </div>
      <?php endwhile; wp_reset_query(); ?>
    </div>
  </div>
  <?php endif; ?>
  <div class="vrly" style="z-index: -1; opacity: 1; background:url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/bg_diensten.png') no-repeat center center; background-size: cover;"></div>
  </div>
</div>
<div class="container-fluid knnsbnk py-2 py-md-5">
  <div class="container">
    <div class="row d-flex align-items-center">
      <div class="col-12 col-md-8">
        <h2>Onze kennisbank</h2>
			</div>
      <div class="col-md-4 text-end d-none d-md-block">
        <a href="/kennisbank/"><u>Naar de volledige kennisbank</u></a>
			</div>
		</div>
    <?php
    $args = array(
      'post_type'		=> 'post',
      'posts_per_page'	=> 8
    );
    $posts = new WP_Query($args);
    $count = 0;
    if($posts->have_posts()):?>
    <div class="row mt-2">
      <?php while($posts->have_posts()): $count++; $posts->the_post(); ?>
      <div class="col-12 col-md-6">
        <div class="knsrtl">
          <a href="<?php the_permalink(); ?>"><i class="fas fa-circle"></i> <?php the_title(); ?></a>
        </div>
      </div>
    <?php endwhile; wp_reset_query(); ?>
    </div>
  <?php endif; ?>
  <div class="row mt-2 d-block d-md-none">
    <div class="col-12">
      <a href="/kennisbank/" class="btn btn-primary">Naar de kennisbank</a>
    </div>
  </div>
  </div>
</div>
<div class="container-fluid vctrs py-2 py-md-5">
  <div class="container">
    <div class="row d-flex align-items-center">
      <div class="col-12 col-md-8">
        <h2>Xantara-it zoekt</h2>
			</div>
      <div class="col-md-4 text-end d-none d-md-block">
        <a href="/vacatures/"><u>Alle vacatures</u></a>
			</div>
		</div>
    <div class="row my-2">
    <?php

    the_content();
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
    <div class="row d-flex align-items-center justify-content-center">
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
    <div class="row mt-2 d-block d-md-none">
      <div class="col-12">
        <a href="/vacatures/" class="btn btn-primary">Alle vacatures</a>
      </div>
    </div>
  </div>
</div>
<?php get_footer();
