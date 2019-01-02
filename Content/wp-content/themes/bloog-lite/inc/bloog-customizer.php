<?php
/**
 * Bloog Lite Other Customizer
 *
 * @package Bloog Lite
 */
/** customizer start ***/

function bloog_customizer( $wp_customize ) {
    $wp_customize->add_panel( 
        'general_panel',
        array(
            'priority' => 10,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => __( 'Header And General Panel', 'bloog-lite' ),
            'description' => __( 'Default section provided by WordPress customizer.', 'bloog-lite' ),
            ) 
        );  
    
    $wp_customize->get_section( 'header_image' )->panel             = 'general_panel';
    $wp_customize->get_section( 'title_tagline' )->panel            = 'general_panel';  
    $wp_customize->get_section( 'colors' )->panel                   = 'general_panel';
    $wp_customize->get_section( 'background_image' )->panel         = 'general_panel';
    $wp_customize->get_section( 'static_front_page' )->panel        = 'general_panel';

    // choose category of slider   
    $wp_customize->add_section(
        'header_logo_bkg_section',
        array(
            'title' => __('Logo Background','bloog-lite'),
            'priority' => 120,
            'panel' => 'general_panel',
            )
        );
    
    $wp_customize->add_setting('bloog_lite_logo_bkgimage', array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
        ));

    $wp_customize->add_control(new WP_Customize_Image_Control( $wp_customize, 'bloog_lite_logo_bkgimage', array(
        'label'      => __( 'Logo Background Image', 'bloog-lite' ),
        'description'      => __( 'Background Image behind the logo in header', 'bloog-lite' ),
        'section'    => 'header_logo_bkg_section',
        'setting'   => 'bloog_lite_logo_bkgimage',
        ) ) );

    /** Slider part **/
    $wp_customize -> add_panel(
        'home_slider_panel',
        array(
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => __('Home Slider', 'bloog-lite')
            )
        ); 
    
    // choose category of slider   
    $wp_customize->add_section(
        'home_slider_post_choose_section',
        array(
            'title' => __('Choose Post For Slider','bloog-lite'),
            'priority' => 20,
            'description' => __('Choose Post To Show In Slider','bloog-lite'),
            'panel' => 'home_slider_panel',
            )
        );
    
    $wp_customize->add_setting(
        'slider_1',
        array(
            'sanitize_callback' => 'bloog_lite_sanitize_dropdown_general',
            )
        );
    $wp_customize->add_control( new Bloog_lite_Post_Dropdown( $wp_customize, 'slider_1',
        array(
            'label' => __('Choose Slider 1','bloog-lite'),
            'section' => 'home_slider_post_choose_section',
            'type' => 'select',
            )
        ) );
    
    $wp_customize->add_setting(
        'slider_2',
        array(
            'sanitize_callback' => 'bloog_lite_sanitize_dropdown_general',
            )
        );
    $wp_customize->add_control( new Bloog_lite_Post_Dropdown( $wp_customize, 'slider_2',
        array(
            'label' => __('Choose Slider 2','bloog-lite'),
            'section' => 'home_slider_post_choose_section',
            'type' => 'select',
            )
        ) );
    
    $wp_customize->add_setting(
        'slider_3',
        array(
            'sanitize_callback' => 'bloog_lite_sanitize_dropdown_general',
            )
        );
    $wp_customize->add_control( new Bloog_lite_Post_Dropdown( $wp_customize, 'slider_3',
        array(
            'label' => __('Choose Slider 3','bloog-lite'),
            'section' => 'home_slider_post_choose_section',
            'type' => 'select',
            )
        ) );
    
    $wp_customize->add_setting(
        'slider_4',
        array(
            'sanitize_callback' => 'bloog_lite_sanitize_dropdown_general',
            )
        );
    $wp_customize->add_control( new Bloog_lite_Post_Dropdown( $wp_customize, 'slider_4',
        array(
            'label' => __('Choose Slider 4','bloog-lite'),
            'section' => 'home_slider_post_choose_section',
            'type' => 'select',
            )
        ) ); 
    
    $wp_customize->add_setting(
        'slider_5',
        array(
            'sanitize_callback' => 'bloog_lite_sanitize_dropdown_general',
            )
        );
    $wp_customize->add_control( new Bloog_lite_Post_Dropdown( $wp_customize, 'slider_5',
        array(
            'label' => __('Choose Slider 5','bloog-lite'),
            'section' => 'home_slider_post_choose_section',
            'type' => 'select',
            )
        ) ); 
    
    $wp_customize->add_setting(
        'slider_6',
        array(
            'sanitize_callback' => 'bloog_lite_sanitize_dropdown_general',
            )
        );
    $wp_customize->add_control( new Bloog_lite_Post_Dropdown( $wp_customize, 'slider_6',
        array(
            'label' => __('Choose Slider 6','bloog-lite'),
            'section' => 'home_slider_post_choose_section',
            'type' => 'select',
            )
        ) ); 
    
    $wp_customize->add_setting(
        'slider_7',
        array(
            'sanitize_callback' => 'bloog_lite_sanitize_dropdown_general',
            )
        );
    $wp_customize->add_control( new Bloog_lite_Post_Dropdown( $wp_customize, 'slider_7',
        array(
            'label' => __('Choose Slider 7','bloog-lite'),
            'section' => 'home_slider_post_choose_section',
            'type' => 'select',
            )
        ) ); 
    
    $wp_customize->add_setting(
        'slider_8',
        array(
            'sanitize_callback' => 'bloog_lite_sanitize_dropdown_general',
            )
        );
    $wp_customize->add_control( new Bloog_lite_Post_Dropdown( $wp_customize, 'slider_8',
        array(
            'label' => __('Choose Slider 8','bloog-lite'),
            'section' => 'home_slider_post_choose_section',
            'type' => 'select',
            )
        ) ); 
    
    $wp_customize->add_setting(
        'slider_9',
        array(
            'sanitize_callback' => 'bloog_lite_sanitize_dropdown_general',
            )
        );
    $wp_customize->add_control( new Bloog_lite_Post_Dropdown( $wp_customize, 'slider_9',
        array(
            'label' => __('Choose Slider 9','bloog-lite'),
            'section' => 'home_slider_post_choose_section',
            'type' => 'select',
            )
        ) ); 
    
    // slider mode selection
    $wp_customize -> add_section(
        'home_slider_mode',
        array(
            'title' => __('Slider Mode','bloog-lite'),
            'priority' => 20,
            'panel' => 'home_slider_panel'
            )
        );
    
    $wp_customize -> add_setting(
        'slider_mode_setting',
        array(
            'default' => 'horizontal',
            'trasport' => 'refresh',
            'sanitize_callback' => 'bloog_lite_webpage_slider_mode_radio_sanitize'
            )
        );
    
    $wp_customize -> add_control(
        'slider_mode_setting',
        array(
            'label' => __('Select Slider Mode','bloog-lite'),
            'section' => 'home_slider_mode',
            'type' => 'radio',
            'choices'=> array(
                'horizontal' => __('Horizontal','bloog-lite'),
                'fade' => __('Fade','bloog-lite')
                )
            )
        );
    
        // function bloog_lite_to sanitize slider mode
    function bloog_lite_webpage_slider_mode_radio_sanitize($input){
        $valid_keys = array(
           'horizontal' => __('horizontal', 'bloog-lite'),
           'fade' => __('fade', 'bloog-lite')
           );
        if ( array_key_exists( $input, $valid_keys)) {
           return $input;
       } else {
           return '';
       }
   }

    // To set the slider speed

   $wp_customize -> add_section(
    'slider_speed_section',
    array(
        'title' => __('Slider Speed','bloog-lite'),
        'priority' => 20,
        'panel' => 'home_slider_panel'
        )
    );

   $wp_customize -> add_setting(
    'slider_speed_setting',
    array(
        'default' => '3000',
        'sanitize_callback' => 'bloog_lite_sanitize_integer'
        )
    );

   $wp_customize -> add_control(
    'slider_speed_setting',
    array(
        'label' => __('Enter Slider Speed','bloog-lite'),
        'section' => 'slider_speed_section',
        'type' => 'text'
        )
    );


     // slider pause duration
   $wp_customize -> add_section(
    'home_slider_pause_section',
    array(
        'title' => __('Transistion Speed','bloog-lite'),
        'priority' => 20,
        'panel' => 'home_slider_panel'
        )
    );

   $wp_customize -> add_setting(
    'home_slider_pause_setting',
    array(
        'default' => '4000',
        'sanitize_callback' => 'bloog_lite_sanitize_integer'
        )
    );

   $wp_customize -> add_control(
    'home_slider_pause_setting',
    array(
        'label' => __('Enter Pause Duration','bloog-lite'),
        'description' => __('The amount of time (in ms) between each auto transition', 'bloog-lite'),
        'section' => 'home_slider_pause_section',
        'type' => 'text'
        )
    );    

    // Auto slide Options
   $wp_customize -> add_section(
    'auto_slide_section',
    array(
        'title' => __('Auto Slide Option','bloog-lite'),
        'priority' => 20,
        'panel' => 'home_slider_panel'
        )
    );

   $wp_customize -> add_setting(
    'auto_slide_setting',
    array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'bloog_lite_sanitize_checkbox'
        )
    );

   $wp_customize -> add_control(
    'auto_slide_setting',
    array(
        'label' => __('Check To Disable Autoslide','bloog-lite'),
        'section' => 'auto_slide_section',
        'type' => 'checkbox'
        )
    ); 

    // No of comments in slider
   $wp_customize -> add_section(
    'comment_number_slider_section',
    array(
        'title' => __('Comment Numbers (Show/Hide)','bloog-lite'),
        'priority' => 20,
        'panel' => 'home_slider_panel'
        )
    );

   $wp_customize -> add_setting(
    'comment_number_slider_setting',
    array(
        'default' => '1',
        'sanitize_callback' => 'bloog_lite_sanitize_checkbox'
        )
    );

   $wp_customize -> add_control(
    'comment_number_slider_setting',
    array(
        'label' => __('Show Numbers of Comments','bloog-lite'),
        'description' => __('check to display in numbers of Comments in slider', 'bloog-lite'),
        'section' => 'comment_number_slider_section',
        'type' => 'checkbox'
        )
    ); 
/** Slider part ends**/

    $wp_customize -> add_panel(
        'home_posts_panel',
        array(
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => __('Home Posts', 'bloog-lite')
            )
        ); 


    // Display post in home page Option
   $wp_customize -> add_section(
    'home_post_display_section',
    array(
        'title' => __('Choose Categories','bloog-lite'),
        'description' => __('Choose Categories to display posts in Home Page','bloog-lite'),
        'priority' => 20,
        'panel' => 'home_posts_panel'
        )
    );

   $wp_customize -> add_setting(
    'home_post_display_cat_1',
    array(
        'sanitize_callback' => 'bloog_lite_sanitize_dropdown_general'
        )
    );

   $wp_customize->add_control( new Bloog_lite_Category_Dropdown( $wp_customize, 'home_post_display_cat_1',
    array(
        'label' => __('Category','bloog-lite'),
        'section' => 'home_post_display_section',
        'type' => 'select',
        )
    ) );

   $wp_customize -> add_setting(
    'home_post_display_cat_2',
    array(
        'sanitize_callback' => 'bloog_lite_sanitize_dropdown_general'
        )
    );

   $wp_customize->add_control( new Bloog_lite_Category_Dropdown( $wp_customize, 'home_post_display_cat_2',
    array(
        'label' => __('Category','bloog-lite'),
        'section' => 'home_post_display_section',
        'type' => 'select',
        )
    ) );

   $wp_customize -> add_setting(
    'home_post_display_cat_3',
    array(
        'sanitize_callback' => 'bloog_lite_sanitize_dropdown_general'
        )
    );

   $wp_customize->add_control( new Bloog_lite_Category_Dropdown( $wp_customize, 'home_post_display_cat_3',
    array(
        'label' => __('Category','bloog-lite'),
        'section' => 'home_post_display_section',
        'type' => 'select',
        )
    ) );

   $wp_customize -> add_setting(
    'home_post_display_cat_4',
    array(
        'sanitize_callback' => 'bloog_lite_sanitize_dropdown_general'
        )
    );

   $wp_customize->add_control( new Bloog_lite_Category_Dropdown( $wp_customize, 'home_post_display_cat_4',
    array(
        'label' => __('Category','bloog-lite'),
        'section' => 'home_post_display_section',
        'type' => 'select',
        )
    ) );


// Design setting 
   $wp_customize -> add_panel(
    'desig_setting_panel',
    array(
        'priority' => 20,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __('Design Setting', 'bloog-lite')
        )
    ); 


   $wp_customize -> add_section(
    'homepage_layout_section',
    array(
        'title' => __('Home Page Layout','bloog-lite'),
        'priority' => 20,
        'panel' => 'desig_setting_panel'
        )
    );

   $wp_customize -> add_setting(
    'homepage_layout_setting',
    array(
        'default' => 'fullwidth-home',
        'sanitize_callback' => 'bloog_lite_sanitize_homelayout_radio'
        )
    );

        // function bloog_lite_to sanitize background pattern
   function bloog_lite_sanitize_homelayout_radio($input){
    $valid_keys = array(
       'fullwidth-home' => __('fullwidth-home', 'bloog-lite'),
       'gridview-home' => __('gridview-home', 'bloog-lite'),
       'fullwidth-sidebar-home' => __('fullwidth-sidebar-home', 'bloog-lite'),
       );
    if ( array_key_exists( $input, $valid_keys)) {
       return $input;
   } else {
       return '';
   }
}

$wp_customize -> add_control(
    'homepage_layout_setting',
    array(
        'label' => __('Home Layout Option', 'bloog-lite'),
        'section' => 'homepage_layout_section',
        'type' => 'radio',
        'choices' => array(
            'fullwidth-home' => __('FullWidth','bloog-lite'),
            'gridview-home' => __('Grid view','bloog-lite'),
            'fullwidth-sidebar-home' => __('Full Width With Sidebar','bloog-lite'),
            )
        )
    );

    // No of comments in posts
$wp_customize -> add_section(
    'comment_number_post_section',
    array(
        'title' => __('Comment Numbers (Show/Hide)','bloog-lite'),
        'priority' => 20,
        'panel' => 'desig_setting_panel'
        )
    );

$wp_customize -> add_setting(
    'comment_number_post_setting',
    array(
        'default' => '1',
        'sanitize_callback' => 'bloog_lite_sanitize_checkbox'
        )
    );

$wp_customize -> add_control(
    'comment_number_post_setting',
    array(
        'label' => __('Show Numbers of Comments','bloog-lite'),
        'description' => __('check to display in numbers of Comments in Post', 'bloog-lite'),
        'section' => 'comment_number_post_section',
        'type' => 'checkbox'
        )
    ); 

/*** Category page settings ****/    
    // Category page  Setting
$wp_customize -> add_panel(
    'category_page_setting_panel',
    array(
        'priority' => 20,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __('Category Page', 'bloog-lite')
        )
    ); 

$wp_customize -> add_section(
    'category_page_section',
    array(
        'title' => __('Category Page Layout','bloog-lite'),
        'priority' => 20,
        'panel' => 'category_page_setting_panel'
        )
    );


$wp_customize -> add_setting(
    'categorypage_layout_setting',
    array(
        'default' => 'fullwidth-category-page',
        'sanitize_callback' => 'bloog_lite_sanitize_category_radio'
        )
    ); 

    // function bloog_lite_to sanitize background pattern
function bloog_lite_sanitize_category_radio($input){
    $valid_keys = array(
       'fullwidth-category-page' => __('FullWidth','bloog-lite'),
       'gridview-category-page' => __('Grid view','bloog-lite'),
       'fullwidth-sidebar-category-page' => __('Full Width With Sidebar','bloog-lite'),
       );
    if ( array_key_exists( $input, $valid_keys)) {
       return $input;
   } else {
       return '';
   }
}

$wp_customize -> add_control(
    'categorypage_layout_setting',
    array(
        'label' => __('Category Layout Option', 'bloog-lite'),
        'section' => 'category_page_section',
        'type' => 'radio',
        'choices' => array(
            'fullwidth-category-page' => __('FullWidth','bloog-lite'),
            'gridview-category-page' => __('Grid view','bloog-lite'),
            'fullwidth-sidebar-category-page' => __('Full Width With Sidebar','bloog-lite'),
            )
        )
    );

    // Display slider in category page
$wp_customize -> add_section(
    'category_page_slider_option_section',
    array(
        'title' => __('Slider (Category Page)','bloog-lite'),
        'priority' => 20,
        'panel' => 'category_page_setting_panel'
        )
    );


$wp_customize -> add_setting(
    'category_page_slider_option_setting',
    array(
        'default' => 'show-slider-category-page',
        'sanitize_callback' => 'bloog_lite_sanitize_category_slider_radio'
        )
    ); 

    // function bloog_lite_to sanitize background pattern
function bloog_lite_sanitize_category_slider_radio($input){
    $valid_keys = array(
       'show-slider-category-page' => __('Show Slider','bloog-lite'),
       'hide-slider-category-page' => __('Hide Slider','bloog-lite'),
       );
    if ( array_key_exists( $input, $valid_keys)) {
       return $input;
   } else {
       return '';
   }
}

$wp_customize -> add_control(
    'category_page_slider_option_setting',
    array(
        'label' => __('Show/Hide Slider (Category Page)', 'bloog-lite'),
        'section' => 'category_page_slider_option_section',
        'type' => 'radio',
        'choices' => array(
            'show-slider-category-page' => __('Show Slider','bloog-lite'),
            'hide-slider-category-page' => __('Hide Slider','bloog-lite'),
            )
        )
    );

/** category page (End) **/

/*** Single Page settings ****/ 

    // Single Page layout
$wp_customize -> add_panel(
    'single_page_setting_panel',
    array(
        'priority' => 20,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __('Single Page', 'bloog-lite')
        )
    ); 

$wp_customize -> add_section(
    'single_page_layout_section',
    array(
        'title' => __('Single Page Layout','bloog-lite'),
        'priority' => 20,
        'panel' => 'single_page_setting_panel'
        )
    );


$wp_customize -> add_setting(
    'single_page_layout_setting',
    array(
        'default' => 'fullwidth-single-page',
        'sanitize_callback' => 'bloog_lite_sanitize_singlepage_radio'
        )
    ); 

    // function bloog_lite_to sanitize background pattern
function bloog_lite_sanitize_singlepage_radio($input){
    $valid_keys = array(
       'fullwidth-single-page' => __('FullWidth','bloog-lite'),
       'fullwidth-sidebar-single-page' => __('Full Width With Sidebar','bloog-lite'),
       );
    if ( array_key_exists( $input, $valid_keys)) {
       return $input;
   } else {
       return '';
   }
}

$wp_customize -> add_control(
    'single_page_layout_setting',
    array(
        'label' => __('Single Page Layout Option', 'bloog-lite'),
        'section' => 'single_page_layout_section',
        'type' => 'radio',
        'choices' => array(
            'fullwidth-single-page' => __('FullWidth','bloog-lite'),
            'fullwidth-sidebar-single-page' => __('Full Width With Sidebar','bloog-lite'),
            )
        )
    );

    // Display slider in category page
$wp_customize -> add_section(
    'single_page_slider_option_section',
    array(
        'title' => __('Slider (Single Page)','bloog-lite'),
        'priority' => 20,
        'panel' => 'single_page_setting_panel'
        )
    );


$wp_customize -> add_setting(
    'single_page_slider_option_setting',
    array(
        'default' => 'show-slider-single-page',
        'sanitize_callback' => 'bloog_lite_sanitize_page_slider_radio'
        )
    ); 

    // function bloog_lite_to sanitize background pattern
function bloog_lite_sanitize_page_slider_radio($input){
    $valid_keys = array(
       'show-slider-single-page' => __('Show Slider','bloog-lite'),
       'hide-slider-single-page' => __('Hide Slider','bloog-lite'),
       );
    if ( array_key_exists( $input, $valid_keys)) {
       return $input;
   } else {
       return '';
   }
}

$wp_customize -> add_control(
    'single_page_slider_option_setting',
    array(
        'label' => __('Show/Hide Slider (Single Page)', 'bloog-lite'),
        'section' => 'single_page_slider_option_section',
        'type' => 'radio',
        'choices' => array(
            'show-slider-single-page' => __('Show Slider','bloog-lite'),
            'hide-slider-single-page' => __('Hide Slider','bloog-lite'),
            )
        )
    );

/** category page (End) **/



    // END OF DESIGN PANEL

    // Footer Setting
$wp_customize -> add_panel(
    'footer_setting_panel',
    array(
        'priority' => 20,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __('Footer Setting', 'bloog-lite')
        )
    );

$wp_customize -> add_section(
    'footer_layer',
    array(
        'title' => __('Footer Layer 3','bloog-lite'),
        'priority' => 20,
        'panel' => 'footer_setting_panel'
        )
    );

$wp_customize -> add_setting(
    'footer_layer_3',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
        )
    );    

$wp_customize->add_control( 
    new WP_Customize_Upload_Control( 
        $wp_customize, 
        'footer_layer_3', 
        array(
            'label'      => __('Footer Fullwidth Logo','bloog-lite'),
            'section'    => 'footer_layer',
            'description' => __('Above copyright section','bloog-lite'),
            'settings'   => 'footer_layer_3',
            ) ) 
    );

$wp_customize -> add_section(
    'footer_text_section',
    array(
        'title' => __('Footer Text Option','bloog-lite'),
        'priority' => 20,
        'panel' => 'footer_setting_panel'
        )
    );

$wp_customize -> add_setting(
    'footer_text_setting',
    array(
        'default' => 'Bloog Lite : Free Wordpress Theme by 8Degree Themes',
        'sanitize_callback' => 'bloog_lite_sanitize_text'
        )
    );    

$wp_customize -> add_control(
    'footer_text_setting',
    array(
        'label' => __('Footer Text (Left)','bloog-lite'),
        'section' => 'footer_text_section',
        'type' => 'text',
        )
    );

$wp_customize -> add_setting(
    'footer_text_link_setting',
    array(
        'default' => 'http://8degreethemes.com/',
        'sanitize_callback' => 'bloog_lite_sanitize_text'
        )
    );    

$wp_customize -> add_control(
    'footer_text_link_setting',
    array(
        'label' => __('Footer Text Link','bloog-lite'),
        'section' => 'footer_text_section',
        'type' => 'text',
        )
    );



    //add web page layout
$wp_customize->add_section(
    'design_web_layout',
    array(
        'title'         =>  __('Web Layout', 'bloog-lite'),
        'description'   =>  __('', 'bloog-lite'),
        'panel'         =>  'desig_setting_panel'
        )        
    );
$wp_customize -> add_setting(
    'layout_option',
    array(
        'default'       =>  'full_width',
        'sanitize_callback' => 'bloog_lite_web_layout',
        )

    );
$wp_customize -> add_control(
    'layout_option',
    array(
        'label'         =>  __('Website  Layout','bloog-lite'),
        'description'   =>  __('Make your website either box layout or full width from click away', 'bloog-lite'),
        'type'          =>  'radio',
        'section'       =>  'design_web_layout',
        'choices'       =>  array(
            'box_layout'    =>  __('Box Layout','bloog-lite'),
            'full_width'    =>  __('Full Width','bloog-lite')
            )
        )

    );


    //Custom CSS Settings section
$wp_customize->add_section('bloog_lite_custom_tools', array(
    'priority' => 200,
    'title' => __('Custom Tools', 'bloog-lite')
    ));

    //Custom css code
$wp_customize->add_setting('bloog_lite_custom_tools_css_code', array(
    'default' => '',
    'sanitize_callback' => 'bloog_lite_sanitize_text',
    ));

$wp_customize->add_control('bloog_lite_custom_tools_css_code',array(
    'type' => 'textarea',
    'label' => 'Custom Css Code',
    'section' => 'bloog_lite_custom_tools',
    ));

    //Custom js Settings section
$wp_customize->add_section('bloog_lite_custom_tools_js', array(
    'priority' => 20,
    'title' => __('Custom JS', 'bloog-lite'),
    ));

    //Custom css code
$wp_customize->add_setting('bloog_lite_custom_tools_js_code', array(
    'default' => '',
    'sanitize_callback' => 'bloog_lite_sanitize_text',
    ));

$wp_customize->add_control('bloog_lite_custom_tools_js_code',array(
    'type' => 'textarea',
    'label' => 'Custom JS/Google Analytics Code',
    'section' => 'bloog_lite_custom_tools',
    ));

    //Typography settings
$wp_customize->add_section( 'blooglite_typography_option' , array(
  'title'       => __('Typography Options','bloog-lite'),
  'description' => __('Choose fonts for body and headings.','bloog-lite'),
  'priority'    => 200,
  ) );

    //heading typography   
$wp_customize->add_setting('heading_typography',array(
  'default' => 'Lato',
  'transport' => 'postMessage',
  'sanitize_callback' => 'bloog_lite_sanitize_text',
  ));

$wp_customize->add_control( new Typography_Dropdown( $wp_customize ,'heading_typography',array(
  'label' => __('Choose Fonts for Heading Text.','bloog-lite'),
  'section' => 'blooglite_typography_option',
  'description' => __('Choose a font for the heading H1, H2, H3, H4, H5, H6 text','bloog-lite'),
  'type' => 'select',
  )));

     //body typography   
$wp_customize->add_setting('body_typography',array(
    'default' => 'Lato',
  'transport' => 'postMessage',
  'sanitize_callback' => 'bloog_lite_sanitize_text',
  ));

$wp_customize->add_control( new Typography_Dropdown( $wp_customize ,'body_typography',array(
  'label' => __('Choose Fonts for Body Text.','bloog-lite'),
  'section' => 'blooglite_typography_option',
  'description' => 'Choose fonts for body text.',
  'type' => 'select',
  )));


    //Checkbox sanitization customizer
function bloog_lite_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}

    //Sanitize input text general
function bloog_lite_sanitize_text( $input ){
    return wp_kses_post( force_balance_tags( $input ) );
} 

    //Integer Sanitize in the customizer
function bloog_lite_sanitize_integer( $input ) {
 return absint( $input );
} 

    //General dropdown sanitize for integer value
function bloog_lite_sanitize_dropdown_general( $input ) {
    return absint( $input );
}

function bloog_lite_web_layout($input){
  $valid_keys = array( 
    'box_layout'    =>  __('Box Layout','bloog-lite'),
    'full_width'    =>  __('Full Width','bloog-lite')
    );
  if ( array_key_exists( $input, $valid_keys ) ) {
   return $input;
} else {
   return '';
}

}

/*****************************/
    } // end of customizer
    add_action( 'customize_register', 'bloog_customizer' );
    ?>