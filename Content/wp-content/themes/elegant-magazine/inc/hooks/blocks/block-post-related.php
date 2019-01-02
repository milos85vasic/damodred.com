<?php
/**
 * List block part for displaying page content in page.php
 *
 * @package Elegant_Magazine
 */

?>
<div class="em-reated-posts clearfix">
    <?php
    global $post;
    $categories = get_the_category($post->ID);
    $related_section_title = elegant_magazine_get_option('single_related_posts_title');

    if ($categories) {
    $cat_ids = array();
    foreach ($categories as $category) $cat_ids[] = $category->term_id;
    $args = array(
        'category__in' => $cat_ids,
        'post__not_in' => array($post->ID),
        'posts_per_page' => 5, // Number of related posts to display.
        'ignore_sticky_posts' => 1
    );
    $related_posts = new wp_query($args);

    if (!empty($related_posts)) { ?>
        <h2 class="related-title">
            <?php echo esc_html($related_section_title); ?>
        </h2>
    <?php }
    ?>
    <ul>
        <?php
        while ($related_posts->have_posts()) {
            $related_posts->the_post();
            ?>
            <li>
                <?php the_title('<h3 class="article-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a>
            </h3>'); ?>
                <div class="grid-item-metadata">
                    <?php elegant_magazine_post_item_meta(); ?>
                </div>
            </li>
        <?php }
        }
        wp_reset_postdata();
        ?>
    </ul>
</div>


