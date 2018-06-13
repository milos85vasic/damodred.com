/**
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
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );

	//body text fonts
    wp.customize( 'body_typography', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'font-family' , to );
		} );
	} );

	//header text fonts
    wp.customize( 'heading_typography', function( value ) {
		value.bind( function( to ) {
			$( 'h1, h2 , h3 , h4 , h5 , h6' ).css( 'font-family' , to );
		} );
	} );

} )( jQuery );
