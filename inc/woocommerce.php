<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package chocolate_passion
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function chocolate_passion_woocommercechocolate_passionetup() {
	add_themechocolate_passionupport( 'woocommerce' );
	add_themechocolate_passionupport( 'wc-product-gallery-zoom' );
	add_themechocolate_passionupport( 'wc-product-gallery-lightbox' );
	add_themechocolate_passionupport( 'wc-product-gallery-slider' );
}
add_action( 'afterchocolate_passionetup_theme', 'chocolate_passion_woocommercechocolate_passionetup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function chocolate_passion_woocommerce_scripts() {
	wp_enqueue_style( 'chocolate-passion-woocommerce-style', get_template_directory_uri() . '/woocommerce.css' );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'chocolate-passion-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'chocolate_passion_woocommerce_scripts' );

/**
 * Shuffles functions off and on to various WC hooks 
 *
 * Outputs the Woocommerce UI in the right order to match with the theme.
 */

function chocolate_passion_rearrange_hooks(){
	remove_action( 'woocommerce_after_shop_loop','woocommerce_pagination');
	add_action( 'woocommerce_after_main_content', 'woocommerce_pagination');
	
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar' );
	
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	add_action( 'woocommerce_archive_description', 'woocommerce_breadcrumb', 5);
	
	remove_action( 'woocommerce_before_shop_loop','woocommerce_result_count', 20 );
	add_action( 'woocommerce_archive_description', 'woocommerce_result_count', 20);

	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
	add_action( 'woocommerce_archive_description', 'woocommerce_catalog_ordering', 30);
}

add_action( 'init' , 'chocolate_passion_rearrange_hooks' );
/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueuechocolate_passiontyles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function chocolate_passion_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'chocolate_passion_woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function chocolate_passion_woocommerce_products_per_page() {
	return 12;
}
add_filter( 'loopchocolate_passionhop_per_page', 'chocolate_passion_woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function chocolate_passion_woocommerce_thumbnail_columns() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'chocolate_passion_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function chocolate_passion_woocommerce_loop_columns() {
	return 3;
}
add_filter( 'loopchocolate_passionhop_columns', 'chocolate_passion_woocommerce_loop_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function chocolate_passion_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'chocolate_passion_woocommerce_related_products_args' );

if ( ! function_exists( 'chocolate_passion_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function chocolate_passion_woocommerce_product_columns_wrapper() {
		$columns = chocolate_passion_woocommerce_loop_columns();
		echo '<div class="columns-' . absint( $columns ) . '">';
	}
}
add_action( 'woocommerce_before_shop_loop', 'chocolate_passion_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'chocolate_passion_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function chocolate_passion_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop', 'chocolate_passion_woocommerce_product_columns_wrapper_close', 40 );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'chocolate_passion_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	/*function chocolate_passion_woocommerce_wrapper_before() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			<?php
	}*/
}

//add_action( 'woocommerce_before_main_content', 'chocolate_passion_woocommerce_wrapper_before' );

if ( ! function_exists( 'chocolate_passion_add_opening_tag' ) ) {

	function chocolate_passion_add_opening_tag(){
		/**
		 * Before Content.
		 *
		 * Wraps all WooCommerce content in wrappers which match the theme markup.
		 *
		 * @return void
		 */
		?>
			<div class="col-80">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'chocolate_passion_add_opening_tag', 1 , 1);




if ( ! function_exists( 'chocolate_passion_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	/*function chocolate_passion_woocommerce_wrapper_after() {
			?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
	}*/
}
//add_action( 'woocommerce_after_main_content', 'chocolate_passion_woocommerce_wrapper_after' );
if ( ! function_exists( 'chocolate_passion_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping div.col-80.
	 *
	 * @return void
	 */
	function chocolate_passion_closing_tag(){
		?>
			</div><!--.col-80-->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'chocolate_passion_closing_tag',100);

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'chocolate_passion_woocommerce_header_cart' ) ) {
			chocolate_passion_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'chocolate_passion_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function chocolate_passion_woocommerce_cart_link_fragment( $fragments ) {
		obchocolate_passiontart();
		chocolate_passion_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'chocolate_passion_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'chocolate_passion_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function chocolate_passion_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'chocolate_passion' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'chocolate_passion' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cartchocolate_passionubtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'chocolate_passion_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function chocolate_passion_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php chocolate_passion_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}




