<?php
/**
 * List block part for displaying page content in page.php
 *
 * @package Elegant_Magazine
 */

$image_class = elegant_magazine_get_option('archive_layout');
if ($image_class == 'archive-layout-list') {
    $image_align_class = elegant_magazine_get_option('archive_image_alignment');
    $image_class .= ' ';
    $image_class .= $image_align_class;
}

$excerpt_length = 20;
if (has_post_thumbnail()) {
    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'elegant-magazine-medium');
    $url = $thumb['0'];
} else {
    $url = '';
}
global $post;
$col_class = 'col-ten';
?>
<div class="col col-ten base-border <?php echo esc_attr($image_class); ?>">
    <div class="row-sm align-items-center">
        <?php

        if (!empty($url)):
            $col_class = 'col-five';
            ?>
            <div class="col <?php echo $col_class; ?>">
                <figure class="categorised-article">
                    <div class="categorised-article-item">
                        <div class="article-item-image">
                            <img src="<?php echo esc_url($url); ?>" alt="<?php the_title_attribute(); ?>">
                        </div>
                    </div>
                </figure>
            </div>
        <?php endif; ?>
        <div class="col <?php echo $col_class; ?>">
            <?php if ('post' === get_post_type()) : ?>
                <div class="figure-categories">

                    <?php elegant_magazine_post_categories('/'); ?>
                </div>
            <?php endif; ?>
            <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a>
            </h2>'); ?>
            <div class="grid-item-metadata">
                <?php echo elegant_magazine_post_format($post->ID); ?>
                <?php elegant_magazine_post_item_meta(); ?>
            </div>
            <?php
            $archive_content_view = elegant_magazine_get_option('archive_content_view');

                ?>
                <div class="full-item-discription">
                    <div class="post-description">
                        <?php

                        if ($archive_content_view == 'archive-content-excerpt') {

                            the_excerpt();
                        } else {
                            the_content();
                        }
                        ?>
                    </div>
                </div>

        </div>
        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'elegant-magazine'),
            'after' => '</div>',
        ));
        ?>
    </div>
</div>






