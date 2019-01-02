<?php
/**
 * Page Options Meta Box Form
 *
 * @package kale
 */
?>
<div class="meta_control">

	<label><strong><?php esc_attr_e( 'Featured Image Layout', 'kale' ); ?></strong></label>

	<p>
		<label>
			<input type="radio" name="_page_options_meta[featured_image]" id="featured_image_default" value="Default" <?php if( ! empty( $meta ) ) { if ( $meta['featured_image'] == 'Default' || empty( $meta['featured_image'] ) ) echo 'checked'; } else echo 'checked'; ?>> <?php esc_attr_e( 'Default', 'kale' ); ?>
		</label>
		<small class="howto">
			<?php esc_html_e( 'Show featured image under the title, in the content area.', 'kale' ) ?>
		</small>
	</p>

	<p>
		<label>
			<input type="radio" name="_page_options_meta[featured_image]" id="featured_image_banner" value="Banner" <?php if ( ! empty( $meta ) ) if ( $meta['featured_image'] == 'Banner' ) echo 'checked'; ?>> <?php esc_attr_e( 'Banner', 'kale' ); ?>
		</label>
		<small class="howto">
			<?php esc_html_e( 'Show featured image at the top, like a banner.', 'kale' ); ?>
		</small>
	</p>

	<p>
		<label>
			<input type="radio" name="_page_options_meta[featured_image]" id="featured_image_hide" value="Hide" <?php if ( ! empty( $meta ) ) if ( $meta['featured_image'] == 'Hide' ) echo 'checked'; ?>> <?php esc_attr_e( 'Hide', 'kale' ); ?>
		</label>
		<small class="howto">
			<?php esc_html_e( 'Do not show the featured image.', 'kale' ); ?>
		</small>
	</p>
</div><!-- meta_control -->
