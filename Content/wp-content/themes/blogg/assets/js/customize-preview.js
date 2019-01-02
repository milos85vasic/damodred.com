/**
 * Customizer Live Preview
 *
 * Reloads changes on Theme Customizer Preview asynchronously for better usability
 *
 * @package Blogg
 */

( function( $ ) {

	// Site Title textfield.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title' ).text( to );
		} );
	} );

	// Site Description textfield.
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Site Title checkbox.
	wp.customize( 'blogg_show_site_title', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.site-title' );
			} else {
				showElement( '.site-title' );
			}
		} );
	} );
	
	// Site Description checkbox.
	wp.customize( 'blogg_show_site_description', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.site-description' );
			} else {
				showElement( '.site-description' );
			}
		} );
	} );

	// Page width 
	wp.customize('blogg_page_width',function(value) {
		value.bind( function( to ) {
			$('#page').css('max-width',to+'px');
		} );
	} );	
	
	// Header width 
	wp.customize('blogg_header_width',function(value) {
		value.bind( function( to ) {
			$('.site-header .container').css('max-width',to+'px');
		} );
	} );	
	
	// Featured box section width 
	wp.customize('blogg_featured_boxes_width',function(value) {
		value.bind( function( to ) {
			$('.featured-boxes').css('max-width',to+'px');
		} );
	} );


	// Read More textfield.
	wp.customize( 'blogg_read_more_text', function( value ) {
		value.bind( function( to ) {
			$( 'a.more-link' ).text( to );
		} );
	} );

	// Post meta info checkbox.
	wp.customize( 'blogg_meta_info', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.single .post-details' );
			} else {
				showElement( '.single .post-details' );
			}
		} );
	} );
	
	// Post Categories checkbox.
	wp.customize( 'blogg_meta_category', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.post-categories' );
			} else {
				showElement( '.post-categories' );
			}
		} );
	} );

	// Author Avatar checkbox.
	wp.customize( 'blogg_display_author_avatar', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.entry-meta .avatar' );
			} else {
				showElement( '.entry-meta .avatar' );
			}
		} );
	} );
	
	// Post Tags checkbox.
	wp.customize( 'blogg_meta_tags', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.entry-tags' );
			} else {
				showElement( '.entry-tags' );
			}
		} );
	} );

	// Post Navigation checkbox.
	wp.customize( 'blogg_post_navigation', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.single-post .post-navigation' );
			} else {
				showElement( '.single-post .post-navigation' );
			}
		} );
	} );
	

	// Slide Category checkbox.
	wp.customize( 'blogg_theme_options[display_slide_cat]', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.slide-text .post-category' );
			} else {
				showElement( '.slide-text .post-category' );
			}
		} );
	} );

	// Slide Date checkbox.
	wp.customize( 'blogg_theme_options[display_slide_date]', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.slide-text .slide-date' );
			} else {
				showElement( '.slide-text .slide-date' );
			}
		} );
	} );
	
	// Slide Read More checkbox.
	wp.customize( 'blogg_display_slide_readmore', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.slide-readmore' );
			} else {
				showElement( '.slide-readmore' );
			}
		} );
	} );
	
	// Gallery View Comments checkbox.
	wp.customize( 'blogg_attachment_comments', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.attachment .comments-area' );
			} else {
				showElement( '.attachment .comments-area' );
			}
		} );
	} );	
	
	// Copyright textfield.
	wp.customize( 'blogg_copyright', function( value ) {
		value.bind( function( to ) {
			$( '.copyright-name' ).text( to );
		} );
	} );
	
	// Show Credit Line checkbox.
	wp.customize( 'blogg_show_design_by', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '#footer-credit' );
			} else {
				showElement( '#footer-credit' );
			}
		} );
	} );
	
	// Site Title Colour
	wp.customize('blogg_sitetitle_colour',function(value) {
		value.bind( function( to ) {
			$('.site-title a').css('color',to);
		} );
	} );

	// Site Tagline Colour
	wp.customize('blogg_tagline_colour',function(value) {
		value.bind( function( to ) {
			$('.site-description').css('color',to);
		} );
	} );

	// First colour
	wp.customize(
		'blogg_first_colour', function( value ) {
			value.bind(
				function( to ) {
					changeInlineCSS( 'blogg_first_colour', to );
				}
			);
		}
	);	
	
	// Second colour
	wp.customize(
		'blogg_second_colour', function( value ) {
			value.bind(
				function( to ) {
					changeInlineCSS( 'blogg_second_colour', to );
				}
			);
		}
	);	
	
	// Third colour
	wp.customize(
		'blogg_third_colour', function( value ) {
			value.bind(
				function( to ) {
					changeInlineCSS( 'blogg_third_colour', to );
				}
			);
		}
	);	
	
	function hideElement( element ) {
		$( element ).css({
			clip: 'rect(1px, 1px, 1px, 1px)',
			position: 'absolute',
			width: '1px',
			height: '1px',
			overflow: 'hidden'
		});
	}

	function showElement( element ) {
		$( element ).css({
			clip: 'auto',
			position: 'relative',
			width: 'auto',
			height: 'auto',
			overflow: 'visible'
		});
	}

} )( jQuery );
