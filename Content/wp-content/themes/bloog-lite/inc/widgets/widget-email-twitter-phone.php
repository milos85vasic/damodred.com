<?php
/**
 * Call To Action
 *
 * @package Bloog Lite
 */

/**
 * Adds Featuer page display widget.
 */
add_action( 'widgets_init', 'bloog_lite_register_middle_social_widget' );
function bloog_lite_register_middle_social_widget() {
    register_widget( 'bloog_lite_middle_social_widget' );
}
class Bloog_lite_middle_social_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'bloog_lite_middle_social',
			'Bloog : Email,Twitter,Phone',
			array(
				'description'	=> __( 'A widget To Display Email Twitter Phone number and link', 'bloog-lite' )
			)
		);
	}

	/**
	 * Helper function that holds widget fields
	 * Array is used in update and form functions
	 */
	 private function widget_fields() {
		$fields = array(
			'email_title' => array(
                'bloog_widgets_name' => 'email_title',
                'bloog_widgets_title' => __('Email','bloog-lite'),
                'bloog_widgets_field_type' => 'text',
            ),
            'email_link' => array(
                'bloog_widgets_name' => 'email_link',
                'bloog_widgets_title' => __('Email Link','bloog-lite'),
                'bloog_widgets_field_type' => 'text',
            ),
            'email_img' => array(
                'bloog_widgets_name' => 'email_img',
                'bloog_widgets_title' => __('Email Link Image','bloog-lite'),
                'bloog_widgets_field_type' => 'upload'
            ),
            'twitter_title' => array(
                'bloog_widgets_name' => 'twitter_title',
                'bloog_widgets_title' => __('Twitter Title','bloog-lite'),
                'bloog_widgets_field_type' => 'text',
            ),
            'twitter_link' => array(
                'bloog_widgets_name' => 'twitter_link',
                'bloog_widgets_title' => __('Twitter Link','bloog-lite'),
                'bloog_widgets_field_type' => 'text',
            ),
            'twitter_img' => array(
                'bloog_widgets_name' => 'twitter_img',
                'bloog_widgets_title' => __('Twitter Image','bloog-lite'),
                'bloog_widgets_field_type' => 'upload'
            ),
            'phone_title' => array(
                'bloog_widgets_name' => 'phone_title',
                'bloog_widgets_title' => __('Phone No.','bloog-lite'),
                'bloog_widgets_field_type' => 'text',
            ),
            'phone_img' => array(
                'bloog_widgets_name' => 'phone_img',
                'bloog_widgets_title' => __('Phone Imagee','bloog-lite'),
                'bloog_widgets_field_type' => 'upload'
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
        $bloog_email_title = $instance['email_title'];
        $bloog_email_link = $instance['email_link'];
        $bloog_email_image = $instance['email_img'];
        
        $bloog_twitter_title = $instance['twitter_title'];
        $bloog_twitter_link = $instance['twitter_link'];
        $bloog_twitter_image = $instance['twitter_img'];
        
        $bloog_phone_title = $instance['phone_title'];
        $bloog_phone_image = $instance['phone_img'];

        echo $before_widget;
            ?>
                <div class="email-twitter-phone-section-wrap">
                    <?php // if(!empty($feat_page_title)) : ?>
                        <div class="bloog_img_title_twitter_wrap">
                            <a class="bloog-email-title" href="mainto:<?php echo esc_attr($bloog_email_link); ?>"><img src="<?php echo esc_url($bloog_email_image); ?>"/></a>
                            <a class="bloog-email-title" href="mainto:<?php echo esc_attr($bloog_email_link); ?>"><?php echo esc_attr($bloog_email_title); ?></a>
                        </div>
                        <div class="bloog_img_title_twitter_wrap">
                            <a href="https://twitter.com/<?php echo $bloog_twitter_link; ?>" target="_blank"><img src="<?php echo esc_url($bloog_twitter_image); ?>"/></a>
                            <a class="bloog-email-title" href="https://twitter.com/<?php echo $bloog_twitter_link; ?>" target="_blank"><?php echo esc_attr($bloog_twitter_title); ?></a>
                        </div>
                        <div class="bloog_img_title_twitter_wrap">
                            <img src="<?php echo esc_url($bloog_phone_image); ?>"/>
                            <a class="bloog-email-title" href="#"><?php echo esc_attr($bloog_phone_title); ?></a>
                        </div>
                    <?php // endif; ?>
                </div>
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