<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package chocolate_passion
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 * See: https://jetpack.com/support/social-menu/
 */
function chocolate_passion_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' 		=> 'infinite-scroll-container',
		'render'    		=> 'chocolate_passion_infinite_scroll_render',
		'footer'    		=> 'page',
		'footer-widgets'	=> 'footer-widgets',
		'wrapper'   		=> false
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Content Options.
	add_theme_support( 'jetpack-content-options', array(
		'post-details'    => array(
			'stylesheet' => 'chocolate-passion-style',
			'date'       => '.posted-on',
			'categories' => '.cat-links',
			'tags'       => '.tags-links',
			'author'     => '.byline',
			'comment'    => '.comments-link',
		),
		'featured-images' => array(
			'archive'    => true,
			'post'       => true,
			'page'       => true,
		),
	) );

	// Add theme support for Social Menu.
	add_theme_support( 'jetpack-social-menu' );
}
add_action( 'after_setup_theme', 'chocolate_passion_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function chocolate_passion_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			chocolate_passion_load_post_layout();
		endif;
	}
}
