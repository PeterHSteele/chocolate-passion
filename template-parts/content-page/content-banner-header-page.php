<?php
/**
 * Template part for displaying page content in banner-header.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package chocolate_passion
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="chocolate-passion-banner" style="background-image: url(<?php echo esc_url( wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' )[0]); ?>)">
	</div><!-- .chocolate-passion-banner--> 
	<div class="col-80">
		<div class="col-60">
		<div class="banner-header-content-wrap"> 
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->
			 
			<div class="entry-content">
				<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'chocolate-passion' ),
					'after'  => '</div>',
				) );
				?>
			</div><!-- .entry-content -->

			<?php if ( get_edit_post_link() ) : ?>
				<footer class="entry-footer">
					<?php
					edit_post_link(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__( 'Edit <span class="screen-reader-text">%s</span>', 'chocolate-passion' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							get_the_title()
						),
						'<span class="edit-link">',
						'</span>'
					);
					?>
				</footer><!-- .entry-footer -->
			<?php endif; ?>
		</div><!--.banner-header-content-wrap-->
		</div><!--.col-60-->
	</div><!--.col-80-->
</article><!-- #post-<?php the_ID(); ?> -->