<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}


/**
 * Customizer
 *
 * @class   elegant_magazine
 */

if (!function_exists('elegant_magazine_custom_style')) {

    function elegant_magazine_custom_style()
    {
        $top_header_background = elegant_magazine_get_option('top_header_background_color');
        $top_text_color = elegant_magazine_get_option('top_header_text_color');
        ob_start();
        ?>


        <?php if (!empty($top_header_background)): ?>
        .top-masthead {
        background: <?php echo esc_html($top_header_background); ?>;
        }
        .top-masthead-overlay{
        background: <?php echo esc_html(elegant_magazine_hex2rgb($top_header_background, '0.75')); ?>;
        }
        <?php endif; ?>

        <?php if (!empty($top_text_color)): ?>
        .top-masthead, .top-masthead a {
        color: <?php echo esc_html($top_text_color); ?>;

        }

    <?php endif; ?>


        <?php
        return ob_get_clean();

    }

}

if (!function_exists('elegant_magazine_hex2rgb')) {

    /**
     * @param $hex
     * @return array
     */
    function elegant_magazine_hex2rgb($hex, $alpha = '1') {
    $hex = str_replace("#", "", $hex);

    if(strlen($hex) == 3) {
        $r = hexdec(substr($hex,0,1).substr($hex,0,1));
        $g = hexdec(substr($hex,1,1).substr($hex,1,1));
        $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
    }
        $rgba = 'rgba('.$r.','. $g. ','. $b. ','. $alpha.')';
    //return implode(",", $rgb); // returns the rgb values separated by commas
    return $rgba; // returns an array with the rgb values
}
}

