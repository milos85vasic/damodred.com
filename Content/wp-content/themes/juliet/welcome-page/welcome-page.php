<?php
/**
 * Welcome Page
 *
 * @package Juliet
 */
/**
 * Include Welcome page class
 */
require_once get_template_directory() . '/welcome-page/class.welcomepage.php';

/**
 * Welcome page config
 */
$config = array(
	'menu_label'       => esc_html__( 'Welcome to Juliet', 'juliet' ),
	'page_title'       => esc_html__( 'Welcome to Juliet', 'juliet' ),
	/* Translators: Theme name */
	'welcome_title'   => sprintf( esc_html__( 'Welcome to %s, version ', 'juliet' ), 'Juliet' ),
	// 'welcome_content' => '',
	/**
	 * Tabs
	 */
	'tabs' => array(
		'getting_started' => esc_html__( 'Getting Started', 'juliet' ),
		'support'         => esc_html__( 'Support', 'juliet' ),
		'free_vs_pro'     => esc_html__( 'Free vs Pro', 'juliet' ),
	),
	/**
	 * Getting started tab
	 */
	'getting_started' => array(
		'cards' => array(
			'one' => array(
				'title'       => esc_html__( 'Required Actions', 'juliet' ),
				'description' => esc_html__( 'Be sure to install and activate the Kirki plugin. It is required to make full use of the customization features of this theme.', 'juliet' ),
				'btn_label'   => esc_html__( 'Install Plugins', 'juliet' ),
				'btn_url'     => esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ),
				'new_tab'     => false,
			),
			'two' => array(
				'title'       => esc_html__( 'Documentation', 'juliet' ),
				'description' => esc_html__( 'For more information on how to fully utilize all the features of Juliet, please check the full documentation.', 'juliet' ),
				'btn_label'   => esc_html__( 'Documentation', 'juliet' ),
				'btn_url'     => esc_url( 'https://help.lyrathemes.com/#collection-274' ),
				'new_tab'     => true,
			),
			'three' => array(
				'title'       => esc_html__( 'Customize and Set Up', 'juliet' ),
				'description' => esc_html__( 'Use the WordPress Customizer to set up and customize your website.', 'juliet' ),
				'btn_label'   => esc_html__( 'Go to the Customizer', 'juliet' ),
				'btn_url'     => esc_url( admin_url( 'customize.php' ) ),
				'new_tab'     => false,
			),
		),
	),

	/**
	 * Support tab
	 */
	'support' => array(
		'cards' => array(
			'one' => array(
				'title'       => esc_html__( 'Contact Support', 'juliet' ),
				'description' => esc_html__( "If you need any help with theme set up or options, enhancements, or have any questions about how a feature works, please feel free to reach out to us and we'd be happy to assist. LyraThemes has a world class support team, and we try our best to respond to all queries within 24-48 hours.", "juliet" ),
				'btn_label'   => esc_html__( 'Contact Support', 'juliet' ),
				'btn_url'     => esc_url( 'https://www.lyrathemes.com/support/' ),
				'new_tab'     => true,
			),
			'two' => array(
				'title'       => esc_html__( 'Documentation', 'juliet' ),
				'description' => esc_html__( 'For more information on how to fully utilize all the features of Juliet, please check the full documentation.', 'juliet' ),
				'btn_label'   => esc_html__( 'Documentation', 'juliet' ),
				'btn_url'     => esc_url( 'https://help.lyrathemes.com/#collection-274' ),
				'new_tab'     => true,
			),
		),
	),

	/**
	 * Free vs Pro tab
	 */
	'free_vs_pro' => array(
		'free'     => esc_html__( 'Juliet', 'juliet' ),
		'pro'      => esc_html__( 'Juliet Pro', 'juliet' ),
		'pro_url'  => esc_url( 'https://www.lyrathemes.com/juliet-pro/' ),
		'compare_url'  => esc_url( 'https://www.lyrathemes.com/juliet/#comparison' ),
		'features_list' => array(
			esc_html__( 'Two Header Options', 'juliet' ),
            esc_html__( 'Special Lookbook / Index Template', 'juliet' ),
            esc_html__( 'Built-in About Me Widget', 'juliet' ),
            esc_html__( 'Built-in MailChimp Subscription Form Widget', 'juliet' ),
            esc_html__( 'Built-in Ads', 'juliet' ),
            esc_html__( 'Sticky Header/Navigation', 'juliet' ),
            esc_html__( 'Front Page Posts and Custom Slider', 'juliet' ),
            esc_html__( 'YouTube and Vimeo Video Slides', 'juliet' ),
            esc_html__( 'Front Page Featured Links/Boxes', 'juliet' ),
            esc_html__( 'Front Page Highlight Post', 'juliet' ),
            esc_html__( 'Front Page Focus Posts', 'juliet' ),
            esc_html__( 'Integration with WP Instagram Widget', 'juliet' ),
            esc_html__( 'Built-in Related Posts', 'juliet' ),
            esc_html__( '600+ Google Fonts', 'juliet' ),
            esc_html__( 'Custom Fonts and Colors', 'juliet' ),
            esc_html__( 'Left Hand Sidebars', 'juliet' ),
            esc_html__( 'One-click Demo Import', 'juliet' ),

            // free
            esc_html__( 'Classic and Contemporary Skins', 'juliet' ),
            esc_html__( 'Full WooCommerce Integration', 'juliet' ),
            esc_html__( 'Off Canvas Menus', 'juliet' ),
            esc_html__( 'Front Page Banner', 'juliet' ),
            esc_html__( 'Front Page Featured Posts', 'juliet' ),
            esc_html__( 'Special Sticky Posts Format with Signature', 'juliet' ),
            esc_html__( 'Full Width Home Page & Blog Feed', 'juliet' ),
            esc_html__( 'Optional Full Width Posts and Pages', 'juliet' ),
            esc_html__( 'Excerpt or Full Blog Feed Layouts', 'juliet' ),	
            esc_html__( 'Integration with MailPoet', 'juliet' ),
            esc_html__( 'Easy to Create Social Media Icon Menus', 'juliet' ),
            esc_html__( 'Header and Footer Area Widgets', 'juliet' ),
            esc_html__( 'Post and Front Page Specific Sidebars', 'juliet' ),	
            esc_html__( 'Footer Widgets', 'juliet' ),
		),
		'features_free' => array(
			false,
            false,
            false,
            false,
            false,
            false,
            false,
            false,
            false,
            false,
            false,
            false,
            false,
            false,
            false,
            false,
            false,
            // free
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
		),
		'features_pro' => array(
			true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            // free
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
		),
	),
);
/**
 * Initialize Welcome page
 */
Juliet_Welcome_Page::init( apply_filters( 'juliet_welcome_page_config', $config ) );
