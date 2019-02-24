<?php

class WDIViewWidget {
  ////////////////////////////////////////////////////////////////////////////////////////
  // Events                                                                             //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Constants                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Variables                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
  private $model;

  ////////////////////////////////////////////////////////////////////////////////////////
  // Constructor & Destructor                                                           //
  ////////////////////////////////////////////////////////////////////////////////////////
  public function __construct($model) {
    $this->model = $model;
  }
  ////////////////////////////////////////////////////////////////////////////////////////
  // Public Methods                                                                     //
  ////////////////////////////////////////////////////////////////////////////////////////

  public function display() {
  }

  function widget($args, $instance) {
    extract($args);
    $title = (isset($instance['title']) ? $instance['title'] : "");
    $feed_id = (isset($instance['feed_id']) ? $instance['feed_id'] : 0);
    $img_number = (isset($instance['img_number']) ? $instance['img_number'] : 4);
    $show_likes_comments = (isset($instance['show_likes_comments']) ? $instance['show_likes_comments'] : 0);
    $number_of_columns = (isset($instance['number_of_columns']) ? $instance['number_of_columns'] : 1);
    $enable_loading_buttons = (isset($instance['enable_loading_buttons']) ? $instance['enable_loading_buttons'] : 0);
    // Before widget.
    echo $before_widget;
    // Title of widget.
    if ($title) {
      echo $before_title . $title . $after_title;
    }
    // Widget output.
    $widget_params = array(
      'widget' => true,
      'widget_image_num' => $img_number,
      'widget_show_likes_and_comments' => $show_likes_comments,
      'number_of_columns'=>$number_of_columns,
      'enable_loading_buttons' => $enable_loading_buttons,
      );
    echo wdi_feed(array('id'=>$feed_id),$widget_params);
   
    // After widget.
    echo $after_widget;
  }
  
  // Widget Control Panel.
  function form($instance, 
                  $id_title, $name_title,
                  $id_feed_id, $name_feed_id,
                  $id_img_number, $name_img_number,
                  $id_show_likes_comments, $name_show_likes_comments,
                  $id_number_of_columns,$name_number_of_columns,
                  $id_enable_loading_buttons, $name_enable_loading_buttons) {
    $defaults = array(
			'title' => 'Instagram Feed',
      'feed_id' => 1,
      'img_number' => 4,
      'show_likes_comments' => 0,
      'number_of_columns' => 1,
      'enable_loading_buttons' => 0
		);
    require_once(WDI_DIR . '/framework/WDILibrary.php');
    $feeds = WDILibrary::objectToArray($this->model->get_feeds());
    $instance = wp_parse_args((array) $instance, $defaults);
    ?>

    <p>
      <label for="<?php echo $id_title; ?>"><?php _e("Title", 'wd-instagram-feed'); ?></label>
      <input class="widefat" id="<?php echo $id_title; ?>" name="<?php echo $name_title; ?>" type="text" value="<?php echo $instance['title']; ?>"/>
    </p>
    <p>
      <label for="<?php echo $id_feed_id; ?>"><?php _e("Feed", 'wd-instagram-feed'); ?></label>
      <select onchange="wdi_toggle(jQuery(this));" class="widefat" id="<?php echo $id_feed_id; ?>" name="<?php echo $name_feed_id; ?>">
        <?php foreach ($feeds as $feed) {
          ?>
          <option <?php if($instance['feed_id'] == $feed['id']) echo 'selected'?> value="<?php echo $feed['id'];?>"><?php echo $feed['feed_name'];?></option>
          <?php
        }?>
      </select>
    </p>
    
    <p class="wdi_number_of_columns">
      <label for="<?php echo $id_number_of_columns; ?>"><?php _e("Number of columns", 'wd-instagram-feed'); ?></label>
      <select class="widefat" id="<?php echo $id_number_of_columns; ?>" name="<?php echo $name_number_of_columns; ?>" >
        <?php for ($k = 1 ;$k <= 10; $k++) {
          ?>
          <option <?php if($instance['number_of_columns'] == $k) echo 'selected'?> value="<?php echo $k?>"><?php echo $k;?></option>
          <?php
        }?>
      </select>
    </p>


    <p>
      <label for="<?php echo $id_img_number; ?>"><?php _e("Number of images to show", 'wd-instagram-feed'); ?></label>
      <input class="widefat" id="<?php echo $id_img_number; ?>" name="<?php echo $name_img_number; ?>" type="text" value="<?php echo $instance['img_number']; ?>"/>
    </p>
    <p>
      <input <?php if($instance['show_likes_comments']=='1') echo "checked"?> class="widefat" id="<?php echo $id_show_likes_comments; ?>" name="<?php echo $name_show_likes_comments; ?>" type="checkbox" value="<?php echo $instance['show_likes_comments']; ?>"/>
      <label for="<?php echo $id_show_likes_comments; ?>"><?php _e("Show likes and comments", 'wd-instagram-feed'); ?></label>
    </p>
    <p>
      <input <?php if($instance['enable_loading_buttons']=='1') echo "checked"?> class="widefat" id="<?php echo $id_enable_loading_buttons; ?>" name="<?php echo $name_enable_loading_buttons; ?>" type="checkbox" value="<?php echo $instance['enable_loading_buttons']; ?>"/>
      <label for="<?php echo $id_enable_loading_buttons; ?>"><?php _e("Enable loading new images", 'wd-instagram-feed'); ?></label>
    </p>
    <script>
    jQuery(document).ready(function(){
      wdi_toggle(jQuery('#<?php echo $id_feed_id; ?>'));
    });

    function wdi_toggle(select){
      var feed_list = <?php echo json_encode($feeds);?>;
      var id = select.val();
      for(var i = 0 ; i < feed_list.length; i++){
        if(feed_list[i]['id'] == id){
          if(feed_list[i]['feed_type'] == 'blog_style'){
            select.parent().parent().find('.wdi_number_of_columns').css('display','none');
          }else{
            select.parent().parent().find('.wdi_number_of_columns').css('display','block');
          }
        }
      }
    }
    </script>
    <?php
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