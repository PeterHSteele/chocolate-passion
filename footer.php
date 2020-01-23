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
				<!--<div class="secondary-menu-wrap">-->
					<nav id="secondary-menu" class="secondary-navigation">
						<!--<button class="menu-toggle" aria-controls="seconary-menu"></button>-->
						<?php 
							wp_nav_menu( array(
								'theme_location' => 'menu-2',
								'menu_id' => 'nav-secondary-menu'
							));
						?>
					</nav>
				<!--</div>--><!--secondary-menu-wrap-->
					<nav id="footer-links-one" class="footer-links">
						<?php 
							wp_nav_menu( array(
								'theme_location' => 'menu-3',
								'menu_id' => 'nav-secondary-menu',
								'depth' => 1,
							));
						?>
					</nav>
					<nav id="footer-links-two" class="footer-links">
						<?php 
							wp_nav_menu( array(
								'theme_location' => 'menu-4',
								'menu_id' => 'nav-secondary-menu',
								'depth' => 1,
							));
						?>
					</nav>
				</div><!--.row-->
			</div>
		<div>	
		<div class="site-info">
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
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
