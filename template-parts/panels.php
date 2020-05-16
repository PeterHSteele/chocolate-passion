<?php
/**
 * Template part for displaying panels.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package chocolate_passion
 */

$panels = chocolate_passion_get_panels();
if ( $panels ) :
?>
	<section class="cp-panels col-80">
		<div class="cp-panels-container">
			<?php 
			foreach( $panels as $panel ): 
			$bg_img = wp_get_attachment_image_src( get_post_thumbnail_id( $panel['post'] ), 'full' )[0];
			?>
			<div class="cp-panel" style="background-image: url(<?php echo esc_attr( $bg_img ); ?>); ">
				<div class="cp-panel-content <?php echo esc_attr( $panel['position'] ) ?>">
					<header class="entry-header">
						<h2>
							<a href="<?php echo esc_url(get_the_permalink( $panel['post'])); ?>"> 
								<?php echo esc_html( get_the_title( $panel['post'] ) ) ?>
							</a>
						</h2>
					</header>
					<div class="entry-content">
						<p><?php echo apply_filters( 'the excerpt', get_the_excerpt( $panel['post'] ) ); ?></p>
					</div>
				</div><!--.panel-content-->
			</div><!--.panel-->
			<?php endforeach; ?>
		</div><!--.panels-container-->
	</section><!--.panels-->
<?php endif;