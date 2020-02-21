<?php
/**
 * Template part for displaying slider.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package chocolate_passion
 */

$panels = chocolate_passion_get_panels();
if ( $panels ) :
?>
	<section class="panels col-80">
		<div class="panels-container">
			<?php 
			global $post;
			foreach( $panels as $panel ): 
			$post = get_post( $panel['id'] );
			$bg_img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[0];
			?>
			<div class="panel" style="background-image: url(<?php echo esc_attr( $bg_img ); ?>); ">
			
			<div class="panel-content <?php esc_attr_e( $panel['position'] ) ?>">
				<header class="entry-header">
					<?php 
					the_title( 
						sprintf(
							'<h2><a href="%1$s">',
							esc_url( get_the_permalink() )
						), 
						'</a></h2>' 
					); 
					?>
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