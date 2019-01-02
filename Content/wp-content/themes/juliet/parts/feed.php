<?php
/**
 * The loop / blog feed
 *
 * @package juliet
 */
?>
<?php
$juliet_blog_feed_meta_show = juliet_get_option('juliet_blog_feed_meta_show');
$juliet_blog_feed_date_show = juliet_get_option('juliet_blog_feed_date_show');
$juliet_blog_feed_category_show = juliet_get_option('juliet_blog_feed_category_show');
$juliet_blog_feed_author_show = juliet_get_option('juliet_blog_feed_author_show');
$juliet_blog_feed_comments_show = juliet_get_option('juliet_blog_feed_comments_show');
$juliet_blog_feed_post_format = juliet_get_option('juliet_blog_feed_post_format');
?>

<!-- Blog Feed -->
<div class="blog-feed">

    <h2><?php echo get_the_archive_title(); ?></h2>
    
    <?php 
    if ( have_posts() ) { 
        while ( have_posts() ) : the_post(); 
            include(locate_template('parts/entry.php'));
        endwhile;
    } else { ?><div class="blog-feed-empty"><p><?php esc_html_e('No posts found.', 'juliet'); ?></p></div><?php } ?>
    
    <?php if(get_next_posts_link() || get_previous_posts_link()) { ?>
    <div class="pagination-blog-feed">
        <?php if( get_next_posts_link() ) { ?><div class="previous_posts"><?php next_posts_link( esc_html__('Previous Posts', 'juliet') ); ?></div><?php } ?>
        <?php if( get_previous_posts_link() ) { ?><div class="next_posts"><?php previous_posts_link( esc_html__('Next Posts', 'juliet') ); ?></div><?php } ?>
    </div>
    <?php } ?>

</div>
<!-- /Blog Feed -->