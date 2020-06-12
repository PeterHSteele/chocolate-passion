<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package chocolate_passion
 */

if ( ! function_exists( 'chocolate_passion_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function chocolate_passion_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$output = $time_string;
		$title = trim( get_the_title() );
		if ( empty( $title ) && !is_single() ){
			$output = sprintf( 
				'<a href="%1$s" rel="bookmark">%2$s</a>',
				esc_url( get_the_permalink() ),
				$output
			);
		}

		echo '<span class="posted-on">' . $output . '</span>';// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if ( ! function_exists( 'chocolate_passion_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function chocolate_passion_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'By %s', 'post author', 'chocolate-passion' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'chocolate_passion_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function chocolate_passion_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'chocolate-passion' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( 
					'<span class="cat-links"><span class="screen-reader-text">%1$s</span><i class="fas fa-folder-open"></i> %2$s</span>',
				 	esc_html__( 'Posted in ', 'chocolate-passion' ),
				 	$categories_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				 );

				//separator
				echo '<span class="sep"> </span>';
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'chocolate-passion' ) );
			if ( $tags_list ) {

				/* translators: 1: list of tags. */
				printf( 
					'<span class="tags-links"><i class="fas fa-tags"></i> <span class="screen-reader-text">%1$s</span>%2$s</span><span class="sep"> </span>',
					esc_html__( 'Tagged' , 'chocolate-passion' ),
					$tags_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				);
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Comment<span class="screen-reader-text"> on %s</span>', 'chocolate-passion' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo ' </span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'chocolate-passion' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'chocolate_passion_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function chocolate_passion_post_thumbnail( $size = 'post-thumbnail' ) {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( $size, array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'chocolate_passion_header_text' ) ) :
	/** 
	* displays <h1> tag on front page depending
	* on whether header text is displayed, whether
	* title and tagline are set, and homepage settings.
	*/

	function chocolate_passion_header_text(){
		$h1_class = display_header_text() ? 'site-title' : 'site-title screen-reader-text';
		?>
			<h1 class="<?php echo $h1_class // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped?>">
		<?php 

			if ( get_bloginfo( 'description' ) ) {
				bloginfo( 'description' );
			} elseif ( get_bloginfo( 'name' ) ){
				bloginfo( 'name' );
			} else {
				esc_html_e( 'Recent Posts' , 'chocolate-passion' );
			}

		?>
			</h1>
		<?php
	}

endif;

if ( ! function_exists( 'chocolate_passion_background_image' ) ) :

	/**
	* echos the background image url for posts using the background-image.php template. 
	*/

	function chocolate_passion_background_image( $size = 'large' ){
		$image_attrs = wp_get_attachment_image_src( get_post_thumbnail_id(), $size );
		$background_image = $image_attrs[0];
		echo esc_url( $background_image );
	}

endif;

if ( ! function_exists( 'chocolate_passion_menu_name' ) ) :
	/**
	* Displays the name of a menu
	*
	* Prints the menu name as it appears in Dashboard -> Appearance -> Menus.
	* @param string 	$location 	theme location of menu whose name to display
	*/
	function chocolate_passion_menu_name( $location = '' ){
		echo esc_html( wp_get_nav_menu_name( $location ) );
	}

endif;

if ( ! function_exists( 'chocolate_passion_edit_link') ):

	/**
	* Displays the edit link for banner-header, sidebar right, and regular
	* page template parts.
	*/
	function chocolate_passion_edit_link(){
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'chocolate-passion' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'chocolate_passion_footer_nav' ) ):
	/**
	* Displays a list of auxiliary links.
	*
	* Allows addition of additional links to footer.
	*/
	function chocolate_passion_footer_navs(){
		$labels = array(
			'menu-2' 	  => __( 'secondary' , 'chocolate-passion' ),
			'menu-3' 	  => __( 'first additional links', 'chocolate-passion'),
			'menu-4' 	  => __( 'second additional links', 'chocolate-passion'),
			'menu-5'	  => __( 'third additional links', 'chocolate-passion')
		);

		//add a css class based on how many menus there are
		$footer_nav_base_class = chocolate_passion_footer_nav_class();
		//print the menu
		foreach ( $labels as $nav => $label ){
			if ( isset( $nav ) && has_nav_menu( $nav ) ){
				//add additional class to secondary menu;
				$footer_nav_class = $nav == 'menu-2' ? $footer_nav_base_class . ' secondary-navigation' : $footer_nav_base_class;	
			?>
				<nav class="<?php echo esc_attr( $footer_nav_class )?>" role="navigation" aria-label="<?php echo esc_attr( $labels[$nav] ); ?>">
					<h2><?php chocolate_passion_menu_name( $nav ) ?></h2>
					<?php 
						wp_nav_menu( array(
							'theme_location' => $nav,
							'depth' => 1,
							'fallback_cb' => false
						));
					?>
				</nav>	
			<?php 	
			}//endif
		}//endforeach
	}
endif;

if ( ! function_exists( 'chocolate_passion_copyright' ) ):
	/**
	* Prints a copyright statement.
	*/
	function chocolate_passion_copyright(){
		$date = get_theme_mod( 'chocolate_passion_copyright_year', date( 'o' ) );
		if ( isset( $date ) && get_theme_mod( 'chocolate_passion_copyright_visible', false ) ){
			?>
			<span class="copyright">
			<?php
				printf(
					'&copy; %2$s %1$s',
					esc_html( get_bloginfo( 'name' ) ),
					esc_html( $date )
				); 
			?>
			</span>
			<?php
		}
	}	
endif;

if( ! function_exists( 'chocolate_passion_footer_widgets_aria_label' ) ) :

	/**
	* Adds an aria label to footer widget area if there is another <aside> on the page.
	*/

	function chocolate_passion_footer_widgets_aria_label(){
		if ( 
			is_active_sidebar( 'sidebar-right' ) && get_page_template_slug( 'page-templates/sidebar-right.php' ) || 
			is_active_sidebar( 'sidebar-single' ) && is_single() || 
			is_active_sidebar( 'sidebar-3' ) && function_exists( 'is_woocommerce' ) && is_woocommerce()
		){
			?>
			aria-label="<?php esc_attr_e( 'Additional Supplementary Content', 'chocolate-passion' ) ?>"
			<?php
		}
	}

endif;
