<?php

/**
 * Front page section additions.
 */



if ( ! function_exists( 'elegant_magazine_full_width_upper_footer_section' ) ) :
    /**
     *
     * @since Elegant Magazine 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function elegant_magazine_full_width_upper_footer_section() {

        if (1 == elegant_magazine_get_option('footer_show_latest_blog_carousel')) {
            elegant_magazine_get_block('latest');
        }

    }
endif;
add_action('elegant_magazine_action_full_width_upper_footer_section', 'elegant_magazine_full_width_upper_footer_section');
