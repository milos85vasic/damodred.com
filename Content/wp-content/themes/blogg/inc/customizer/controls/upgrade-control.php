<?php
/**
 * Upgrade Control for the Customizer
 * @package Blogg
 */

 /**
 * Control type.
 * For Upsell content in the customizer
 */
if ( ! class_exists( 'Blogg_Customize_Static_Text_Control' ) ) {
	if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;
		class Blogg_Customize_Static_Text_Control extends WP_Customize_Control {
		public $type = 'static-text';
		public function esc_html__construct( $manager, $id, $args = array() ) {
			parent::__construct( $manager, $id, $args );
		}
		protected function render_content() {
			if ( ! empty( $this->label ) ) :
				?><span class="blogg-customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
			endif;
			if ( ! empty( $this->description ) ) :
				?><div class="blogg-description blogg-customize-control-description"><?php

				if( is_array( $this->description ) ) {
					echo '<p>' . implode( '</p><p>', wp_kses_post( $this->description )) . '</p>';
					
				} else {
					echo wp_kses_post( $this->description );
				}
				?>
							
			<h1><?php esc_html_e('Blogg Pro', 'blogg') ?></h1>
			
			<p><?php esc_html_e('If you decide to upgrade to the pro version of this theme, use this discount code on checkout.','blogg'); ?></p>	
			<div id="promotion-header"><p class="main-title"><?php esc_html_e('Upgrade to Pro (Save $5)', 'blogg') ?><br><?php esc_html_e('Use Code:', 'blogg') ?> <strong><?php esc_html_e('SAVEFIVE', 'blogg') ?></strong></p>
			<p><a href="https://www.bloggingthemestyles.com/wordpress-themes/blogg-pro/" target="_blank" class="button button-primary"><?php esc_html_e('Get the Pro - Save $5', 'blogg') ?></a></p></div>
			
			<p style="font-weight: 700;"><?php esc_html_e('Pro Features:', 'blogg') ?></p>
			<ul>
				<li><?php esc_html_e('&bull; 8 Blog Styles', 'blogg')?></li>
				<li><?php esc_html_e('&bull; 16 Dynamic Sidebar Positions', 'blogg')?></li>
				<li><?php esc_html_e('&bull; 2 Header Styles', 'blogg')?></li>
				<li><?php esc_html_e('&bull; Custom Logo Letter Feature', 'blogg')?></li>
				<li><?php esc_html_e('&bull; Adjustable Content Widths', 'blogg')?></li>
				<li><?php esc_html_e('&bull; Thumbnail Creation for the Blogs', 'blogg')?></li>
				<li><?php esc_html_e('&bull; An Author Info Widget', 'blogg')?></li>
				<li><?php esc_html_e('&bull; Full Post Featured Image with Title Overlay', 'blogg')?></li>
				<li><?php esc_html_e('&bull; 1 Click Demo Content Import', 'blogg')?></li>
				<li><?php esc_html_e('&bull; Related Posts with Thumbnails', 'blogg')?></li>
				<li><?php esc_html_e('&bull; Basic Typography Options', 'blogg')?></li>
				<li><?php esc_html_e('&bull; Featured Image Captions for Posts', 'blogg')?></li>
				<li><?php esc_html_e('&bull; Customize the Read More Button Text', 'blogg')?></li>
				<li><?php esc_html_e('&bull; Add an Extra Wide Image to Content', 'blogg')?></li>
				<li><?php esc_html_e('&bull; Premium Support', 'blogg')?></li>
			</ul>
							
			<?php
			endif;
		}
	}
}