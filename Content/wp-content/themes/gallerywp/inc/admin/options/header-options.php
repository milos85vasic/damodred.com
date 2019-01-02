<?php
/**
* Header options
*
* @package GalleryWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function gallerywp_header_options($wp_customize) {

    // Header
    $wp_customize->add_section( 'sc_gallerywp_header', array( 'title' => esc_html__( 'Header Options', 'gallerywp' ), 'panel' => 'gallerywp_main_options_panel', 'priority' => 240 ) );

    $wp_customize->add_setting( 'gallerywp_options[hide_header_content]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gallerywp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gallerywp_hide_header_content_control', array( 'label' => esc_html__( 'Hide Header Content', 'gallerywp' ), 'section' => 'sc_gallerywp_header', 'settings' => 'gallerywp_options[hide_header_content]', 'type' => 'checkbox', ) );

}