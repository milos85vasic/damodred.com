<?php
/**
 * Define fields for Widgets.
 * 
 * @package Bloog Lite
 */

function bloog_lite_widgets_show_widget_field( $instance = '', $widget_field = '', $athm_field_value = '' ) {
	$bloog_lite_pagelist[0] = array(
        'value' => 0,
        'label' => '--choose--'
    );
    $arg = array('posts_per_page'   => -1);
    $bloog_lite_pages = get_pages($arg);
    foreach($bloog_lite_pages as $bloog_lite_page) :
        $bloog_lite_pagelist[$bloog_lite_page->ID] = array(
            'value' => $bloog_lite_page->ID,
            'label' => $bloog_lite_page->post_title
        );
    endforeach;
    //print_r($widget_field);
	extract( $widget_field );
	
	switch( $bloog_widgets_field_type ) {
	
		// Standard text field
		case 'text' : ?>
			<p>
				<label for="<?php echo $instance->get_field_id( $bloog_widgets_name ); ?>"><?php echo $bloog_widgets_title; ?>:</label>
				<input class="widefat" id="<?php echo $instance->get_field_id( $bloog_widgets_name ); ?>" name="<?php echo $instance->get_field_name( $bloog_widgets_name ); ?>" type="text" value="<?php echo $athm_field_value; ?>" />
				
				<?php if( isset( $bloog_widgets_description ) ) { ?>
				<br />
				<small><?php echo $bloog_widgets_description; ?></small>
				<?php } ?>
			</p>
			<?php
			break;

		// Textarea field
		case 'textarea' : ?>
			<p>
				<label for="<?php echo $instance->get_field_id( $bloog_widgets_name ); ?>"><?php echo $bloog_widgets_title; ?>:</label>
				<textarea class="widefat" rows="6" id="<?php echo $instance->get_field_id( $bloog_widgets_name ); ?>" name="<?php echo $instance->get_field_name( $bloog_widgets_name ); ?>"><?php echo $athm_field_value; ?></textarea>
			</p>
			<?php
			break;
			
		// Checkbox field
		case 'checkbox' : ?>
			<p>
				<input id="<?php echo $instance->get_field_id( $bloog_widgets_name ); ?>" name="<?php echo $instance->get_field_name( $bloog_widgets_name ); ?>" type="checkbox" value="1" <?php checked( '1', $athm_field_value ); ?>/>
				<label for="<?php echo $instance->get_field_id( $bloog_widgets_name ); ?>"><?php echo $bloog_widgets_title; ?></label>

				<?php if( isset( $bloog_widgets_description ) ) { ?>
				<br />
				<small><?php echo $bloog_widgets_description; ?></small>
				<?php } ?>
			</p>
			<?php
			break;
			
		// Radio fields
		case 'radio' : ?>
			<p>
				<?php
				echo $bloog_widgets_title; 
				echo '<br />';
				foreach( $bloog_widgets_field_options as $athm_option_name => $athm_option_title ) { ?>
					<input id="<?php echo $instance->get_field_id( $athm_option_name ); ?>" name="<?php echo $instance->get_field_name( $bloog_widgets_name ); ?>" type="radio" value="<?php echo $athm_option_name; ?>" <?php checked( $athm_option_name, $athm_field_value ); ?> />
					<label for="<?php echo $instance->get_field_id( $athm_option_name ); ?>"><?php echo $athm_option_title; ?></label>
					<br />
				<?php } ?>
				
				<?php if( isset( $bloog_widgets_description ) ) { ?>
				<small><?php echo $bloog_widgets_description; ?></small>
				<?php } ?>
			</p>
			<?php
			break;
			
		// Select field
		case 'select' : ?>
			<p>
				<label for="<?php echo $instance->get_field_id( $bloog_widgets_name ); ?>"><?php echo $bloog_widgets_title; ?>:</label>
				<select name="<?php echo $instance->get_field_name( $bloog_widgets_name ); ?>" id="<?php echo $instance->get_field_id( $bloog_widgets_name ); ?>" class="widefat">
					<?php
					foreach ( $bloog_widgets_field_options as $athm_option_name => $athm_option_title ) { ?>
						<option value="<?php echo $athm_option_name; ?>" id="<?php echo $instance->get_field_id( $athm_option_name ); ?>" <?php selected( $athm_option_name, $athm_field_value ); ?>><?php echo $athm_option_title; ?></option>
					<?php } ?>
				</select>

				<?php if( isset( $bloog_widgets_description ) ) { ?>
				<br />
				<small><?php echo $bloog_widgets_description; ?></small>
				<?php } ?>
			</p>
			<?php
			break;
			
		case 'number' : ?>
			<p>
				<label for="<?php echo $instance->get_field_id( $bloog_widgets_name ); ?>"><?php echo $bloog_widgets_title; ?>:</label><br />
				<input name="<?php echo $instance->get_field_name( $bloog_widgets_name ); ?>" type="number" step="1" min="1" id="<?php echo $instance->get_field_id( $bloog_widgets_name ); ?>" value="<?php echo $athm_field_value; ?>" class="small-text" />
				
				<?php if( isset( $bloog_widgets_description ) ) { ?>
				<br />
				<small><?php echo $bloog_widgets_description; ?></small>
				<?php } ?>
			</p>
			<?php
			break;

		// Select field
		case 'selectpage' : ?>
			<p>
				<label for="<?php echo $instance->get_field_id( $bloog_widgets_name ); ?>"><?php echo $bloog_widgets_title; ?> :</label>
				<select name="<?php echo $instance->get_field_name( $bloog_widgets_name ); ?>" id="<?php echo $instance->get_field_id( $bloog_widgets_name ); ?>" class="widefat">
					<?php
					foreach ( $bloog_lite_pagelist as $bloog_lite_single_page ) { ?>
						<option value="<?php echo $bloog_lite_single_page['value']; ?>" id="<?php echo $instance->get_field_id( $bloog_lite_single_page['label'] ); ?>" <?php selected( $bloog_lite_single_page['value'], $athm_field_value ); ?>><?php echo $bloog_lite_single_page['label']; ?></option>
					<?php } ?>
				</select>

				<?php if( isset( $bloog_widgets_description ) ) { ?>
				<br />
				<small><?php echo $bloog_widgets_description; ?></small>
				<?php } ?>
			</p>
			<?php
			break;
            
        case 'upload' :

            $output = '';
            $id = $instance->get_field_id($bloog_widgets_name);
            $class = '';
            $int = '';
            $value = $athm_field_value;
            $name = $instance->get_field_name($bloog_widgets_name);


            if ($value) {
                $class = ' has-file';
            }
            $output .= '<div class="sub-option widget-upload">';
            $output .= '<label for="' . $instance->get_field_id($bloog_widgets_name) . '">' . $bloog_widgets_title . '</label><br/>';
            $output .= '<input id="' . $id . '" class="upload' . $class . '" type="text" name="' . $name . '" value="' . $value . '" placeholder="' . __('No file chosen', 'bloog-lite') . '" />' . "\n";
            if (function_exists('wp_enqueue_media')) {
                
                    $output .= '<input id="upload-' . $id . '" class="upload-button button" type="button" value="' . __('Upload', 'bloog-lite') . '" />' . "\n";

            } else {
                $output .= '<p><i>' . __('Upgrade your version of WordPress for full media support.', 'bloog-lite') . '</i></p>';
            }

            $output .= '<div class="screenshot team-thumb" id="' . $id . '-image">' . "\n";

            if ($value != '') {
                $remove = '<a class="remove-image remove-screenshot">Remove</a>';
                $attachment_id = attachment_url_to_postid($value);

                $image_array = wp_get_attachment_image_src($attachment_id, 'medium');
                $image = preg_match('/(^.*\.jpg|jpeg|png|gif|ico*)/i', $value);
                if ($image) {
                    $output .= '<img src="' . $image_array[0] . '" alt="" />' . $remove;
                } else {
                    $parts = explode("/", $value);
                    for ($i = 0; $i < sizeof($parts); ++$i) {
                        $title = $parts[$i];
                    }

                    // No output preview if it's not an image.
                    $output .= '';

                    // Standard generic output if it's not an image.
                    $title = __('View File', 'bloog-lite');
                    $output .= '<div class="no-image"><span class="file_link"><a href="' . $value . '" target="_blank" rel="external">' . $title . '</a></span></div>';
                }
            }
            $output .= '</div></div>' . "\n";
            echo $output;
            break;	
            
        case 'select_theme' : ?>
			<p>
				<label for="<?php echo $instance->get_field_id( $bloog_widgets_name ); ?>"><?php echo $bloog_widgets_title; ?> :</label>
				<select name="<?php echo $instance->get_field_name( $bloog_widgets_name ); ?>" id="<?php echo $instance->get_field_id( $bloog_widgets_name ); ?>" class="widefat">
					<?php
					foreach ( $twitter_themes as $twitter_theme ) { ?>
						<option value="<?php echo $twitter_theme['value']; ?>" id="<?php echo $instance->get_field_id( $twitter_theme['label'] ); ?>" <?php selected( $twitter_theme['value'], $athm_field_value ); ?>><?php echo $twitter_theme['label']; ?></option>
					<?php } ?>
				</select>

				<?php if( isset( $bloog_widgets_description ) ) { ?>
				<br />
				<small><?php echo $bloog_widgets_description; ?></small>
				<?php } ?>
			</p>
			<?php
			break;
	}
	
}