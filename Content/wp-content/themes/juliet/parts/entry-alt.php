<?php
/**
 * Alternate template for displaying a post within a feed (Featured Posts)
 *
 * @package juliet
 */
?>
<?php
$juliet_blog_feed_meta_show = juliet_get_option('juliet_blog_feed_meta_show');
$juliet_blog_feed_category_show = juliet_get_option('juliet_blog_feed_category_show');
if($juliet_entry == 'juliet-featured')  { $juliet_post_class = 'entry-featured'; $juliet_image_size = 'juliet-featured'; }
$juliet_example_content = juliet_get_option('juliet_example_content');
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('entry ' . $juliet_post_class); ?>>
    
	<?php if(has_post_thumbnail() || $juliet_example_content == 1) { ?>
    <div class="entry-thumb">
        <?php if(has_post_thumbnail()) { ?>
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $juliet_image_size, array( 'alt' => get_the_title(), 'class'=>'img-responsive' ) ); ?></a>
        <?php } else if($juliet_example_content == 1){ ?>
        <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url(juliet_get_sample($juliet_image_size)) ?>" alt="<?php the_title_attribute() ?>" class="img-responsive" /></a>
        <?php } ?>
    </div>
	<?php } ?>
    
    <?php if($juliet_blog_feed_meta_show == 1 && $juliet_blog_feed_category_show == 1) { ?>
    <div class="entry-category">
        <?php the_category( ' ~ ' ); ?>
    </div>
    <?php } ?>
    
    <?php if(get_the_title() != '') { ?>
    <h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
    <?php } else { ?>
    <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php esc_html_e('Post ID: ', 'juliet'); the_ID(); ?></a></h3>
    <?php } ?>

    <div class="entry-summary"><?php the_excerpt(); ?></div>
    
</div>