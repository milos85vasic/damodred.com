<?php
/**
 * Customizer functionality
 *
 * @package juliet
 */
?>
<?php 
/*------------------------------
 Panels and Sections
 ------------------------------*/

function juliet_customizer_panels_sections( $wp_customize ) {
    
    #juliet_section_general_settings
    $wp_customize->add_section( 'juliet_section_theme_info', array(
        'title'       => esc_html__( 'Upgrade to Pro', 'juliet' ),
        'priority'    => 0
    ) );
    
    #juliet_section_general_settings
    $wp_customize->add_section( 'juliet_section_general_settings', array(
        'title'       => esc_html__( 'General Settings', 'juliet' ),
        'priority'    => 10
    ) );
    
    #juliet_section_layout_settings
    $wp_customize->add_section( 'juliet_section_layout_settings', array(
        'title'       => esc_html__( 'Layout Settings', 'juliet' ),
        'priority'    => 11
    ) );
    
    #juliet_panel_frontpage
    $wp_customize->add_panel( 'juliet_panel_frontpage', array(
        'priority'    => 61,
        'title'       => esc_html__( 'Front Page', 'juliet' ),
    ) );
	$wp_customize->add_section( 'juliet_section_frontpage_banner', array(
        'title'       => esc_html__( 'Banner Settings', 'juliet' ),
        'priority'    => 62,
        'panel'       => 'juliet_panel_frontpage',
    ) );
    $wp_customize->add_section( 'juliet_section_frontpage_featured_posts', array(
        'title'       => esc_html__( 'Featured Posts', 'juliet' ),
        'priority'    => 63,
        'panel'       => 'juliet_panel_frontpage',
    ) );
    $wp_customize->add_section( 'juliet_section_frontpage_blog_feed', array(
        'title'       => esc_html__( 'Blog Feed', 'juliet' ),
        'priority'    => 64,
        'panel'       => 'juliet_panel_frontpage',
    ) );
    
    #juliet_section_blog_feed
    $wp_customize->add_section( 'juliet_section_blog_feed', array(
        'title'       => esc_html__( 'Blog Feed', 'juliet' ),
        'priority'    => 70
    ) );
    
    #juliet_section_posts
    $wp_customize->add_section( 'juliet_section_posts', array(
        'title'       => esc_html__( 'Posts', 'juliet' ),
        'priority'    => 71,
    ) );
   
    #juliet_section_pages
    $wp_customize->add_section( 'juliet_section_pages', array(
        'title'       => esc_html__( 'Pages', 'juliet' ),
        'priority'    => 72,
    ) );

    #juliet_section_advanced
    $wp_customize->add_section( 'juliet_section_advanced', array(
        'title'       => esc_html__( 'Advanced', 'juliet' ),
        'priority'    => 90,
    ) );
    
    #juliet_section_menu
    $wp_customize->add_section( 'juliet_section_menu', array(
        'title'       => esc_html__( 'Juliet Menu Settings', 'juliet' ),
        'priority'    => 30,
        'panel'       => 'nav_menus',
    ) );
}

add_action( 'customize_register', 'juliet_customizer_panels_sections' );


/*------------------------------
 Fields
 ------------------------------*/
 
function juliet_customizer_fields( $fields ) {
    
    global $juliet_defaults;
    
    #juliet_section_theme_info
    #-----------------------------------------
    
    $fields[] = array(
        'type'        => 'custom',
        'settings'    => 'juliet_theme_info',
        'label'       => esc_html__( 'Upgrade to Pro', 'juliet' ),
        'description' => 
            '<h1>' . esc_html__('Juliet Pro', 'juliet') . '</h1>' .
            '<p><a class="button" href="https://www.lyrathemes.com/juliet-pro/" target="_blank">Upgrade to Juliet Pro</a></p>' .
            '<p>' . esc_html__('Upgrade for the many awesome features and expert support included with the pro version of this theme.', 'juliet') . '</p>' .
            '<p><a class="button" href="http://www.lyrathemes.com/preview/?theme=juliet-pro" target="_blank">Juliet Pro Demo</a></p>' .
            '<p><a class="button" href="https://www.lyrathemes.com/juliet/#comparison" target="_blank">Free vs. Pro Comparison</a></p>' .
            '<p><a href="https://www.lyrathemes.com/juliet-pro/" target="_blank"><img src="' . esc_url( get_parent_theme_file_uri( 'customize/images/juliet-pro-1.jpg' ) ) . '" /></a><br />' . 
            '<p><a href="https://www.lyrathemes.com/juliet-pro/" target="_blank"><img src="' . esc_url( get_parent_theme_file_uri( 'customize/images/juliet-pro-2.jpg' ) ) . '" /></a><br />' . 
            '<hr />' . 
            '<h1>' . esc_html__('Current Theme: Juliet', 'juliet') . '</h1>' .
            '<h3>' . esc_html__('Demo Site', 'juliet') . '</h3>' .
            '<p>' . esc_html__('Head on over to the Juliet demo to see what you can accomplish with this theme!', 'juliet') . '</p>' .
            '<p><a class="button" href="http://www.lyrathemes.com/preview/?theme=juliet" target="_blank">Juliet Demo</a></p>' . 
            '<h3>Documentation</h3>' . 
            '<p>' . esc_html__('Read how to customize the theme, set up widgets, and learn of all the possible options available to you.', 'juliet') . '</p>' . 
            '<p><a class="button" href="https://help.lyrathemes.com/#collection-274" target="_blank">Juliet Documentation</a></p>' . 
            '<h3>' . esc_html__('Sample Data', 'juliet') . '</h3>' .
            '<p>' . esc_html__('You can install the content and settings shown on our demo site by importing this sample data.', 'juliet') . '</p>' . 
            '<p><a class="button" href="https://www.lyrathemes.com/sample-data/juliet-sample-data.zip" target="_blank">Juliet Sample Data</a></p>' . 
            '<h3>' . esc_html__('Feedback and Support', 'juliet') . '</h3>' . 
            '<p>' . esc_html__('For feedback and support, please contact us and we would be happy to assist!', 'juliet') . '</p>' . 
            '<p><a class="button" href="https://www.lyrathemes.com/support/" target="_blank">Juliet Support</a></p>',
        'section'     => 'juliet_section_theme_info',
        'priority'    => 1,

        );
    
    #juliet_section_general_settings
    #-----------------------------------------
    
    
    $fields[] = array(
        'type'        => 'textarea',
        'settings'    => 'juliet_footer_copyright',
        'label'       => esc_html__( 'Copyright Text', 'juliet' ),
        'description' => esc_html__( 'Accepts HTML.', 'juliet' ),
        'section'     => 'juliet_section_general_settings',
        'priority'    => 2,
        'default'     => $juliet_defaults['juliet_footer_copyright'],
        'sanitize_callback' => 'force_balance_tags',
    );
    
    $fields[] = array(
        'type'        => 'toggle',
        'settings'     => 'juliet_enable_fancy_scrollbar',
        'label'       => esc_html__( 'Enable Fancy Scrollbar?', 'juliet' ),
        'description' => esc_html__( 'Whether to replace the default page scrollbar with a fancy scrollbar.', 'juliet' ),
        'section'     => 'juliet_section_general_settings',
        'priority'    => 4,
        'default'     => $juliet_defaults['juliet_enable_fancy_scrollbar']
    );
    
	$fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'juliet_example_content',
        'label'       => esc_html__( 'Show Example Content?', 'juliet' ),
        'description' => esc_html__( 'Turning this off will disable all default/sample images for posts. It will also hide all default widgets in the Default Sidebar.', 'juliet' ),
        'section'     => 'juliet_section_general_settings',
        'priority'    => 6,
        'default'     => $juliet_defaults['juliet_example_content']
    );
    
    
    #juliet_section_layout_settings
    #-----------------------------------------
    
    $fields[] = array(
        'type'        => 'radio',
        'settings'    => 'juliet_skin',
        'label'       => esc_html__( 'Select Skin', 'juliet' ),
        'section'     => 'juliet_section_layout_settings',
        'priority'    => 1,
        'default'     => $juliet_defaults['juliet_skin'],
        'choices'     => array(
                            'Classic'   => array(
                                esc_attr__( 'Classic', 'juliet' ),
                                esc_attr__( 'Serif fonts and pink accent color.', 'juliet' ),
                            ),
                            'Contemporary' => array(
                                esc_attr__( 'Contemporary', 'juliet' ),
                                esc_attr__( 'Minimalist look, black and white.', 'juliet' ),
                            ),
                        ),
    );
    $fields[] = array(
        'type'        => 'image',
        'settings'     => 'juliet_sticky_post_signature',
        'label'       => esc_html__( 'Sticky Post Signature', 'juliet' ),
        'description' => esc_html__( 'Upload an image to include at the end of each sticky post, something like a signature..', 'juliet' ),
        'section'     => 'juliet_section_layout_settings',
        'priority'    => 2,
        'default'     => $juliet_defaults['juliet_sticky_post_signature']
    );
    
    
    #title_tagline
    #-----------------------------------------
    
    $fields[] = array(
        'type'        => 'switch',
        'settings'     => 'juliet_image_logo_show',
        'label'       => esc_html__( 'Show Image Logo?', 'juliet' ),
        'description' => esc_html__( 'Choose whether to display the image logo.', 'juliet' ),
        'section'     => 'title_tagline',
        'priority'    => 1,
        'default'     => $juliet_defaults['juliet_image_logo_show'],
        'choices'     => array( 'on'  => esc_attr__( 'SHOW', 'juliet' ), 'off' => esc_attr__( 'HIDE', 'juliet' ) ),
    );
    $fields[] = array(
        'type'        => 'text',
        'settings'     => 'juliet_text_logo',
        'label'       => esc_html__( 'Text Logo', 'juliet' ),
        'description' => esc_html__( 'Displayed when `Show Image Logo?` is set to `Show` or if there is no logo image uploaded.', 'juliet' ),
        'section'     => 'title_tagline',
        'priority'    => 2,
        'default'     => $juliet_defaults['juliet_text_logo'],
        'active_callback'  => array( array( 'setting'  => 'juliet_image_logo_show', 'operator' => '==', 'value'    => false ) ),
        'sanitize_callback'=> 'sanitize_text_field'
    );
    
    $fields[] = array(
        'type'        => 'custom',
        'settings'     => 'juliet_text_logo_sep1',
        'label'       => wp_kses_post ( '<hr />' ),
        'section'     => 'title_tagline',
        'priority'    => 3
    );
    
    #header_image
    #-----------------------------------------
    
    $fields[] = array(
        'type'        => 'text',
        'settings'    => 'juliet_banner_heading',
        'label'       => esc_html__( 'Caption Heading', 'juliet' ),
        'section'     => 'header_image',
        'priority'    => 10,
        'default'     => $juliet_defaults['juliet_banner_heading'],
        'sanitize_callback' => 'sanitize_text_field',
    );
    $fields[] = array(
        'type'        => 'textarea',
        'settings'    => 'juliet_banner_description',
        'label'       => esc_html__( 'Caption Description', 'juliet' ),
        'section'     => 'header_image',
        'priority'    => 11,
        'default'     => $juliet_defaults['juliet_banner_description'],
        'sanitize_callback' => 'force_balance_tags'
    );
    $fields[] = array(
        'type'        => 'text',
        'settings'    => 'juliet_banner_url',
        'label'       => esc_html__( 'Caption URL', 'juliet' ),
        'section'     => 'header_image',
        'priority'    => 12,
        'default'     => $juliet_defaults['juliet_banner_url'],
        'sanitize_callback' => 'sanitize_text_field',
    );
    
	
	#juliet_section_frontpage_banner
    #-----------------------------------------
    
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'juliet_frontpage_banner_overlay_show',
        'label'       => esc_html__('Show Color Overlay/Filter?', 'juliet' ),
        'section'     => 'juliet_section_frontpage_banner',
        'priority'    => 1,
        'default'     => $juliet_defaults['juliet_frontpage_banner_overlay_show'],
    );
	
	$fields[] = array(
        'type'        => 'color',
        'settings'    => 'juliet_frontpage_banner_overlay_color',
        'label'       => esc_html__( 'Select Color', 'juliet' ),
        'section'     => 'juliet_section_frontpage_banner',
        'priority'    => 2,
        'default'     => $juliet_defaults['juliet_frontpage_banner_overlay_color'],
        'sanitize_callback' => 'sanitize_hex_color',
		'active_callback'  => array( array( 'setting'  => 'juliet_frontpage_banner_overlay_show', 'operator' => '==', 'value'    => '1', ),)
    );
    
    #juliet_section_frontpage_featured_posts
    #-----------------------------------------
    
    $fields[] = array(
        'type'        => 'switch',
        'settings'    => 'juliet_frontpage_featured_posts_show',
        'label'       => esc_html__( 'Show Featured Posts?', 'juliet' ),
        'description' => esc_html__( 'Choose whether to display the featured posts.', 'juliet' ),
        'section'     => 'juliet_section_frontpage_featured_posts',
        'priority'    => 1,
        'default'     => $juliet_defaults['juliet_frontpage_featured_posts_show'],
        'choices'     => array( 'on'  => esc_attr__( 'SHOW', 'juliet' ), 'off' => esc_attr__( 'HIDE', 'juliet' ), )
    );
    $fields[] = array(
        'type'        => 'custom',
        'settings'    => 'juliet_frontpage_featured_posts_sep1',
        'label'       => wp_kses_post( '<hr />' ),
        'section'     => 'juliet_section_frontpage_featured_posts',
        'priority'    => 2,
        'active_callback'  => array( array( 'setting'  => 'juliet_frontpage_featured_posts_show', 'operator' => '==', 'value'    => true, ), )
    );
    $fields[] = array(
        'type'        => 'text',
        'settings'    => 'juliet_frontpage_featured_posts_heading',
        'label'       => esc_html__( 'Heading', 'juliet' ),
        'section'     => 'juliet_section_frontpage_featured_posts',
        'priority'    => 3,
        'default'     => $juliet_defaults['juliet_frontpage_featured_posts_heading'],
        'active_callback'  => array( array( 'setting'  => 'juliet_frontpage_featured_posts_show', 'operator' => '==', 'value'    => true, ), )
    );
    $fields[] = array(
        'type'        => 'select',
        'settings'    => 'juliet_frontpage_featured_posts_post_1',
        'label'       => esc_html__( 'Post 1', 'juliet' ),
        'section'     => 'juliet_section_frontpage_featured_posts',
        'priority'    => 4,
        'default'     => $juliet_defaults['juliet_frontpage_featured_posts_post_1'],
        'choices'     => Kirki_Helper::get_posts( array( 'numberposts' => -1 ) ),
        'active_callback'  => array( array( 'setting'  => 'juliet_frontpage_featured_posts_show', 'operator' => '==', 'value'    => true, ), )
    );
    $fields[] = array(
        'type'        => 'select',
        'settings'    => 'juliet_frontpage_featured_posts_post_2',
        'label'       => esc_html__( 'Post 2', 'juliet' ),
        'section'     => 'juliet_section_frontpage_featured_posts',
        'priority'    => 5,
        'default'     => $juliet_defaults['juliet_frontpage_featured_posts_post_2'],
        'choices'     => Kirki_Helper::get_posts( array( 'numberposts' => -1 ) ),
        'active_callback'  => array( array( 'setting'  => 'juliet_frontpage_featured_posts_show', 'operator' => '==', 'value'    => true, ), )
    );
    $fields[] = array(
        'type'        => 'select',
        'settings'    => 'juliet_frontpage_featured_posts_post_3',
        'label'       => esc_html__( 'Post 3', 'juliet' ),
        'section'     => 'juliet_section_frontpage_featured_posts',
        'priority'    => 5,
        'default'     => $juliet_defaults['juliet_frontpage_featured_posts_post_3'],
        'choices'     => Kirki_Helper::get_posts( array( 'numberposts' => -1 ) ),
        'active_callback'  => array( array( 'setting'  => 'juliet_frontpage_featured_posts_show', 'operator' => '==', 'value'    => true, ), )
    );
    $fields[] = array(
        'type'        => 'select',
        'settings'    => 'juliet_frontpage_featured_posts_post_4',
        'label'       => esc_html__( 'Post 4', 'juliet' ),
        'section'     => 'juliet_section_frontpage_featured_posts',
        'priority'    => 6,
        'default'     => $juliet_defaults['juliet_frontpage_featured_posts_post_4'],
        'choices'     => Kirki_Helper::get_posts( array( 'numberposts' => -1 ) ),
        'active_callback'  => array( array( 'setting'  => 'juliet_frontpage_featured_posts_show', 'operator' => '==', 'value'    => true, ), )
    );
    
    #juliet_section_frontpage_blog_feed
    #-----------------------------------------
  
    $fields[] = array(
        'type'        => 'radio-image',
        'settings'    => 'juliet_frontpage_blog_feed_sidebar',
        'label'       => esc_html__( 'Layout', 'juliet' ),
        'description' => esc_html__( 'Choose whether to display the sidebar on the home page.', 'juliet' ),
        'section'     => 'juliet_section_frontpage_blog_feed',
        'default'     => $juliet_defaults['juliet_frontpage_blog_feed_sidebar'],
        'priority'    => 2,
        'choices'     => array( '0' => trailingslashit( get_template_directory_uri() ) . 'customize/images/full.png',
                                '1' => trailingslashit( get_template_directory_uri() ) . 'customize/images/sidebar.png', ),
    );
    
    /* juliet_section_blog_feed */
    #-----------------------------------------
    
    $fields[] = array(
        'type'        => 'switch',
        'settings'    => 'juliet_blog_feed_meta_show',
        'label'       => esc_html__( 'Show Meta?', 'juliet' ),
        'description' => esc_html__( 'Choose whether to display date, category, author, tags for posts in the blog feed. This applies to all blog feeds on all pages, including the front page.', 'juliet' ),
        'section'     => 'juliet_section_blog_feed',
        'priority'    => 1,
        'default'     => $juliet_defaults['juliet_blog_feed_meta_show'],
        'choices' => array( 'on'  => esc_attr__( 'SHOW', 'juliet' ), 'off' => esc_attr__( 'HIDE', 'juliet' ), )
    );
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'juliet_blog_feed_date_show',
        'label'       => esc_html__( 'Show Date?', 'juliet' ),
        'section'     => 'juliet_section_blog_feed',
        'priority'    => 2,
        'default'     => $juliet_defaults['juliet_blog_feed_date_show'],
        'active_callback'  => array( array( 'setting'  => 'juliet_blog_feed_meta_show', 'operator' => '==', 'value'    => true, ),)
    );
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'juliet_blog_feed_category_show',
        'label'       => esc_html__( 'Show Category?', 'juliet' ),
        'section'     => 'juliet_section_blog_feed',
        'priority'    => 3,
        'default'     => $juliet_defaults['juliet_blog_feed_category_show'],
        'active_callback'  => array( array( 'setting'  => 'juliet_blog_feed_meta_show', 'operator' => '==', 'value'    => true, ),)
    );
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'juliet_blog_feed_author_show',
        'label'       => esc_html__( 'Show Author?', 'juliet' ),
        'section'     => 'juliet_section_blog_feed',
        'priority'    => 4,
        'default'     => $juliet_defaults['juliet_blog_feed_author_show'],
        'active_callback'  => array( array( 'setting'  => 'juliet_blog_feed_meta_show', 'operator' => '==', 'value'    => true, ),)
    );
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'juliet_blog_feed_comments_show',
        'label'       => esc_html__( 'Show Comments?', 'juliet' ),
        'section'     => 'juliet_section_blog_feed',
        'priority'    => 5,
        'default'     => $juliet_defaults['juliet_blog_feed_comments_show'],
        'active_callback'  => array( array( 'setting'  => 'juliet_blog_feed_meta_show', 'operator' => '==', 'value'    => true, ),)
    );
    $fields[] = array(
        'type'        => 'custom',
        'settings'    => 'juliet_blog_feed_sep1',
        'label'       => wp_kses_post ('<hr />'),
        'section'     => 'juliet_section_blog_feed',
        'priority'    => 6
    );
    $fields[] = array(
        'type'        => 'radio',
        'settings'    => 'juliet_blog_feed_post_format',
        'label'       => esc_html__( 'Post Display Format', 'juliet' ),
        'section'     => 'juliet_section_blog_feed',
        'priority'    => 7,
        'default'     => $juliet_defaults['juliet_blog_feed_post_format'],
        'choices'     => array(
                            'Excerpt'  => array(
                                esc_attr__( 'Image and Excerpt', 'juliet' ),
                            ),
                            'Full'   => array(
                                esc_attr__( 'Image and Full Content', 'juliet' ),
                            )                            
                        ),
    );
    $fields[] = array(
        'type'        => 'radio-image',
        'settings'    => 'juliet_blog_feed_sidebar',
        'label'       => esc_html__( 'Layout', 'juliet' ),
        'description' => esc_html__( 'Choose whether to display the sidebar on the blog feed pages.', 'juliet' ),
        'section'     => 'juliet_section_blog_feed',
        'default'     => $juliet_defaults['juliet_blog_feed_sidebar'],
        'priority'    => 8,
        'choices'     => array( '0' => trailingslashit( get_template_directory_uri() ) . 'customize/images/full.png',
                                '1' => trailingslashit( get_template_directory_uri() ) . 'customize/images/sidebar.png', ),
    );
	
	$fields[] = array(
        'type'        => 'text',
        'settings'     => 'juliet_blog_feed_label',
        'label'       => esc_html__( 'Heading for Blog Feed', 'juliet' ),
        'description' => esc_html__( 'The `Recent Posts` label for the blog feed.', 'juliet' ),
        'section'     => 'juliet_section_blog_feed',
        'priority'    => 9,
        'default'     => $juliet_defaults['juliet_blog_feed_label'],
        'sanitize_callback'=> 'sanitize_text_field'
    );
    
    /* juliet_section_posts */
    #-----------------------------------------
    
    $fields[] = array(
        'type'        => 'switch',
        'settings'    => 'juliet_posts_meta_show',
        'label'       => esc_html__( 'Show Meta?', 'juliet' ),
        'description' => esc_html__( 'Choose whether to display date, category, author, tags for posts on the post page.', 'juliet' ),
        'section'     => 'juliet_section_posts',
        'priority'    => 1,
        'default'     => $juliet_defaults['juliet_posts_meta_show'],
        'choices' => array( 'on'  => esc_attr__( 'SHOW', 'juliet' ), 'off' => esc_attr__( 'HIDE', 'juliet' ), )
    );
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'juliet_posts_date_show',
        'label'       => esc_html__( 'Show Date?', 'juliet' ),
        'section'     => 'juliet_section_posts',
        'priority'    => 2,
        'default'     => $juliet_defaults['juliet_posts_date_show'],
        'active_callback'  => array( array( 'setting'  => 'juliet_posts_meta_show', 'operator' => '==', 'value'    => true, ), )
    );
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'juliet_posts_category_show',
        'label'       => esc_html__( 'Show Category?', 'juliet' ),
        'section'     => 'juliet_section_posts',
        'priority'    => 3,
        'default'     => $juliet_defaults['juliet_posts_category_show'],
        'active_callback'  => array( array( 'setting'  => 'juliet_posts_meta_show', 'operator' => '==', 'value'    => true, ), )
    );
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'juliet_posts_author_show',
        'label'       => esc_html__( 'Show Author?', 'juliet' ),
        'section'     => 'juliet_section_posts',
        'priority'    => 4,
        'default'     => $juliet_defaults['juliet_posts_author_show'],
        'active_callback'  => array( array( 'setting'  => 'juliet_posts_meta_show', 'operator' => '==', 'value'    => true, ), )
    );
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'juliet_posts_tags_show',
        'label'       => esc_html__( 'Show Tags?', 'juliet' ),
        'section'     => 'juliet_section_posts',
        'priority'    => 5,
        'default'     => $juliet_defaults['juliet_posts_tags_show'],
        'active_callback'  => array( array( 'setting'  => 'juliet_posts_meta_show', 'operator' => '==', 'value'    => true, ), )
    );
    $fields[] = array(
        'type'        => 'custom',
        'settings'    => 'juliet_posts_sep1',
        'label'       => wp_kses_post ( '<hr />' ),
        'section'     => 'juliet_section_posts',
        'priority'    => 6
    );
    $fields[] = array(
        'type'        => 'radio-image',
        'settings'    => 'juliet_posts_sidebar',
        'label'       => esc_html__( 'Layout', 'juliet' ),
        'description' => esc_html__( 'Choose whether to display the sidebar.', 'juliet' ),
        'section'     => 'juliet_section_posts',
        'default'     => $juliet_defaults['juliet_posts_sidebar'],
        'priority'    => 7,
        'choices'     => array( '0' => trailingslashit( get_template_directory_uri() ) . 'customize/images/full.png',
                                '1' => trailingslashit( get_template_directory_uri() ) . 'customize/images/sidebar.png', ),
    );
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'juliet_posts_featured_image_show',
        'label'       => esc_html__( 'Show Featured Image ?', 'juliet' ),
        'description' => esc_html__( 'Whether to show featured image at the beginning of the post.', 'juliet' ),
        'section'     => 'juliet_section_posts',
        'priority'    => 8,
        'default'     => $juliet_defaults['juliet_posts_featured_image_show']
    );
    
    
    /* juliet_section_pages */
    #-----------------------------------------
    
   $fields[] = array(
        'type'        => 'radio-image',
        'settings'    => 'juliet_pages_sidebar',
        'label'       => esc_html__( 'Layout', 'juliet' ),
        'description' => esc_html__( 'Choose whether to display the sidebar.', 'juliet' ),
        'section'     => 'juliet_section_pages',
        'default'     => $juliet_defaults['juliet_pages_sidebar'],
        'priority'    => 1,
        'choices'     => array( '0' => trailingslashit( get_template_directory_uri() ) . 'customize/images/full.png',
                                '1' => trailingslashit( get_template_directory_uri() ) . 'customize/images/sidebar.png', ),
    );
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'juliet_pages_featured_image_show',
        'label'       => esc_html__( 'Show Featured Image ?', 'juliet' ),
        'description' => esc_html__( 'Whether to show featured image at the beginning of the page.', 'juliet' ),
        'section'     => 'juliet_section_pages',
        'priority'    => 2,
        'default'     => $juliet_defaults['juliet_pages_featured_image_show']
    );
    
    /* juliet_section_advanced */
   #-----------------------------------------
	if(juliet_show_custom_css_field()){
    $fields[] = array(
        'type'        => 'code',
        'settings'    => 'juliet_advanced_css',
        'label'       => esc_html__( 'Custom CSS', 'juliet' ),
        'description' => esc_html__( 'Custom CSS code to modify styling.', 'juliet' ),
        'section'     => 'juliet_section_advanced',
        'priority'    => 1,
        'choices'     => array( 'language' => 'css', 'theme'    => 'monokai', 'height'   => 500, ),
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    );
    }
    
    /* juliet_section_menu */
    #-----------------------------------------
    
    $fields[] = array(
        'type'        => 'toggle',
        'settings'     => 'juliet_enable_off_canvas_menu',
        'label'       => esc_html__( 'Enable Off Canvas Menu?', 'juliet' ),
        'description' => esc_html__( 'Whether to show an off canvas menu that you can populate with various widgets.', 'juliet' ),
        'section'     => 'juliet_section_menu',
        'priority'    => 1,
        'default'     => $juliet_defaults['juliet_enable_off_canvas_menu']
    );
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'juliet_dropdown_node_enable',
        'label'       => esc_html__( 'Enable Dropdown Menu Parent Nodes', 'juliet' ),
        'description' => esc_html__( 'The menu item that is clicked to drop down sub menus is not assigned a URL by default (it is set to #). If you would like to enable links for the parent nodes, you can do so here.', 'juliet' ),
        'section'     => 'juliet_section_menu',
        'priority'    => 1,
        'default'     => $juliet_defaults['juliet_dropdown_node_enable']
    );
	
    return $fields;
}

add_filter( 'kirki/fields', 'juliet_customizer_fields' );
?>