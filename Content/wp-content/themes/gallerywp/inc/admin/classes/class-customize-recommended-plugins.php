<?php
/**
* GalleryWP_Customize_Recommended_Plugins class
*
* @package GalleryWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

class GalleryWP_Customize_Recommended_Plugins extends WP_Customize_Control {
    public $type = 'tdna-recommended-wpplugins';
    
    public function render_content() {
        $plugins = array(
        'wp-pagenavi' => array( 
            'link'  => esc_url( admin_url('plugin-install.php?tab=plugin-information&plugin=wp-pagenavi' ) ),
            'text'  => esc_html__( 'WP-PageNavi', 'gallerywp' ),
            'desc'  => esc_html__( 'WP-PageNavi plugin helps to display numbered page navigation of this theme. Just install and activate the plugin.', 'gallerywp' ),
            ),
        'regenerate-thumbnails' => array( 
            'link'  => esc_url( admin_url('plugin-install.php?tab=plugin-information&plugin=regenerate-thumbnails' ) ),
            'text'  => esc_html__( 'Regenerate Thumbnails', 'gallerywp' ),
            'desc'  => esc_html__( 'Regenerate Thumbnails plugin helps you to regenerate your thumbnails to match with this theme. Install and activate the plugin. From the left hand navigation menu, click Tools &gt; Regen. Thumbnails. On the next screen, click Regenerate All Thumbnails.', 'gallerywp' ),
            ),
        );
        foreach ( $plugins as $plugin) {
            echo wp_kses_post( force_balance_tags( '<p>'.$plugin['desc'].'</p>' ) );
            echo wp_kses_post( force_balance_tags( '<p style="background:#fff;border:1px solid #ddd;color:#000;padding:10px;font-size:120%;font-style:normal;font-weight:bold;"><i class="fa fa-wordpress" aria-hidden="true"></i> <a style="margin-left:8px;font-weight:bold;color:#000" href="' . esc_url($plugin['link']) .'" target="_blank">' . esc_attr($plugin['text']) .' </a></p>' ) );
        }
    }
}