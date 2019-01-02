<?php
/**
* Register widget area.
*
* @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
*
* @package GalleryWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function gallerywp_widgets_init() {

register_sidebar(array(
    'id' => 'gallerywp-header-banner',
    'name' => esc_html__( 'Header Banner', 'gallerywp' ),
    'description' => esc_html__( 'This sidebar is located on the header of the web page.', 'gallerywp' ),
    'before_widget' => '<div id="%1$s" class="gallerywp-header-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="gallerywp-widget-title">',
    'after_title' => '</h2>'));

register_sidebar(array(
    'id' => 'gallerywp-sidebar-one',
    'name' => esc_html__( 'Main Sidebar', 'gallerywp' ),
    'description' => esc_html__( 'This sidebar is normally located on the left-hand side of web page.', 'gallerywp' ),
    'before_widget' => '<div id="%1$s" class="gallerywp-side-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="gallerywp-widget-title"><span>',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'gallerywp-home-top-widgets',
    'name' => esc_html__( 'Top Widgets (Home Page Only)', 'gallerywp' ),
    'description' => esc_html__( 'This widget area is located at the top of homepage.', 'gallerywp' ),
    'before_widget' => '<div id="%1$s" class="gallerywp-main-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="gallerywp-widget-title"><span>',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'gallerywp-top-widgets',
    'name' => esc_html__( 'Top Widgets (Every Page)', 'gallerywp' ),
    'description' => esc_html__( 'This widget area is located at the top of every page.', 'gallerywp' ),
    'before_widget' => '<div id="%1$s" class="gallerywp-main-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="gallerywp-widget-title"><span>',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'gallerywp-home-bottom-widgets',
    'name' => esc_html__( 'Bottom Widgets (Home Page Only)', 'gallerywp' ),
    'description' => esc_html__( 'This widget area is located at the bottom of homepage.', 'gallerywp' ),
    'before_widget' => '<div id="%1$s" class="gallerywp-main-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="gallerywp-widget-title"><span>',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'gallerywp-bottom-widgets',
    'name' => esc_html__( 'Bottom Widgets (Every Page)', 'gallerywp' ),
    'description' => esc_html__( 'This widget area is located at the bottom of every page.', 'gallerywp' ),
    'before_widget' => '<div id="%1$s" class="gallerywp-main-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="gallerywp-widget-title"><span>',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'gallerywp-footer-1',
    'name' => esc_html__( 'Footer 1', 'gallerywp' ),
    'description' => esc_html__( 'This sidebar is located on the left bottom of web page.', 'gallerywp' ),
    'before_widget' => '<div id="%1$s" class="gallerywp-footer-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="gallerywp-widget-title"><span>',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'gallerywp-footer-2',
    'name' => esc_html__( 'Footer 2', 'gallerywp' ),
    'description' => esc_html__( 'This sidebar is located on the middle bottom of web page.', 'gallerywp' ),
    'before_widget' => '<div id="%1$s" class="gallerywp-footer-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="gallerywp-widget-title"><span>',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'gallerywp-footer-3',
    'name' => esc_html__( 'Footer 3', 'gallerywp' ),
    'description' => esc_html__( 'This sidebar is located on the middle bottom of web page.', 'gallerywp' ),
    'before_widget' => '<div id="%1$s" class="gallerywp-footer-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="gallerywp-widget-title"><span>',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'gallerywp-footer-4',
    'name' => esc_html__( 'Footer 4', 'gallerywp' ),
    'description' => esc_html__( 'This sidebar is located on the right bottom of web page.', 'gallerywp' ),
    'before_widget' => '<div id="%1$s" class="gallerywp-footer-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="gallerywp-widget-title"><span>',
    'after_title' => '</span></h2>'));

}
add_action( 'widgets_init', 'gallerywp_widgets_init' );


function gallerywp_top_widgets() { ?>

<?php if ( is_active_sidebar( 'gallerywp-home-top-widgets' ) || is_active_sidebar( 'gallerywp-top-widgets' ) ) : ?>
<div class="gallerywp-featured-posts-area gallerywp-featured-posts-area-top clearfix">
<?php if(is_front_page() && !is_paged()) { ?>
<?php dynamic_sidebar( 'gallerywp-home-top-widgets' ); ?>
<?php } ?>

<?php dynamic_sidebar( 'gallerywp-top-widgets' ); ?>
</div>
<?php endif; ?>

<?php }


function gallerywp_bottom_widgets() { ?>

<?php if ( is_active_sidebar( 'gallerywp-home-bottom-widgets' ) || is_active_sidebar( 'gallerywp-bottom-widgets' ) ) : ?>
<div class='gallerywp-featured-posts-area gallerywp-featured-posts-area-bottom clearfix'>
<?php if(is_front_page() && !is_paged()) { ?>
<?php dynamic_sidebar( 'gallerywp-home-bottom-widgets' ); ?>
<?php } ?>

<?php dynamic_sidebar( 'gallerywp-bottom-widgets' ); ?>
</div>
<?php endif; ?>

<?php }