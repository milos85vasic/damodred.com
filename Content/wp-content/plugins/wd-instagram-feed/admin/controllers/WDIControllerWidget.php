<?php

class WDIControllerWidget extends WP_Widget {
  ////////////////////////////////////////////////////////////////////////////////////////
  // Events                                                                             //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Constants                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Variables                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
  private $view;
  private $model;
  ////////////////////////////////////////////////////////////////////////////////////////
  // Constructor & Destructor                                                           //
  ////////////////////////////////////////////////////////////////////////////////////////
  public function __construct() {

    $widget_ops = array(
      'classname' => 'wdi_instagram_widget',
      'description' => __('Show your instagram feeds in your widget area',"wd-instagram-feed")
    );
    // Widget Control Settings.
    $control_ops = array('id_base' => 'wdi_instagram_widget');
    // Create the widget.
    parent::__construct('wdi_instagram_widget', __('Instagram WD Widget',"wd-instagram-feed"), $widget_ops, $control_ops);
    require_once WDI_DIR . "/admin/models/WDIModelWidget.php";
    $this->model = new WDIModelWidget();
    require_once WDI_DIR . "/admin/views/WDIViewWidget.php";
    $this->view = new WDIViewWidget($this->model);
  }
  ////////////////////////////////////////////////////////////////////////////////////////
  // Public Methods                                                                     //
  ////////////////////////////////////////////////////////////////////////////////////////

  public function widget($args, $instance) {

    $this->view->widget($args, $instance);
	}

 	public function form( $instance ) {

    $this->view->form(
      $instance, 
      parent::get_field_id('title'), 
      parent::get_field_name('title'),
      parent::get_field_id('feed_id'), 
      parent::get_field_name('feed_id'), 
      parent::get_field_id('img_number'), 
      parent::get_field_name('img_number'), 
      parent::get_field_id('show_likes_comments'), 
      parent::get_field_name('show_likes_comments'),
      parent::get_field_id('number_of_columns'), 
      parent::get_field_name('number_of_columns'),
      parent::get_field_id('enable_loading_buttons'), 
      parent::get_field_name('enable_loading_buttons')
    );    
	}

	// Update Settings.
  public function update($new_instance, $old_instance) {
    $instance['title'] = wp_filter_nohtml_kses($new_instance['title']);
    $instance['feed_id'] = intval($new_instance['feed_id']);
    $instance['img_number'] = intval($new_instance['img_number']) ? intval($new_instance['img_number']) : 4;
    $instance['show_likes_comments'] = isset($new_instance['show_likes_comments']) ? 1 : 0;
    $instance['number_of_columns'] = intval($new_instance['number_of_columns']) ? intval($new_instance['number_of_columns']) : 1;
    $instance['enable_loading_buttons'] = isset($new_instance['enable_loading_buttons']) ? 1 : 0;
    return $instance;
  }

  ////////////////////////////////////////////////////////////////////////////////////////
  // Getters & Setters                                                                  //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Private Methods                                                                    //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Listeners                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
}