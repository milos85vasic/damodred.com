<?php
/**
* The template for displaying the footer widgets
*
* @package kale
*/
?>

<?php if ( is_active_sidebar( 'footer-row-2-col-1' ) 
        || is_active_sidebar( 'footer-row-2-col-2' ) 
        || is_active_sidebar( 'footer-row-2-col-3' ) 
        || is_active_sidebar( 'footer-row-2-col-4' ) 
        || is_active_sidebar( 'footer-row-2-col-5' ) ) { ?>

<!-- Footer Widgets -->
<div class="footer-widgets">

    <!-- Footer Row 2 -->
    <?php 
    $active_sidebar = 0;
    if ( is_active_sidebar( 'footer-row-2-col-1' ) ) $active_sidebar++;
    if ( is_active_sidebar( 'footer-row-2-col-2' ) ) $active_sidebar++; 
    if ( is_active_sidebar( 'footer-row-2-col-3' ) ) $active_sidebar++; 
    if ( is_active_sidebar( 'footer-row-2-col-4' ) ) $active_sidebar++;  
    if ( is_active_sidebar( 'footer-row-2-col-5' ) ) $active_sidebar++;  
    $class = kale_get_bootstrap_class($active_sidebar);
    if($active_sidebar > 0) {
    ?>
    <div class="row footer-row-2">
        
        <?php if(is_active_sidebar( 'footer-row-2-col-1' )) { ?><div class="<?php echo $class ?>"><?php dynamic_sidebar('footer-row-2-col-1'); ?></div><?php } ?>
        
        <?php if(is_active_sidebar( 'footer-row-2-col-2' )) { ?><div class="<?php echo $class ?>"><?php dynamic_sidebar('footer-row-2-col-2'); ?></div><?php } ?>
        
        <?php if(is_active_sidebar( 'footer-row-2-col-3' )) { ?><div class="<?php echo $class ?>"><?php dynamic_sidebar('footer-row-2-col-3'); ?></div><?php } ?>
        
        <?php if(is_active_sidebar( 'footer-row-2-col-4' )) { ?><div class="<?php echo $class ?>"><?php dynamic_sidebar('footer-row-2-col-4'); ?></div><?php } ?>
        
        <?php if(is_active_sidebar( 'footer-row-2-col-5' )) { ?><div class="<?php echo $class ?>"><?php dynamic_sidebar('footer-row-2-col-5'); ?></div><?php } ?>
        
     </div>
     <hr />
     <?php } ?>
     <!-- /Footer Row 2 -->
     
     

</div>
<?php } ?>

<!-- /Footer Widgets -->
