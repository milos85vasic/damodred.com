<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Bloog Lite
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div id="page" class="hfeed site">
     <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'bloog-lite' ); ?></a>

     <header id="masthead" class="site-header" role="banner">
        <div class="bloog-wrapper">
            <?php if(is_active_sidebar('social_icon_header')){ ?>
            <div class="header_social_icon">
                <?php dynamic_sidebar('social_icon_header'); ?>
            </div>
            <?php } ?>
            <div class="header-left">
                <div class="site-branding clearfix">
                   <h1 class="site-title">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <?php bloginfo( 'name' ); ?>
                    </a>
                </h1>
                <p class="site-description"><?php bloginfo( 'description' ); ?></p>
            </div><!-- .site-branding -->
            <?php $bloog_show_header_img = get_theme_mod('show_header_setting','0'); ?>
            <?php
            if(($bloog_show_header_img == 0) && (get_header_image())){ ?>
            <div class="header-logo-container">
                <h1 class="site-header-logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <img src="<?php header_image(); ?>" />
                    </a>
                </h1>
            </div>
            <?php  } ?>
        </div>
        <div class="search_header">
            <i class="fa fa-search"></i>
            <div class="search_form_wrap">
                <?php echo get_template_part('searchform-header'); ?>
                <a href="javascript:void(0);" class="search_close">X</a>
            </div>
        </div>
    </div>
</div>
</header><!-- #masthead -->

<nav id="site-navigation" class="main-navigation" role="navigation">
    <div class="bloog-wrapper">
        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( '', 'bloog-lite' ); ?>
            <span class="menu-bar-wrap">
                <span class="menu-bar"></span>
                <span class="menu-bar bar-middle"></span>
                <span class="menu-bar"></span>
            </span>
        </button>
        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
    </div>
</nav><!-- #site-navigation -->


<div id="content" class="site-content">

    <!-- slider section -->
    <?php
    $bloog_cateory_show_slider = get_theme_mod('category_page_slider_option_setting', 'show-slider-category-page'); 
    $bloog_singlepage_show_slider = get_theme_mod('single_page_slider_option_setting', 'show-slider-single-page'); 
    
    if(is_home() || is_front_page() || (is_category() && $bloog_cateory_show_slider =='show-slider-category-page') || (is_single() && $bloog_singlepage_show_slider=='show-slider-single-page') || (is_page() && $bloog_singlepage_show_slider=='show-slider-single-page') ): ?>
    <div class="bloog-lite-slider-wrapper">
        <div class="bloog-container">
            <?php do_action('bloog_lite_home_slider'); ?>
        </div>
    </div>
<?php endif; ?>

