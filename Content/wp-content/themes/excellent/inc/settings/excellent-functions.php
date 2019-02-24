<?php
/**
 * Custom functions
 *
 * @package Theme Freesia
 * @subpackage Excellent
 * @since Excellent 1.0
 */
/********************* Set Default Value if not set ***********************************/
	if ( !get_theme_mod('excellent_theme_options') ) {
		set_theme_mod( 'excellent_theme_options', excellent_get_option_defaults_values() );
	}
/********************* EXCELLENT RESPONSIVE AND CUSTOM CSS OPTIONS ***********************************/
function excellent_responsiveness() {
	$excellent_settings = excellent_get_theme_options();
	if( $excellent_settings['excellent_responsive'] == 'on' ) { ?>
	<meta name="viewport" content="width=device-width" />
	<?php } else{ ?>
	<meta name="viewport" content="width=1170" />
	<?php  }
}
add_filter( 'wp_head', 'excellent_responsiveness');

/******************************** EXCERPT LENGTH *********************************/
function excellent_excerpt_length($length) {
	$excellent_settings = excellent_get_theme_options();
	$excellent_excerpt_length = $excellent_settings['excellent_excerpt_length'];
	return absint($excellent_excerpt_length);
}
add_filter('excerpt_length', 'excellent_excerpt_length');

/********************* CONTINUE READING LINKS FOR EXCERPT *********************************/
function excellent_continue_reading() {
	 return '&hellip; '; 
}
add_filter('excerpt_more', 'excellent_continue_reading');

/***************** USED CLASS FOR BODY TAGS ******************************/
function excellent_body_class($excellent_class) {
	$excellent_settings = excellent_get_theme_options();
	$excellent_blog_layout = $excellent_settings['excellent_blog_layout'];
	$excellent_site_layout = $excellent_settings['excellent_design_layout'];
	if ($excellent_site_layout =='boxed-layout') {
		$excellent_class[] = 'boxed-layout';
	}elseif ($excellent_site_layout =='small-boxed-layout') {
		$excellent_class[] = 'boxed-layout-small';
	}else{
		$excellent_class[] = '';
	}
	if(!is_single()){
		if ($excellent_blog_layout == 'medium_image_display'){
			$excellent_class[] = "small-image-blog";
		}elseif($excellent_blog_layout == 'two_column_image_display'){
			$excellent_class[] = "two-column-blog";
		}else{
			$excellent_class[] = "";
		}
	}
	if(is_page_template('page-templates/excellent-corporate.php')) {
			$excellent_class[] = 'excellent-corporate';
	}
	return $excellent_class;
}
add_filter('body_class', 'excellent_body_class');

/********************** SCRIPTS FOR DONATE/ UPGRADE BUTTON ******************************/
function excellent_customize_scripts() {
	wp_enqueue_style( 'excellent_customizer_custom', get_template_directory_uri() . '/inc/css/excellent-customizer.css');
}
add_action( 'customize_controls_print_scripts', 'excellent_customize_scripts');

/**************************** SOCIAL MENU *********************************************/
function excellent_social_links_display() {
		if ( has_nav_menu( 'social-link' ) ) : ?>
	<div class="social-links clearfix">
	<?php
		wp_nav_menu( array(
			'container' 	=> '',
			'theme_location' => 'social-link',
			'depth'          => 1,
			'items_wrap'      => '<ul>%3$s</ul>',
			'link_before'    => '<span class="screen-reader-text">',
			'link_after'     => '</span>',
		) );
	?>
	</div><!-- end .social-links -->
	<?php endif; ?>
<?php }
add_action ('excellent_social_links', 'excellent_social_links_display');

/******************* DISPLAY BREADCRUMBS ******************************/
function excellent_breadcrumb() {
	if (function_exists('bcn_display')) { ?>
		<div class="breadcrumb home">
			<?php bcn_display(); ?>
		</div> <!-- .breadcrumb -->
	<?php }
}

/*********************** excellent PAGE SLIDERS ***********************************/
function excellent_category_sliders() {
	$excellent_settings = excellent_get_theme_options();
	global $excellent_excerpt_length;
	$slider_custom_text = $excellent_settings['excellent_secondary_text'];
	$slider_custom_url = $excellent_settings['excellent_secondary_url'];
	$query = new WP_Query(array(
					'posts_per_page' =>  intval($excellent_settings['excellent_category_slider_number']),
					'post_type' => array(
						'post'
					) ,
					'category__in' => intval($excellent_settings['excellent_category_slider']),
				));
	if($query->have_posts() && !empty($excellent_settings['excellent_category_slider'])){
		$excellent_category_sliders_display = '';
		$excellent_category_sliders_display 	.= '<div class="main-slider"> <div class="layer-slider"><ul class="slides">';
		while ($query->have_posts()):$query->the_post();
			$attachment_id = get_post_thumbnail_id();
			$image_attributes = wp_get_attachment_image_src($attachment_id,'excellent_slider_image');
			$title_attribute = apply_filters('the_title', get_the_title(get_queried_object_id()));
			$excerpt = get_the_excerpt();
				$excellent_category_sliders_display    	.= '<li>';
				if ($image_attributes) {
					$excellent_category_sliders_display 	.= '<div class="image-slider" title="'.the_title_attribute('echo=0').'"' .' style="background-image:url(' ."'" .esc_url($image_attributes[0])."'" .')">';
				}else{
					$excellent_category_sliders_display 	.= '<div class="image-slider">';
				}
				if ($title_attribute != '' || $excerpt != '') {
					$excellent_category_sliders_display 	.= '<article class="slider-content">';
				}
				$remove_link = $excellent_settings['excellent_slider_link'];
					if($remove_link == 0){
						if ($title_attribute != '') {
							$excellent_category_sliders_display .= '<h2 class="slider-title"><a href="'.esc_url(get_permalink()).'" title="'.the_title_attribute('echo=0').'" rel="bookmark">'.get_the_title().'</a></h2><!-- .slider-title -->';
						}
					}else{
						$excellent_category_sliders_display .= '<h2 class="slider-title">'.get_the_title().'</h2><!-- .slider-title -->';
					}
					if ($excerpt != '') {
						$excellent_category_sliders_display .= '<p class="slider-text">'.wp_strip_all_tags( get_the_excerpt(), true ).'</p><!-- end .slider-text -->';
					}
						$excellent_category_sliders_display 	.='<div class="slider-buttons">';
						if(!empty($slider_custom_text)){
							$excellent_category_sliders_display 	.= '<a title="'.esc_attr($slider_custom_text).'"' .' href="'.esc_url($slider_custom_url). '"'. ' class="btn-default vivid" target="_blank">'.esc_attr($slider_custom_text). '</a>';
						}
						if($excellent_settings['excellent_slider_button'] == 0){
							$excerpt_text = $excellent_settings['excellent_tag_text'];
							if($excerpt_text == '' || $excerpt_text == 'Continue Reading') :
								$excellent_category_sliders_display 	.= '<a title='.'"'.the_title_attribute('echo=0'). '"'. ' '.'href="'.esc_url(get_permalink()).'"'.' class="btn-default dark">'.esc_html__('Continue reading', 'excellent').'</a>';
							else:
								$excellent_category_sliders_display 	.= '<a title='.'"'.the_title_attribute('echo=0'). '"'. ' '.'href="'.esc_url(get_permalink()).'"'.' class="btn-default dark">'.esc_attr($excellent_settings[ 'excellent_tag_text' ]).'</a>';
							endif;
						}
						$excellent_category_sliders_display 	.= '</div><!-- end .slider-buttons -->';
						$excellent_category_sliders_display 	.='</article><!-- end .slider-content --> ';
				$excellent_category_sliders_display 	.='</div><!-- end .image-slider -->
				</li>';
			endwhile;
			wp_reset_postdata();
			$excellent_category_sliders_display .= '</ul><!-- end .slides -->
				</div> <!-- end .layer-slider -->
			</div> <!-- end .main-slider -->';
				echo $excellent_category_sliders_display;
			}
}
/*************************** ENQUEING STYLES AND SCRIPTS ****************************************/
function excellent_scripts() {
	$excellent_settings = excellent_get_theme_options();
	wp_enqueue_script('excellent-main', get_template_directory_uri().'/js/excellent-main.js', array('jquery'), false, true);
	$excellent_stick_menu = $excellent_settings['excellent_stick_menu'];
	if($excellent_stick_menu != 1):
		wp_enqueue_script('jquery-sticky', get_template_directory_uri().'/assets/sticky/jquery.sticky.min.js', array('jquery'), false, true);
	wp_enqueue_script('excellent-sticky-settings', get_template_directory_uri().'/assets/sticky/sticky-settings.js', array('jquery'), false, true);
	endif;
	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_style( 'excellent-style', get_stylesheet_uri() );
	wp_enqueue_style('font-awesome', get_template_directory_uri().'/assets/font-awesome/css/font-awesome.min.css');
	wp_enqueue_script('jquery-flexslider', get_template_directory_uri().'/js/jquery.flexslider.js', array('jquery'), false, true);
	wp_enqueue_script('excellent-slider', get_template_directory_uri().'/js/flexslider-setting.js', array('jquery-flexslider'), false, true);
	if($excellent_settings['excellent_scrollreveal_effect'] ==0){
		wp_enqueue_style('excellent-animate', get_template_directory_uri().'/assets/wow/css/animate.min.css');
		wp_enqueue_script('wow', get_template_directory_uri().'/assets/wow/js/wow.min.js', array('jquery'), false, true);
		wp_enqueue_script('wow-settings', get_template_directory_uri().'/assets/wow/js/wow-settings.js', array('jquery'), false, true);
	}
	wp_enqueue_script('excellent-navigation', get_template_directory_uri().'/js/navigation.js', array('jquery'), false, true);
	$excellent_animation_effect   = esc_attr($excellent_settings['excellent_animation_effect']);
	$excellent_slideshowSpeed    = absint($excellent_settings['excellent_slideshowSpeed'])*1000; // Set the speed of the slideshow cycling, in milliseconds
	$excellent_animationSpeed = absint($excellent_settings['excellent_animationSpeed'])*100; //Set the speed of animations, in milliseconds
	$excellent_direction = esc_attr($excellent_settings['excellent_direction']);
	wp_localize_script(
		'excellent-slider',
		'excellent_slider_value',
		array(
			'excellent_animation_effect'   => $excellent_animation_effect,
			'excellent_slideshowSpeed'    => $excellent_slideshowSpeed,
			'excellent_animationSpeed' => $excellent_animationSpeed,
			'excellent_direction' => $excellent_direction,
		)
	);
	wp_enqueue_script( 'excellent-slider' );
	if( $excellent_settings['excellent_responsive'] == 'on' ) {
		wp_enqueue_style('excellent-responsive', get_template_directory_uri().'/css/responsive.css');
	}
	/********* Adding Multiple Fonts ********************/
	$excellent_googlefont = array();
	array_push( $excellent_googlefont, 'Roboto:300,400,400i,700');
	array_push( $excellent_googlefont, 'Lora:400,400i');
	$excellent_googlefonts = implode("|", $excellent_googlefont);
	wp_register_style( 'excellent_google_fonts', '//fonts.googleapis.com/css?family='.$excellent_googlefonts);
	wp_enqueue_style( 'excellent_google_fonts' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	/* Custom Css */
	$excellent_internal_css='';
	if ($excellent_settings['excellent_slider_content_bg_color'] =='on'){
		$excellent_internal_css .= '/* Slider Content With background color */
		.slider-content {
			background: rgba(255, 255, 255, 0.8) padding-box;
			border: 7px solid rgba(255, 255, 255, 0.4);
			padding: 20px 20px 25px;
		}';
	}
	if ($excellent_settings['excellent_site_sticky_hide_social_icon'] =='on'){
		$excellent_internal_css .= '/* Show Site Title on Sticky Header and Hide Social Icon */
			.is-sticky #sticky-header .nav-site-title {
				display: block;
				float: left;
				padding: 0;
			}

			.is-sticky .header-social-block {
				display: none;
			}

			.is-sticky .main-navigation {
				float: right;
			}';
	}
	if ($excellent_settings['excellent_logo_high_resolution'] !=0){
		$excellent_internal_css .= '/* Logo for high resolution screen(Use 2X size image) */
			.custom-logo-link .custom-logo {
				width: 50%;
			}

			@media only screen and (max-width: 767px) { 
				.custom-logo-link .custom-logo {
					width: 60%;
				}
			}

			@media only screen and (max-width: 480px) { 
				.custom-logo-link .custom-logo {
					width: 80%;
				}
			}';
	}
	if ($excellent_settings['excellent_small_feature_single_post'] !=0){
		$excellent_internal_css .= '/* Display small feature image in single post */
			.single-featured-image-header {
				height: 400px;
				margin: 50px auto 0;
				overflow: hidden;
				width: 1170px;
			}

			.single-featured-image-header img {
				position: relative;
				top: 50%;
				transform: translateY(-50%);
				width: 100%;
			}

			@media only screen and (max-width: 1300px) { 
				.single-featured-image-header {
					width: 970px;
				}
				.boxed-layout .single-featured-image-header,
				.boxed-layout-small .single-featured-image-header {
					max-width: 904px;
				}
			}

			@media only screen and (max-width: 1023px) { 
				.single-featured-image-header {
					height: 100%;
					width: 708px;
				}

				.boxed-layout .single-featured-image-header,
				.boxed-layout-small .single-featured-image-header {
					width: 668px;
				}

				.single-featured-image-header img {
					top: inherit;
					transform: inherit;
				}
			}

			@media only screen and (max-width: 767px) { 
				.single-featured-image-header {
					width: 460px;
				}

				.boxed-layout .single-featured-image-header,
				.boxed-layout-small .single-featured-image-header {
					width: 440px;
				}
			}

			@media only screen and (max-width: 480px) { 
				.single-featured-image-header {
					width: 300px;
				}

				.boxed-layout .single-featured-image-header,
				.boxed-layout-small .single-featured-image-header {
					width: 280px;
				}
			}

			@media only screen and (max-width: 319px) {
				.single-featured-image-header,
				.boxed-layout .single-featured-image-header,
				.boxed-layout-small .single-featured-image-header {
					width: 96%;
				}
			}';
	}
	if($excellent_settings['excellent_header_display']=='header_logo'){
		$excellent_internal_css .= '
		#site-branding #site-title, #site-branding #site-description{
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}';
	}
	wp_add_inline_style( 'excellent-style', wp_strip_all_tags($excellent_internal_css) );
}
add_action( 'wp_enqueue_scripts', 'excellent_scripts' );