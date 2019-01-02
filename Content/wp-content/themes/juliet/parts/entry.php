<?php
/**
 * Main template for displaying a post within a feed
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
$juliet_image_size = 'juliet-thumbnail';
$juliet_example_content = juliet_get_option('juliet_example_content');
?>
<div class="entry <?php if(is_sticky()) { ?>entry-sticky<?php } ?> <?php if($juliet_blog_feed_post_format == 'Excerpt') { ?>entry-excerpt<?php } else { ?>entry-full<?php } ?>">
    
	<?php if(has_post_thumbnail() || $juliet_example_content == 1) { ?>
    <div class="left">
        <div class="entry-thumb">
			<?php if(has_post_thumbnail()) { ?>
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $juliet_image_size, array( 'alt' => get_the_title(), 'class'=>'img-responsive' ) ); ?></a>
            <?php } else if($juliet_example_content == 1){ ?>
            <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url(juliet_get_sample($juliet_image_size)) ?>" alt="<?php the_title_attribute() ?>" class="img-responsive" /></a>
            <?php } ?>
        </div>
    </div>
	<?php } ?>

    <div class="right">

        <?php if($juliet_blog_feed_meta_show == 1 && $juliet_blog_feed_category_show == 1) { ?>
        <div class="entry-category"><?php the_category( ' ~ ' ); ?></div>
        <?php } ?>

        <?php if(get_the_title() != '') { ?>
        <h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
        <?php } else { ?>
        <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php esc_html_e('Post ID: ', 'juliet'); the_ID(); ?></a></h3>
        <?php } ?>
        
        <?php if($juliet_blog_feed_post_format == 'Excerpt') { ?><div class="entry-summary"><?php the_excerpt(); ?></div>
        <?php } else { ?><div class="entry-content"><?php the_content(); ?><?php wp_link_pages(); ?></div><?php } ?>
        
        <?php 
        $juliet_sticky_post_signature = juliet_get_option('juliet_sticky_post_signature');
        if(is_sticky() && $juliet_sticky_post_signature != ''){ ?>
        <div class="entry-signature"><img src="<?php echo esc_url($juliet_sticky_post_signature); ?>" class="img-responsive" /></div>
        <?php } ?>
        
        <?php if($juliet_blog_feed_meta_show == 1) { ?>
        <div class="entry-meta">
            <?php 
            $juliet_temp = array();
            if($juliet_blog_feed_author_show == 1)  $juliet_temp[] = '<div class="entry-author">' . esc_html__('by ', 'juliet') . get_the_author() . '</div>';
            if($juliet_blog_feed_date_show == 1)    $juliet_temp[] = '<div class="entry-date">' . get_the_date() . '</div>';
            if ( ! post_password_required() && comments_open() && $juliet_blog_feed_comments_show == 1)  
                                                    $juliet_temp[] = '<div class="entry-comments"><a href="'.get_comments_link().'">'. sprintf( _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'juliet' ), number_format_i18n( get_comments_number() ) ) .'</a></div>';
            $juliet_str = '';
            if($juliet_temp) $juliet_str = implode('<span class="sep"> - </span>', $juliet_temp);
            echo $juliet_str;
            ?>
        </div>
        <?php } ?>        
        
    </div>
</div>