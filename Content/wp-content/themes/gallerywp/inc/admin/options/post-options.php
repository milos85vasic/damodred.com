<?php
/**
* Post options
*
* @package GalleryWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function gallerywp_post_options($wp_customize) {

    $wp_customize->add_section( 'sc_gallerywp_posts', array( 'title' => esc_html__( 'Post Options', 'gallerywp' ), 'panel' => 'gallerywp_main_options_panel', 'priority' => 260 ) );

    $wp_customize->add_setting( 'gallerywp_options[hide_posts_heading]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gallerywp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gallerywp_hide_posts_heading_control', array( 'label' => esc_html__( 'Hide HomePage Posts Heading', 'gallerywp' ), 'section' => 'sc_gallerywp_posts', 'settings' => 'gallerywp_options[hide_posts_heading]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gallerywp_options[posts_heading]', array( 'default' => esc_html__( 'Recent Posts', 'gallerywp' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field', ) );

    $wp_customize->add_control( 'gallerywp_posts_heading_control', array( 'label' => esc_html__( 'HomePage Posts Heading', 'gallerywp' ), 'section' => 'sc_gallerywp_posts', 'settings' => 'gallerywp_options[posts_heading]', 'type' => 'text', ) );

    $wp_customize->add_setting( 'gallerywp_options[thumbnail_link]', array( 'default' => 'yes', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gallerywp_sanitize_thumbnail_link' ) );

    $wp_customize->add_control( 'gallerywp_thumbnail_link_control', array( 'label' => esc_html__( 'Thumbnail Link', 'gallerywp' ), 'description' => esc_html__('Do you want single post thumbnail to be linked to their post?', 'gallerywp'), 'section' => 'sc_gallerywp_posts', 'settings' => 'gallerywp_options[thumbnail_link]', 'type' => 'select', 'choices' => array( 'yes' => esc_html__('Yes', 'gallerywp'), 'no' => esc_html__('No', 'gallerywp') ) ) );

    $wp_customize->add_setting( 'gallerywp_options[hide_posted_date_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gallerywp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gallerywp_hide_posted_date_home_control', array( 'label' => esc_html__( 'Hide Posted Date from Posts Summaries', 'gallerywp' ), 'section' => 'sc_gallerywp_posts', 'settings' => 'gallerywp_options[hide_posted_date_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gallerywp_options[hide_posted_date]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gallerywp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gallerywp_hide_posted_date_control', array( 'label' => esc_html__( 'Hide Posted Date from Single Posts', 'gallerywp' ), 'section' => 'sc_gallerywp_posts', 'settings' => 'gallerywp_options[hide_posted_date]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gallerywp_options[hide_post_author_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gallerywp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gallerywp_hide_post_author_home_control', array( 'label' => esc_html__( 'Hide Post Author from Posts Summaries', 'gallerywp' ), 'section' => 'sc_gallerywp_posts', 'settings' => 'gallerywp_options[hide_post_author_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gallerywp_options[hide_post_author]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gallerywp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gallerywp_hide_post_author_control', array( 'label' => esc_html__( 'Hide Post Author from Single Posts', 'gallerywp' ), 'section' => 'sc_gallerywp_posts', 'settings' => 'gallerywp_options[hide_post_author]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gallerywp_options[hide_post_categories_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gallerywp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gallerywp_hide_post_categories_home_control', array( 'label' => esc_html__( 'Hide Post Categories from Posts Summaries', 'gallerywp' ), 'section' => 'sc_gallerywp_posts', 'settings' => 'gallerywp_options[hide_post_categories_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gallerywp_options[hide_post_categories]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gallerywp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gallerywp_hide_post_categories_control', array( 'label' => esc_html__( 'Hide Post Categories from Single Posts', 'gallerywp' ), 'section' => 'sc_gallerywp_posts', 'settings' => 'gallerywp_options[hide_post_categories]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gallerywp_options[hide_post_tags_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gallerywp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gallerywp_hide_post_tags_home_control', array( 'label' => esc_html__( 'Hide Post Tags from Posts Summaries', 'gallerywp' ), 'section' => 'sc_gallerywp_posts', 'settings' => 'gallerywp_options[hide_post_tags_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gallerywp_options[hide_post_tags]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gallerywp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gallerywp_hide_post_tags_control', array( 'label' => esc_html__( 'Hide Post Tags from Single Posts', 'gallerywp' ), 'section' => 'sc_gallerywp_posts', 'settings' => 'gallerywp_options[hide_post_tags]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gallerywp_options[hide_comments_link_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gallerywp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gallerywp_hide_comments_link_home_control', array( 'label' => esc_html__( 'Hide Comment Link from Posts Summaries', 'gallerywp' ), 'section' => 'sc_gallerywp_posts', 'settings' => 'gallerywp_options[hide_comments_link_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gallerywp_options[hide_comments_link]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gallerywp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gallerywp_hide_comments_link_control', array( 'label' => esc_html__( 'Hide Comment Link from Single Posts', 'gallerywp' ), 'section' => 'sc_gallerywp_posts', 'settings' => 'gallerywp_options[hide_comments_link]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gallerywp_options[hide_post_edit]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gallerywp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gallerywp_hide_post_edit_control', array( 'label' => esc_html__( 'Hide Post Edit Link', 'gallerywp' ), 'section' => 'sc_gallerywp_posts', 'settings' => 'gallerywp_options[hide_post_edit]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gallerywp_options[hide_thumbnail]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gallerywp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gallerywp_hide_thumbnail_control', array( 'label' => esc_html__( 'Hide Thumbnails from Every Page', 'gallerywp' ), 'section' => 'sc_gallerywp_posts', 'settings' => 'gallerywp_options[hide_thumbnail]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gallerywp_options[hide_thumbnail_single]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gallerywp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gallerywp_hide_thumbnail_single_control', array( 'label' => esc_html__( 'Hide Thumbnails from Posts/Pages', 'gallerywp' ), 'section' => 'sc_gallerywp_posts', 'settings' => 'gallerywp_options[hide_thumbnail_single]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gallerywp_options[hide_author_bio_box]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gallerywp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gallerywp_hide_author_bio_box_control', array( 'label' => esc_html__( 'Hide Author Bio Box', 'gallerywp' ), 'section' => 'sc_gallerywp_posts', 'settings' => 'gallerywp_options[hide_author_bio_box]', 'type' => 'checkbox', ) );

}