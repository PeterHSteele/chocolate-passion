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
	$wp_customize->get_setting( 'custom_logo' )->transport  = 'postMessage';
	
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
		'default' => '#db3a00',
		'sanitize_callback' => 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'chocolate_passion_primary_color', array(
		'label' => __( 'Primary Color', 'chocolate-passion' ),
		'section' => 'colors',
		'settings' => 'chocolate_passion_primary_color'
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
	//Panels

	$wp_customize->add_section('chocolate_passion_panels',array(
		'title' => __( 'CP Panels' , 'chocolate-passion' ),
		'description' => __( 
				"Set pages and posts to appear as panels at the top of the page. 
				Any posts that do not have a featured image will be skipped. ", 
				'chocolate_passion' 
		),
		'active_callback' => 'chocolate_passion_is_panels',
	));

	$wp_customize->add_setting( 'chocolate_passion_panels_homepage', array(
		'default' => 0,
		'sanitize_callback' => 'chocolate_passion_sanitize_checkbox'
	) );
	
		$wp_customize->add_control( 'chocolate_passion_panels_homepage', array(
			'label' => __( 'Show Panels on Blog Page', 'chocolate-passion' ),
			'type' => 'checkbox',
			'section' => 'chocolate_passion_panels',
			'active_callback' => 'chocolate_passion_is_home'
		));
	

	for( $count = 1; $count <= 4; $count++){
		
		/*
		allows user to set the post to include in panel page
		*/
		$wp_customize->add_setting( 'chocolate_passion_panel_posts_' . $count, array(
			'default' => '',
			'sanitize_callback' => 'absint'
		));
 		
 		$wp_customize->add_control( new Chocolate_Passion_Dropdown_Posts_Control( $wp_customize, 'chocolate_passion_panel_posts_' . $count, array(
			/* translators:  %s: panel number.*/
			'label' => sprintf( __( 'Panel %s Content', 'chocolate-passion' ), $count ),
			'section' => 'chocolate_passion_panels',
			'settings' => 'chocolate_passion_panel_posts_' . $count,
			'active_callback' => 'chocolate_passion_show_panel_control'
		)));
		/*
		allows user to set the text position of the panel content
		*/

		$wp_customize->add_setting( 'chocolate_passion_panel_text_position_' . $count, array(
			'default' => 'bottom-left',
			'sanitize_callback' => 'chocolate_passion_sanitize_text_position'
		) );

		$wp_customize->add_control( 'chocolate_passion_panel_text_position_' .  $count, array(
			/* translators: %s: panel number */
			'label' => sprintf( __( 'Panel Text %s Positioning', 'chocolate-passion' ), $count ),
			'type' => 'select',
			'choices' => chocolate_passion_text_position_choices(),
			'section' => 'chocolate_passion_panels',
			'active_callback' => 'chocolate_passion_show_panel_control'
		));

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

/* enqueue customizer css for panels section */

function chocolate_passion_enqueue_customizer_css(){
	wp_enqueue_style( 'chocolate-passion-customizer-styles', get_template_directory_uri() . '/css/customizer.css' );
}

add_action( 'customize_controls_print_styles', 'chocolate_passion_enqueue_customizer_css' );

/** 
*Custom Sanitization Functions
*
* sanitize_year is for the copyright year.
*/

function chocolate_passion_sanitize_year( $year ){
	return absint( substr( $year, 0, 4) );
}

function chocolate_passion_sanitize_checkbox( $input ){
    return $input > 0 ? 1 : 0;
}

/**
* Sanitizes the text-position fields in the panels pane.
*/

function chocolate_passion_sanitize_text_position( $input ){
	$save;
	switch( $input ){
		case 'top-left': 
			$save = $input;
			break;
		case 'top-right': 
			$save = $input;
			break;
		case 'bottom-right': 
			$save = $input;
			break;
		default:
			$save = 'bottom-left';
	}
	return $save;
}

/* populates the options in the text-position <selects> in the panels page */

function chocolate_passion_text_position_choices( ){
	return array(
		'bottom-left'  => __('bottom-left','chocolate-passion'),
		'bottom-right' => __('bottom-right','chocolate-passion'),
		'top-left'     => __('top-left', 'chocolate-passion'),
		'top-right'	   => __('top-right', 'chocolate-passion')
	);
}

/* 
	Checks if panels page template is being used.
	Active callback for whether to show the CP Panels section
*/

function chocolate_passion_is_panels(){
	if ( is_page_template( 'page-templates/panel-page.php' ) || is_home() ){
		return true;
	}
}

/*
 Checks for blog page. Active callback for
 'show panels on blog page' checkbox
*/

function chocolate_passion_is_home(){
	return is_home();
}

/*
	Checks whether panel and text position controls should appear.
	Active callback for panel controls and text position controls.
*/

function chocolate_passion_show_panel_control(){
	return (
		is_home() && get_theme_mod( 'chocolate_passion_panels_homepage' ) || 
		!is_home() && is_page_template( 'page-templates/panel-page.php' )
	); 
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function chocolate_passion_customize_partial_blogname() {
	bloginfo( 'name' );
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
	wp_enqueue_script( 'chocolate-passion-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'chocolate_passion_customize_preview_js' );

function chocolate_passion_customize_controls_js(){
	wp_enqueue_script( 'chocolate-passion-customize-controls', get_template_directory_uri() . '/js/customize-controls.js', array( 'customize-controls' ), '20151215', true );
}
add_action( 'customize_controls_enqueue_scripts', 'chocolate_passion_customize_controls_js' );
