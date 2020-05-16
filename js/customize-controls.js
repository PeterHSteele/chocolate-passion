/**
 * File customize-controls.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Shows and hides certain customizer controls depending on the current page.
 */

( function() {
	function updateControls( active ){
		for ( let i = 1; i <= 4; i++ ){
			let settings = [ 
				wp.customize.control('chocolate_passion_panel_posts_' + i), 
				wp.customize.control('chocolate_passion_panel_text_position_' +i) 
			];
			
			settings.forEach( e => e.toggle( active ) );
		}
	}

	wp.customize.bind( 'ready', function(){
		wp.customize.control( 'chocolate_passion_panels_homepage', function( control ){
			control.setting.bind( function(value){
				updateControls( value );
			} );
		} );
	});	
}) (); 