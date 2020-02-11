<?php
/**
 * chocolate passion Theme Customizer
 *
 * @package chocolate_passion
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
require get_template_directory() . '/inc/customizer/class-dropdown-posts-control.php';// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

function chocolate_passion_customize_register( $wp_customize ) {
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'chocolate_passion_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'chocolate_passion_customize_partial_blogdescription',
		) );
	}
	//Colors
	$wp_customize->add_setting( 'chocolate_passion_primary_color', array(
		'default' => '#000000',
		'sanitize_callback' => 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'chocolate_passion_primary_color', array(
		'label' => __( 'Primary Color', 'chocolate-passion' ),
		'section' => 'colors',
		'settings' => 'chocolate_passion_primary_color'
	)));

	$wp_customize->add_setting( 'chocolate_passion_accent_color', array(
		'default' => '#ff4500',
		'sanitize_callback' => 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'chocolate_passion_accent_color', array(
		'label' => __( 'Accent Color', 'chocolate-passion' ),
		'section' => 'colors',
		'settings' => 'chocolate_passion_accent_color'
	)));

	$wp_customize->add_setting( 'chocolate_passion_link_color', array(
		'default' => '#4169E1',
		'sanitize_callback' => 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'chocolate_passion_link_color', array(
		'label' => __( 'Link Color', 'chocolate-passion' ),
		'section' => 'colors',
		'description' => __( 'The color for unvisited links in the content.' , 'chocolate-passion' ),
		'settings' => 'chocolate_passion_link_color'
	)));

	$wp_customize->add_setting( 'chocolate_passion_hover_link_color', array(
		'default' => '#191970',
		'sanitize_callback' => 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'chocolate_passion_hover_link_color', array(
		'label' => __( 'Link Color', 'chocolate-passion' ),
		'section' => 'colors',
		'description' => __( 'The color links in the content when hovered by the mouse.' , 'chocolate-passion' ),
		'settings' => 'chocolate_passion_hover_link_color'
	)));
	//Homepage Slideshow
	$wp_customize->add_section('chocolate_passion_homepage_settings',array(
		'title' => __( 'Homepage Slideshow' , 'chocolate-passion' ),
		'description' => __( 
			'Here you can add pages and posts to the slideshow on the homepage. 
			Any slides left empty or that do not have a featured image will be skipped. ', 
			'chocolate-passion'),
		'active_callback' => 'is_front_page',
	));

	for( $count = 1; $count <= 10; $count++){
		$wp_customize->add_setting( 'chocolate_passion_slider_posts_' . $count, array(
			'default' => '',
			'sanitize_callback' => 'absint'
		));
 		
 		if ( $count % 2 ){
			$wp_customize->add_control( 'chocolate_passion_slider_posts_' .  $count, array(
				'label' => __( 'Page to include in homepage slider', 'chocolate-passion' ),
				'type' => 'dropdown-pages',
				'section' => 'chocolate_passion_homepage_settings',
			));
		} else{
			
			$wp_customize->add_control( new WP_Dropdown_Posts_Control( $wp_customize, 'chocolate_passion_slider_posts_' . $count, array(
				'label' => __( 'Post to include in homepage slider', 'chocolate-passion' ),
				'section' => __( 'chocolate_passion_homepage_settings', 'chocolate-passion' ),
				'settings' => 'chocolate_passion_slider_posts_' . $count,
			)));
		}
	}

	//Copyright
	$wp_customize->add_setting( 'chocolate_passion_copyright_visible', array(
		'default' => false,
		'sanitize_callback' => 'chocolate_passion_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'chocolate_passion_copyright_visible', array(
		'label' => __( 'Show Copyright', 'chocolate-passion' ),
		'type'  => 'checkbox',
		'section' => 'title_tagline',
		'priority' => 100
	));

	$wp_customize->add_setting( 'chocolate_passion_copyright_year', array(
		'default' => date('o'),
		'sanitize_callback' => 'chocolate_passion_sanitize_year'
	) );

	$wp_customize->add_control( 'chocolate_passion_copyright_year', array(
		'label' => __( 'Copyright Year', 'chocolate-passion' ),
		'type'  => 'number',
		'section' => 'title_tagline',
		'priority' => 105
	));

}
add_action( 'customize_register', 'chocolate_passion_customize_register' );

function chocolate_passion_sanitize_year( $year ){
	return absint( substr( $year, 0, 4) );
}

function chocolate_passion_sanitize_checkbox( $input ){
    //returns true if checkbox is checked
    return $input > 0 ? 1 : 0;
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function chocolate_passion_customize_partial_blogname() {
	bloginfo( 'name' );
}

function chocolate_passion_render_dropdown_posts(){
	$posts = get_posts( -1 );
	?>
	<select>
	<?php foreach ($posts as $post): ?>
		<option data-id="<?php echo esc_attr( $post->id ) ?>">echo get_the_title( $post )</option>
	<?php endforeach; ?>
	</select>
	<?php
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function chocolate_passion_customize_partial_blogdescription() {
	bloginfo( 'description' );
}


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function chocolate_passion_customize_preview_js() {
	wp_enqueue_script( 'chocolate-passion-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'chocolate_passion_customize_preview_js' );
