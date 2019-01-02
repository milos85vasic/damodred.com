<?php
/**
 * Meta Boxes
 *
 * @package kale
 */
/**
 * Register scripts and styles for admin area
 * and enqueue them when needed.
 *
 * This function is attached to 'admin_enqueue_scripts'
 * action hook.
 */
function kale_admin_scripts() {
	wp_enqueue_style( 'kale-meta-boxes', get_template_directory_uri() . '/meta_boxes/style.css' );
}
add_action( 'admin_enqueue_scripts', 'kale_admin_scripts' );
/**
 * Load page template
 *
 * Fire 'add_meta_boxes' and 'save_post' action hooks.
 * This function is attached to 'load-page.php' and
 * 'load-page-new.php' dynamic action hooks.
 */
function kale_meta_init(){
	add_action( 'add_meta_boxes', 'kale_page_options_meta_box_register' );
	add_action( 'save_post', 'kale_page_options_meta_box_save' );
}
add_action( 'load-post.php', 'kale_meta_init' );
add_action( 'load-post-new.php', 'kale_meta_init' );
/**
 * Add custom meta box to pages
 *
 * This function is attached to 'add_meta_boxes'
 * action hook.
 */
function kale_page_options_meta_box_register() {
	add_meta_box(
		'kale_page_options_meta_box',
		esc_html__( 'Kale - Page Options', 'kale' ),
		'kale_page_options_meta_box_render',
		'page',
		'side',
		'high'
	);
}
/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post (page) object.
 */
function kale_page_options_meta_box_render( $post ) {
	global $post;
	$meta = get_post_meta( $post->ID, '_page_options_meta', true );
	include get_template_directory() . '/meta_boxes/meta_box_page.php';
	wp_nonce_field( __FILE__, 'kale_page_options_nonce' );
}
/**
 * Save meta box content.
 *
 * @param int $post_id Post (page) ID
 */
function kale_page_options_meta_box_save( $post_id ) {
	// Do nothing on autosave.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Check if we have our nonce.
	if ( ! isset( $_POST['kale_page_options_nonce'] ) ) {
		return;
	}
	// Verify nonce.
	if ( ! wp_verify_nonce( $_POST['kale_page_options_nonce'], __FILE__ ) ) {
		return;
	}
	// Make sure this user can edit pages.
	if ( $_POST['post_type'] == 'page' ) :
		if ( ! current_user_can( 'edit_page', $post_id ) ) :
			return;
		endif; // ! current_user_can( 'edit_page', $post_id )
	endif; // $_POST['post_type'] == 'page'
	// Get meta.
	$meta = $_POST['_page_options_meta'];
	// Update meta.
	update_post_meta( $post_id, '_page_options_meta', $meta );
}
