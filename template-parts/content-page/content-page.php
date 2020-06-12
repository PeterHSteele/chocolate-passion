<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package chocolate_passion
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php chocolate_passion_post_thumbnail(); ?>
	<div class="col-60">
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
				<?php chocolate_passion_edit_link(); ?>
			</footer><!-- .entry-footer -->
		<?php endif; ?>
	</div><!--.col-60-->
</article><!-- #post-<?php the_ID(); ?> -->
