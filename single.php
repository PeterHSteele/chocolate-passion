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
		<div id="primary" class="content-area">
			<div aria-hidden="true">
				<?php 
				/*
				Post thumbnail for sighted visitors.
				Screen reader only post thumbnail will appear within <main>.
				*/
				chocolate_passion_post_thumbnail() 
				?>
			</div>
			<main id="main" class="site-main" role="main">
			<?php
			while ( have_posts() ) :
				the_post();
						
				get_template_part( 'template-parts/content-post/content', 'post-single' );

				wp_link_pages();

			endwhile; // End of the loop.
			?>

			</main><!-- #main -->	
		</div><!--.content-area-->
		<?php get_sidebar( 'single' ) ?>
		<?php 
			
			the_post_navigation(
				array(
					'prev_text' => esc_html__( 'Previous: ', 'chocolate_passion' ) . '<span class="post-title">%title</span>',
					'next_text' => esc_html__( 'Next: ', 'chocolate_passion' ) . '<span class="post-title">%title</span>',
				)
			); 
		?>
		<?php 
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
		?>
		
			<?php comments_template(); ?>
		
		<?php endif; ?>
	</div><!--.col-80-->

<?php
get_footer();
