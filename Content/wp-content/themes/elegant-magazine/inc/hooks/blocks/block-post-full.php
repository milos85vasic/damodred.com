<?php
/**
 * Full block part for displaying page content in page.php
 *
 * @package Elegant_Magazine
 */
?>

<div class="entry-header-image-wrap full-post-block">
    <header class="entry-header">
        <?php elegant_magazine_post_thumbnail(); ?>
        <div class="header-details-wrapper">
            <div class="entry-header-details">
                <?php if ('post' === get_post_type()) : ?>
                    <div class="figure-categories figure-categories-bg">
                        <?php echo elegant_magazine_post_format($post->ID); ?>
                        <?php elegant_magazine_post_categories(); ?>
                    </div>
                <?php endif; ?>

                <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a>
                    </h2>'); ?>
                <?php
                $archive_content_view = elegant_magazine_get_option('archive_content_view');

                    ?>
                    <div class="post-excerpt">
                        <?php
                        $archive_content_view = elegant_magazine_get_option('archive_content_view');
                        if ($archive_content_view == 'archive-content-excerpt') {

                            the_excerpt();
                        } else {
                            the_content();
                        }
                        ?>
                    </div>


                <?php if ('post' === get_post_type()) : ?>
                    <div class="post-item-metadata entry-meta">
                        <?php elegant_magazine_post_item_meta(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </header>
</div>