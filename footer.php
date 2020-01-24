<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package chocolate_passion
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="footer-navigation">
			<div class="col-80">
				<div class="row">
					<?php 	
						//get menu locastions, exclude primary menu
						$footer_navs = array_slice( get_nav_menu_locations(), 1 );
						//add a css class based on how many menus there are
						$footer_nav_class = chocolate_passion_footer_nav_class();
						//print the menus
						foreach ( $footer_navs as $nav => $items ){
							chocolate_passion_footer_nav( 
								$nav, 
								$nav == 'menu-2' ? $footer_nav_class . ' secondary-navigation' : $footer_nav_class 
							);
						}
					?>
				</div><!--.row-->
			</div><!--.col-80-->
		</div><!--.footer-navigation-->	
		<!--<div class="site-info">-->
			<!--<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'chocolate-passion' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'chocolate-passion' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'chocolate-passion' ), 'chocolate-passion', '<a href="'. esc_url( 'https://peterhsteele.com' ) . '">Peter Steele</a>' );
				?>-->
		<!--</div>--><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
