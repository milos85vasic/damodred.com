<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package imagegridly
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses imagegridly_header_style()
 */
function imagegridly_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'imagegridly_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'flex-height'            => true,
		'wp-head-callback'       => 'imagegridly_header_style',
		) ) );
	

}
add_action( 'after_setup_theme', 'imagegridly_custom_header_setup' );

if ( ! function_exists( 'imagegridly_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see imagegridly_custom_header_setup().
	 */
function imagegridly_header_style() {
	$header_text_color = get_header_textcolor();
	$header_image = get_header_image();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( empty( $header_image ) && $header_text_color == get_theme_support( 'custom-header', 'default-text-color' ) ){
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
		<style type="text/css">


	.site-title a,
		.site-description,
		.logofont {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}

	<?php if ( ! display_header_text() ) : ?>
	a.logofont {
		position: absolute;
		clip: rect(1px, 1px, 1px, 1px);
		display:none;
	}
	<?php endif; ?>

		<?php header_image(); ?>"
		<?php
		if ( ! display_header_text() ) :
			?>
		a.logofont{
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
			display:none;
		}
		<?php
		else :
			?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
		<?php endif; ?>
		</style>
		<?php
	}
	endif;
