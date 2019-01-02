<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function elegant_magazine_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Main Sidebar', 'elegant-magazine'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets for main sidebar.', 'elegant-magazine'),
        'before_widget' => '<div id="%1$s" class="widget elegant-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span>',
        'after_title' => '</span></h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Off-canvas Panel', 'elegant-magazine'),
        'id'            => 'express-off-canvas-panel',
        'description'   => esc_html__('Add widgets for off-canvas panel.', 'elegant-magazine'),
        'before_widget' => '<div id="%1$s" class="widget elegant-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span>',
        'after_title' => '</span></h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Front-page Content Section', 'elegant-magazine'),
        'id' => 'home-content-widgets',
        'description' => esc_html__('Add widgets to front-page contents section.', 'elegant-magazine'),
        'before_widget' => '<div id="%1$s" class="widget elegant-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title"><span>',
        'after_title' => '</span></h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Front-page Sidebar Section', 'elegant-magazine'),
        'id' => 'home-sidebar-widgets',
        'description' => esc_html__('Add widgets to front-page sidebar section.', 'elegant-magazine'),
        'before_widget' => '<div id="%1$s" class="widget elegant-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span>',
        'after_title' => '</span></h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer First Section', 'elegant-magazine'),
        'id' => 'footer-first-widgets-section',
        'description' => esc_html__('Displays items on footer first column.', 'elegant-magazine'),
        'before_widget' => '<div id="%1$s" class="widget elegant-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Second Section', 'elegant-magazine'),
        'id' => 'footer-second-widgets-section',
        'description' => esc_html__('Displays items on footer second column.', 'elegant-magazine'),
        'before_widget' => '<div id="%1$s" class="widget elegant-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Third Section', 'elegant-magazine'),
        'id' => 'footer-third-widgets-section',
        'description' => esc_html__('Displays items on footer third column.', 'elegant-magazine'),
        'before_widget' => '<div id="%1$s" class="widget elegant-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1">',
        'after_title' => '</h2>',
    ));

}

add_action('widgets_init', 'elegant_magazine_widgets_init');