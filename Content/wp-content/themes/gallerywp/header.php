<?php
/**
* The header for GalleryWP theme.
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package GalleryWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class('gallerywp-animated gallerywp-fadein'); ?> id="gallerywp-site-body" itemscope="itemscope" itemtype="http://schema.org/WebPage">

<div class="gallerywp-outer-wrapper-full">
<div class="gallerywp-outer-wrapper">

<?php if ( !(gallerywp_get_option('disable_secondary_menu')) ) { ?>
<div class="gallerywp-container gallerywp-secondary-menu-container clearfix">
<div class="gallerywp-secondary-menu-container-inside clearfix">

<nav class="gallerywp-nav-secondary" id="gallerywp-secondary-navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement" role="navigation">
<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'gallerywp-menu-secondary-navigation', 'menu_class' => 'gallerywp-secondary-nav-menu gallerywp-menu-secondary', 'fallback_cb' => 'gallerywp_top_fallback_menu', ) ); ?>
</nav>

</div>
</div>
<?php } ?>

<div class="gallerywp-container" id="gallerywp-header" itemscope="itemscope" itemtype="http://schema.org/WPHeader" role="banner">
<div class="gallerywp-head-content clearfix" id="gallerywp-head-content">

<?php if ( get_header_image() ) : ?>
<div class="gallerywp-header-image clearfix">
<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="gallerywp-header-img-link">
    <img src="<?php header_image(); ?>" width="<?php echo esc_attr(get_custom_header()->width); ?>" height="<?php echo esc_attr(get_custom_header()->height); ?>" alt="" class="gallerywp-header-img"/>
</a>
</div>
<?php endif; ?>

<?php if ( !(gallerywp_get_option('hide_header_content')) ) { ?>
<div class="gallerywp-header-inside clearfix">
<div id="gallerywp-logo">
<?php if ( has_custom_logo() ) : ?>
    <div class="site-branding">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="gallerywp-logo-img-link">
        <img src="<?php echo esc_url( gallerywp_custom_logo() ); ?>" alt="" class="gallerywp-logo-img"/>
    </a>
    </div>
<?php else: ?>
    <div class="site-branding">
      <h1 class="gallerywp-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
      <p class="gallerywp-site-description"><?php bloginfo( 'description' ); ?></p>
    </div>
<?php endif; ?>
</div><!--/#gallerywp-logo -->

<div id="gallerywp-header-banner">
<?php dynamic_sidebar( 'gallerywp-header-banner' ); ?>
</div><!--/#gallerywp-header-banner -->
</div>
<?php } ?>

</div><!--/#gallerywp-head-content -->
</div><!--/#gallerywp-header -->

<div class="gallerywp-container gallerywp-primary-menu-container clearfix">
<div class="gallerywp-primary-menu-container-inside clearfix">
<?php if ( !(gallerywp_get_option('disable_primary_menu')) ) { ?>

<nav class="gallerywp-nav-primary" id="gallerywp-primary-navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement" role="navigation">
<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'gallerywp-menu-primary-navigation', 'menu_class' => 'gallerywp-nav-primary-menu gallerywp-menu-primary', 'fallback_cb' => 'gallerywp_fallback_menu', ) ); ?>
</nav>

<?php if ( !(gallerywp_get_option('hide_header_social_buttons')) ) { gallerywp_header_social_buttons(); } ?>

<div class='gallerywp-social-search-box'>
<?php get_search_form(); ?>
</div>

<?php } ?>
</div>
</div>

<div class="gallerywp-container clearfix" id="gallerywp-wrapper">
<div class="gallerywp-content-wrapper clearfix" id="gallerywp-content-wrapper">