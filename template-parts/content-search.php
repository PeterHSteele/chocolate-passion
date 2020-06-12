<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package chocolate_passion
 */

?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php chocolate_passion_post_thumbnail( 'thumbnail' ); ?>
	<header class="entry-header">
		<?php 
		the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<div> <?php chocolate_passion_posted_on(); ?><div>
			<div><?php chocolate_passion_posted_by(); ?></div>
			<div class='tags'><?php chocolate_passion_entry_footer(); ?></div>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	
</article><!-- #post-<?php the_ID(); ?> -->

