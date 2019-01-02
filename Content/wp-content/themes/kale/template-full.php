<?php
/**
 * Template Name: Full Width
 *
 * The template for displaying a full width page
 *
 * @package kale
 */
?>
<?php get_header(); ?>

<?php 
$kale_pages_featured_image_show = 'Default';
$kale_page_meta = get_post_meta(get_the_ID(),'_page_options_meta',TRUE);
if($kale_page_meta) {
    $kale_pages_featured_image_show = $kale_page_meta['featured_image'];
    if($kale_pages_featured_image_show == '' || empty($kale_pages_featured_image_show)) $kale_pages_featured_image_show = 'Default';
} 
?>

<?php while ( have_posts() ) : the_post(); ?>

<?php 
if($kale_pages_featured_image_show == 'Banner' && has_post_thumbnail()) {
    ?>
    <!-- Featured Image (Banner) -->
    <div class="internal-banner">
        <?php 
        $src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'kale-slider' ) ;
		if ($src)$featured_image = $src[0]
        ?>
        <img src="<?php echo esc_url($featured_image) ?>" alt="<?php the_title_attribute(); ?>" />
        
        <div class="caption">
        
            <?php $title = get_the_title(); ?>
            <?php if($title == '') { ?>
            <h1 class="entry-title"><?php _e('Page ID: ', 'kale'); the_ID(); ?></h1>
            <?php } else { ?>
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <?php } ?>
            
        </div>
    </div>
    <!-- /Featured Image (Banner) -->
<?php } ?>

<!-- /Full Width -->
<div class="row full-width">
    <!-- Main Column -->
    <div class="main-column col-md-12">
        
        <!-- Page Content -->
        <div id="page-<?php the_ID(); ?>" <?php post_class('entry entry-page entry-page-full'); ?>>
            
            <?php if($kale_pages_featured_image_show == 'Default' && has_post_thumbnail()) { ?>
                <div class="entry-thumb"><?php the_post_thumbnail( 'full', array( 'alt' => get_the_title(), 'class'=>'img-responsive' ) ); ?></div>
            <?php } ?>
            
            <?php if($kale_pages_featured_image_show != 'Banner') { ?>
            <?php $title = get_the_title(); ?>
            <?php if($title == '') { ?>
            <h1 class="entry-title"><?php esc_html_e('Page ID: ', 'kale'); the_ID(); ?></h1>
            <?php } else { ?>
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <?php } ?>
            <?php } ?>
            
            <div class="page-content"><?php the_content(); ?></div>
            
        </div>
        <!-- /Page Content -->
        
        <!-- Page Comments -->
        <?php if ( comments_open() ) : ?>
        <hr />
        <?php comments_template(); ?>
        <?php endif; ?>  
        <!-- /Page Comments -->  
        
    </div>
    <!-- /Main Column -->

</div>
<!-- /Full Width -->

<?php endwhile; ?>
<hr />

<?php get_footer(); ?>