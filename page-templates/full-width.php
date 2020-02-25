<?php
/**
 * Template Name: Full Width
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package chocolate_passion
 */

get_header();
?>
	<div id="primary" class="content-area">
		<div class="col-80"> 
			<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) :
				the_post();
			?>	
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->
				
				<?php chocolate_passion_post_thumbnail(); ?>
				
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
				
			</article><!-- #post-<?php the_ID(); ?> -->
			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

			</main><!-- #main -->
		</div><!--.col-80-->
	</div><!-- #primary -->

<?php
get_footer();