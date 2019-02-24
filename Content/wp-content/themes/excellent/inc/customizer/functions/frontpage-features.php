<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Excellent
 * @since Excellent 1.0
 */
class Excellent_Category_Control extends WP_Customize_Control {
	public $type = 'select';
	public function render_content() {
	$excellent_settings = excellent_get_theme_options();
	$excellent_categories = get_categories(); ?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<select <?php $this->link(); ?>>
			<?php
				foreach ( $excellent_categories as $category) :?>
						<option value="<?php echo $category->cat_ID; ?>" <?php if ( in_array( $category->cat_ID, $excellent_settings) ) { echo 'selected="selected"';}?>><?php echo $category->cat_name; ?></option>
					<?php endforeach; ?>
			</select>
		</label>
	<?php 
	}
}

/******************** EXCELLENT FRONTPAGE  *********************************************/
/* Frontpage Excellent Section */
$excellent_settings = excellent_get_theme_options();
$wp_customize->add_section( 'excellent_frontpage_about_us', array(
	'title' => __('About Us Section','excellent'),
	'priority' => 400,
	'panel' =>'excellent_frontpage_panel'
));
$wp_customize->add_section( 'excellent_frontpage_features', array(
	'title' => __('Frontpage Features Section','excellent'),
	'priority' => 500,
	'panel' =>'excellent_frontpage_panel'
));
$wp_customize->add_section( 'excellent_latest_blog_features', array(
	'title' => __('Latest from Blog Section','excellent'),
	'priority' => 600,
	'panel' =>'excellent_frontpage_panel'
));
$wp_customize->add_section( 'excellent_portfolio_box_features', array(
	'title' => __('Portfolio Section','excellent'),
	'priority' => 900,
	'panel' =>'excellent_frontpage_panel'
));
$wp_customize->add_section( 'excellent_our_testimonial_features', array(
	'title' => __('Our Testimonial Section','excellent'),
	'priority' => 1000,
	'panel' =>'excellent_frontpage_panel'
));
$wp_customize->add_section( 'excellent_frontpage_display_position', array(
	'title' => __('Change Position frontpage features','excellent'),
	'priority' => 1050,
	'panel' =>'excellent_frontpage_panel'
));

/* About Us Section */
$wp_customize->add_setting( 'excellent_theme_options[excellent_disable_about_us]', array(
	'default' => $excellent_settings['excellent_disable_about_us'],
	'sanitize_callback' => 'excellent_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'excellent_theme_options[excellent_disable_about_us]', array(
	'priority' => 410,
	'label' => __('Disable About Us Section', 'excellent'),
	'section' => 'excellent_frontpage_about_us',
	'type' => 'checkbox',
));
$wp_customize->add_setting( 'excellent_theme_options[excellent_about_us_remove_link]', array(
	'default' => $excellent_settings['excellent_about_us_remove_link'],
	'sanitize_callback' => 'excellent_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'excellent_theme_options[excellent_about_us_remove_link]', array(
	'priority' => 415,
	'label' => __('Remove link from Title and Image', 'excellent'),
	'section' => 'excellent_frontpage_about_us',
	'type' => 'checkbox',
));
$wp_customize->add_setting('excellent_theme_options[excellent_about_title]', array(
	'default' =>$excellent_settings['excellent_about_title'],
	'sanitize_callback' => 'sanitize_text_field',
	'type' => 'option',
	'capability' => 'manage_options'
));
$wp_customize->add_control('excellent_theme_options[excellent_about_title]', array(
	'priority' =>420,
	'label' => __('Title', 'excellent'),
	'section' => 'excellent_frontpage_about_us',
	'type' => 'text',
));
$wp_customize->add_setting('excellent_theme_options[excellent_about_description]', array(
	'default' =>$excellent_settings['excellent_about_description'],
	'sanitize_callback' => 'sanitize_textarea_field',
	'type' => 'option',
	'capability' => 'manage_options'
));
$wp_customize->add_control('excellent_theme_options[excellent_about_description]', array(
	'priority' =>430,
	'label' => __('Description', 'excellent'),
	'section' => 'excellent_frontpage_about_us',
	'type' => 'textarea',
));
$wp_customize->add_setting('excellent_theme_options[excellent_about_us]', array(
	'default' =>$excellent_settings['excellent_about_us'],
	'sanitize_callback' =>'excellent_sanitize_page',
	'type' => 'option',
	'capability' => 'manage_options'
));
$wp_customize->add_control( 'excellent_theme_options[excellent_about_us]', array(
	'priority' => 440,
	'label' => __('Excellent Page', 'excellent'),
	'section' => 'excellent_frontpage_about_us',
	'type' => 'dropdown-pages',
));
/* Frontpage Features */
$wp_customize->add_setting( 'excellent_theme_options[excellent_disable_features]', array(
	'default' => $excellent_settings['excellent_disable_features'],
	'sanitize_callback' => 'excellent_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'excellent_theme_options[excellent_disable_features]', array(
	'priority' => 500,
	'label' => __('Disable Front Page Features', 'excellent'),
	'section' => 'excellent_frontpage_features',
	'type' => 'checkbox',
));
$wp_customize->add_setting( 'excellent_theme_options[excellent_disable_features_readmore]', array(
	'default' => $excellent_settings['excellent_disable_features_readmore'],
	'sanitize_callback' => 'excellent_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'excellent_theme_options[excellent_disable_features_readmore]', array(
	'priority' => 520,
	'label' => __('Disable Read More Button', 'excellent'),
	'section' => 'excellent_frontpage_features',
	'type' => 'checkbox',
));
$wp_customize->add_setting( 'excellent_theme_options[excellent_disable_features_image]', array(
	'default' => $excellent_settings['excellent_disable_features_image'],
	'sanitize_callback' => 'excellent_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'excellent_theme_options[excellent_disable_features_image]', array(
	'priority' => 525,
	'label' => __('Disable Image from Front Page features', 'excellent'),
	'section' => 'excellent_frontpage_features',
	'type' => 'checkbox',
));
$wp_customize->add_setting( 'excellent_theme_options[excellent_features_title]', array(
	'default' => $excellent_settings['excellent_features_title'],
	'sanitize_callback' => 'sanitize_text_field',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_control( 'excellent_theme_options[excellent_features_title]', array(
	'priority' => 530,
	'label' => __( 'Title', 'excellent' ),
	'section' => 'excellent_frontpage_features',
	'settings' => 'excellent_theme_options[excellent_features_title]',
	'type' => 'text',
	)
);
$wp_customize->add_setting( 'excellent_theme_options[excellent_features_description]', array(
	'default' => $excellent_settings['excellent_features_description'],
	'sanitize_callback' => 'sanitize_textarea_field',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_control( 'excellent_theme_options[excellent_features_description]', array(
	'priority' => 540,
	'label' => __( 'Description', 'excellent' ),
	'section' => 'excellent_frontpage_features',
	'settings' => 'excellent_theme_options[excellent_features_description]',
	'type' => 'textarea',
	)
);
for ( $i=1; $i <= $excellent_settings['excellent_total_features'] ; $i++ ) {
	$wp_customize->add_setting('excellent_theme_options[excellent_frontpage_features_'. $i .']', array(
		'default' =>'',
		'sanitize_callback' =>'excellent_sanitize_page',
		'type' => 'option',
		'capability' => 'manage_options'
	));
	$wp_customize->add_control( 'excellent_theme_options[excellent_frontpage_features_'. $i .']', array(
		'priority' => 501 . $i,
		'label' => __(' Feature #', 'excellent') . ' ' . $i ,
		'section' => 'excellent_frontpage_features',
		'type' => 'dropdown-pages',
	));
}
/* Latest from Blog Excellent */
$wp_customize->add_setting( 'excellent_theme_options[excellent_disable_latest_blog]', array(
	'default' => $excellent_settings['excellent_disable_latest_blog'],
	'sanitize_callback' => 'excellent_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'excellent_theme_options[excellent_disable_latest_blog]', array(
	'priority' => 600,
	'label' => __('Disable Latest Blog/Category', 'excellent'),
	'section' => 'excellent_latest_blog_features',
	'type' => 'checkbox',
));
$wp_customize->add_setting('excellent_theme_options[excellent_total_latest_from_blog]', array(
    'default'        => $excellent_settings['excellent_total_latest_from_blog'],
    'sanitize_callback' => 'excellent_numeric_value',
    'type'                  => 'option',
    'capability'            => 'manage_options'
));
$wp_customize->add_control('excellent_theme_options[excellent_total_latest_from_blog]', array(
    'priority'      => 603,
    'label'      => __('No. of Post', 'excellent'),
    'section'    => 'excellent_latest_blog_features',
    'type'       => 'text',
) );
$wp_customize->add_setting( 'excellent_theme_options[excellent_latest_blog_title]', array(
	'default' => $excellent_settings['excellent_latest_blog_title'],
	'sanitize_callback' => 'sanitize_text_field',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_control( 'excellent_theme_options[excellent_latest_blog_title]', array(
	'priority' => 610,
	'label' => __( 'Title', 'excellent' ),
	'section' => 'excellent_latest_blog_features',
	'settings' => 'excellent_theme_options[excellent_latest_blog_title]',
	'type' => 'text',
	)
);
$wp_customize->add_setting( 'excellent_theme_options[excellent_latest_blog_description]', array(
	'default' => $excellent_settings['excellent_latest_blog_description'],
	'sanitize_callback' => 'sanitize_textarea_field',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_control( 'excellent_theme_options[excellent_latest_blog_description]', array(
	'priority' => 620,
	'label' => __( 'Description', 'excellent' ),
	'section' => 'excellent_latest_blog_features',
	'settings' => 'excellent_theme_options[excellent_latest_blog_description]',
	'type' => 'textarea',
	)
);
$wp_customize->add_setting( 'excellent_theme_options[excellent_display_blog_category]', array(
	'default' => $excellent_settings['excellent_display_blog_category'],
	'sanitize_callback' => 'excellent_sanitize_select',
	'type' => 'option',
));
$wp_customize->add_control( 'excellent_theme_options[excellent_display_blog_category]', array(
	'priority'=>625,
	'label' => __('Display Latest Blog/Category', 'excellent'),
	'section' => 'excellent_latest_blog_features',
	'type' => 'radio',
	'checked' => 'checked',
	'choices' => array(
		'blog' => __('Display Latest Blog','excellent'),
		'category' => __('Display Category','excellent'),
	),
));
$wp_customize->add_setting( 'excellent_theme_options[excellent_latest_from_blog_category_list]', array(
		'default'				=>array(),
		'capability'			=> 'manage_options',
		'sanitize_callback'	=> 'excellent_sanitize_latest_from_blog_select',
		'type'				=> 'option'
	));
$wp_customize->add_control(
	new Excellent_Category_Control(
	$wp_customize,
	'excellent_theme_options[excellent_latest_from_blog_category_list]',
		array(
			'priority' 				=> 630,
			'label'					=> __('Select Category','excellent'),
			'section'				=> 'excellent_latest_blog_features',
			'settings'				=> 'excellent_theme_options[excellent_latest_from_blog_category_list]',
			'type'					=>'select'
		)
	)
);
/* Portfolio Box */
$wp_customize->add_setting( 'excellent_theme_options[excellent_disable_portfolio_box]', array(
	'default' => $excellent_settings['excellent_disable_portfolio_box'],
	'sanitize_callback' => 'excellent_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'excellent_theme_options[excellent_disable_portfolio_box]', array(
	'priority' => 900,
	'label' => __('Disable Portfolio Box', 'excellent'),
	'section' => 'excellent_portfolio_box_features',
	'type' => 'checkbox',
));
for ( $i=1; $i <= $excellent_settings['excellent_total_portfolio_box'] ; $i++ ) {
	$wp_customize->add_setting('excellent_theme_options[excellent_portfolio_box_features_'. $i .']', array(
		'default' =>'',
		'sanitize_callback' =>'excellent_sanitize_page',
		'type' => 'option',
		'capability' => 'manage_options'
	));
	$wp_customize->add_control( 'excellent_theme_options[excellent_portfolio_box_features_'. $i .']', array(
		'priority' => 93 . $i,
		'label' => __(' Portfolio #', 'excellent') . ' ' . $i ,
		'section' => 'excellent_portfolio_box_features',
		'type' => 'dropdown-pages',
	));
}
/* Testimonial Box */
$wp_customize->add_setting( 'excellent_theme_options[excellent_disable_our_testimonial]', array(
	'default' => $excellent_settings['excellent_disable_our_testimonial'],
	'sanitize_callback' => 'excellent_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'excellent_theme_options[excellent_disable_our_testimonial]', array(
	'priority' => 1000,
	'label' => __('Disable Testimonial', 'excellent'),
	'section' => 'excellent_our_testimonial_features',
	'type' => 'checkbox',
));
$wp_customize->add_setting( 'excellent_theme_options[excellent_our_testimonial_title]', array(
	'default' => $excellent_settings['excellent_our_testimonial_title'],
	'sanitize_callback' => 'sanitize_text_field',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_control( 'excellent_theme_options[excellent_our_testimonial_title]', array(
	'priority' => 1010,
	'label' => __( 'Title', 'excellent' ),
	'section' => 'excellent_our_testimonial_features',
	'settings' => 'excellent_theme_options[excellent_our_testimonial_title]',
	'type' => 'text',
	)
);
for ( $i=1; $i <= $excellent_settings['excellent_total_our_testimonial'] ; $i++ ) {
	$wp_customize->add_setting('excellent_theme_options[excellent_our_testimonial_features_'. $i .']', array(
		'default' =>'',
		'sanitize_callback' =>'excellent_sanitize_page',
		'type' => 'option',
		'capability' => 'manage_options'
	));
	$wp_customize->add_control( 'excellent_theme_options[excellent_our_testimonial_features_'. $i .']', array(
		'priority' => 103 . $i,
		'label' => __(' Testimonial #', 'excellent') . ' ' . $i ,
		'section' => 'excellent_our_testimonial_features',
		'type' => 'dropdown-pages',
	));
	/* Display Frontpage Position Section */
	$wp_customize->add_setting('excellent_theme_options[excellent_frontpage_position]', array(
		'default' => $excellent_settings['excellent_frontpage_position'],
		'sanitize_callback' => 'excellent_sanitize_select',
		'type' => 'option',
	));
	$wp_customize->add_control('excellent_theme_options[excellent_frontpage_position]', array(
		'priority' =>1100,
		'label' => __('Display Frontpage Position', 'excellent'),
		'section' => 'excellent_frontpage_display_position',
		'type' => 'select',
		'checked' => 'checked',
		'choices' => array(
			'default' => __('Default','excellent'),
			'design_second_position_display' => __('Second Position Design','excellent'),
			'design_third_position_display' => __('Third Position Design','excellent'),
			'design_fourth_position_display' => __('Fourth Position Design','excellent'),
			'design_fifth_position_display' => __('Fifth Position Design','excellent'),
			'design_sixth_position_display' => __('Sixth Position Design','excellent'),
			'design_seventh_position_display' => __('Seventh Position Design','excellent'),
			'design_eigth_position_display' => __('Eighth Position Design','excellent'),
			'design_ninth_position_display' => __('Ninth Position Design','excellent'),
			'design_tenth_position_display' => __('Tenth Position Design','excellent'),
	),
));
}