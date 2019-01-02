<?php
/**
 * Theme Info Page
 * Special thanks to the Consulting theme by ThinkUpThemes for this info page to be used as a foundation.
 * @package Blogg
 */
 
function blogg_info() {    


	// About page instance
	// Get theme data
	$theme_data     = wp_get_theme();

	// Get name of parent theme

		$theme_name    = trim( ucwords( str_replace( ' (Lite)', '', $theme_data->get( 'Name' ) ) ) );
		$theme_slug    = trim( strtolower( str_replace( ' (Lite)', '-lite', $theme_data->get( 'Name' ) ) ) );
		$theme_version = $theme_data->get( 'Version' );

	$config = array(
		// translators: %1$s: menu title under appearance
		'menu_name'             => sprintf( esc_html__( 'About %1$s', 'blogg' ), ucfirst( $theme_name ) ),
		// translators: %1$s: page name 
		'page_name'             => sprintf( esc_html__( 'About %1$s', 'blogg' ), ucfirst( $theme_name ) ),
		// translators: %1$s: welcome title 
		'welcome_title'         => sprintf( esc_html__( 'Welcome to %1$s - v', 'blogg' ), ucfirst( $theme_name ) ),
		// translators: %1$s: welcome content 
		'welcome_content'       => sprintf( esc_html__(  '%1$s is a unique design concept where retro and modern merged into a vibrant and dynamic theme designed for bloggers that love to tell stories and express words to capture attention. With a choice of   many blog layouts, full post layouts, dynamic width sidebars, a flexible featured post slider, unlimited colours, and a ton of customization settings; Blogg provides all you need to quickly and easily create a stunning blog that you and your readers will love.', 'blogg' ), ucfirst( $theme_name ) ),
		
		/**
		 * Tabs array.
		 *
		 * The key needs to be ONLY consisted from letters and underscores. If we want to define outside the class a function to render the tab,
		 * the will be the name of the function which will be used to render the tab content.
		 */
		
		'tabs'                 => array(
			'getting_started'  => esc_html__( 'Getting Started', 'blogg' ),
			'support_content'  => esc_html__( 'Support', 'blogg' ),
			'changelog'           => esc_html__( 'Changelog', 'blogg' ),
			'free_pro'         => esc_html__( 'Free VS PRO', 'blogg' ),
		),
		// Getting started tab
		'getting_started' => array(
			'first' => array (
				'title'               => esc_html__( 'Setup Documentation', 'blogg' ),
				'text'                => sprintf( esc_html__( 'To help you get started with the initial setup of this theme and to learn about the various features, you can check out detailed setup documentation.', 'blogg' ) ),
				// translators: %1$s: theme name 
				'button_label'        => sprintf( esc_html__( 'View %1$s Tutorials', 'blogg' ), ucfirst( $theme_name ) ),
				'button_link'         => esc_url( '//www.bloggingthemestyles.com/setup-blogg' ),
				'is_button'           => true,
				'recommended_actions' => false,
                'is_new_tab'          => true,
			),
			'second' => array(
				'title'               => esc_html__( 'Go to Customizer', 'blogg' ),
				'text'                => esc_html__( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'blogg' ),
				'button_label'        => esc_html__( 'Go to Customizer', 'blogg' ),
				'button_link'         => esc_url( admin_url( 'customize.php' ) ),
				'is_button'           => true,
				'recommended_actions' => false,
                'is_new_tab'          => true,
			),
			
			'third' => array(
				'title'               => esc_html__( 'Using a Child Theme', 'blogg' ),
				'text'                => sprintf( esc_html__( 'If you plan to customize this theme, I recommend looking into using a child theme. To learn more about child themes and why it\'s important to use one, check out the WordPress documentation.', 'blogg' ) ),
				'button_label'        => sprintf( esc_html__( 'Child Themes', 'blogg' ), ucfirst( $theme_name ) ),
				'button_link'         => esc_url( '//developer.wordpress.org/themes/advanced-topics/child-themes/' ),
				'is_button'           => true,
				'recommended_actions' => false,
                'is_new_tab'          => true,
			),		
		),

		// Changelog content tab.
		'changelog'      => array(
			'first' => array (				
				'title'        => esc_html__( 'Changelog', 'blogg' ),
				'text'         => esc_html__( 'I generally recommend you always read the CHANGELOG before updating so that you can see what was fixed, changed, deleted, or added to the theme.', 'blogg' ),	
				'button_label' => '',
				'button_link'  => '',
				'is_button'    => false,
				'is_new_tab'   => false,				
				),
		),			
		// Support content tab.
		'support_content'      => array(
			'first' => array (
				'title'        => esc_html__( 'Free Support', 'blogg' ),
				'icon'         => 'dashicons dashicons-sos',
				'text'         => esc_html__( 'If you experience any problems, please post your questions to support and we will be more than happy to help you out.', 'blogg' ),
				'button_label' => esc_html__( 'Get Free Support', 'blogg' ),
				'button_link'  => esc_url( '//wordpress.org/support/theme/blogg' ),
				'is_button'    => true,
				'is_new_tab'   => true,
			),
			'second' => array(
				'title'        => esc_html__( 'Common Problems', 'blogg' ),
				'icon'         => 'dashicons dashicons-editor-help',
				'text'         => esc_html__( 'For quick answers to the most common problems, you can check out the tutorials which can provide instant solutions and answers.', 'blogg' ),
				'button_label' => sprintf( esc_html__( 'Get Answers', 'blogg' ) ),
				'button_link'  => '//www.bloggingthemestyles.com/support/common-problems',
				'is_button'    => true,
				'is_new_tab'   => true,
			),

		),	
		// Free vs pro array.
		'free_pro'                => array(
			'free_theme_name'     => ucfirst( $theme_name ) . ' (free)',
			'pro_theme_name'      => esc_html__('Blogg Pro','blogg' ),
			'pro_theme_link'      => '//www.bloggingthemestyles.com/wordpress-themes/blogg-pro/',
			'get_pro_theme_label' => sprintf( esc_html__( 'Get Blogg Pro', 'blogg' ) ),
			'features'            => array(
				array(
					'title'            => esc_html__( 'Mobile Friendly', 'blogg' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),		
				array(
					'title'            => esc_html__( 'Change Accent Colours', 'blogg' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),	
				array(
					'title'            => esc_html__( 'Featured Post Slider', 'blogg' ),
					'description'      => esc_html__('Showcase posts from your category of choice.', 'blogg'),
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),						
				array(
					'title'            => esc_html__( 'Adjustable Page Width', 'blogg' ),
					'description'      => esc_html__('If you prefer a boxed layout instead of full width, you can adjust the page width.', 'blogg'),
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),	
							
				array(
					'title'            => esc_html__( 'Page Background Image', 'blogg' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),
				array(
					'title'            => esc_html__( 'Built-In Social Menu', 'blogg' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),
				array(
					'title'            => esc_html__( 'Show or Hide Elements', 'blogg' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),				
				array(
					'title'            => esc_html__( 'Custom Error Page', 'blogg' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),		
				
				array(
					'title'            => esc_html__( 'Blog Styles', 'blogg' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '3',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '8',
					'hidden'           => '',
				),				
				array(
					'title'            => esc_html__( 'Sidebar Positions', 'blogg' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '12',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '16',
					'hidden'           => '',
				),
				array(
					'title'            => esc_html__( 'Page Templates', 'blogg' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '3',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '4',
					'hidden'           => '',
				),

				array(
					'title'            => esc_html__( 'Recent Posts Widget with Thumbnails', 'blogg' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),	
			
				array(
					'title'            => esc_html__( 'Theme Options', 'blogg' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),		
				array(
					'title'            => esc_html__( 'Support', 'blogg' ),
					'description'      => '',
					'is_in_lite'       => '',
					'is_in_lite_text'  => 'Basic',
					'is_in_pro'        => '',
					'is_in_pro_text'   => 'Premium',
					'hidden'           => '',
				),				
				array(
					'title'            => esc_html__( 'Related Posts with Thumbnails', 'blogg' ),
					'description'      => '',
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),	
				array(
					'title'            => esc_html__( 'Multiple Header Styles', 'blogg' ),
					'description'      => esc_html__('In addition to the current header style, additional options for your site header area.', 'blogg'),
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),		
				array(
					'title'            => esc_html__( 'Adjust Section Widths', 'blogg' ),
					'description'      => esc_html__('You can adjust the width of your header, banner area, main content, page content, footer, and more.', 'blogg'),
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),					
				array(
					'title'            => esc_html__( 'Custom Blog Title &amp; Introduction', 'blogg' ),
					'description'      => esc_html__('WordPress does not have this, but we have added a customizable blog title and intro option.', 'blogg'),
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),				
				array(
					'title'            => esc_html__( 'Blog Thumbnail Creation', 'blogg' ),
					'description'      => esc_html__('Automatically have post featured images cropped when uploading. You get a couple with the free version but more with the Pro.', 'blogg'),
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),			
				array(
					'title'            => esc_html__( 'Extra Wide Image in Content', 'blogg' ),
					'description'      => esc_html__('To prepare for the new WordPress Gutenberg editor, we included an option to give you an extra wide image in your page content.', 'blogg'),
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),					
				array(
					'title'            => esc_html__( 'Author About Widget', 'blogg' ),
					'description'      => esc_html__('We included a custom widget for an author photo plus social links.', 'blogg'),
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),		
				array(
					'title'            => esc_html__( 'Customizable Read More Text', 'blogg' ),
					'description'      => esc_html__('You can change the Read More text to display what you want.', 'blogg'),
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),	
				
				array(
					'title'            => esc_html__( 'Custom Logo Letter', 'blogg' ),
					'description'      => esc_html__('Take advantage of a logo letter option that lets you add the first letter of your site name if you do not have a logo.', 'blogg'),
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),		
				array(
					'title'            => esc_html__( '1-Click Demo Content Import Compatible', 'blogg' ),
					'description'      => esc_html__('We included the ability to let you import the demo site content.', 'blogg'),
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),					
				array(
					'title'            => esc_html__( 'Typography Options', 'blogg' ),
					'description'      => esc_html__('Includes a few basic typography options, such as adding a dropcap to your full post.', 'blogg'),
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),						
				array(
					'title'            => esc_html__( 'Custom Styled Archive Titles', 'blogg' ),
					'description'      => esc_html__('We customized the style of archive titles for tags, categories, etc.', 'blogg'),
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),					
		
				
			),
		),
	);
	blogg_info_page::init( $config );

}

add_action('after_setup_theme', 'blogg_info');

?>