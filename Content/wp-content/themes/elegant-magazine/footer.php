<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Elegant_Magazine
 */

?>


</div>

<?php if ( is_active_sidebar('express-off-canvas-panel') ) : ?>
    <div id="sidr" class="primary-background">
        <a class="sidr-class-sidr-button-close" href="#sidr-nav"><i class="far primary-footer fa-window-close"></i></a>
        <?php dynamic_sidebar('express-off-canvas-panel'); ?>
    </div>
<?php endif; ?>

<?php


    if (is_front_page() || is_home()) {
        do_action('elegant_magazine_action_full_width_upper_footer_section');
    }


?>

<footer class="site-footer">
    <?php if (is_active_sidebar( 'footer-first-widgets-section') || is_active_sidebar( 'footer-second-widgets-section') || is_active_sidebar( 'footer-third-widgets-section')) : ?>
    <div class="primary-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                            <?php if (is_active_sidebar( 'footer-first-widgets-section') ) : ?>
                                <div class="primary-footer-area footer-first-widgets-section col-md-4 col-sm-12">
                                    <section class="widget-area">
                                            <?php dynamic_sidebar('footer-first-widgets-section'); ?>
                                    </section>
                                </div>
                            <?php endif; ?>

                        <?php if (is_active_sidebar( 'footer-second-widgets-section') ) : ?>
                            <div class="primary-footer-area footer-second-widgets-section col-md-4 col-sm-12">
                                <section class="widget-area">
                                    <?php dynamic_sidebar('footer-second-widgets-section'); ?>
                                </section>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar( 'footer-third-widgets-section') ) : ?>
                            <div class="primary-footer-area footer-third-widgets-section col-md-4 col-sm-12">
                                <section class="widget-area">
                                    <?php dynamic_sidebar('footer-third-widgets-section'); ?>
                                </section>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="footer-logo-branding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="footer-logo">
                        <div class="site-branding">
                            <?php the_custom_logo(); ?>
                            <h3 class="site-title font-family-1">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                            </h3>
                            <?php
                            $description = get_bloginfo('description', 'display');
                            if ($description || is_customize_preview()) : ?>
                                <p class="site-description"><?php echo esc_html($description); ?></p>
                                <?php
                            endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (has_nav_menu( 'em-footer-nav' ) || has_nav_menu( 'em-social-nav' )):
        $class = 'col-sm-12';
        if (has_nav_menu( 'em-footer-nav' ) && has_nav_menu( 'em-social-nav' )){
            $class = 'col-sm-6';
        }

        ?>
    <div class="secondary-footer">
        <div class="container">
            <div class="row">
                <?php if (has_nav_menu( 'em-footer-nav' )): ?>
                    <div class="<?php echo esc_attr($class); ?>">
                        <div class="footer-nav-wrapper">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'em-footer-nav',
                            'menu_id' => 'footer-menu',
                            'depth' => 1,
                            'container' => 'div',
                            'container_class' => 'footer-navigation'
                        )); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php if (has_nav_menu( 'em-social-nav' )): ?>
                    <div class="<?php echo esc_attr($class); ?>">
                        <div class="footer-social-wrapper">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'em-social-nav',
                                'link_before' => '<span class="screen-reader-text">',
                                'link_after' => '</span>',
                                'menu_id' => 'social-menu',
                                'container' => 'div',
                                'container_class' => 'social-navigation'
                            ));
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="site-info">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <?php $em_copy_right = elegant_magazine_get_option('footer_copyright_text'); ?>
                    <?php if (!empty($em_copy_right)): ?>
                        <?php echo esc_html($em_copy_right); ?>
                    <?php endif; ?>
                    <span class="sep"> | </span>
                    <?php
                    /* translators: 1: Theme name, 2: Theme author. */
                    printf(esc_html__('Theme: %1$s by %2$s.', 'elegant-magazine'), '<a href="https://afthemes.com/elegant-magazine">Elegant Magazine</a>', '<a href="https://afthemes.com/">AF themes</a>');
                    ?>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
<a id="scroll-up" class="secondary-color">
    <i class="fa fa-angle-up"></i>
</a>
<?php wp_footer(); ?>

</body>
</html>
