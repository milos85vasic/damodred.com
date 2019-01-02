<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elegant_Magazine
 */

?>
    <?php if (is_singular()) : ?>
            <div class="entry-content">
                <?php
                the_content(sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'elegant-magazine'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ));
                ?>
                <?PHP if (is_single()): ?>
                    <div class="post-item-metadata entry-meta">
                        <?php elegant_magazine_post_item_tag(); ?>
                    </div>
                <?php endif; ?>
                <?php

                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'elegant-magazine'),
                    'after' => '</div>',
                ));
                ?>
            </div><!-- .entry-content -->
            <footer class="entry-footer">
                <?php //elegant_magazine_entry_footer(); ?>
            </footer>


    <?php else: ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('col col-three-point-three'); ?>>
            <?php elegant_magazine_page_layout_blocks(); ?>
        <footer class="entry-footer">
            <?php
                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'elegant-magazine'),
                    'after' => '</div>',
                ));
            ?>
        </footer>
    </article>
    <?php endif; ?>


