<?php
/**
* The template for displaying the footer widgets
*
* @package juliet
*/
?>
<?php $juliet_example_content = juliet_get_option('juliet_example_content');  ?>
<?php 
if ( is_active_sidebar( 'footer-row-1-col-1' ) || is_active_sidebar( 'footer-row-1-col-2' ) 
        || is_active_sidebar( 'footer-row-1-col-3' ) || is_active_sidebar( 'footer-row-1-col-4' ) ) { 

    $active_sidebar = 0;
    if ( is_active_sidebar( 'footer-row-1-col-1' ) ) $active_sidebar++;
    if ( is_active_sidebar( 'footer-row-1-col-2' ) ) $active_sidebar++; 
    if ( is_active_sidebar( 'footer-row-1-col-3' ) ) $active_sidebar++; 
    if ( is_active_sidebar( 'footer-row-1-col-4' ) ) $active_sidebar++;  
    $class = juliet_get_bootstrap_class($active_sidebar); $class = esc_attr($class);
    if($active_sidebar > 0) { ?>

    <!-- Footer Row 1 -->
    <div class="sidebar-footer footer-row-1">
        <div class="row">
            <?php if(is_active_sidebar( 'footer-row-1-col-1' )) { ?><div class="<?php echo $class ?>"><?php dynamic_sidebar('footer-row-1-col-1'); ?></div><?php } ?>
            <?php if(is_active_sidebar( 'footer-row-1-col-2' )) { ?><div class="<?php echo $class ?>"><?php dynamic_sidebar('footer-row-1-col-2'); ?></div><?php } ?>
            <?php if(is_active_sidebar( 'footer-row-1-col-3' )) { ?><div class="<?php echo $class ?>"><?php dynamic_sidebar('footer-row-1-col-3'); ?></div><?php } ?>
            <?php if(is_active_sidebar( 'footer-row-1-col-4' )) { ?><div class="<?php echo $class ?>"><?php dynamic_sidebar('footer-row-1-col-4'); ?></div><?php } ?>
        </div>
    </div>
    <!-- /Footer Row 1 -->

<?php } 
} else if($juliet_example_content == 1) { juliet_example_footer_widgets(); } ?>

<!-- Footer Row 2 --->
<div class="sidebar-footer footer-row-2">
    
    <?php if ( is_active_sidebar( 'footer-row-2-center' ) ) { ?>
    <div class="footer-row-2-center"><?php dynamic_sidebar( 'footer-row-2-center' ); ?></div>
    <?php } ?>
    
    <?php $juliet_footer_copyright = juliet_get_option('juliet_footer_copyright'); ?>
    <?php if($juliet_footer_copyright != '') { ?>
    <div class="footer-copyright"><?php echo wp_kses_post($juliet_footer_copyright); ?></div>
    <?php } ?>
    
    <div class="footer-copyright">
        <ul class="credit">
            <li><a href="https://www.lyrathemes.com/juliet/" target="_blank"><?php esc_html_e('Juliet', 'juliet'); ?></a> <?php esc_html_e('by LyraThemes.com', 'juliet'); ?></li>
        </ul>
    </div>

</div>
<!-- /Footer Row 2 -->