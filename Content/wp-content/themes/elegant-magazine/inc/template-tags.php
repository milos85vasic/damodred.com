<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Elegant_Magazine
 */

if (!function_exists('elegant_magazine_post_categories')) :
    function elegant_magazine_post_categories($separator = '&nbsp')
    {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list($separator);
            if ($categories_list) {
                /* translators: 1: list of categories. */
                printf('<span class="cat-links">' . esc_html__(' %1$s', 'elegant-magazine') . '</span>', $categories_list); // WPCS: XSS OK.
            }
        }
    }
endif;

if (!function_exists('elegant_magazine_post_item_meta')) :

    function elegant_magazine_post_item_meta()
    {
        global $post;
        $author_id = $post->post_author;
        ?>
        <span class="item-metadata posts-author">
            <span class=""><?php _e('By', 'elegant-magazine'); ?></span>
            <a href="<?php echo esc_url(get_author_posts_url($author_id)) ?>">
                <?php echo esc_html(get_the_author_meta('display_name', $author_id)); ?>
            </a>
        </span>
        <span class=""><?php _e('/', 'elegant-magazine'); ?></span>
        <span class="item-metadata posts-date">
            <?php echo esc_html(get_the_date(get_option('date_format'))); ?>
        </span>
        <?php
    }
endif;


if (!function_exists('elegant_magazine_entry_footer')) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function elegant_magazine_entry_footer()
    {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html__(', ', 'elegant-magazine'));
            if ($categories_list) {
                /* translators: 1: list of categories. */
                printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'elegant-magazine') . '</span>', $categories_list); // WPCS: XSS OK.
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'elegant-magazine'));
            if ($tags_list) {
                /* translators: 1: list of tags. */
                printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'elegant-magazine') . '</span>', $tags_list); // WPCS: XSS OK.
            }
        }

        if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                    /* translators: %s: post title */
                        __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'elegant-magazine'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                )
            );
            echo '</span>';
        }

        edit_post_link(
            sprintf(
                wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Edit <span class="screen-reader-text">%s</span>', 'elegant-magazine'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            ),
            '<span class="edit-link">',
            '</span>'
        );
    }
endif;


if (!function_exists('elegant_magazine_post_item_tag')) :

    function elegant_magazine_post_item_tag($view = 'default')
    {
        global $post;

        if ('post' === get_post_type()) {

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'elegant-magazine'));
            if ($tags_list) {
                /* translators: 1: list of tags. */
                printf('<span class="tags-links">'. __('Tags:', 'elegant-magazine') .' ' . esc_html('%1$s') . '</span>', $tags_list); // WPCS: XSS OK.
            }
        }

        if (is_single()) {
            edit_post_link(
                sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Edit <span class="screen-reader-text">%s</span>', 'elegant-magazine'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ),
                '<span class="edit-link">',
                '</span>'
            );
        }

    }
endif;