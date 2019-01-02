<?php
/**
* Social profiles options
*
* @package GalleryWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function gallerywp_social_profiles($wp_customize) {

    $wp_customize->add_section( 'sc_gallerywp_sociallinks', array( 'title' => esc_html__( 'Social Links', 'gallerywp' ), 'panel' => 'gallerywp_main_options_panel', 'priority' => 400, ));

    $wp_customize->add_setting( 'gallerywp_options[hide_header_social_buttons]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gallerywp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gallerywp_hide_header_social_buttons_control', array( 'label' => esc_html__( 'Hide Header Social Buttons', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[hide_header_social_buttons]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gallerywp_options[twitterlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gallerywp_twitterlink_control', array( 'label' => esc_html__( 'Twitter URL', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[twitterlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gallerywp_options[facebooklink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gallerywp_facebooklink_control', array( 'label' => esc_html__( 'Facebook URL', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[facebooklink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gallerywp_options[googlelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) ); 

    $wp_customize->add_control( 'gallerywp_googlelink_control', array( 'label' => esc_html__( 'Google Plus URL', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[googlelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gallerywp_options[pinterestlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gallerywp_pinterestlink_control', array( 'label' => esc_html__( 'Pinterest URL', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[pinterestlink]', 'type' => 'text' ) );
    
    $wp_customize->add_setting( 'gallerywp_options[linkedinlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gallerywp_linkedinlink_control', array( 'label' => esc_html__( 'Linkedin Link', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[linkedinlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gallerywp_options[instagramlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gallerywp_instagramlink_control', array( 'label' => esc_html__( 'Instagram Link', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[instagramlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gallerywp_options[vklink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gallerywp_vklink_control', array( 'label' => esc_html__( 'VK Link', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[vklink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gallerywp_options[flickrlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gallerywp_flickrlink_control', array( 'label' => esc_html__( 'Flickr Link', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[flickrlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gallerywp_options[youtubelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gallerywp_youtubelink_control', array( 'label' => esc_html__( 'Youtube URL', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[youtubelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gallerywp_options[vimeolink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gallerywp_vimeolink_control', array( 'label' => esc_html__( 'Vimeo URL', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[vimeolink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gallerywp_options[soundcloudlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gallerywp_soundcloudlink_control', array( 'label' => esc_html__( 'Soundcloud URL', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[soundcloudlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gallerywp_options[lastfmlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gallerywp_lastfmlink_control', array( 'label' => esc_html__( 'Lastfm URL', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[lastfmlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gallerywp_options[githublink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gallerywp_githublink_control', array( 'label' => esc_html__( 'Github URL', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[githublink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gallerywp_options[bitbucketlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gallerywp_bitbucketlink_control', array( 'label' => esc_html__( 'Bitbucket URL', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[bitbucketlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gallerywp_options[tumblrlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gallerywp_tumblrlink_control', array( 'label' => esc_html__( 'Tumblr URL', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[tumblrlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gallerywp_options[digglink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gallerywp_digglink_control', array( 'label' => esc_html__( 'Digg URL', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[digglink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gallerywp_options[deliciouslink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gallerywp_deliciouslink_control', array( 'label' => esc_html__( 'Delicious URL', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[deliciouslink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gallerywp_options[stumblelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gallerywp_stumblelink_control', array( 'label' => esc_html__( 'Stumbleupon Link', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[stumblelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gallerywp_options[redditlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gallerywp_redditlink_control', array( 'label' => esc_html__( 'Reddit Link', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[redditlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gallerywp_options[dribbblelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gallerywp_dribbblelink_control', array( 'label' => esc_html__( 'Dribbble Link', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[dribbblelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gallerywp_options[behancelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gallerywp_behancelink_control', array( 'label' => esc_html__( 'Behance Link', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[behancelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gallerywp_options[codepenlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gallerywp_codepenlink_control', array( 'label' => esc_html__( 'Codepen Link', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[codepenlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gallerywp_options[jsfiddlelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gallerywp_jsfiddlelink_control', array( 'label' => esc_html__( 'JSFiddle Link', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[jsfiddlelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gallerywp_options[stackoverflowlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gallerywp_stackoverflowlink_control', array( 'label' => esc_html__( 'Stack Overflow Link', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[stackoverflowlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gallerywp_options[stackexchangelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gallerywp_stackexchangelink_control', array( 'label' => esc_html__( 'Stack Exchange Link', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[stackexchangelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gallerywp_options[bsalink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gallerywp_bsalink_control', array( 'label' => esc_html__( 'BuySellAds Link', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[bsalink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gallerywp_options[slidesharelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gallerywp_slidesharelink_control', array( 'label' => esc_html__( 'SlideShare Link', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[slidesharelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gallerywp_options[skypeusername]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ) );

    $wp_customize->add_control( 'gallerywp_skypeusername_control', array( 'label' => esc_html__( 'Skype Username', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[skypeusername]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gallerywp_options[emailaddress]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gallerywp_sanitize_email' ) );

    $wp_customize->add_control( 'gallerywp_emailaddress_control', array( 'label' => esc_html__( 'Email Address', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[emailaddress]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gallerywp_options[rsslink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gallerywp_rsslink_control', array( 'label' => esc_html__( 'RSS Feed URL', 'gallerywp' ), 'section' => 'sc_gallerywp_sociallinks', 'settings' => 'gallerywp_options[rsslink]', 'type' => 'text' ) );

}