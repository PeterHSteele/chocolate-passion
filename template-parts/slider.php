<?php
/**
 * Template part for displaying slider.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package chocolate_passion
 */

$slides = chocolate_passion_get_slides();
if ( $slides && !empty($slides) ) :
?>
<section class="slider col-80">
	<div class="slider-container">
		<?php foreach( $slides as $slide ): ?>
		<!--<div class="slide">-->
		<div class="slide" style="background: url(<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $slide ), 'full' )[0]; ?>); background-size:cover">
		<!--</div>-->
		<?php //echo get_the_post_thumbnail( $slide ); ?>
		<div class="slide-content">
			<header class="entry-header">
				<h2><?php echo get_the_title( $slide ); ?></h2>
			</header>

			<div class="entry-content">
				<?php
				//print_r( esc_html(get_the_content( null, false, $slide )) );
				echo chocolate_passion_custom_excerpt( get_the_content( null, false, $slide ) );
				//echo get_the_excerpt( $slide );
				?>
			</div>
		</div><!--.slide-content-->
		</div><!--.slide-->
		<?php endforeach; ?>
	</div>
</section><!--.slider-section-->
<?php endif;