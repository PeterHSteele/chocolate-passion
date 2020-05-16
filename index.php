<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package chocolate_passion
 */

get_header();


if ( is_home() && get_theme_mod( 'chocolate_passion_panels_homepage', false ) ){
	get_template_part( 'template-parts/panels' );
}

?>
		
	<div id="primary" class="content-area">
		<div class="col-80">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :
			if ( is_home() && ! is_front_page() ) :
				?>
				<header class="page-header">
					<h1 class="page-title"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;
			chocolate_passion_grid_sizer();
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				if ( get_page_template_slug() === "page-templates/background-image.php" ){
					get_template_part( 'template-parts/content-post/content', 'post-background-image' );
				} else {
					get_template_part( 'template-parts/content-post/content', get_post_type()  );
				}
				
			endwhile;
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
		<?php the_posts_navigation(); ?>
		</div>
	</div><!-- #primary -->

<?php
get_footer();
