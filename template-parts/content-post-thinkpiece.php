<?php
/**
 * Template for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package chocolate_passion
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'thinkpiece '/* . chocolate_passion_post_thumbnail_class()*/ ); ?>>
	<?php chocolate_passion_post_thumbnail(); ?>
	<?php if ( is_sticky() && ! is_single() ): ?>
		<span class="sticky-icon"><i class="fas fa-lg fa-thumbtack"></i></span>
	<?php endif; ?>
	<div class="thinkpiece-flex-container clear">  
	<header class="entry-header">
		<div class="header-content-wrap">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php
					chocolate_passion_posted_on();
					chocolate_passion_posted_by();
					?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
			<?php chocolate_passion_entry_footer(); ?>
		</div>
	</header><!-- .entry-header -->

	

	<div class="entry-content">
		<?php
		if ( ! is_single() ){
			the_excerpt();
		} else {
			the_content();
		}
		/*the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				/*__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'chocolate-passion' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );*/

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'chocolate-passion' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->
	</div><!--.thinkpiece-flex-container-->
	<!--<footer class="entry-footer">
		
	</footer>--><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->