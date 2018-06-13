<?php
/**
 * The template for displaying pages
 *
 * @package kale
 */
?>
<?php get_header(); ?>

<?php 
$kale_pages_sidebar = kale_get_option('kale_pages_sidebar'); 
$kale_pages_featured_image_show = kale_get_option('kale_pages_featured_image_show');
$kale_sidebar_size = kale_get_option('kale_sidebar_size');
?>

<?php while ( have_posts() ) : the_post(); ?>
<!-- Two Columns -->
<div class="row two-columns">
    <!-- Main Column -->
    <?php if($kale_pages_sidebar == 1) { ?>
    <div class="main-column <?php if($kale_sidebar_size == 0) { ?> col-md-8 <?php } else { ?> col-md-9 <?php } ?>">
    <?php } else { ?>
    <div class="main-column col-md-12">
    <?php } ?>
        
        <!-- Page Content -->
        <div id="page-<?php the_ID(); ?>" <?php post_class('entry entry-page'); ?>>
        
            <?php 
            if($kale_pages_featured_image_show == 1) { 
                if(has_post_thumbnail()) { ?>
                <div class="entry-thumb"><?php the_post_thumbnail( 'full', array( 'alt' => get_the_title(), 'class'=>'img-responsive' ) ); ?></div><?php } 
            } ?>
            
            <?php $title = get_the_title(); ?>
            <?php if($title == '') { ?>
            <h1 class="entry-title"><?php esc_html_e('Page ID: ', 'kale'); the_ID(); ?></h1>
            <?php } else { ?>
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <?php } ?>
            
            <div class="entry-content"><?php the_content(); ?></div>
            
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

    <?php if($kale_pages_sidebar == 1)  get_sidebar();  ?>

</div>
<!-- /Two Columns -->

<?php endwhile; ?>
<hr />

<?php get_footer(); ?>