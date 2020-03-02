<?php
/**
 * The sidebar for single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package chocolate_passion
 */

if ( ! is_active_sidebar( 'sidebar-single' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-single' ); ?>
</aside><!-- #secondary -->
