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
* Add a post meta field to each new post that allows users to specify what design it 
* should use when it appears on archive and index pages.
* 
* if user enters 'background_image', post will use a special headline/feature image 
* template part.
*/

function chocolate_passion_post_view( $id, $post, $update ){
	if ( !  $update ){
		update_post_meta( $id, 'chocolate_passion_post_view', 'normal' );
	}
}

add_action( 'save_post', 'chocolate_passion_post_view', 10, 3 );