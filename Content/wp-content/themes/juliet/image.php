<?php
/**
 * The template for displaying posts
 *
 * @package juliet
 */
?>
<?php get_header(); ?>

<?php
$juliet_posts_sidebar = juliet_get_option('juliet_posts_sidebar');
?>

<?php if($juliet_posts_sidebar == 1 ) { ?>
	<div class="row two-columns sidebar-right"><div class="main-column col-md-9">
<?php } else if($juliet_posts_sidebar == 2 ) { ?>
	<div class="row two-columns sidebar-left"><?php get_sidebar(); ?><div class="main-column col-md-9">
<?php } else if($juliet_woocommerce_sidebar == 0 ) { ?> 
	<div class="row one-column sidebar-none"><div class="main-column col-md-12">
<?php } ?>
    
        <?php while ( have_posts() ) : the_post(); ?>
        
        <!-- Post Content -->
        <div id="post-<?php the_ID(); ?>" <?php post_class('entry-attachment'); ?>>
            
            <div class="entry-header">
            
                <?php $title = get_the_title(); ?>
                <?php if($title == '') { ?>
                <h1 class="entry-title"><?php esc_html_e('Attachment ID: ', 'juliet'); the_ID(); ?></h1>
                <?php } else { ?>
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <?php } ?>
  
            </div>
            
            <div class="attachment-image"><?php echo wp_get_attachment_image( get_the_ID(), 'full' ); ?></div>
            
            <?php $attachment_meta = juliet_get_attachment( get_the_ID() ); if ($attachment_meta['caption'] != '') { ?>
            <div class="attachment-caption"><?php echo esc_html($attachment_meta['caption']); ?></div>
            <?php } ?>
            
            <?php if(get_the_content() != '') { ?>
            <div class="attachment-content"><?php the_content(); wp_link_pages(); ?></div>
            <?php } ?>
        
        </div>
        <!-- /Post Content -->
        
        
        <hr />
	
        
        <div class="pagination-post">
            <div class="previous_post"><?php previous_image_link( false, __( 'Previous Image', 'juliet' ) ); ?></div>
            <div class="next_post"><?php next_image_link( false, __( 'Next Image', 'juliet' ) ); ?></div>
        </div>
        
        <!-- Post Comments -->
        <?php if ( comments_open() ) : ?>
        <hr />
        <?php comments_template(); ?>
        <?php endif; ?>  
        <!-- /Post Comments -->
        
    </div>
    <!-- /Main Column -->
    
    
    <?php if($juliet_posts_sidebar == 1)  get_sidebar();  ?>
    
</div>
<!-- /Two Columns -->
        
<?php endwhile; ?>

<?php get_footer(); ?>