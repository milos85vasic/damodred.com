<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blogg
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<?php get_template_part( 'template-parts/sidebars/sidebar', 'content-bottom' ); ?>
<?php get_template_part( 'template-parts/sidebars/sidebar', 'bottom' ); ?>

    </div> <!-- #content -->
    </div><!-- #content-wrapper -->
	
    <footer id="site-footer">
        <div id="footer-content">

            <?php 
				// Check if there is a social menu.
				if ( has_nav_menu( 'social' ) ) : 
					// Display Social Icons Menu.
					echo '<nav id="footer-social-icons" class="footer-social-menu blogg-social-menu clearfix">';										
						wp_nav_menu( array(
							'theme_location' => 'social',
							'container' => false,
							'menu_class' => 'social-icons-menu',
							'echo' => true,
							'fallback_cb' => '',
							'link_before' => '<span class="screen-reader-text social-icon-label">',
							'link_after' => '</span>',
							'depth' => 1,
							)
						);
					echo '</nav>';
				 endif; ?>
				 
		<?php get_template_part( 'template-parts/sidebars/sidebar', 'footer' ); ?>
		
				<?php 
				// Check if there is a footer menu.
				if ( has_nav_menu( 'footer' ) ) { 
					get_template_part( 'template-parts/navigation/nav', 'footer' ); 
				}
				?>

		<div id="footer-copyright">
			<?php esc_html_e('Copyright &copy;', 'blogg'); ?>
			<?php echo date_i18n( __( 'Y', 'blogg' ) ); // WPCS: XSS OK ?>
			<span class="copyright-name"><?php echo esc_html(get_theme_mod( 'blogg_copyright' )); ?></span>.
			<?php esc_html_e('All rights reserved.', 'blogg'); ?>
		</div>
				
		<?php 
			if( esc_attr(get_theme_mod( 'blogg_show_design_by', true ) ) ) { 
		?>		
		<div id="footer-credit">		
		<?php esc_html_e('Blogg theme designed by ', 'blogg'); ?>
			<a href="<?php echo esc_url( __( 'https://www.bloggingthemestyles.com', 'blogg' ) ); ?>"><?php esc_html_e( 'Blogging Theme Styles', 'blogg' ); ?></a>
		</div>
		<?php 
			}
		?>

		<?php // If you enable the privacy policy page
		if ( function_exists( 'blogg_the_privacy_policy_link' ) ) {
			echo '<div id="privacy-link">';
				the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
			echo '</div>';
		}
		?>

        </div>
    </footer>

    </div><!-- #page -->

    <?php wp_footer(); ?>

    </body>

    </html>
