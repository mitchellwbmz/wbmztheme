</main>
		<div class="container-fluid ftr py-2">
			<div class="container">
				<div class="row">
					<div class="col-12 col-md-3">
						<?php dynamic_sidebar( 'footer_een' ); ?>
					</div>
					<div class="col-12 col-md-3">
						<?php dynamic_sidebar( 'footer_twee' ); ?>
					</div>
					<div class="col-12 col-md-3">
						<?php dynamic_sidebar( 'footer_drie' ); ?>
					</div>
					<div class="col-12 col-md-3">
						<?php dynamic_sidebar( 'footer_vier' ); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid ftrbtm pb-1">
			<div class="container">
				<div class="row">
					<div class="col-12 text-center">
						<?php $disclaimer = get_field('disclaimer_tonen','options');
							$disclaimer_link = get_field('disclaimer_link','options');
							$algemenevoorw = get_field('algemene_voorwaarden_tonen','options');
							$algemenevoorw_link = get_field('algemene_voorwaarden_link','options');
							$privacypol = get_field('privacy_policy_tonen','options');
							$privacypol_link = get_field('privacy_policy_link','options'); ?>
						&copy; Copyright <?php the_date('Y');?>  <?php bloginfo('name'); ?> | <?php if($privacypol):?><a href="<?php echo $privacypol_link; ?>" target="blank">Privacy Statement</a> |<?php endif; ?> <?php if($disclaimer):?><a href="<?php echo $disclaimer_link; ?>" target="blank">Disclaimer</a> |<?php endif; ?> <?php if($algemenevoorw):?><a href="<?php echo $algemenevoorw_link; ?>" target="blank">Algemene voorwaarden</a> |<?php endif; ?> Website: <a href="https://www.webmazing.nl" target="_blank">Webmazing</a>
					</div>
				</div>
			</div>
		</div>


	<?php wp_footer(); ?>
	<script src="https://kit.fontawesome.com/ec8e43c269.js" crossorigin="anonymous"></script>
	<script src="//code.jquery.com/jquery-3.6.0.slim.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
	<?php if (get_field('eq_script_laden','options')):?>
	<script>
	jQuery(function() {
	<?php if ( have_rows( 'equal_height_classes', 'option' ) ) : ?>
		<?php while ( have_rows( 'equal_height_classes', 'option' ) ) : the_row(); ?>
			$('.<?php the_sub_field( 'class' ); ?>').matchHeight();
		<?php endwhile; ?>
	<?php else : ?>
	<?php endif; ?>
	});
	</script>
	<?php endif; ?>
	<script>
	 jQuery(document).ready(function($){
		  $('.sldrsftwr').slick({
		  	 centerMode: false,
		  	 autoplay: true,
		  	 autoplaySpeed: 7000,
		  	 speed: '1000',
		  	 centerPadding: '32%',
				 prevArrow:"<div class='slick-prev'><i class='fas fa-chevron-left'></i></div>",
         nextArrow:"<div class='slick-next'><i class='fas fa-chevron-right'></i></div>",
		  	 dots: false,
         slidesToShow: 2,
		  	 pauseOnHover: true,
		  	 adaptiveHeight: false,
		  	 infinite: true,
		  	 fade: false,
		  	 slidesToScroll: 1,
         responsive: [
			    {
			      breakpoint: 1024,
			      settings: {
			        slidesToShow: 2,
			        slidesToScroll: 1,
			        dots: false
			      }
			    },
			    {
			      breakpoint: 600,
			      settings: {
			        slidesToShow: 2,
			        dots: false,
			        slidesToScroll: 1
			      }
			    },
			    {
			      breakpoint: 480,
			      settings: {
			        slidesToShow: 1,
			        dots: false,
			        slidesToScroll: 1
			      }
			    }
			  ]
		  });
			$('.sldr').slick({
			 autoplay: true,
			 autoplaySpeed: 7000,
			 slidesToShow: 1,
			 slidesToScroll: 1,
			 arrows: false,
			 dots: false,
			 fade: true,
			 asNavFor: '.sldrnv'
			});
			$('.sldrnv').slick({
				autoplay: true,
				autoplaySpeed: 7000,
			 slidesToShow: 1,
			 slidesToScroll: 1,
			 asNavFor: '.sldr',
			 dots: false,
			 arrows: false,
			 infinite: false,
			 centerMode: false,
			 focusOnSelect: true
			});
		});
	</script>
	</body>
</html>
