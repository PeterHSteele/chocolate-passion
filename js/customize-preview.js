/**
 * File customize-preview.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.

	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	wp.customize( 'custom_logo', function( value ) {
		value.bind( function( attachmentId ) {
			const id = parseInt( attachmentId, 10 );
			const branding = $('.site-branding' );
			if (! id ){
				wp.customize( 'blogname', function(setting) {
					const name = setting.get();
					if ( ! branding.children('h2').length ){
						const string = '<h2 style="font-size: 1.5em; margin: 0">' + name + '</h2>';
						branding.append( string );
					} else {
						branding.children('h2').text( name );
					}
					
				})
			} else {
				branding.children('h2').text('');
			} 
		})
	});

} )( jQuery );
