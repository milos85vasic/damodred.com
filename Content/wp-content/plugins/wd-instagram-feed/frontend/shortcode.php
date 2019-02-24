<?php
//global counter for webpage feeds
/*ttt!!! this will not work in case of AJAX request, note that for future versions*/
$wdi_feed_counter = 0;

add_action('init', 'wdi_frontend_init');

function wdi_frontend_init()
{
  global $wdi_options;
  $wdi_options = get_option(WDI_OPT);
}

add_shortcode('wdi_feed', 'wdi_feed');
add_shortcode('wdi_preview', 'wdi_feed');
// [wdi_feed id="feed_id"]
function wdi_feed($atts, $widget_params = '')
{
  global $post;

  ob_start();
  global $wdi_feed_counter;
  require_once(WDI_DIR . '/framework/WDILibrary.php');

  wdi_register_frontend_scripts();

  if(WDILibrary::is_ajax() || WDILibrary::elementor_is_active()) {

    if ($wdi_feed_counter == 0) {

      $wdi_feed_counter = rand(1000, 9999);
      global $wdi_feed_counter_init;
      $wdi_feed_counter_init = $wdi_feed_counter;
    }

    //load scripts and styles from view files
  } else {
    wdi_load_frontend_scripts();
  }


  require_once(WDI_DIR . '/framework/WDILibrary.php');
  if(isset($_GET["feed_id"]) && $post->post_type === "wdi_instagram" && $widget_params === ""){
    if(!is_array($atts)) {
      $atts = array();
    }
    $atts["id"] = $_GET["feed_id"];
  }
  $attributes = shortcode_atts(array(
    'id' => 'no_id',
  ), $atts);
  if ($attributes['id'] == 'no_id') {
    //including feed model
    require_once(WDI_DIR . '/admin/models/WDIModelEditorShortcode.php');
    $shortcode_feeds_model = new WDIModelEditorShortcode();
    /*if there are feeds select first one*/
    $first_feed_id = $shortcode_feeds_model->get_first_feed_id();

    $attributes['id'] = isset($first_feed_id) ? $first_feed_id : $attributes['id'];

    if($attributes['id'] == 'no_id'){
      ob_get_clean();
      return __('No feed. Create and publish a feed to display it.', "wd-instagram-feed");
    }
    /*else continue*/

  }


  //including feed model
  require_once(WDI_DIR . '/admin/models/WDIModelFeeds_wdi.php');
  $feed_model = new WDIModelFeeds_wdi();
  //getting all feed information from db
  $feed_row = WDILibrary::objectToArray($feed_model->get_feed_row($attributes['id']));
  $feed_row = WDILibrary::keep_only_self_user($feed_row);

  if($feed_row['nothing_to_display'] === '1'){
    ob_get_clean();
    return __('Cannot get other user media. API shut down by Instagram. Sorry. Display only your media.', "wd-instagram-feed");
  }


  //checking if access token is not set or removed display proper error message
  global $wdi_options;
  if ((!isset($wdi_options['wdi_access_token']) || $wdi_options['wdi_access_token'] == '') && empty($wdi_options['fb_token'])) {
    ob_get_clean();
    return __('Access Token is invalid, please get it again ', "wd-instagram-feed");
  }

  if (!isset($feed_row) || $feed_row == NULL) {
    ob_get_clean();
    return __('Feed with such ID does not exist', "wd-instagram-feed");
  }


  $feed_row['widget'] = false;
  if ($widget_params != '' && $widget_params['widget'] == true) {
    $feed_row['widget'] = true;
    $feed_row['number_of_photos'] = (string)$widget_params['widget_image_num'];
    $feed_row['show_likes'] = (string)$widget_params['widget_show_likes_and_comments'];
    $feed_row['show_comments'] = (string)$widget_params['widget_show_likes_and_comments'];
    $feed_row['show_usernames'] = '0';
    $feed_row['display_header'] = '0';
    $feed_row['show_description'] = '0';
    $feed_row['number_of_columns'] = (string)$widget_params['number_of_columns'];

//    if($feed_row['feed_display_view'] == "load_more_btn" || $feed_row['feed_display_view'] == "infinite_scroll") {
//      $feed_row['load_more_number'] = (string)$widget_params['widget_image_num'];
//    } else if($feed_row['feed_display_view'] == "pagination") {
//      $feed_row['pagination_per_page_number'] = (string)$widget_params['widget_image_num'];
//    }

    if ($widget_params['enable_loading_buttons'] == 0) {
      $feed_row['feed_display_view'] = 'none';
    }
  }

  if (isset($feed_row['published']) && $feed_row['published'] === '0') {
    ob_get_clean();
    return __('Unable to display unpublished feed ', "wd-instagram-feed");
  }
  //checking feed type and using proper MVC
  $feed_type = isset($feed_row['feed_type']) ? $feed_row['feed_type'] : '';
  switch ($feed_type) {
    case 'thumbnails': {
      //including thumbnails controller
      require_once(WDI_DIR . '/frontend/controllers/WDIControllerThumbnails_view.php');
      $controller = new WDIControllerThumbnails_view();
      $controller->execute($feed_row, $wdi_feed_counter);
      $wdi_feed_counter++;
      break;
    }
    case 'image_browser': {
      //including thumbnails controller
      require_once(WDI_DIR . '/frontend/controllers/WDIControllerImageBrowser_view.php');
      $controller = new WDIControllerImageBrowser_view();
      $controller->execute($feed_row, $wdi_feed_counter);
      $wdi_feed_counter++;
      break;
    }
    default: {
      ob_get_clean();
      return __('Invalid feed type', "wd-instagram-feed");
    }

  }


  global $wdi_options;
  if (isset($wdi_options['wdi_custom_css'])) {
    ?>
    <style>
      <?php echo $wdi_options['wdi_custom_css'];?>
    </style>
    <?php
  }
  if (isset($wdi_options['wdi_custom_js'])) {
    ?>
    <script>
      <?php echo htmlspecialchars_decode(stripcslashes($wdi_options['wdi_custom_js']));?>
    </script>
    <?php
  }


  return ob_get_clean();
}


function wdi_register_frontend_scripts(){

  if(WDI_MINIFY === true) {
    wp_register_script('wdi_instagram', WDI_URL . '/js/wdi_instagram.min.js', array("jquery"), WDI_VERSION, true);
    wp_register_script('wdi_frontend', WDI_URL . '/js/wdi_frontend.min.js', array("jquery", 'wdi_instagram', 'underscore'), WDI_VERSION, true);
    wp_register_script('wdi_responsive', WDI_URL . '/js/wdi_responsive.min.js', array("jquery", "wdi_frontend"), WDI_VERSION, true);
  } else {
    wp_register_script('wdi_instagram', WDI_URL . '/js/wdi_instagram.js', array("jquery"), WDI_VERSION, true);
    wp_register_script('wdi_frontend', WDI_URL . '/js/wdi_frontend.js', array("jquery", 'wdi_instagram', 'underscore'), WDI_VERSION, true);
    wp_register_script('wdi_responsive', WDI_URL . '/js/wdi_responsive.js', array("jquery", "wdi_frontend"), WDI_VERSION, true);
  }

  ////////////////////////////GALLERY BOX//////////////////////////////
  // Styles/Scripts for popup.
  wp_register_script('jquery-mobile', WDI_FRONT_URL . '/js/gallerybox/jquery.mobile.js', array('jquery'), WDI_VERSION);
  //wp_enqueue_script('jquery-mCustomScrollbar', WDI_FRONT_URL . '/js/gallerybox/jquery.mCustomScrollbar.concat.min.js', array('jquery'), WDI_VERSION);
  wp_register_script('jquery-fullscreen', WDI_FRONT_URL . '/js/gallerybox/jquery.fullscreen-0.4.1.js', array('jquery'), WDI_VERSION);

  if(WDI_MINIFY === true) {
    //wp_enqueue_style('wdi_mCustomScrollbar', WDI_FRONT_URL . '/css/gallerybox/jquery.mCustomScrollbar.min.css', array(), WDI_VERSION);
    /*ttt!!! gallery fullscreeni het conflict chka ?? arje stugel ete fullscreen script ka, apa el chavelacnel*/
    wp_register_script('wdi_gallery_box', WDI_FRONT_URL . '/js/gallerybox/wdi_gallery_box.min.js', array('jquery'), WDI_VERSION);
  } else {
    //wp_enqueue_style('wdi_mCustomScrollbar', WDI_FRONT_URL . '/css/gallerybox/jquery.mCustomScrollbar.css', array(), WDI_VERSION);
    /*ttt!!! gallery fullscreeni het conflict chka ?? arje stugel ete fullscreen script ka, apa el chavelacnel*/
    wp_register_script('wdi_gallery_box', WDI_FRONT_URL . '/js/gallerybox/wdi_gallery_box.js', array('jquery'), WDI_VERSION);
  }

  wp_localize_script('wdi_gallery_box', 'wdi_objectL10n', array(
    'wdi_field_required' => __('Field is required.', "wd-instagram-feed"),
    'wdi_mail_validation' => __('This is not a valid email address.', "wd-instagram-feed"),
    'wdi_search_result' => __('There are no images matching your search.', "wd-instagram-feed"),
  ));

  $wdi_token_error_flag = get_option("wdi_token_error_flag");

  $options = wdi_get_options();

  $business_account_id = (!empty($options['business_account_id'])) ? $options['business_account_id'] : "";
  $fb_token = (!empty($options['fb_token'])) ? $options['fb_token'] : "";


  wp_localize_script("wdi_frontend", 'wdi_ajax', array(
    'ajax_url' => admin_url('admin-ajax.php'),
    'wdi_nonce' => wp_create_nonce("wdi_cache"),
    'WDI_MINIFY' => (WDI_MINIFY) ? 'true' : 'false',
    'business_account_id' => $business_account_id,
    'fb_token' => $fb_token,
  ));

  wp_localize_script("wdi_frontend", 'wdi_url', array('plugin_url' => WDI_URL . '/',
    'ajax_url' => admin_url('admin-ajax.php')));

  $user_is_admin = current_user_can('manage_options');
  wp_localize_script("wdi_frontend", 'wdi_front_messages',
    array('connection_error' => __('Connection Error, try again later :(', 'wd-instagram-feed'),
      'user_not_found' => __('Username not found', 'wd-instagram-feed'),
      'network_error' => __('Network error, please try again later :(', 'wd-instagram-feed'),
      'hashtag_nodata' => __('There is no data for that hashtag', 'wd-instagram-feed'),
      'filter_title' => __('Click to filter images by this user', 'wd-instagram-feed'),
      'invalid_users_format' => __('Provided feed users are invalid or obsolete for this version of plugin', 'wd-instagram-feed'),
      'feed_nomedia' => __('There is no media in this feed', 'wd-instagram-feed'),
      'follow' => __('Follow', 'wd-instagram-feed'),
      'show_alerts' => $user_is_admin,
      'wdi_token_flag_nonce' => wp_create_nonce(''),
      'wdi_token_error_flag' => $wdi_token_error_flag
    ));

  //styles
  if(WDI_MINIFY === true) {
    wp_register_style('wdi_frontend_thumbnails', WDI_URL . '/css/wdi_frontend.min.css', array(), WDI_VERSION);
  } else {
    wp_register_style('wdi_frontend_thumbnails', WDI_URL . '/css/wdi_frontend.css', array(), WDI_VERSION);
  }
  wdi_load_frontend_styles();
}

function wdi_load_frontend_styles(){
  global $wdi_options;
  if(WDI_MINIFY === true) {
    wp_register_style('wdi_frontend_thumbnails', WDI_URL . '/css/wdi_frontend.min.css', array(), WDI_VERSION);
  } else {
    wp_register_style('wdi_frontend_thumbnails', WDI_URL . '/css/wdi_frontend.css', array(), WDI_VERSION);
  }


  wp_enqueue_style('wdi_frontend_thumbnails');

  if(empty($wdi_options['wdi_disable_fa'])) {
    wp_register_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), WDI_VERSION);
    wp_enqueue_style('font-awesome');
  }

}

function wdi_load_frontend_scripts(){
  wp_enqueue_script('underscore');
  wp_enqueue_script('wdi_instagram');
  wp_enqueue_script('wdi_frontend');
  wp_enqueue_script('wdi_responsive');
  wp_enqueue_script('wdi_gallery_box');
  wp_enqueue_script('jquery-mobile');
  wp_enqueue_script('jquery-fullscreen');

  wp_enqueue_style('wdi_frontend_thumbnails');
  wp_enqueue_style('font-awesome');
}

/*load all scripts and styles directly without dependency on jquery*/
function wdi_load_frontend_scripts_ajax($additional_scripts = array(), $additional_styles = array()){
  global $wp_scripts;
  global $wp_styles;

  $scripts_handles = array(
    'underscore',
    'wdi_instagram',
    'wdi_responsive',
    'wdi_frontend',
    'wdi_gallery_box',
    'jquery-mobile',
    'jquery-fullscreen'
  );

  $scripts_handles = array_merge($scripts_handles, $additional_scripts);
  $script_tag = '<script src="%s?ver=%s"></script>';

  foreach($scripts_handles as $handle) {
    if(!isset($wp_scripts->registered[$handle])) {
      continue;
    }

    if(!empty($wp_scripts->registered[$handle]->extra['data'])) {
      echo '<script>' . $wp_scripts->registered[$handle]->extra['data'] . '</script>';
    }

    if(strpos($wp_scripts->registered[$handle]->src, '/wp-includes/js/') === 0) {
      echo sprintf($script_tag, $wp_scripts->base_url . $wp_scripts->registered[$handle]->src, $wp_scripts->registered[$handle]->ver);
    } else {
      echo sprintf($script_tag, $wp_scripts->registered[$handle]->src, $wp_scripts->registered[$handle]->ver);
    }
  }

  $styles_handles = array(
    'font-awesome',
    'wdi_frontend_thumbnails'
  );

  $styles_handles = array_merge($styles_handles, $additional_styles);
  $style_tag = "<link rel='stylesheet' id='%s'  href='%s?ver=%s' type='text/css' media='all' />";

  foreach($styles_handles as $handle) {
    if(!isset($wp_styles->registered[$handle])) {
      continue;
    }

    if(!empty($wp_styles->registered[$handle]->extra['data'])) {
      echo '<script>' . $wp_styles->registered[$handle]->extra['data'] . '</script>';
    }

    if(strpos($wp_styles->registered[$handle]->src, '/wp-includes/js/') === 0) {
      echo sprintf($style_tag, $handle, $wp_styles->base_url . $wp_styles->registered[$handle]->src, $wp_styles->registered[$handle]->ver);
    } else {
      echo sprintf($style_tag, $handle, $wp_styles->registered[$handle]->src, $wp_styles->registered[$handle]->ver);
    }
  }

}



add_action('wp_ajax_wdi_token_flag', 'wdi_token_flag');
add_action('wp_ajax_nopriv_wdi_token_flag', 'wdi_token_flag');
function wdi_token_flag() {
  if (check_ajax_referer('', 'wdi_token_flag_nonce', false)){
      add_option("wdi_token_error_flag", 1);
  }
}
add_action('wp_ajax_wdi_delete_token_flag', 'wdi_delete_token_flag');
add_action('wp_ajax_nopriv_wdi_delete_token_flag', 'wdi_delete_token_flag');
function wdi_delete_token_flag() {
  if (check_ajax_referer('', 'wdi_token_flag_nonce', false)){
    delete_option("wdi_token_error_flag");
  }
}


function wdi_feed_frontend_messages(){
  $manage_options_user = current_user_can('manage_options');
  //$class = $manage_options_user ? '' : '';


  $js_error_message = __("Something is wrong.", "wd-instagram-feed");

  $token_error_message = __("Instagram token error.");
  $error_style = "";
  $private_feed_error = "";
  $private_feed_error_1 = "";
  $private_feed_error_2 = "";
  $private_feed_error_3 = "";
  if($manage_options_user){
    $js_error_message = __("Something is wrong. Response takes too long or there is JS error. Press Ctrl+Shift+J or Cmd+Shift+J on a Mac to see error in console or ask for <a class='wdi_error_link' href='https://wordpress.org/support/plugin/wd-instagram-feed' target='_blank'>free support</a>.", "wd-instagram-feed");
    $token_error_message = __("Instagram token is invalid or expired. Please <a href='".site_url()."/wp-admin/admin.php?page=wdi_settings' target='_blank'>reset token</a> and sign-in again to get new one.");
    $error_style = 'style="color: #cc0000; text-align: center;"';
    $private_feed_error_1 = __("Admin warning: there is one or more private user in this feed") ;

    $private_feed_error_2 = __("Their media won't be displayed.") ;
    $private_feed_error_3 = '(<span class="wdi_private_feed_names"></span>). ' ;
  }

  $ajax_error_message = (defined('DOING_AJAX') && DOING_AJAX) ? __("Warning: Instagram Feed is loaded using AJAX request. It might not display properly.", "wd-instagram-feed") : '';

  echo '<div '.$error_style.' class="wdi_js_error">'.
    $js_error_message ."<br/>". $ajax_error_message .'</div>';
  echo '<div '.$error_style.' class="wdi_token_error wdi_hidden">'. $token_error_message .'</div>';
  echo '<div '.$error_style.' class="wdi_private_feed_error wdi_hidden"><span>'. $private_feed_error_1 . $private_feed_error_3 .$private_feed_error_2.'</span></div>';
  echo '<div class="wdi_check_fontawesome wdi_hidden"><i class="fa fa-instagram""></i></div>';
}