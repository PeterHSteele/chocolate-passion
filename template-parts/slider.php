<?php
/**
 * Template part for displaying slider.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package chocolate_passion
 */

$slides = chocolate_passion_get_slides();
if ( !empty( $slides ) ) :
?>
	<section class="slider col-80">
		<div class="slider-container">
			<?php 
			global $post;
			foreach( $slides as $slide ): 
			$post = get_post($slide);
			$bg_img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[0];
			?>
			<div class="slide" style="background-image: url(<?php echo esc_attr( $bg_img ); ?>); ">
			
			<div class="slide-content">
				<header class="entry-header">
					<?php the_title( '<h2>', '</h2>' ); ?>
				</header>

				<div class="entry-content">
					<?php the_excerpt(); ?>
				</div>
			</div><!--.slide-content-->
			</div><!--.slide-->
			<?php 
			endforeach; 
			wp_reset_postdata();
			?>
		</div><!--.slider-container-->
	</section><!--.slider-section-->
<?php endif;