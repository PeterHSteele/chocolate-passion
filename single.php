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

	<div id="primary" class="content-area">
		<div class="col-80">
			<main id="main" class="site-main" role="main">
			

			<?php
			while ( have_posts() ) :
				the_post();
				
				get_template_part( 'template-parts/content-post/content', 'post-single' );

				wp_link_pages();

				// If comments are open or we have at least one comment, load up the comment template.

				if ( comments_open() || get_comments_number() ) :
				?>
				<div class="col-60">
					<?php comments_template(); ?>
				</div>
				<?php
				endif;

			endwhile; // End of the loop.
			?>

			
			<?php the_post_navigation(); ?>
			</main><!-- #main -->
		</div><!--.col-80-->	
	</div><!-- #primary -->

<?php
get_footer();
