<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package chocolate_passion
 */

get_header();
?>
	<div class="col-80">
		<div class="content-area">
			<div aria-hidden="true">
				<?php chocolate_passion_post_thumbnail() ?>
			</div>
			<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) :
				the_post();
						
				get_template_part( 'template-parts/content-post/content', 'post-single' );

				wp_link_pages();

				// If comments are open or we have at least one comment, load up the comment template.

				if ( comments_open() || get_comments_number() ) :
				
						
				 comments_template();
						
				
				endif;

			endwhile; // End of the loop.
			?>

				
			<?php the_post_navigation(); ?>
			</main><!-- #main -->	
			</div><!--.content-area-->
		<?php get_sidebar( 'single' ) ?>
	</div><!--.col-80-->

<?php
get_footer();
