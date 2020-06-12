<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package chocolate_passion
 */

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function chocolate_passion_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'chocolate_passion_pingback_header' );

/**
* Adds a class to an archive or blog page if the main query has no posts
*/
function chocolate_passion_no_posts_css_class( $classes ){
	if ( ( is_home() || is_archive() ) && ! have_posts() ){
		$classes[] = 'cp-no-posts';
	}
	return $classes;
}

add_filter( 'body_class', 'chocolate_passion_no_posts_css_class' );