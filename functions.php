<?php
/**
 * chocolate passion functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package chocolate_passion
 */

if ( ! function_exists( 'chocolate_passion_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function chocolate_passion_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on chocolate passion, use a find and replace
		 * to change 'chocolate-passion' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'chocolate-passion', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		

		/**
		* Support woocommerce
		*/
		add_theme_support( 'woocommerce' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'chocolate-passion' ),
			'menu-2' => esc_html__( 'Secondary' , 'chocolate-passion' ),
			'menu-3' => esc_html__( 'Footer Links 1' , 'chocolate-passion' ),
			'menu-4' => esc_html__( 'Footer Links 2' , 'chocolate-passion' ),
			'menu-5' => esc_html__( 'Footer Links 3' , 'chocolate-passion' ),
			'menu-social' => esc_html__( 'Social Menu' , 'chocolate-passion' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'chocolate_passion_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'chocolate_passion_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function chocolate_passion_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'chocolate_passion_content_width', 640 );
}
add_action( 'after_setup_theme', 'chocolate_passion_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function chocolate_passion_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'chocolate-passion' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'chocolate-passion' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'chocolate_passion_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function chocolate_passion_scripts() {
	//fontawesome
	wp_enqueue_style( 'fontawesome', get_stylesheet_directory_uri() . '/assets/fontawesome/css/all.css' );

	//wp_enqueue_script( 'chocolate-passion-searchbar', get_template_directory_uri() . '/js/searchbar.js', array( 'jquery' ), '20151215', true );
	wp_enqueue_script( 'chocolate-passion-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20151215', true );
	
	if ( is_page_template( 'page-templates/sidebar-right.php' ) ){
		wp_enqueue_style( 'chocolate-passion-sidebar-right-style', get_template_directory_uri() . '/layouts/content-sidebar.css' );
	}
	
	if ( is_front_page() && chocolate_passion_get_slides() ){

		wp_enqueue_style( 'chocolate-passion-slick-css', get_template_directory_uri() . '/js/slick/slick.css' );
		wp_enqueue_script( 'chocolate-passion-slick-js', get_template_directory_uri() . '/js/slick/slick.js', array( 'jquery' ) );
		wp_add_inline_script( 'chocolate-passion-navigation', 'jQuery(".slider-container").slick({dots: true,autoplay:true,autoplaySpeed:15000})' );
	}

	wp_enqueue_style( 'chocolate-passion-style', get_stylesheet_uri() );

	if ( is_woocommerce() ){
		wp_enqueue_style( 'woocommerce-style', get_stylesheet_directory_uri() . '/woocommerce.css' );
	}

	wp_enqueue_style( 'chocolate-passion-google-font', 'https://fonts.googleapis.com/css?family=Nunito&display=swap' );

	wp_enqueue_script( 'chocolate-passion-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'chocolate_passion_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

if ( ! function_exists( 'chocolate_passion_footer_nav_class' ) ):

	/**
	* Applies a class to 'more links' navs in footer depending
	* on how many are active.
	*/

	function chocolate_passion_footer_nav_class(){
		$footer_lists = 0;
		//count the number of navs in the footer (not including the secondary menu that shows up there on small screens)
		for ( $i = 3; $i <= 5; $i++ ){
			if ( has_nav_menu( 'menu-' . $i ) ){
				$footer_lists++;
			}
		}
		//use number of navs in a css class to help with alignment
		return 'footer-links footer-has-' . $footer_lists .'-navs';
	}
endif;

/* Retrieve customizer options for primary color and accent colors */

if ( ! function_exists( 'chocolate_passion_customize_css' ) ):

	function chocolate_passion_customize_css(){
		$primary = get_theme_mod( 'chocolate_passion_primary_color' );
		$accent = get_theme_mod( 'chocolate_passion_accent_color' );
		$link = get_theme_mod( 'chocolate_passion_link_color' );
		$hover = get_theme_mod( 'chocolate_passion_hover_link_color' );
		?>
		<style>
			a{
				color: <?php echo esc_attr( $link ); ?>;
			}

			a:visited,
			a:active{
				color: <?php echo esc_attr( $accent ); ?>;
			}

			a:hover{
				color: <?php echo esc_attr( $hover )?>;
			}

			.main-navigation a:hover,
			.main-navigation a:active{
				color: <?php echo esc_attr( $primary )?>;
			}

			.header-row-one,
			.header-row-two,
			.site-footer{
				background: <?php echo esc_attr( $primary )?>;
			}
			/*
			.blog .site-main > article.sticky{
				border-bottom: 3px solid <?php echo esc_attr( $primary ) ?>;
			}
			*/
			.sticky-icon i{
				color: <?php echo esc_attr( $primary )?>;
			}

			.woocommerce span.onsale{
				background-color: <?php echo esc_attr( $accent )?>;
			}

			.woocommerce ul.products li.product .price,
			.woocommerce div.product p.price{
				color: <?php echo esc_attr( $accent )?>;
			}

			.woocommerce button.button.alt,
			.woocommerce a.button.alt{
				background: <?php echo esc_attr( $primary )?>;
			}

			.woocommerce button.button.alt:hover,
			.woocommerce a.button.alt:hover{
				background: <?php echo esc_attr( $accent )?>;
			}

			.menu-toggle:hover,
			.menu-toggle:focus{
				background: <?php echo esc_attr( $accent ); ?>;
				border: 5px solid <?php echo esc_attr( $accent ); ?>;
			}

			.footer-links a:hover{
				color: <?php echo esc_attr( $accent ); ?>;
			}

			.comment-navigation .nav-previous a,
			.posts-navigation .nav-previous a,
			.post-navigation .nav-previous a,
			.comment-navigation .nav-next a,
			.posts-navigation .nav-next a,
			.post-navigation .nav-next a,
			.slick-prev,
			.slick-next,
			.comment-form input[type="submit"]{
				background: <?php echo esc_attr( $primary )?>;
				border: 2px solid <?php echo esc_attr( $primary )?>;
			}

			.comment-navigation .nav-previous a:hover,
			.comment-navigation .nav-previous a:focus,
			.posts-navigation .nav-previous a:hover,
			.posts-navigation .nav-previous a:focus,
			.post-navigation .nav-previous a:hover,
			.post-navigation .nav-previous a:focus,
			.comment-navigation .nav-next a:hover,
			.comment-navigation .nav-next a:focus,
			.posts-navigation .nav-next a:hover,
			.posts-navigation .nav-next a:focus,
			.post-navigation .nav-next a:hover,
			.post-navigation .nav-next a:focus,
			.slick-next:hover,
			.slick-next:focus,
			.slick-prev:hover,
			.slick-prev:focus{
				color: <?php echo esc_attr( $primary )?>;
				border: 2px solid <?php echo esc_attr( $primary ) ?>;
			}

			.comment-form input[type="submit"],
			.comment-form button{
				color: <?php echo esc_attr( $primary )?>>;
			}

			.comment-form input[type="submit"]:hover,
			.comment-form input[type="submit"]:focus{
				background: <?php echo esc_attr( $primary )?>;
			}

			.woocommerce nav.woocommerce-pagination ul li{
				border: 2px solid <?php echo esc_attr( $primary )?>;
			}

			.page-numbers li a,
			.page-numbers li a:visited,
			.page-numbers li a:active{
				background: <?php echo esc_attr( $primary )?>;
			}

			.woocommerce nav.woocommerce-pagination ul li a:hover,
			.woocommerce nav.woocommerce-pagination ul li a:focus,
			.woocommerce nav.woocommerce-pagination ul li span.current{
				color: <?php echo esc_attr( $primary )?>;
			}

			@media all and (min-width: 300px){
				.menu-toggle:hover,
				.menu-toggle:focus{
					border: 3px solid <?php echo esc_attr( $accent ); ?>;
				}
			}
		</style>

		<?php
	}

endif;

add_action( 'wp_head', 'chocolate_passion_customize_css' );

if ( ! function_exists( 'chocolate_passion_custom_excerpt' ) ):

	/**
	* Chocolate Passion Custom Excerpt
	*
	* Generates excerpt that allows links. For use in homepage slider.
	*/

	function chocolate_passion_custom_excerpt( $content ){
		
		$no_headings = chocolate_passion_strip_headings( $content );

		echo wp_kses( 
			substr( $no_headings, 0, strpos( $no_headings, '</p>' ) ), 
			array(
				'p' => array(),
				'a' => array(
					'href' => array(),
					'class' => array()
				)
			)
		);
	}

endif;

if ( ! function_exists( 'chocolate_passion_strip_headings' ) ):

	function chocolate_passion_strip_headings( $content ){
		$regex = '/<h[^>]+>.*<\/h[^>]+>/';
		preg_match_all( $regex, $content, $matches, PREG_PATTERN_ORDER);
		return str_replace( $matches[0], '', $content );
	}

endif;

function chocolate_passion_rearrange_hooks(){
	remove_action( 'woocommerce_after_shop_loop','woocommerce_pagination');
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar' );
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	remove_action( 'woocommerce_before_shop_loop','woocommerce_result_count', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
	add_action( 'woocommerce_after_main_content', 'woocommerce_pagination');
	add_action( 'woocommerce_archive_description', 'woocommerce_breadcrumb', 5);
	add_action( 'woocommerce_archive_description', 'woocommerce_result_count', 20);
	add_action( 'woocommerce_archive_description', 'woocommerce_catalog_ordering', 30);
}

add_action( 'init' , 'chocolate_passion_rearrange_hooks' );

function chocolate_passion_add_opening_tag(){
	//if ( is_archive() ) : ?>
		<div class="col-80">
	<?php //endif; 
}

add_action( 'woocommerce_before_main_content', 'chocolate_passion_add_opening_tag', 1 , 1);

function chocolate_passion_closing_tag(){
	echo '</div>';
}
add_action( 'woocommerce_after_main_content', 'chocolate_passion_closing_tag',100);

if ( ! function_exists('chocolate_passion_get_slides') ):

	/**
	* Gets pages/posts for homepage slideshow.
	*/

	function chocolate_passion_get_slides(){
		$slides = array();
		for ( $count = 1; $count <= 8; $count++ ){
			$id = get_theme_mod( 'chocolate_passion_slider_posts_' . $count );
			if ( $id && has_post_thumbnail( $id ) ){
				$slides[] = $id;
			}	
		}
		return !empty( $slides ) ? $slides : false;
	}

endif;
/*
if ( ! function_exists( 'chocolate_passion_post_thumbnail_class' ) ):

 
adds a class to a post depending on whether the class has a post thumbnail
*/
/*
function chocolate_passion_post_thumbnail_class(){
	return has_post_thumbnail() ? '' : 'no-post-thumbnail' ;
}

endif;
*/