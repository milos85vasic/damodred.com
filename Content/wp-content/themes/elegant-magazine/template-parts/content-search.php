<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elegant_Magazine
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
