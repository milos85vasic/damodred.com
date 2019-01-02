<?php
/**
 * Welcome Page
 *
 * @package Kale
 */
/**
 * Include Welcome page class
 */
require_once get_template_directory() . '/welcome-page/class.welcomepage.php';

/**
 * Welcome page config
 */
$config = array(
	'menu_label'       => esc_html__( 'Welcome to Kale', 'kale' ),
	'page_title'       => esc_html__( 'Welcome to Kale', 'kale' ),
	/* Translators: Theme name */
	'welcome_title'   => sprintf( esc_html__( 'Welcome to %s, version ', 'kale' ), 'Kale' ),
	// 'welcome_content' => '',
	/**
	 * Tabs
	 */
	'tabs' => array(
		'getting_started' => esc_html__( 'Getting Started', 'kale' ),
		'support'         => esc_html__( 'Support', 'kale' ),
		'recommended'     => esc_html__( 'Recommended Plugins', 'kale' ),
		'free_vs_pro'     => esc_html__( 'Free vs Pro', 'kale' ),
	),
	/**
	 * Getting started tab
	 */
	'getting_started' => array(
		'cards' => array(
			'one' => array(
				'title'       => esc_html__( 'Required Actions', 'kale' ),
				'description' => esc_html__( 'Be sure to install and activate the Kirki plugin. It is required to make full use of the customization features of this theme.', 'kale' ),
				'btn_label'   => esc_html__( 'Install Plugins', 'kale' ),
				'btn_url'     => esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ),
				'new_tab'     => false,
			),
			'two' => array(
				'title'       => esc_html__( 'Documentation', 'kale' ),
				'description' => esc_html__( 'For more information on how to fully utilize all the features of Kale, please check the full documentation.', 'kale' ),
				'btn_label'   => esc_html__( 'Documentation', 'kale' ),
				'btn_url'     => esc_url( 'https://help.lyrathemes.com/#collection-181' ),
				'new_tab'     => true,
			),
			'three' => array(
				'title'       => esc_html__( 'Customize and Set Up', 'kale' ),
				'description' => esc_html__( 'Use the WordPress Customizer to set up and customize your website. Click the button below, or go to Appearance > Customize.', 'kale' ),
				'btn_label'   => esc_html__( 'Go to the Customizer', 'kale' ),
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
				'title'       => esc_html__( 'Contact Support', 'kale' ),
				'description' => esc_html__( "If you need any help with theme set up, options, enhancements, or about how a feature works, please feel free to reach out and we'd be happy to assist. LyraThemes has a world class support team, and we try our best to respond to all queries within 24-48 hours.", "kale" ),
				'btn_label'   => esc_html__( 'Contact Support', 'kale' ),
				'btn_url'     => esc_url( 'https://www.lyrathemes.com/support/' ),
				'new_tab'     => true,
			),
			'two' => array(
				'title'       => esc_html__( 'Documentation', 'kale' ),
				'description' => esc_html__( 'For more information on how to fully utilize all the features of Elara, please review the full documentation. We have tried to add as much information as possible, including screenshots and videos, to help you make the most of this theme.', 'kale' ),
				'btn_label'   => esc_html__( 'Documentation', 'kale' ),
				'btn_url'     => esc_url( 'https://help.lyrathemes.com/#collection-181' ),
				'new_tab'     => true,
			),
		),
	),

	/**
	 * Recommended Plugins tab
	 */
	'recommended' => array(
		'cards' => array(
			'one' => array(
				'title'       => esc_html__( 'Kirki', 'kale' ),
				'description' => esc_html__( "Kirki helps us create rich experiences for the WordPress Customizer. Be sure to install and activate the Kirki plugin. It is required to make full use of the customization features of this theme.", "kale" ),
				'btn_label'   => esc_html__( 'Install Kirki', 'kale' ),
				'btn_url'     => esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ),
				'new_tab'     => false,
			),
            'two' => array(
				'title'       => esc_html__( 'WPForms', 'kale' ),
				'description' => esc_html__( 'Drag and drop form builder that helps you create beautiful contact forms with just a few clicks. Kale integrates well with WPForms and you can use it to create contact, newsletter, suggestion forms, etc. ', 'kale' ),
				'btn_label'   => esc_html__( 'Get WPForms', 'kale' ),
				'btn_url'     => esc_url( 'https://shareasale.com/r.cfm?b=837827&u=1288386&m=64312&urllink=&afftrack=' ),
				'new_tab'     => true,
			),
			'three' => array(
				'title'       => esc_html__( 'Recent Posts Widget With Thumbnails', 'kale' ),
				'description' => esc_html__( 'List the most recent posts with post titles, thumbnails, excerpts, authors, categories, dates and more! You can use it to showcase special posts in your sidebar.', 'kale' ),
				'btn_label'   => esc_html__( 'Install Now', 'kale' ),
				'btn_url'     => esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ),
				'new_tab'     => false,
			),
		),
	),

	/**
	 * Free vs Pro tab
	 */
	'free_vs_pro' => array(
		'free'     => esc_html__( 'Kale', 'kale' ),
		'pro'      => esc_html__( 'Kale Pro', 'kale' ),
		'pro_url'  => esc_url( 'https://www.lyrathemes.com/kale-pro/' ),
		'compare_url'  => esc_url( 'https://www.lyrathemes.com/kale/#comparison' ),
		'features_list' => array(
            //pro
			esc_html__( 'Built-in Ads', 'kale' ),
            esc_html__( 'Unlimited Color Schemes', 'kale' ),
            esc_html__( '600+ Google Fonts', 'kale' ),
            esc_html__( 'Sort/Rearrange Front Page Sections', 'kale' ),
            esc_html__( 'Built-in MailChimp Widget', 'kale' ),
            esc_html__( 'Built-in About Me Widget', 'kale' ),
            esc_html__( 'Front Page Without Sidebar (Full Width)', 'kale' ),
            esc_html__( 'Front Page Featured Pages', 'kale' ),
            esc_html__( 'Front Page Custom Slider With Icons', 'kale' ),
            esc_html__( 'Front Page Vertical Posts', 'kale' ),
            esc_html__( 'Special Recipe Index Template (Drag/Drop Sortable Categories)', 'kale' ),
            esc_html__( 'Recipe Shortcode Builder', 'kale' ),
            esc_html__( 'Structured Data Google Friendly Recipe Cards (Printable)', 'kale' ),
            esc_html__( 'Full Content/Image Blog Feed Layout', 'kale' ),
            esc_html__( 'Extra Sidebars', 'kale' ),
            esc_html__( 'Full WooCommerce Integration', 'kale' ),
            esc_html__( 'Extra Page Post and WooCommerce Sidebars', 'kale' ),
            esc_html__( 'Fixed Main Nav Option', 'kale' ),

            //free
            esc_html__( 'Front Page Banner', 'kale' ),
            esc_html__( 'Front Page Posts Slider', 'kale' ),
            esc_html__( 'Two Sidebar Sizes', 'kale' ),
            esc_html__( 'Front Page Featured Posts', 'kale' ),
            esc_html__( 'Front Page Highlight Post', 'kale' ),
            esc_html__( 'Image and Text Logos', 'kale' ),
            esc_html__( 'Special Category Template', 'kale' ),
            esc_html__( 'Two-in-a-Row Blog Feed Layout', 'kale' ),
            esc_html__( 'Integration with MailPoet', 'kale' ),
            esc_html__( 'Header and Footer Area Widgets', 'kale' ),
            esc_html__( 'Basic WooCommerce Integration', 'kale' ),
            esc_html__( 'Automatically Responsive YouTube Videos', 'kale' ),
            esc_html__( 'Banner on Pages', 'kale' ),
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
            false,

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
Kale_Welcome_Page::init( apply_filters( 'kale_welcome_page_config', $config ) );
