<?php
/**
 * The template for displaying the footer.
 *
 * @package Theme Freesia
 * @subpackage Excellent
 * @since Excellent 1.0
 */
?>
</div><!-- end #content -->
<!-- Footer Start ============================================= -->
<footer id="colophon" class="site-footer">
<?php
$excellent_settings = excellent_get_theme_options(); 
$footer_column = $excellent_settings['excellent_footer_column_section'];
	if( is_active_sidebar( 'excellent_footer_1' ) || is_active_sidebar( 'excellent_footer_2' ) || is_active_sidebar( 'excellent_footer_3' ) || is_active_sidebar( 'excellent_footer_4' )) { ?>
	<div class="widget-wrap">
		<div class="wrap">
			<div class="widget-area">
			<?php
				if($footer_column == '1' || $footer_column == '2' ||  $footer_column == '3' || $footer_column == '4'){
				echo '<div class="column-'.$footer_column.'">';
					if ( is_active_sidebar( 'excellent_footer_1' ) ) :
						dynamic_sidebar( 'excellent_footer_1' );
					endif;
				echo '</div><!-- end .column'.$footer_column. '  -->';
				}
				if($footer_column == '2' ||  $footer_column == '3' || $footer_column == '4'){
				echo '<div class="column-'.$footer_column.'">';
					if ( is_active_sidebar( 'excellent_footer_2' ) ) :
						dynamic_sidebar( 'excellent_footer_2' );
					endif;
				echo '</div><!--end .column'.$footer_column.'  -->';
				}
				if($footer_column == '3' || $footer_column == '4'){
				echo '<div class="column-'.$footer_column.'">';
					if ( is_active_sidebar( 'excellent_footer_3' ) ) :
						dynamic_sidebar( 'excellent_footer_3' );
					endif;
				echo '</div><!--end .column'.$footer_column.'  -->';
				}
				if($footer_column == '4'){
				echo '<div class="column-'.$footer_column.'">';
					if ( is_active_sidebar( 'excellent_footer_4' ) ) :
						dynamic_sidebar( 'excellent_footer_4' );
					endif;
				echo '</div><!--end .column'.$footer_column.  '-->';
				}
				?>
			</div> <!-- end .widget-area -->
		</div><!-- end .wrap -->
	</div> <!-- end .widget-wrap -->
	<?php }
		if(class_exists('Excellent_Plus_Features')){
			if(is_page_template('page-templates/excellent-corporate.php') ){
				do_action('excellent_client_box');
			}
		} ?>
	<div class="site-info" <?php if($excellent_settings['excellent-img-upload-footer-image'] !=''){?>style="background-image:url('<?php echo esc_url($excellent_settings['excellent-img-upload-footer-image']); ?>');" <?php } ?>>
	<div class="wrap">
	<?php
		if($excellent_settings['excellent_buttom_social_icons'] == 0):
			do_action('excellent_social_links');
		endif;
		do_action('excellent_footer_menu');
		do_action('excellent_sitegenerator_footer'); ?>
			<div style="clear:both;"></div>
		</div> <!-- end .wrap -->
	</div> <!-- end .site-info -->
	<?php
		$disable_scroll = $excellent_settings['excellent_scroll'];
		if($disable_scroll == 0):?>
			<a class="go-to-top">
				<span class="icon-bg"></span>
				<span class="back-to-top-text"><?php esc_html_e('Top','excellent');?></span>
				<i class="fa fa-angle-up back-to-top-icon"></i>
			</a>
	<?php endif; ?>
</footer> <!-- end #colophon -->
</div><!-- end .site-content-contain -->
</div><!-- end #page -->
<?php wp_footer(); ?>
</body>
</html>