<?php
/**
 * Main template for displaying a post within a feed
 *
 * @package kale
 */
?>
<?php

$kale_blog_feed_meta_show = kale_get_option('kale_blog_feed_meta_show');
$kale_blog_feed_date_show = kale_get_option('kale_blog_feed_date_show');
$kale_blog_feed_category_show = kale_get_option('kale_blog_feed_category_show');
$kale_blog_feed_author_show = kale_get_option('kale_blog_feed_author_show');
$kale_blog_feed_comments_show = kale_get_option('kale_blog_feed_comments_show');

$kale_example_content = kale_get_option('kale_example_content');

if($kale_entry == 'small')    { $kale_post_class = 'entry-small'; $kale_image_size = 'kale-thumbnail'; }
if($kale_entry == 'full')    { $kale_post_class = 'entry-full'; $kale_image_size = 'full'; }

#variables passed from calling pages
if(!isset($kale_frontpage_large_post)) $kale_frontpage_large_post = 'no';
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('entry ' . $kale_post_class); ?>>
    
    <div class="entry-content">
        
        <div class="entry-thumb">
            <?php if(has_post_thumbnail()) { ?>
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $kale_image_size, array( 'alt' => get_the_title(), 'class'=>'img-responsive' ) ); ?></a>
            <?php } else if($kale_example_content == 1) { ?>
            <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url(kale_get_sample($kale_image_size)) ?>" alt="<?php the_title_attribute() ?>" class="img-responsive" /></a>
            <?php } ?>
        </div>
        
        <?php if($kale_blog_feed_meta_show == 1 && $kale_blog_feed_date_show == 1) { ?>
        <div class="entry-date date updated"><a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a></div>
        <?php } ?>
        
        <?php if(get_the_title() != '') { ?>
        <h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
        <?php } else { ?>
        <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php esc_html_e('Post ID: ', 'kale'); the_ID(); ?></a></h3>
        <?php } ?>
        
        <?php if($kale_entry == 'full' ) { ?>
        <div class="entry-summary"><?php the_content(); ?><?php wp_link_pages(); ?></div>
        <?php } else { ?>
        <div class="entry-summary"><?php the_excerpt(); ?><?php wp_link_pages(); ?></div>
        <?php } ?>
        
        <?php if($kale_blog_feed_meta_show == 1) { ?>
        <div class="entry-meta">
            <?php 
            $kale_temp = array();
            if($kale_blog_feed_category_show == 1)  $kale_temp[] = '<div class="entry-category">' . get_the_category_list(', '). '</div>';
            if($kale_blog_feed_author_show == 1)    $kale_temp[] = '<div class="entry-author">' . __('by ', 'kale') 
														. '<span class="vcard author"><span class="fn">' 
														. get_the_author() 
														. '</span></span>' 
														. '</div>';
            if($kale_blog_feed_date_show == 1 && $kale_entry == 'vertical')     
                                                    $kale_temp[] = '<br /><div class="entry-date date updated">' . get_the_date() . '</div>';
            if ( ! post_password_required() && comments_open() && $kale_blog_feed_comments_show == 1)  
                                                    $kale_temp[] = '<div class="entry-comments"><a href="'.esc_url(get_comments_link()).'">'. sprintf( _nx( '%1$s Comment', '%1$s Comments', get_comments_number(), 'comments title', 'kale' ), number_format_i18n( get_comments_number() ) ) .'</a></div>';
            $kale_str = '';
            if($kale_temp) $kale_str = implode('<span class="sep"> - </span>', $kale_temp);
            echo $kale_str;
            ?>
        </div>
        <?php } ?>
        
    </div>
</div>