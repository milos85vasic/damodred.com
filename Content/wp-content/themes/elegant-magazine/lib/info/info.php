<?php
/**
 * Info setup
 *
 * @package Elegant_Magazine
 */

if ( ! function_exists( 'elegant_magazine_details_setup' ) ) :

	/**
	 * Info setup.
	 *
	 * @since 1.0.0
	 */
	function elegant_magazine_details_setup() {

		$config = array(

			// Welcome content.
			'welcome-texts' => sprintf( esc_html__( 'Howdy %1$s, we would like to thank you for installing and activating %2$s theme for your precious site. All of the features provided by the theme are now ready to use; Here, we have gathered all of the essential details and helpful links for you and your better experience with %2$s. Once again, Thanks for using our theme!', 'elegant-magazine' ), get_bloginfo('name'), 'Elegant Magazine' ),

			// Tabs.
			'tabs' => array(
				'getting-started' => esc_html__( 'Getting Started', 'elegant-magazine' ),
				'support'         => esc_html__( 'Support', 'elegant-magazine' ),
				'useful-plugins'  => esc_html__( 'Useful Plugins', 'elegant-magazine' ),
				'demo-content'    => esc_html__( 'Demo Content', 'elegant-magazine' ),
				'upgrade-to-pro'  => esc_html__( 'Upgrade to Pro', 'elegant-magazine' ),
				),

			// Quick links.
			'quick_links' => array(
				'theme_url' => array(
					'text' => esc_html__( 'Theme Details', 'elegant-magazine' ),
					'url'  => 'https://www.afthemes.com/products/elegant-magazine/',
					),
				'demo_url' => array(
					'text' => esc_html__( 'View Demo', 'elegant-magazine' ),
					'url'  => 'https://www.afthemes.com/elegant-magazine-demos/',
					),
				'documentation_url' => array(
					'text' => esc_html__( 'View Documentation', 'elegant-magazine' ),
					'url'  => 'https://docs.afthemes.com/themes/elegant-magazine/',
					),
				'rating_url' => array(
					'text' => esc_html__( 'Rate This Theme','elegant-magazine' ),
					'url'  => 'https://wordpress.org/support/theme/elegant-magazine/reviews/#new-post',
					),
				),

			// Getting started.
			'getting_started' => array(
				'one' => array(
					'title'       => esc_html__( 'Theme Documentation', 'elegant-magazine' ),
					'icon'        => 'dashicons dashicons-format-aside',
					'description' => esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'elegant-magazine' ),
					'button_text' => esc_html__( 'View Documentation', 'elegant-magazine' ),
					'button_url'  => 'https://docs.afthemes.com/themes/elegant-magazine/',
					'button_type' => 'link',
					'is_new_tab'  => true,
					),
				'two' => array(
					'title'       => esc_html__( 'Static Front Page', 'elegant-magazine' ),
					'icon'        => 'dashicons dashicons-admin-generic',
					'description' => esc_html__( 'To achieve custom home page other than blog listing, you need to create and set static front page.', 'elegant-magazine' ),
					'button_text' => esc_html__( 'Static Front Page', 'elegant-magazine' ),
					'button_url'  => admin_url( 'customize.php?autofocus[section]=static_front_page' ),
					'button_type' => 'primary',
					),
				'three' => array(
					'title'       => esc_html__( 'Theme Options', 'elegant-magazine' ),
					'icon'        => 'dashicons dashicons-admin-customizer',
					'description' => esc_html__( 'Theme uses Customizer API for theme options. Using the Customizer you can easily customize different aspects of the theme.', 'elegant-magazine' ),
					'button_text' => esc_html__( 'Customize', 'elegant-magazine' ),
					'button_url'  => wp_customize_url(),
					'button_type' => 'primary',
					),
				'four' => array(
					'title'       => esc_html__( 'Widgets', 'elegant-magazine' ),
					'icon'        => 'dashicons dashicons-welcome-widgets-menus',
					'description' => esc_html__( 'Theme uses Wedgets API for widget options. Using the Widgets you can easily customize different aspects of the theme.', 'elegant-magazine' ),
                    'button_text' => esc_html__( 'Widgets', 'elegant-magazine' ),
                    'button_url'  => admin_url('widgets.php'),
                    'button_type' => 'primary',
					),
				'five' => array(
					'title'       => esc_html__( 'Demo Content', 'elegant-magazine' ),
					'icon'        => 'dashicons dashicons-layout',
					'description' => sprintf( esc_html__( 'To import sample demo content, %1$s plugin should be installed and activated. After plugin is activated, visit Import Demo Data menu under Appearance.', 'elegant-magazine' ), esc_html__( 'One Click Demo Import', 'elegant-magazine' ) ),
					'button_text' => esc_html__( 'Demo Content', 'elegant-magazine' ),
					'button_url'  => admin_url( 'themes.php?page=elegant-magazine-info&tab=demo-content' ),
					'button_type' => 'secondary',
					),
				'six' => array(
					'title'       => esc_html__( 'Theme Preview', 'elegant-magazine' ),
					'icon'        => 'dashicons dashicons-welcome-view-site',
					'description' => esc_html__( 'You can check out the theme demos for reference to find out what you can achieve using the theme and how it can be customized.', 'elegant-magazine' ),
					'button_text' => esc_html__( 'View Demo', 'elegant-magazine' ),
					'button_url'  => 'https://demo.afthemes.com/elegant-magazine/',
					'button_type' => 'link',
					'is_new_tab'  => true,
					),
				),

			// Support.
			'support' => array(
				'one' => array(
					'title'       => esc_html__( 'Contact Support', 'elegant-magazine' ),
					'icon'        => 'dashicons dashicons-sos',
					'description' => esc_html__( 'Got theme support question or found bug or got some feedbacks? Best place to ask your query is the dedicated Support forum for the theme.', 'elegant-magazine' ),
					'button_text' => esc_html__( 'Contact Support', 'elegant-magazine' ),
					'button_url'  => 'https://www.afthemes.com/supports/',
					'button_type' => 'link',
					'is_new_tab'  => true,
					),
				'two' => array(
					'title'       => esc_html__( 'Theme Documentation', 'elegant-magazine' ),
					'icon'        => 'dashicons dashicons-format-aside',
					'description' => esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'elegant-magazine' ),
					'button_text' => esc_html__( 'View Documentation', 'elegant-magazine' ),
					'button_url'  => 'https://docs.afthemes.com/themes/elegant-magazine/',
					'button_type' => 'link',
					'is_new_tab'  => true,
					),
				'three' => array(
					'title'       => esc_html__( 'Child Theme', 'elegant-magazine' ),
					'icon'        => 'dashicons dashicons-admin-tools',
					'description' => esc_html__( 'For advanced theme customization, it is recommended to use child theme rather than modifying the theme file itself. Using this approach, you wont lose the customization after theme update.', 'elegant-magazine' ),
					'button_text' => esc_html__( 'Learn More', 'elegant-magazine' ),
					'button_url'  => 'https://developer.wordpress.org/themes/advanced-topics/child-themes/',
					'button_type' => 'link',
					'is_new_tab'  => true,
					),
				),

			 //Useful plugins.
			'useful_plugins' => array(
				'description' => esc_html__( 'Theme supports some helpful WordPress plugins to enhance your site. But, please enable only those plugins which you need in your site. For example, enable WooCommerce only if you are using e-commerce.', 'elegant-magazine' ),
				),

			 //Demo content.
			'demo_content' => array(
				'description' => sprintf( esc_html__( 'To import demo content for this theme, %1$s plugin is needed. Please make sure plugin is installed and activated. After plugin is activated, you will see Import Demo Data menu under Appearance.', 'elegant-magazine' ), '<a href="https://wordpress.org/plugins/one-click-demo-import/" target="_blank">' . esc_html__( 'One Click Demo Import', 'elegant-magazine' ) . '</a>' ),
				),

			// Upgrade content.
			'upgrade_to_pro' => array(
				'description' => esc_html__( 'If you want more advanced features then you can upgrade to the premium version of the theme.', 'elegant-magazine' ),
				'button_text' => esc_html__( 'Upgrade Now', 'elegant-magazine' ),
				'button_url'  => 'https://afthemes.com/products/elegant-magazine-pro/',
				'button_type' => 'primary',
				'is_new_tab'  => true,
				),
			);

		Elegant_Magazine_Info::init( $config );
	}

endif;

add_action( 'after_setup_theme', 'elegant_magazine_details_setup' );