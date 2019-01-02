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
        <div id="attachment-<?php the_ID(); ?>" <?php post_class('entry entry-attachment'); ?>>
            
            
            <?php $title = get_the_title(); ?>
            <?php if($title == '') { ?>
            <h1 class="entry-title"><?php esc_html_e('Attachment ID: ', 'kale'); the_ID(); ?></h1>
            <?php } else { ?>
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <?php } ?>
            
            <div class="attachment-image"><?php echo wp_get_attachment_image( get_the_ID(), 'full' ); ?></div>
            
            <?php $attachment_meta = kale_get_attachment( get_the_ID() ); if ($attachment_meta['caption'] != '') { ?>
            <div class="attachment-caption"><?php echo esc_html($attachment_meta['caption']); ?></div>
            <?php } ?>
            
            <?php if(get_the_content() != '') { ?>
            <div class="attachment-content"><?php the_content(); wp_link_pages(); ?></div>
            <?php } ?>
        
        </div>
        <!-- /Post Content -->
        
        <hr />
        
        <div class="pagination-post">
            <div class="previous_post"><?php previous_image_link( false, __( 'Previous Image', 'kale' ) ); ?></div>
            <div class="next_post"><?php next_image_link( false, __( 'Next Image', 'kale' ) ); ?></div>
        </div>
        
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