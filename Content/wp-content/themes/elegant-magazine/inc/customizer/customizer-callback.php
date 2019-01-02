<?php
/**
 * Customizer callback functions for active_callback.
 *
 * @package Elegant_Magazine
 */

/*select page for slider*/
if ( ! function_exists( 'elegant_magazine_frontpage_content_status' ) ) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function elegant_magazine_frontpage_content_status( $control ) {

        if ( 'page' == $control->manager->get_setting( 'show_on_front' )->value() ) {
            return true;
        } else {
            return false;
        }

    }

endif;

    /*select page for slider*/
if ( ! function_exists( 'elegant_magazine_ticker_news_status' ) ) :

    /**
     * Check if ticker section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function elegant_magazine_ticker_news_status( $control ) {

        if ( true == $control->manager->get_setting( 'show_ticker_news_section' )->value() ) {
            return true;
        } else {
            return false;
        }

    }

endif;

    /*select page for slider*/
if ( ! function_exists( 'elegant_magazine_slider_section_status' ) ) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function elegant_magazine_slider_section_status( $control ) {

        if ( true == $control->manager->get_setting( 'show_main_news_section' )->value() ) {
            return true;
        } else {
            return false;
        }

    }

endif;

/*select page for slider*/
if ( ! function_exists( 'elegant_magazine_archive_image_status' ) ) :

    /**
     * Check if archive no image is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function elegant_magazine_archive_image_status( $control ) {

        if ( 'archive-layout-list' == $control->manager->get_setting( 'archive_layout' )->value() ) {
            return true;
        } else {
            return false;
        }

    }

endif;

/*related posts*/
if ( ! function_exists( 'elegant_magazine_related_posts_status' ) ) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function elegant_magazine_related_posts_status( $control ) {

        if ( true == $control->manager->get_setting( 'single_show_related_posts' )->value() ) {
            return true;
        } else {
            return false;
        }

    }

endif;

