<?php
/**
 * The template for displaying posts
 *
 * @package kale
 */
?>
<?php get_header(); ?>

<?php
$kale_posts_meta_show = kale_get_option('kale_posts_meta_show');
$kale_posts_date_show = kale_get_option('kale_posts_date_show');
$kale_posts_category_show = kale_get_option('kale_posts_category_show');
$kale_posts_author_show = kale_get_option('kale_posts_author_show');
$kale_posts_tags_show = kale_get_option('kale_posts_tags_show');
$kale_posts_sidebar = kale_get_option('kale_posts_sidebar');
$kale_posts_featured_image_show = kale_get_option('kale_posts_featured_image_show');
$kale_sidebar_size = kale_get_option('kale_sidebar_size');
$kale_posts_posts_nav_show = kale_get_option('kale_posts_posts_nav_show');

?>
<?php while ( have_posts() ) : the_post(); ?>
<!-- Two Columns -->
<div class="row two-columns">

    <!-- Main Column -->
    <?php if($kale_posts_sidebar == 1) { ?>
    <div class="main-column <?php if($kale_sidebar_size == 0) { ?> col-md-8 <?php } else { ?> col-md-9 <?php } ?>">
    <?php } else { ?>
    <div class="main-column col-md-12">
    <?php } ?>
    
        <!-- Post Content -->
        <div id="post-<?php the_ID(); ?>" <?php post_class('entry entry-post'); ?>>
            
            <div class="entry-header">
				<?php if($kale_posts_meta_show == 1 && $kale_posts_date_show == 1) { ?>
                <div class="entry-meta">
                    <div class="entry-date date updated"><?php the_date(); ?></div>
                </div>
				<?php } ?>
				<div class="clearfix"></div>
            </div>
            
            <?php $title = get_the_title(); ?>
            <?php if($title == '') { ?>
            <h1 class="entry-title"><?php esc_html_e('Post ID: ', 'kale'); the_ID(); ?></h1>
            <?php } else { ?>
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <?php } ?>
            
            <?php 
            if($kale_posts_featured_image_show == 1) { 
                if(has_post_thumbnail()) { ?>
                <div class="entry-thumb"><?php the_post_thumbnail( 'full', array( 'alt' => get_the_title(), 'class'=>'img-responsive' ) ); ?></div><?php } 
            } ?>
            
            <div class="single-content"><?php the_content(); wp_link_pages(); ?></div>
            
            <?php if(  ( $kale_posts_meta_show == 1 && ($kale_posts_category_show == 1 || $kale_posts_tags_show == 1 || $kale_posts_author_show == 1) )  ) { ?>
            <div class="entry-footer">
                <div class="entry-meta">
                    <?php if($kale_posts_author_show == 1) { ?><div class="entry-author"><span><?php esc_html_e('Author: ', 'kale'); ?></span><span class="vcard author author_name"><span class="fn"><?php the_author_posts_link(); ?></span></span></div><?php } ?>
					<?php if($kale_posts_category_show == 1 && has_category()) { ?><div class="entry-category"><span><?php esc_html_e('Filed Under: ', 'kale'); ?></span><?php the_category(', '); ?></div><?php } ?>
                    <?php if($kale_posts_tags_show == 1 && has_tag()) { ?><div class="entry-tags"><span><?php esc_html_e('Tags: ', 'kale'); ?></span><?php the_tags('',', '); ?></div><?php } ?>
                </div>
            </div>
            <?php } ?>
        
        </div>
        <!-- /Post Content -->
        
        <?php if($kale_posts_posts_nav_show == 1) { ?>
        <hr />
        <div class="pagination-post">
            <div class="previous_post"><?php previous_post_link('%link','%title',true); ?></div>
            <div class="next_post"><?php next_post_link('%link','%title',true); ?></div>
        </div>
        <?php } ?>
        
        <!-- Post Comments -->
        <?php if ( comments_open() ) : ?>
        <hr />
        <?php comments_template(); ?>
        <?php endif; ?>  
        <!-- /Post Comments -->
        
    </div>
    <!-- /Main Column -->
    
    
    <?php if($kale_posts_sidebar == 1)  get_sidebar();  ?>
    
</div>
<!-- /Two Columns -->
        
<?php endwhile; ?>
<hr />

<?php get_footer(); ?>