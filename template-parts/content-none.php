<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package chocolate_passion
 */

?>

<section class="no-results not-found">
	<div class="col-60">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'chocolate-passion' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'chocolate-passion' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'chocolate-passion' ); ?></p>
			<?php get_search_form();
			
		else :
			?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'chocolate-passion' ); ?></p>
			<?php 
			get_search_form(); 

		endif;
		?>
	</div><!-- .page-content -->
	</div><!--.col-60-->
</section><!-- .no-results -->
