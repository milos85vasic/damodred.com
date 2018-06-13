<?php
/**
 * Bloog Lite Functions
 *
 * @package Bloog Lite
 */

if ( ! function_exists( 'is_plugin_active' ) ){
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}

if( ! function_exists( 'bloog_lite_custom_weblayout_class' ) ){
    function bloog_lite_custom_weblayout_class($classes){
        $header_class = get_theme_mod('layout_option','full_width');
        $classes[] = $header_class;
        return $classes;
    }
}
add_filter( 'body_class', 'bloog_lite_custom_weblayout_class' );

    // to insert box or full width design in homepage.
   // if(is_home()|| is_front_page()){
if( ! function_exists( 'bloog_lite_custom_header_tag' ) ){
    function bloog_lite_custom_header_tag($classes){
        $header_class = "";
        if(is_home() || is_front_page()){
            $header_class = get_theme_mod('homepage_layout_setting','fullwidth-home');
        }
        $classes[] = $header_class;
        return $classes;
    }
}
add_filter( 'body_class', 'bloog_lite_custom_header_tag' );
    //}
    // to insert box or full width design in category page.
if( ! function_exists( 'bloog_lite_custom_header_tag_category_page' ) ){
    function bloog_lite_custom_header_tag_category_page($classes){
        $header_class = "";
        if(is_category()){
            $header_class = get_theme_mod('categorypage_layout_setting','fullwidth-category-page');
        }
        $classes[] = $header_class;
        return $classes;
    }
}
add_filter( 'body_class', 'bloog_lite_custom_header_tag_category_page' );

    // to insert box or full width design in Single page.
if( ! function_exists( 'bloog_lite_custom_header_tag_single_page' ) ){
    function bloog_lite_custom_header_tag_single_page($classes){
        $header_class = "";
        if(is_page() && is_single()){
            if(!is_page_template('tpl-about.php')){
                $header_class = get_theme_mod('single_page_layout_setting','fullwidth-single-page');
            }
        }
        $classes[] = $header_class;
        return $classes;
    }
}
add_filter( 'body_class', 'bloog_lite_custom_header_tag_single_page' );

// to insert box or full width design in about and contact page.
if( ! function_exists( 'bloog_lite_custom_header_tag_abtcont_page' ) ){
    function bloog_lite_custom_header_tag_abtcont_page($classes){
        $header_class = "";
        if(is_page_template('tpl-about.php')){
            $header_class = 'fullwidth-single-page';
        }
        $classes[] = $header_class;
        return $classes;
    }
}
add_filter( 'body_class', 'bloog_lite_custom_header_tag_abtcont_page' );


    // to enque jquery 
if(! function_exists('bloog_lite_additional_scripts')){
 function bloog_lite_additional_scripts() {
     wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/fawesome/css/font-awesome.css' );
     wp_enqueue_script( 'jquery-bxslider-js', get_template_directory_uri() . '/js/jquery.bxslider.js', array('jquery') );
 }
}
add_action( 'wp_enqueue_scripts', 'bloog_lite_additional_scripts' );


add_action( 'admin_enqueue_scripts', 'bloog_lite_media_uploader' );


function bloog_lite_media_uploader( $hook )
{
    wp_enqueue_style( 'admin-style', get_template_directory_uri().'/inc/admin-panel/css/admin.css' );
    if( 'widgets.php' == $hook || 'customize.php' == $hook ) {

        wp_enqueue_script('bloog-lite-admin-custom-js', get_template_directory_uri().'/inc/admin-panel/js/custom.js', array('jquery'),'1.0',true);
        wp_enqueue_script( 
            'uploader-script', 
            get_template_directory_uri().'/inc/admin-panel/js/media-uploader.js', 
                array(), // dependencies
                false, // version
                true // on footer
                );
        wp_enqueue_media();
    }
}

//Dynamic styles on header
function bloog_lite_header_styles_scripts(){
    
    echo "<style type='text/css' media='all' id='dynamic-styles'>";

    //top header Section
    $bloog_lite_logo_bkgimage = get_theme_mod('bloog_lite_logo_bkgimage');
    
    if(!empty($bloog_lite_logo_bkgimage)){echo 'header.site-header {background-image: url("'.$bloog_lite_logo_bkgimage.'"); }';}
    
    //Custom CSS CODE
    $custom_css = get_theme_mod('bloog_lite_custom_tools_css_code');
    if(!empty($custom_css)){echo $custom_css;}

    echo "</style>\n";

    //custom js
    $custom_js = get_theme_mod('bloog_lite_custom_tools_js_code');
    if(!empty($custom_js)){
        echo '<script type="text/javascript">'.$custom_js.'</script>';
    }

}

add_action('wp_head','bloog_lite_header_styles_scripts');


add_action('wp_head' , 'bloog_lite_dynamic_style');
function bloog_lite_dynamic_style(){

    //font-family for header h1 to h6.
    $bloog_lite_heading_fonts = get_theme_mod('heading_typography');

    //font-family for body text.
    $bloog_lite_body_fonts = get_theme_mod('body_typography');

    ?>
    <style type="text/css">
        body{
            <?php
            if(!empty($bloog_lite_body_fonts)){ echo "font-family:".$bloog_lite_body_fonts.";"; }
            ?>
        }

        h1, h2, h3, h4, h5, h6 {
        <?php if(!empty($bloog_lite_heading_fonts)){ echo "font-family:".$bloog_lite_heading_fonts.";"; } ?>
        }
        ?>
    </style>
    <?php
}

function bloog_lite_fonts_cb(){
    $http = 'http';
    echo "<link href='".$http."://fonts.googleapis.com/css?family=Arimo:400,700|Open+Sans:400,700,600italic,300|Roboto+Condensed:300,400,700|Roboto:300,400,700|Slabo+27px|Oswald:400,300,700|Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic|Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic|PT+Sans:400,700,400italic,700italic|Droid+Sans:400,700|Raleway:400,100,200,300,500,600,700,800,900|Droid+Serif:400,700,400italic,700italic|Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic|Montserrat:400,700|Roboto+Slab:400,100,300,700|Merriweather:400italic,400,900,300italic,300,700,700italic,900italic|Lora:400,700,400italic,700italic|PT+Sans+Narrow:400,700|Bitter:400,700,400italic|Lobster|Yanone+Kaffeesatz:400,200,300,700|Arvo:400,700,400italic,700italic|Oxygen:400,300,700|Titillium+Web:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900|Dosis:200,300,400,500,600,700,800|Ubuntu+Condensed|Playfair+Display:400,700,900,400italic,700italic,900italic|Cabin:400,500,600,700,400italic,500italic,600italic|Muli:300,400,300italic,400italic' rel='stylesheet' type='text/css'>";   
}
add_action('wp_footer', 'bloog_lite_fonts_cb');