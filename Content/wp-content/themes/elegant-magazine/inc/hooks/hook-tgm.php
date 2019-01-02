<?php
/**
 * Recommended plugins
 *
 * @package Surya_Chandra
 */

if ( ! function_exists( 'elegant_magazine_recommended_plugins' ) ) :

    /**
     * Recommend plugins.
     *
     * @since 1.0.0
     */
    function elegant_magazine_recommended_plugins() {

        $plugins = array(
            array(
                'name'     => esc_html__( 'WP Post Author', 'elegant-magazine' ),
                'slug'     => 'wp-post-author',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'One Click Demo Import', 'elegant-magazine' ),
                'slug'     => 'one-click-demo-import',
                'required' => false,
            ),
        );

        tgmpa( $plugins );

    }

endif;

add_action( 'tgmpa_register', 'elegant_magazine_recommended_plugins' );
