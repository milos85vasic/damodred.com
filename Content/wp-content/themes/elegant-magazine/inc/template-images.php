<?php
/**
 * Custom template images for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Elegant_Magazine
 */


if ( ! function_exists( 'elegant_magazine_post_thumbnail' ) ) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function elegant_magazine_post_thumbnail() {
        if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
            return;
        }

        global $post;

        if ( is_singular() ) :

            $theme_class = elegant_magazine_get_option('global_image_alignment');
            $post_image_alignment = get_post_meta($post->ID, 'elegant-magazine-meta-image-options', true);
            $post_class = !empty($post_image_alignment) ? $post_image_alignment : $theme_class;

            if ( $post_class != 'no-image' ):
                ?>
                <div class="post-thumbnail <?php echo esc_attr($post_class); ?>">
                    <?php the_post_thumbnail('elegant-magazine-featured'); ?>
                </div>
            <?php endif; ?>

        <?php else :
            $archive_layout = elegant_magazine_get_option('archive_layout');
            $archive_layout = $archive_layout;
            $archive_class = '';
            if ($archive_layout == 'archive-layout-list') {
                $archive_image_alignment = elegant_magazine_get_option('archive_image_alignment');
                $archive_class = $archive_image_alignment;
                $archive_image = 'elegant-magazine-medium';
            } elseif ($archive_layout == 'archive-layout-full') {
                $archive_image = 'large';
            } else {
                $archive_image = 'post-thumbnail';
            }

            ?>
            <div class="post-thumbnail <?php echo esc_attr($archive_class); ?>">
                <a href="<?php the_permalink(); ?>" aria-hidden="true">
                    <?php
                    the_post_thumbnail( $archive_image, array(
                        'alt' => the_title_attribute( array(
                            'echo' => false,
                        ) ),
                    ) );
                    ?>
                </a>
            </div>

        <?php endif; // End is_singular().
    }
endif;


