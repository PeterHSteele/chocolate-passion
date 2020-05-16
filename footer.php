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

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-row-one footer-row">
			<div class="col-80">
				<div class="footer-navigation">
					<?php chocolate_passion_footer_navs(); ?>
				</div><!--.footer-navigation-->
			</div><!--.col-80-->
		</div><!--.footer-row-one-->

		<!---->	
		<div class="footer-row-two footer-row footer-widgets">		
			<div class="col-80">
				<?php get_sidebar( 'footer' ); ?>
			 </div><!--.row-->
		</div><!--.footer-row-three-->	
		<div class="footer-row-three footer-row">
			<div class="col-80">
				<nav class="social-links" role='navigation' aria-label="<?php esc_attr_e( 'Social' , 'chocolate-passion' ) ?>">
					<?php
					if ( function_exists( 'jetpack_social_menu' ) ){
						jetpack_social_menu();
					}
					?>
				</nav>
			</div><!--.col-80-->
		</div><!--.footer-row-two-->
		<div class="footer-row-four footer-row">
			<div class="site-info">
				<div class="row">
					<div class="col-80"> 
						<?php chocolate_passion_copyright(); ?>
						<span><?php the_privacy_policy_link(); ?></span>
					</div><!--.col-80-->
			 	</div><!--.row-->
			</div><!-- .site-info -->
		</div><!--.footer-row-three-->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
