<?php
/**
 * The template for displaying WooCommerce pages
 *
 * @package juliet
 */
?>
<?php get_header(); ?>

<?php 
$juliet_pages_sidebar = juliet_get_option('juliet_pages_sidebar'); 
$juliet_pages_featured_image_show = juliet_get_option('juliet_pages_featured_image_show');
?>

<?php if($juliet_pages_sidebar == 1) { ?><div class="row two-columns"><div class="main-column col-md-9"><?php } 
else { ?><div class="row one-column"><div class="main-column col-md-12"><?php } ?>
            
        <!-- Page Content -->
        <div id="page-<?php the_ID(); ?>" <?php post_class('entry entry-page page-woocommerce'); ?>>
            <?php do_action( 'woocommerce_before_main_content' ); ?>

            <?php woocommerce_content(); ?>

            <?php do_action( 'woocommerce_after_main_content' ); ?>
        </div>
        <!-- /Page Content -->
        
    </div>
    <!-- /Main Column -->

    <?php if($juliet_pages_sidebar == 1)  get_sidebar();  ?>

</div>
<!-- /One or Two Columns -->


<?php get_footer(); ?>