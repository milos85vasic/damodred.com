<?php
/**
 * Call To Action
 *
 * @package Bloog Lite
 */

/**
 * Adds Featuer page display widget.
 */
add_action( 'widgets_init', 'bloog_lite_register_featured_page_widget' );
function bloog_lite_register_featured_page_widget() {
	register_widget( 'bloog_lite_featured_page_widget' );
}
class Bloog_lite_Featured_Page_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'bloog_lite_featured_page',
			'Bloog : Featured Page',
			array(
				'description'	=> __( 'A widget To Display Featured Page', 'bloog-lite' )
				)
			);
	}

	/**
	 * Helper function that holds widget fields
	 * Array is used in update and form functions
	 */
	private function widget_fields() {
		$fields = array(
			'feat_page_title' => array(
				'bloog_widgets_name' => 'feat_page_title',
				'bloog_widgets_title' => __('Page Title','bloog-lite'),
				'bloog_widgets_field_type' => 'text',
				'bloog_widgets_description' => __('Displays the Page Title if left empty','bloog-lite'),
				),
			'feat_page_id' => array(
				'bloog_widgets_name' => 'feat_page_id',
				'bloog_widgets_title' => __('Feature Page','bloog-lite'),
				'bloog_widgets_field_type' => 'selectpage'
				)
			);
		
		return $fields;
	}


	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract($args);
		if($instance!=null){
			$feat_page_id = empty($instance['feat_page_id']) ? false : $instance['feat_page_id']; 
			$feat_page_query = new WP_Query('page_id='.$feat_page_id);
			
			$feat_page_title = empty($instance['feat_page_title']) ? false : $instance['feat_page_title'];
        $feat_readmore_text = empty($instance['feat_readmore_text']) ? false : $instance['feat_readmore_text']; //get_theme_mod('home_page_translation');
        $feat_readmore_link = empty($instance['feat_readmore_link']) ? false : $instance['feat_readmore_link'];

        echo $before_widget;
        ?>
        <?php if($feat_page_query->have_posts()) : ?>
        	<?php while($feat_page_query->have_posts()) : $feat_page_query->the_post(); ?> 
        		<div class="feat-page-wrap">
        			<a href="<?php the_permalink();?>">
        				<?php if(!empty($feat_page_title)) : ?>
        					<h2 class="widget-title"><?php echo esc_attr($feat_page_title); ?></h2>
        				<?php else : ?>
        					<h2 class="widget-title"><?php the_title(); ?></h2>
        				<?php endif; ?>
        			</a>
        			<?php $img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'feature-page-img', false ); ?>
        			<?php if(has_post_thumbnail()): ?>
        				<figure class="feat_image_widget">
        					<img src="<?php echo $img_src[0]; ?>"/>
        				</figure>
        			<?php endif; ?>
        			<div class="feat-page-content">
        				<?php echo wp_trim_words(get_the_content(),22); ?>
        			</div>
        		</div>
        	<?php endwhile; ?>
        <?php endif; ?>
        <?php
        echo $after_widget;
    }
}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param	array	$new_instance	Values just sent to be saved.
	 * @param	array	$old_instance	Previously saved values from database.
	 *
	 * @uses	bloog_lite_widgets_updated_field_value()		defined in widget-fields.php
	 *
	 * @return	array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$widget_fields = $this->widget_fields();

		// Loop through fields
		foreach( $widget_fields as $widget_field ) {

			extract( $widget_field );
			
			// Use helper function to get updated field values
			$instance[$bloog_widgets_name] = bloog_lite_widgets_updated_field_value( $widget_field, $new_instance[$bloog_widgets_name] );
			echo $instance[$bloog_widgets_name];
			
		}
		
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param	array $instance Previously saved values from database.
	 *
	 * @uses	accesspress_pro_widgets_show_widget_field()		defined in widget-fields.php
	 */
	public function form( $instance ) {
		$widget_fields = $this->widget_fields();

		// Loop through fields
		foreach( $widget_fields as $widget_field ) {
			// Make array elements available as variables 
			extract( $widget_field );
			$bloog_widgets_field_value = isset( $instance[$bloog_widgets_name] ) ? esc_attr( $instance[$bloog_widgets_name] ) : '';
			bloog_lite_widgets_show_widget_field( $this, $widget_field, $bloog_widgets_field_value );
		}	
	}

}