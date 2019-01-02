<?php
/**
 * Implement theme metabox.
 *
 * @package Elegant_Magazine
 */

if ( ! function_exists( 'elegant_magazine_add_theme_meta_box' ) ) :

    /**
     * Add the Meta Box
     *
     * @since 1.0.0
     */
    function elegant_magazine_add_theme_meta_box() {

        $screens = array( 'post', 'page' );

        foreach ( $screens as $screen ) {
            add_meta_box(
                'elegant-magazine-theme-settings',
                esc_html__( 'Layout Options', 'elegant-magazine' ),
                'elegant_magazine_render_layout_options_metabox',
                $screen,
                'side',
                'low'


            );
        }

    }

endif;

add_action( 'add_meta_boxes', 'elegant_magazine_add_theme_meta_box' );

if ( ! function_exists( 'elegant_magazine_render_layout_options_metabox' ) ) :

    /**
     * Render theme settings meta box.
     *
     * @since 1.0.0
     */
    function elegant_magazine_render_layout_options_metabox( $post, $metabox ) {

        $post_id = $post->ID;

        // Meta box nonce for verification.
        wp_nonce_field( basename( __FILE__ ), 'elegant_magazine_meta_box_nonce' );
        // Fetch Options list.
        $content_layout = get_post_meta($post_id,'elegant-magazine-meta-content-alignment',true);

        if(empty($content_layout)){
            $content_layout = elegant_magazine_get_option('global_content_alignment');
        }


        ?>
        <div id="elegant-magazine-settings-metabox-container" class="elegant-magazine-settings-metabox-container">
            <div id="elegant-magazine-settings-metabox-tab-layout">
                <div class="elegant-magazine-row-content">
                    <!-- Select Field-->
                    <p>

                        <select name="elegant-magazine-meta-content-alignment" id="elegant-magazine-meta-content-alignment">

                            <option value="align-content-left" <?php selected('align-content-left', $content_layout);?>>
                                <?php _e( 'Content - Primary Sidebar', 'elegant-magazine' )?>
                            </option>
                            <option value="align-content-right" <?php selected('align-content-right', $content_layout);?>>
                                <?php _e( 'Primary Sidebar - Content', 'elegant-magazine' )?>
                            </option>
                            <option value="full-width-content" <?php selected('full-width-content', $content_layout);?>>
                                <?php _e( 'Full width content', 'elegant-magazine' )?>
                            </option>
                        </select>
                    </p>

                </div><!-- .elegant-magazine-row-content -->
            </div><!-- #elegant-magazine-settings-metabox-tab-layout -->
        </div><!-- #elegant-magazine-settings-metabox-container -->

        <?php
    }

endif;



if ( ! function_exists( 'elegant_magazine_save_layout_options_meta' ) ) :

    /**
     * Save theme settings meta box value.
     *
     * @since 1.0.0
     *
     * @param int     $post_id Post ID.
     * @param WP_Post $post Post object.
     */
    function elegant_magazine_save_layout_options_meta( $post_id, $post ) {

        // Verify nonce.
        if ( ! isset( $_POST['elegant_magazine_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['elegant_magazine_meta_box_nonce'], basename( __FILE__ ) ) ) {
            return; }

        // Bail if auto save or revision.
        if ( defined( 'DOING_AUTOSAVE' ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
            return;
        }

        // Check the post being saved == the $post_id to prevent triggering this call for other save_post events.
        if ( empty( $_POST['post_ID'] ) || $_POST['post_ID'] != $post_id ) {
            return;
        }

        // Check permission.
        if ( 'page' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return; }
        } else if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        $content_layout =  isset( $_POST[ 'elegant-magazine-meta-content-alignment' ] ) ? $_POST[ 'elegant-magazine-meta-content-alignment' ] : '';
        if( !empty($content_layout) ){
            update_post_meta($post_id, 'elegant-magazine-meta-content-alignment', sanitize_text_field($content_layout));
        }

    }

endif;

add_action( 'save_post', 'elegant_magazine_save_layout_options_meta', 10, 2 );