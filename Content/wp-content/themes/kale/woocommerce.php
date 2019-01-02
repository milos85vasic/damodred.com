<?php
/**
 * The template for displaying WooCommerce pages
 *
 * @package kale
 */
?>
<?php get_header(); ?>

<?php 
$kale_pages_sidebar = kale_get_option('kale_pages_sidebar'); 
$kale_sidebar_size = kale_get_option('kale_sidebar_size');
?>


<!-- Two Columns -->
<div class="row two-columns">
    <!-- Main Column -->
    <?php if($kale_pages_sidebar == 1) { ?>
    <div class="main-column <?php if($kale_sidebar_size == 0) { ?> col-md-8 <?php } else { ?> col-md-9 <?php } ?>">
    <?php } else { ?>
    <div class="main-column col-md-12">
    <?php } ?>
        
        <!-- Page Content -->
        <div id="page-woocommerce" <?php post_class('entry entry-page'); ?>>
        
            <?php woocommerce_content(); ?>
            
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

<hr />

<?php get_footer(); ?>