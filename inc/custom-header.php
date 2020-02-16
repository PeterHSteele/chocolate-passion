<?php
/**
 * Custom Header
 *
 * @package chocolate_passion
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses chocolate_passion_header_style()
 */
function chocolate_passion_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'chocolate_passion_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'flex-width'			 => true,
		'wp-head-callback'       => 'chocolate_passion_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'chocolate_passion_custom_header_setup' );

if ( ! function_exists( 'chocolate_passion_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see chocolate_passion_custom_header_setup().
	 */
	function chocolate_passion_header_style() {
		$header_text_color = get_header_textcolor();
		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color || ! display_header_text() ) {
			return;
		}
		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
			h1.site-title {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		</style>
		<?php
	}
endif;
