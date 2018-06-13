<?php
/**
 * Plugin Name: StairWay Posts-Default Widget
 * Description: Displays the latest posts from the selected category in the default manner.
 * Author: Tomas Toman	
 * Version: 1.0
*/

add_action('widgets_init', create_function('', 'return register_widget("stairway_homepage_default");'));
class stairway_homepage_default extends WP_Widget {
	function stairway_homepage_default() {
		$widget_ops = array('classname' => 'homepage-default-posts', 'description' => __('Displays the latest posts from the selected category in the default manner.', 'stairway') );
		$control_ops = array('width' => 200, 'height' => 400);
		$this->WP_Widget('stairwaydefault', __('StairWay Posts-Default', 'stairway'), $widget_ops, $control_ops);
	}
	function form($instance) {
		// outputs the options form on admin
    if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );
		}
		else {
			$title = __( '', 'stairway' );
		} 

	  if ( $instance ) {
			$category = esc_attr( $instance[ 'category' ] );
		}
		else {
			$category = __( '', 'stairway' );
		} 

		if ( $instance ) {
			$numberposts = esc_attr( $instance[ 'numberposts' ] );
		}
		else {
			$numberposts = __( '5', 'stairway' );
    } ?>
<!-- Title -->
<p>
	<label for="<?php echo $this->get_field_id('title'); ?>">
		<?php _e('Title:', 'stairway'); ?>
	</label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>
<!-- Category -->
<p>
	<label for="<?php echo $this->get_field_id('category'); ?>">
		<?php _e('Category:', 'stairway'); ?>
	</label>
<?php wp_dropdown_categories( array(
    'name' => $this->get_field_name('category'),
    'id' => $this->get_field_id('category'),
    'class' => 'widefat',
    'selected' => $category,
    'show_option_none' => '- not selected -'
) ); ?>
<p style="font-size: 10px; color: #999; margin: 0; padding: 0px;">
	<?php _e('Select a category of posts.', 'stairway'); ?>
</p>
</p>
<!-- Number of posts -->
<p>
	<label for="<?php echo $this->get_field_id('numberposts'); ?>">
		<?php _e('Number of posts:', 'stairway'); ?>
	</label>
	<input class="widefat" id="<?php echo $this->get_field_id('numberposts'); ?>" name="<?php echo $this->get_field_name('numberposts'); ?>" type="text" value="<?php echo $numberposts; ?>" />
<p style="font-size: 10px; color: #999; margin: 0; padding: 0px;">
	<?php _e('Insert here the number of latest posts from the selected category which you want to display.', 'stairway'); ?>
</p>
</p>
<?php } 

function update($new_instance, $old_instance) {
		// processes widget options to be saved
		$instance = $old_instance;
    $instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['category'] = $new_instance['category'];
		$instance['numberposts'] = sanitize_text_field($new_instance['numberposts']);
	return $instance;
	}

function widget($args, $instance) {
		// outputs the content of the widget
		 extract( $args );
     if ( isset( $instance['title'] ) ) {
      $title = apply_filters('widget_title', $instance['title']); }
     else { $title = ''; }
     if ( isset( $instance['category'] ) ) {
			$category = apply_filters('widget_category', $instance['category']); }
     else { $category = ''; }
     if ( isset( $instance['numberposts'] ) ) {
			$numberposts = apply_filters('widget_numberposts', $instance['numberposts']); }
     else { $numberposts = ''; } ?>
<?php echo $before_widget; ?>
    <section class="home-latest-posts">
<?php $args1 = array(
  'cat' => $category,
  'showposts' => $numberposts,
	'post_type' => 'post',
	'post_status' => 'publish'
);
$my_query = new WP_Query( $args1 ); ?> 
                
      <h2 class="entry-headline"><?php echo $title; ?></h2>

<?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>            
<?php get_template_part( 'content', 'archives' ); ?>
<?php endwhile; endif; ?>
<?php wp_reset_postdata(); ?>
    </section>
<?php echo $after_widget; ?>
<?php
	}
}
?>