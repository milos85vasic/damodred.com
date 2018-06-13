<?php
/**
 * @package Theme Freesia
 * @subpackage Excellent
 * @since Excellent 1.0
 */
?>
<?php
/************************* EXCELLENT FOOTER DETAILS **************************************/

function excellent_site_footer() {
if ( is_active_sidebar( 'excellent_footer_options' ) ) :
		dynamic_sidebar( 'excellent_footer_options' );
	else:
		echo '<div class="copyright">' .'&copy; ' . date_i18n(__('Y','excellent')) .' '; ?>
		<a title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" target="_blank" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo get_bloginfo( 'name', 'display' ); ?></a> | 
						<?php esc_html_e('Designed by:','excellent'); ?> <a title="<?php echo esc_html__( 'Theme Freesia', 'excellent' ); ?>" target="_blank" href="<?php echo esc_url( 'https://themefreesia.com' ); ?>"><?php esc_html_e('Theme Freesia','excellent');?></a> | 
						<?php esc_html_e('Powered by:','excellent'); ?> <a title="<?php echo esc_html__( 'WordPress', 'excellent' );?>" target="_blank" href="<?php echo esc_url( 'https://wordpress.org' );?>"><?php esc_html_e('WordPress','excellent'); ?></a>
					</div>
	<?php endif;
}
add_action( 'excellent_sitegenerator_footer', 'excellent_site_footer');