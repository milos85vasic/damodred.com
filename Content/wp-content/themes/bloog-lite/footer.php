<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Bloog Lite
 */

?>

</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">

    <?php if(is_active_sidebar('footer_one_sidebar') || is_active_sidebar('footer_two_sidebar') || is_active_sidebar('footer_three_sidebar')){ ?>
    <div class="footer_layer_one clearfix">
        <div class="bloog-wrapper">
            <?php if(is_active_sidebar('footer_one_sidebar')){ ?>
            <div class="footer_one_column_one">
                <?php dynamic_sidebar( 'footer_one_sidebar' ); ?>
            </div>
            <?php } ?>
            <?php if(is_active_sidebar('footer_two_sidebar')){ ?>
            <div class="footer_one_column_two">
                <?php dynamic_sidebar( 'footer_two_sidebar' ); ?>
            </div>
            <?php } ?>
            <?php if(is_active_sidebar('footer_three_sidebar')){ ?>
            <div class="footer_one_column_three">
                <?php dynamic_sidebar( 'footer_three_sidebar' ); ?>
            </div>
            <?php } ?>
        </div><!-- bloog-wrapper -->            
    </div>
    <?php } ?>

    <?php if(is_active_sidebar('footer_four_sidebar')){ ?>
    <div class="footer_layer_two clearfix">
        <?php dynamic_sidebar('footer_four_sidebar'); ?>      
    </div>
    <?php } ?>  

    <?php if(is_active_sidebar('email_twitter_phone_section')){ ?>
    <div class="footer_layer_two clearfix">
        <div class="bloog-wrapper">
            <?php dynamic_sidebar('email_twitter_phone_section');?>      
        </div>
    </div>
    <?php } ?>  

    <?php
    if(get_theme_mod('footer_layer_3','')!=""){ ?>
    <div class="footer_layer_three">
        <div class="bloog-wrapper">
            <img src="<?php echo  get_theme_mod('footer_layer_3','');?>" alt="Footer Logo">
        </div>
    </div>
    <?php } 
    ?>    
    
    <div class="site-info">
        <div class="bloog-wrapper">
            <div class="footer_btm_left">
                <a href="<?php echo esc_url( get_theme_mod('footer_text_link_setting','http://8degreethemes.com/')); ?>" target="_blank">
                    <?php echo esc_html( get_theme_mod('footer_text_setting', __( 'Powered by: WordPress | Theme: Bloog Lite by 8Degree Themes', 'bloog-lite' ) ) ); ?>
                </a>
            </div>

            <div class="footer_btm_right">
                <a href="javascript:void(0);" class="move_to_top_bloog"><i class="fa fa-long-arrow-up"></i></a>
            </div>
        </div>
    </div><!-- .site-info -->
    
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
