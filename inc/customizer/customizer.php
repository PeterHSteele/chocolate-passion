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
			'Here you can add pages and posts to the panels section on the homepage. 
			Any panels that do not have a featured image will be skipped. ', 
			'chocolate-passion'),
		'active_callback' => 'chocolate_passion_is_panels',
	));

	for( $count = 1; $count <= 4; $count++){
		$wp_customize->add_setting( 'chocolate_passion_panel_posts_' . $count, array(
			'default' => '',
			'sanitize_callback' => 'absint'
		));
 		
 		$wp_customize->add_control( new Chocolate_Passion_Dropdown_Posts_Control( $wp_customize, 'chocolate_passion_panel_posts_' . $count, array(
			'label' => sprintf(
				/*translators:  %s: panel number.*/
				__( 'Panel %s Content', 'chocolate-passion' ),
				$count
			),
			'section' => __( 'chocolate_passion_panels', 'chocolate-passion' ),
			'settings' => 'chocolate_passion_panel_posts_' . $count,
		)));
	
		$wp_customize->add_setting( 'chocolate_passion_panel_text_position_' . $count, array(
			'default' => 'bottom-left',
			'sanitize_callback' => 'chocolate_passion_sanitize_text_position'
		) );

		$wp_customize->add_control( 'chocolate_passion_panel_text_position_' .  $count, array(
			'label' => sprintf( 
				/*translators: %s: panel number.*/
				__( 'Panel Text %s Positioning', 'chocolate-passion' ),
				$count
			),
			'type' => 'select',
			'choices' => chocolate_passion_text_position_choices(),
			'section' => 'chocolate_passion_panels',
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

if ( ! function_exists( 'chocolate_passion_enqueue_customizer_css' ) ):

	function chocolate_passion_enqueue_customizer_css(){
		wp_enqueue_style( 'chocolate-passion-customizer-styles', get_template_directory_uri() . '/css/customizer.css' );
	}

endif;

add_action( 'customize_controls_print_styles', 'chocolate_passion_enqueue_customizer_css' );

function chocolate_passion_sanitize_year( $year ){
	return absint( substr( $year, 0, 4) );
}

function chocolate_passion_sanitize_checkbox( $input ){
    //returns true if checkbox is checked
    return $input > 0 ? 1 : 0;
}

function chocolate_passion_text_position_choices( ){
	return array(
		'bottom-left'  => __('bottom-left','chocolate-passion'),
		'bottom-right' => __('bottom-right','chocolate-passion'),
		'top-left'     => __('top-left', 'chocolate-passion'),
		'top-right'	   => __('top-right', 'chocolate-passion')
	);
}

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

if ( ! function_exists( 'chocolate_passion_is_panels') ):

	/* checks if panels page template is being used*/

	function chocolate_passion_is_panels(){
		if ( is_page_template( 'page-templates/panel-page.php' ) ){
			return true;
		}
	}

endif;

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
