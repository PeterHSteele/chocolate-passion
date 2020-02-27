<?php
/**
 * Template for displaying posts as part of an index page (index.php, archive.php)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package chocolate_passion
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'cp-post-index' ); ?>>
	<?php chocolate_passion_post_thumbnail(); ?>
	<?php if ( is_sticky() && ! is_single() ): ?>
		<span class="sticky-icon">
			<span class="screen-reader-text"><?php esc_html_e( 'pinned post' , 'chocolate-passion' ) ?></span>
			<i class="fas fa-lg fa-thumbtack"></i>
		</span>
	<?php endif; ?>
	  
		<header class="entry-header">
			<div class="header-content-wrap">
				<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
				<div class="entry-meta">
					<?php
					chocolate_passion_posted_on();
					chocolate_passion_posted_by();
				?>
				</div><!-- .entry-meta -->
			</div>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
			the_excerpt();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'chocolate-passion' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->
		<footer class="entry-footer">
			<?php chocolate_passion_entry_footer(); ?>
		</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->