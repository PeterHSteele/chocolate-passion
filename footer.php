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
		<div class="footer-row-one">
			<div class="col-80">
				<div class="footer-navigation">
					
				
					<?php 	
						//get menu locastions, exclude primary menu
						$footer_navs = array_slice( get_nav_menu_locations(), 1, 4 );
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
				
				</div><!--.footer-navigation-->
			</div><!--.col-80-->
		</div><!--.footer-row-one-->
		<div class="footer-row-two">
			<div class="col-80">
				<nav class="social-links">
					<?php
					wp_nav_menu(array(
						'theme_location' => 'menu-social',
						'depth'			 => 1,
						'fallback_cb'	 => false
					)); 
					?>
				</nav>
			</div><!--.col-80-->
		</div><!--.footer-row-two-->	
		<div class="footer-row-three">
		<div class="site-info">
			<div class="row">
			<div class="col-80"> 
			<span>&copy; 2020 <?php echo bloginfo('name') ?></span><span><?php the_privacy_policy_link(); ?></span>
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
				?>
		 --></div><!--.col-80-->
		 	</div><!--.row-->
			</div><!-- .site-info -->
		</div><!--.footer-row-three-->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
