<?php
/**
 * Template part for displaying the post navigation on single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/
 *
 * @package chocolate_passion
 */

the_post_navigation(
	array(
		'prev_text' => esc_html__( 'Previous: ', 'chocolate-passion' ) . '<span class="post-title">%title</span>',
		'next_text' => esc_html__( 'Next: ', 'chocolate-passion' ) . '<span class="post-title">%title</span>',
	)
); 