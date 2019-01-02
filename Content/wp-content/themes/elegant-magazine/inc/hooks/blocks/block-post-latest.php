<?php
/**
 * List block part for displaying latest posts in footer.php
 *
 * @package Elegant_Magazine
 */

?>
<div class="em-latest-post-carousel">
    <?php
    $number_of_posts = 5;
    $all_posts = elegant_magazine_get_posts($number_of_posts);
    ?>
    <div class="latest-posts-carousel">
        <?php
        if ($all_posts->have_posts()) :
            while ($all_posts->have_posts()) : $all_posts->the_post();
                if (has_post_thumbnail()) {
                    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'elegant-magazine-medium');
                    $url = $thumb['0'];
                } else {
                    $url = '';
                }
                global $post;

                ?>
                <div class="slick-item">
                    <figure class="carousel-image">
                        <div class="data-bg data-bg-slide" data-background="<?php echo esc_url($url); ?>">
                            <a class="em-figure-link" href="<?php the_permalink(); ?>"></a>
                        </div>
                        <figcaption class="slider-figcaption slider-figcaption-1">
                            <div class="figure-categories figure-categories-bg">
                                <?php echo elegant_magazine_post_format($post->ID); ?>
                                <?php elegant_magazine_post_categories(); ?>
                            </div>
                            <h3 class="slide-title slide-title-1">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <div class="grid-item-metadata grid-item-metadata-1">
                                <?php elegant_magazine_post_item_meta(); ?>
                            </div>
                        </figcaption>
                    </figure>
                </div>
            <?php
            endwhile;
        endif;
        wp_reset_postdata();
        ?>
    </div>
</div>