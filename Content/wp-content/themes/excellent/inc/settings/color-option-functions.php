<?php /**
 * Register color schemes for Excellent.
 *
 * Can be filtered with {@see 'excellent_color_schemes'}.
 *
 * The order of colors in a colors array:
 * @since Excellent 1.1
 *
 * @return array An associative array of color scheme options.
 */
function excellent_get_color_schemes() {
	return apply_filters( 'excellent_color_schemes', array(
		'default_color' => array(
			'label'  => __( '--Default--', 'excellent' ),
			'colors' => array(
				'#fb876b',
				'#fb876b',
				'#fb876b',
				'#fb876b',
			),
		),
		'dark'    => array(
			'label'  => __( 'Dark', 'excellent' ),
			'colors' => array(
				'#fb876b',
				'#111111',
				'#111111',
				'#111111',
			),
		),
		'yellow'  => array(
			'label'  => __( 'Yellow', 'excellent' ),
			'colors' => array(
				'#fb876b',
				'#ffae00',
				'#ffae00',
				'#ffae00',
			),
		),
		'pink'    => array(
			'label'  => __( 'Red', 'excellent' ),
			'colors' => array(
				'#fb876b',
				'#ff0000',
				'#ff0000',
				'#ff0000',
			),
		),
		'blue'   => array(
			'label'  => __( 'Blue', 'excellent' ),
			'colors' => array(
				'#fb876b',
				'#009eed',
				'#009eed',
				'#009eed',
			),
		),
		'purple'   => array(
			'label'  => __( 'Purple', 'excellent' ),
			'colors' => array(
				'#fb876b',
				'#9651cc',
				'#9651cc',
				'#9651cc',
			),
		),
		'vanburenborwn'    => array(
			'label'  => __( 'Van Buren Brown', 'excellent' ),
			'colors' => array(
				'#fb876b',
				'#a57a6b',
				'#a57a6b',
				'#a57a6b',
			),
		),
		'green'    => array(
			'label'  => __( 'Green', 'excellent' ),
			'colors' => array(
				'#fb876b',
				'#2dcc70',
				'#2dcc70',
				'#2dcc70',
			),
		),
	) );
}

if ( ! function_exists( 'excellent_get_color_scheme' ) ) :
/**
 * Get the current Excellent color scheme.
 *
 * @since Excellent 1.0
 *
 * @return array An associative array of either the current or default color scheme hex values.
 */
function excellent_get_color_scheme() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default_color' );
	$color_schemes       = excellent_get_color_schemes();

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['default_color']['colors'];
}
endif;

if ( ! function_exists( 'excellent_get_color_scheme_choices' ) ) :
/**
 * Returns an array of color scheme choices registered for Excellent.
 *
 * @since Excellent 1.0
 *
 * @return array Array of color schemes.
 */
function excellent_get_color_scheme_choices() {
	$color_schemes                = excellent_get_color_schemes();
	$color_scheme_control_options = array();

	foreach ( $color_schemes as $color_scheme => $value ) {
		$color_scheme_control_options[ $color_scheme ] = $value['label'];
	}

	return $color_scheme_control_options;
}
endif; // excellent_get_color_scheme_choices

if ( ! function_exists( 'excellent_sanitize_color_scheme' ) ) :
/**
 * Sanitization callback for color schemes.
 *
 * @since Excellent 1.0
 *
 * @param string $value Color scheme name value.
 * @return string Color scheme name.
 */
function excellent_sanitize_color_scheme( $value ) {
	$color_schemes = excellent_get_color_scheme_choices();

	if ( ! array_key_exists( $value, $color_schemes ) ) {
		$value = 'default_color';
	}

	return $value;
}
endif; // excellent_sanitize_color_scheme

/**
 * Enqueues front-end CSS for color scheme.
 *
 * @since Excellent 1.0
 *
 * @see wp_add_inline_style()
 */
function excellent_color_scheme_css() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default_color' );

	// Don't do anything if the default_color color scheme is selected.
	if ( 'default_color' === $color_scheme_option ) {
		return;
	}

	$color_scheme = excellent_get_color_scheme();

	$colors = array(
		'site_page_nav_link_title_color'        => get_theme_mod('site_page_nav_link_title_color',$color_scheme[3]),
		'excellent_button_color'    => get_theme_mod('excellent_button_color',$color_scheme[3]),
		'excellent_feature_box_color'    => get_theme_mod('excellent_feature_box_color',$color_scheme[3]),
		'excellent_bbpress_woocommerce_color'        => get_theme_mod('excellent_bbpress_woocommerce_color',$color_scheme[3]),
	);

	$color_scheme_css = excellent_get_color_scheme_css( $colors );

	wp_add_inline_style( 'excellent-style', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'excellent_color_scheme_css' );

/**
 * Binds JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 * @since Excellent 1.0
 */
function excellent_customize_control_js() {
	wp_enqueue_script( 'color-scheme-control', get_template_directory_uri() . '/js/color-scheme-control.js', array( 'customize-controls' ), '20160824', true );
	wp_localize_script( 'color-scheme-control', 'colorScheme', excellent_get_color_schemes() );
}
add_action( 'customize_controls_enqueue_scripts', 'excellent_customize_control_js' );

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Excellent 1.0.4
 */
function excellent_customize_preview_js() {
	wp_enqueue_script( 'excellent-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20160824', true );
}

add_action( 'customize_preview_init', 'excellent_customize_preview_js' );

/**
 * Returns CSS for the color schemes.
 *
 * @since Excellent 1.0
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */
function excellent_get_color_scheme_css( $colors ) {
	$colors = wp_parse_args( $colors, array(
		'site_page_nav_link_title_color'        => '#fb876b',
		'excellent_button_color'    => '#fb876b',
		'excellent_feature_box_color'        => '#fb876b',
		'excellent_bbpress_woocommerce_color'        => '#fb876b',
		
	) );
	$css = <<<CSS
	/****************************************************************/
						/*.... Color Style ....*/
	/****************************************************************/
	/* Nav, links and hover */
	a,
	ul li a:hover,
	ol li a:hover,
	.top-bar .top-bar-menu a:hover,
	.top-bar .widget_contact ul li a:hover, /* Top Header Widget Contact */
	.main-navigation a:hover, /* Navigation */
	.main-navigation ul li.current-menu-item a,
	.main-navigation ul li.current_page_ancestor a,
	.main-navigation ul li.current-menu-ancestor a,
	.main-navigation ul li.current_page_item a,
	.main-navigation ul li:hover > a,
	.main-navigation li.current-menu-ancestor.menu-item-has-children > a:after,
	.main-navigation li.current-menu-item.menu-item-has-children > a:after,
	.main-navigation ul li:hover > a:after,
	.main-navigation li.menu-item-has-children > a:hover:after,
	.main-navigation li.page_item_has_children > a:hover:after,
	.main-navigation ul li ul li a:hover,
	.main-navigation ul li ul li:hover > a,
	.main-navigation ul li.current-menu-item ul li a:hover,
	.header-search:hover, .header-search-x:hover, /* Header Search Form */
	.entry-title a:hover, /* Post */
	.entry-title a:focus,
	.entry-title a:active,
	.entry-meta .author a,
	.entry-meta span:hover,
	.entry-meta a:hover,
	.cat-links,
	.cat-links a,
	.tag-links,
	.tag-links a,
	.image-navigation .nav-links a,
	.widget ul li a:hover, /* Widgets */
	.widget-title a:hover,
	.widget_contact ul li a:hover,
	.site-info .copyright a:first-child,
	.site-info .copyright a:hover, /* Footer */
	#colophon .widget ul li a:hover,
	#footer-navigation a:hover {
		color:  {$colors['site_page_nav_link_title_color']};
	}
	/* -_-_-_ Not for change _-_-_- */
	.entry-meta .entry-format a {
		color: #fff;
	}
	.widget_meta ul li:before,
	.widget_recent_comments ul li:before,
	.widget_categories ul li:before,
	.widget_recent_entries ul li:before,
	.widget_archive ul li:before,
	.entry-format a {
		background-color:  {$colors['site_page_nav_link_title_color']};
	}
	/* Webkit */
	::selection {
		background:  {$colors['site_page_nav_link_title_color']};
		color: #fff;
	}
	/* Gecko/Mozilla */
	::-moz-selection {
		background:  {$colors['site_page_nav_link_title_color']};
		color: #fff;
	}

	/* Accessibility
	================================================== */
	.screen-reader-text:hover,
	.screen-reader-text:active,
	.screen-reader-text:focus {
		background-color: #f1f1f1;
		color:  {$colors['site_page_nav_link_title_color']};
	}

/* Default Buttons
================================================== */

	input[type="reset"],/* Forms  */
	input[type="button"],
	input[type="submit"],
	.main-slider .flex-control-nav a.flex-active,
	.main-slider .flex-control-nav a:hover,
	.go-to-top .icon-bg,
	a.more-link:hover,
	.testimonial-box .flex-control-nav li a.flex-active,
	.testimonial-box .flex-control-nav li a:hover {
		background-color:{$colors['excellent_button_color']};
	}
	/* Testimonial Pagination Buttons */
	.testimonial-box .flex-control-nav li a.flex-active:before,
	.testimonial-box .flex-control-nav li a:hover:before {
		border-color:{$colors['excellent_button_color']};
	}
	/* Buttons */
	.btn-default:hover,
	.vivid,
	.search-submit{
		background-color: {$colors['excellent_button_color']};
		border: 1px solid {$colors['excellent_button_color']};
	}

	/* -_-_-_ Not for change _-_-_- */
	.light-color:hover,
	.vivid:hover {
		background-color: #fff;
		border: 1px solid #fff;
	}
/* Our Feature Big letter and link
================================================== */
	.our-feature-box .feature-title a:first-letter,
	.our-feature-box a.more-link {
		color: {$colors['excellent_feature_box_color']};
	}
/* #bbpress
	================================================== */
	#bbpress-forums .bbp-topics a:hover {
		color: {$colors['excellent_bbpress_woocommerce_color']};
	}
	.bbp-submit-wrapper button.submit {
		background-color: {$colors['excellent_bbpress_woocommerce_color']};
		border: 1px solid {$colors['excellent_bbpress_woocommerce_color']};
	}

	/* Woocommerce
	================================================== */
	.woocommerce #respond input#submit, 
	.woocommerce a.button, 
	.woocommerce button.button, 
	.woocommerce input.button,
	.woocommerce #respond input#submit.alt, 
	.woocommerce a.button.alt, 
	.woocommerce button.button.alt, 
	.woocommerce input.button.alt,
	.woocommerce-demo-store p.demo_store {
		background-color: {$colors['excellent_bbpress_woocommerce_color']};
	}
	.woocommerce .woocommerce-message:before {
		color: {$colors['excellent_bbpress_woocommerce_color']};
	}
CSS;

	return $css;
}
function excellent_color_scheme_css_template() {
	$colors = array(

		// Color Styles
		'site_page_nav_link_title_color'        => '{{ data.site_page_nav_link_title_color }}',
		'excellent_button_color'    => '{{ data.excellent_button_color }}',
		'excellent_feature_box_color'    => '{{ data.excellent_feature_box_color }}',
		'excellent_bbpress_woocommerce_color'        => '{{ data.excellent_bbpress_woocommerce_color }}',
	);
	?>
	<script type="text/html" id="tmpl-excellent-color-scheme">
		<?php echo excellent_get_color_scheme_css( $colors ); ?>
	</script>
<?php
}
add_action( 'customize_controls_print_footer_scripts', 'excellent_color_scheme_css_template' );