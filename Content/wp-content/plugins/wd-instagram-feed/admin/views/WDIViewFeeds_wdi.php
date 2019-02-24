<?php

class WDIViewFeeds_wdi
{
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
  public function __construct($model)
  {
    $this->model = $model;
  }
  ////////////////////////////////////////////////////////////////////////////////////////
  // Public Methods                                                                     //
  ////////////////////////////////////////////////////////////////////////////////////////
  public function display()
  {
    /*My Edit*/
    global $wdi_options;
    $rows_data = $this->model->get_rows_data();
    $page_nav = $this->model->page_nav();
    $search_value = "";
    if(isset($_POST['search_value'])){
      $search_value =esc_html(stripslashes($_POST['search_value']));
    }elseif (isset($_GET["search"])){
      $search_value =esc_html(stripslashes($_GET["search"]));
    }

    $asc_or_desc = ((isset($_GET['order'])) ? esc_html(stripslashes($_GET['order'])) : 'asc');
    $order_by = (isset($_GET['order_by']) ? esc_html(stripslashes($_GET['order_by'])) : 'id');
    if($order_by==="feed_name"){
      $wdi_sort = " sorted ";
    }else{
      $wdi_sort = " sortable ";
    }
    $order_class = 'manage-column column-title '.$wdi_sort . $asc_or_desc;
    $ids_string = '';
    $wdi_button_array = array(
      'publish_all' => __('Publish', 'wdi'),
      'unpublish_all' => __('Unpublish', 'wdi'),
      'duplicate_all' => __('Duplicate', 'wdi'),
      'delete_all' => __('Delete', 'wdi'),
    );
    ?>
    <div class="wrap">
      <h2 class="wdi_page_title"></h2>
      <div class="update-nag wdi_help_bar_wrap">
        <span class="wdi_help_bar_text">
          <?php _e('This section allows you to create, edit and delete Feeds.', "wd-instagram-feed"); ?>
          <a style="color: #5CAEBD; text-decoration: none;border-bottom: 1px dotted;" class="wdi_hb_t_link" target="_blank"
             href="https://help.10web.io/hc/en-us/articles/360016497251-Creating-Instagram-Feed"><?php _e('Read More in User Guide', "wd-instagram-feed"); ?></a>
        </span>
        <div class="wdi_hb_buy_pro">
          <a class="wdi_support_link" href="https://wordpress.org/support/plugin/wd-instagram-feed" target="_blank">
            <img src="<?php echo WDI_URL; ?>/images/i_support.png" >
            <?php _e("Support Forum", "gmwd"); ?>
          </a>
          <a class="wdi_update_pro_link" target="_blank" href="https://web-dorado.com/files/fromInstagramFeedWD.php">
            <?php _e("UPGRADE TO PREMIUM VERSION", "wd-instagram-feed"); ?>
          </a>
        </div>
      </div>
      <form class="" id="wdi_feed_form" method="post" action="admin.php?page=wdi_feeds" >
        <?php wp_nonce_field('nonce_wd', 'nonce_wd'); ?>
        <input type="hidden" id="wdi_access_token" name="access_token"
               value="<?php echo isset($wdi_options['wdi_access_token']) ? $wdi_options['wdi_access_token'] : ''; ?>">
        <div class="wd-page-title wd-header">
			<h1 class="wp-heading-inline"><?php _e('Feeds', "wd-instagram-feed"); ?></h1>
			<?php
			$add_page_data = array(
			  'task' => 'add'
			);
			?>
			<a href="<?php echo WDILibrary::get_page_link($add_page_data);?>" class="add-new-h2"><?php _e('Add new', "wd-instagram-feed"); ?></a>
        </div>
        <?php
          WDILibrary::search(__('Name', "wd-instagram-feed"), $search_value, 'wdi_feed_form');
          ?>

        <div class="tablenav top">
          <div class="alignleft actions bulkactions">
            <select class="bulk_action">
              <option value=""><?php _e('Bulk Actions', 'wd-instagram-feed'); ?></option>
              <?php
              foreach ($wdi_button_array as $key => $value) {
                ?>
                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php
              }
              ?>
            </select>
            <input class="button action" type="button" title="<?php _e('Apply', 'wds'); ?>" onclick="if (!wdi_bulk_actions('.bulk_action')) {return false}" value="<?php _e('Apply', 'wds'); ?>" />
          </div>
          <?php
          WDILibrary::html_page_nav($page_nav['total'], $page_nav['limit'], 'wdi_feed_form');
          ?>
        </div>

        <table class="wp-list-table widefat fixed pages media">
          <thead>
          <td class="manage-column column-cb check-column"><input id="check_all" type="checkbox" onclick="wdi_spider_check_all(this)"/></td>

          <th class="column-primary table_large_col <?php
          echo $order_class;
          ?>">
            <?php
            if($asc_or_desc==="asc"){
              $wdi_order = 'desc';
            }else{
              $wdi_order = 'asc';
            }
            ?>
            <a href="<?php echo WDILibrary::get_page_link(array('order_by'=>'feed_name', 'order'=>$wdi_order));?>">
              <span><?php _e('Title', "wd-instagram-feed"); ?></span><span class="sorting-indicator"></span>
            </a>
          </th>
          <th class="table_big_col"><?php _e('Shortcode', "wd-instagram-feed"); ?></th>
          <th class="table_large_col"><?php _e('PHP function', "wd-instagram-feed"); ?></th>
          </thead>
          <tbody id="tbody_arr">
          <?php
          if ($rows_data) {
            $instagram_preview_post = $this->model->get_instagram_preview_post();

            foreach ($rows_data as $row_data) {
              $alternate = (!isset($alternate) || $alternate == 'class="alternate"') ? '' : 'class="alternate"';
              $published_image = (($row_data->published) ? 'publish' : 'unpublish');
              $published = (($row_data->published) ? 'unpublish' : 'publish');
              $prev_img_url = $this->model->get_slider_prev_img($row_data->id);
              $edit_page_data = array(
                'task' => 'edit',
                'current_id' => $row_data->id,
              );
              $wdi_nonce_wd = wp_create_nonce('nonce_wd');
              ?>
              <tr id="tr_<?php echo $row_data->id; ?>" <?php echo $alternate; ?>>
                <th class="table_small_col check-column"><input id="check_<?php echo $row_data->id; ?>"
                                                                name="check_<?php echo $row_data->id; ?>"
                                                                onclick="wdi_spider_check_all(this)" type="checkbox"/>
                </th>
                <td class="column-primary column-title" data-colname="Name">
                  <strong>
                    <a  href="<?php echo WDILibrary::get_page_link($edit_page_data);?>"
                        title="Edit">
                       <span class="media-icon image-icon">
                        <img title="<?php echo $row_data->feed_name; ?>"
                             style="border: 1px solid #CCCCCC; max-width: 70px; max-height: 50px;"
                             src="<?php echo $prev_img_url; ?>">
                      </span>
                      <?php echo $row_data->feed_name; ?>
                    </a>
                    <?php
                    if ( !$row_data->published ) {
                      ?>
                      —
                      <span class="post-state"><?php _e('Unpublished', "wd-instagram-feed"); ?></span>
                      <?php
                    }

                    ?>
                  </strong>
                  <div class="row-actions">
                      <span>
                        <a  href="<?php echo WDILibrary::get_page_link($edit_page_data);?>"
                            title="Edit"><?php _e('Edit', "wd-instagram-feed"); ?>
                        </a>
                        |
                      </span>
                    <span>
                          <a  href="<?php echo WDILibrary::get_page_link(array('task'=>'duplicate','current_id'=>$row_data->id, 'nonce_wd'=>$wdi_nonce_wd));?>"><?php _e('Duplicate', "wd-instagram-feed"); ?></a>
                          |
                      </span>
                    <span>
                          <a href="<?php echo WDILibrary::get_page_link(array('task'=>$published,'current_id'=>$row_data->id, 'nonce_wd'=>$wdi_nonce_wd));?>" ><?php echo ( $row_data->published ? __('Unpublish', "wd-instagram-feed") : __('Publish', "wd-instagram-feed")); ?></a>
                          |
                      </span>
                    <span class="trash">
                        <a onclick="if (!confirm('<?php esc_attr_e('Do you want to delete selected items?', "wd-instagram-feed"); ?>')){return false;}" href="<?php echo WDILibrary::get_page_link(array('task'=>"delete",'current_id'=>$row_data->id, 'nonce_wd'=>$wdi_nonce_wd));?>">Delete</a>
                        |
                      </span>
                    <span>
                         <a href="<?php echo add_query_arg( array('feed_id' => $row_data->id), $instagram_preview_post); ?>" target="_blank"><?php _e('Preview', "wd-instagram-feed"); ?></a>
                      </span>
                  </div>
                  <button class="toggle-row" type="button">
                    <span class="screen-reader-text"><?php _e('Show more details', "wd-instagram-feed"); ?></span>
                  </button>
                </td>
                <td class="table_big_col" data-colname="Shortcode" >
                  <input type="text" value='[wdi_feed id="<?php echo $row_data->id; ?>"]'
                         onclick="wdi_spider_select_value(this)" size="12" readonly="readonly"
                         style="padding-left: 1px; padding-right: 1px; text-align: center;"/>
                </td>
                <td class="table_large_col" data-colname="PHP function" >
                  <input type="text" value="&#60;?php echo wdi_feed(array('id'=>'<?php echo $row_data->id; ?>')); ?&#62;"
                         onclick="wdi_spider_select_value(this)" size="30" readonly="readonly"
                         style="padding-left: 1px; padding-right: 1px; text-align: center;"/>
                </td>
              </tr>
              <?php
              $ids_string .= $row_data->id . ',';
            }
          }
          ?>
          </tbody>
        </table>
        <input id="task" name="task" type="hidden" value=""/>
        <input id="current_id" name="current_id" type="hidden" value=""/>
        <input id="ids_string" name="ids_string" type="hidden" value="<?php echo $ids_string; ?>"/>
        <input id="asc_or_desc" name="asc_or_desc" type="hidden" value="asc"/>
        <input id="order_by" name="order_by" type="hidden" value="<?php echo $order_by; ?>"/>
      </form>
    </div>
    <?php
  }

  public function edit($type)
  {
    if ($type === 0) {
      $this->generateForm();
      ?>
      <script>jQuery(document).ready(function ()
        {
          wdi_controller.switchFeedTabs('feed_settings');
        });</script>
      <?php
    }
    else {
      global $wdi_new_feed;
      $wdi_new_feed = true;
      $current_id = $type;
      $feed_row = $this->model->get_feed_row($current_id);
      $view_id = $feed_row->feed_type;
      $this->generateForm($current_id);
      $tab = isset($_POST['wdi_refresh_tab']) ? $_POST['wdi_refresh_tab'] : 'feed_settings';
      ?>
      <script>jQuery(document).ready(function ()
        {
          wdi_controller.switchFeedTabs("<?php echo $tab;?>", "<?php echo $view_id;?>");
        });</script>
      <?php

    }


  }


  public function getFormElements($current_id = ''){
    require_once(WDI_DIR . '/admin/models/WDIModelThemes_wdi.php');
    $themes = WDIModelThemes_wdi::get_themes();

    $tabs = array(
      "feed_settings" => array(
        "media" => array(
          "title" => "Media",
          "type" => "full",
          "column" => "two",
          "visibility" =>"show",
          "section_name"=>"wdi_media",
          "elements" => array(
            array(
              //'feed_name' => array('name' => 'feed_name', 'title' => __('Feed Title', "wd-instagram-feed"), 'type' => 'input', 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'thumbnails,masonry,blog_style,image_browser'))),
              'liked_feed' => array('disabled_options' => array('liked'), 'disabled' => array('text' => __("Feed of liked media is available only in premium version", "wd-instagram-feed")), 'name' => 'liked_feed', 'title' => __('Feed Media', "wd-instagram-feed"), 'type' => 'select', 'valid_options' => array('userhash' => __('Username/Hashtag', "wd-instagram-feed"), 'liked' => __('Media I liked', "wd-instagram-feed")), 'break' => 'false', 'hide_ids' => array(), 'tooltip' => __('Display media of User/Hashtag or the media I liked', "wd-instagram-feed"), 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'thumbnails,masonry,blog_style,image_browser'))),
              'feed_users' => array('name' => 'feed_users', 'title' => __('Feed Usernames and Hashtags', "wd-instagram-feed"), 'type' => 'input', 'input_type' => 'hidden', 'tooltip' => sprintf('%s', __('Add usernames or hashtags to your feed. Hashtags must start with #, usernames shouldn\'t start with @.', "wd-instagram-feed")), 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'thumbnails,masonry,blog_style,image_browser'))),
              'hashtag_top_recent' => array('name' => 'hashtag_top_recent', 'title' => __('Hashtag Top/Recent', "wd-instagram-feed"), 'type' => 'radio', 'valid_options' => array('1' => __('Recent', "wd-instagram-feed"), '0' => __('Top', "wd-instagram-feed")), 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'lightbox_settings')), 'hide_ids' => array('1' => 'popup_width,popup_height')),
            ),
            array(
              'sort_images_by' => array('name' => 'sort_images_by', 'title' => __('Sort Media By', "wd-instagram-feed"), 'valid_options' => array('date' => __('Date', "wd-instagram-feed"), 'likes' => __('Likes', "wd-instagram-feed"), 'comments' => __('Comments', "wd-instagram-feed"), 'random' => __('Random', "wd-instagram-feed")), 'type' => 'select', 'tooltip' => "", 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'thumbnails,masonry,blog_style,image_browser'))),
              'display_order' => array('name' => 'display_order', 'title' => __('Sorting Order', "wd-instagram-feed"), 'valid_options' => array('asc' => 'Ascending', 'desc' => 'Descending '), 'type' => 'select', 'tooltip' => "", 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'thumbnails,masonry,blog_style,image_browser'))),
              'feed_item_onclick' => array('name' => 'feed_item_onclick', 'title' => __('Action OnClick', "wd-instagram-feed"), 'type' => 'select', 'valid_options' => array('lightbox' => __('Open Lightbox', "wd-instagram-feed"), 'instagram' => __('Redirect To Instagram', "wd-instagram-feed"), 'custom_redirect' => __('Custom Redirect', "wd-instagram-feed"), 'none' => __('Do Nothing', "wd-instagram-feed")), 'break' => 'true', 'hide_ids' => array('lightbox' => 'redirect_url', 'instagram' => 'redirect_url', 'none' => 'redirect_url'), 'tooltip' => __('Do this action when user clicks on image/video in the feed', 'wd-instagram-feed'), 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'thumbnails,masonry,blog_style,image_browser'))),
              'redirect_url' => array('name' => 'redirect_url', 'title' => __('Redirect URL', "wd-instagram-feed"), 'type' => 'input', 'tooltip' => __('Absolute Url to redirect to.', 'wd-instagram-feed'), 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'thumbnails,masonry,blog_style,image_browser'))),
            )
          )
        ),
        "layout" => array(
          "title" => "Layout and Pagination",
          "type" => "half",
          "column" => "one",
          "section_name"=>"wdi_layout",
          "elements" => array(
            array(
              'feed_display_view' => array('name' => 'feed_display_view', 'title' => __('New Media Loading', "wd-instagram-feed"), 'type' => 'select', 'valid_options' => array('pagination' => __('Pagination', "wd-instagram-feed"), 'load_more_btn' => __('Load More Button', "wd-instagram-feed"), 'infinite_scroll' => __('Infinite Scroll', "wd-instagram-feed"), 'none' => __('None', "wd-instagram-feed")),'disabled_options' => array('infinite_scroll'),'disabled' => array('text' => __("Infinite Scroll option is available only in premium version", "wd-instagram-feed")), 'break' => 'true', 'hide_ids' => array('pagination' => 'number_of_photos,load_more_number,resort_after_load_more', 'load_more_btn' => 'pagination_per_page_number,pagination_preload_number', 'infinite_scroll' => 'pagination_per_page_number,pagination_preload_number', 'none' => 'pagination_preload_number,pagination_per_page_number,load_more_number,resort_after_load_more'), 'tooltip' => __('How to load and display new images/videos', "wd-instagram-feed"), 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'thumbnails,masonry,blog_style'))),
              'number_of_columns' => array('name' => 'number_of_columns', 'title' => __('Number of Columns', "wd-instagram-feed"), 'type' => 'select', 'valid_options' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8'), 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'thumbnails,masonry'))),
              'number_of_photos' => array('name' => 'number_of_photos', 'title' => __('Number of Images/Videos', "wd-instagram-feed"), 'type' => 'input', 'input_type' => 'number', 'tooltip' => __('Number of images/videos to show when feed is loaded first time', "wd-instagram-feed"), 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'thumbnails,masonry,blog_style'))),
              'load_more_number' => array('name' => 'load_more_number', 'title' => __('Number of New Media', "wd-instagram-feed"), 'type' => 'input', 'input_type' => 'number', 'tooltip' => __('Number of new media added to the feed, when user clicks on load more button or triggers infinite scroll', "wd-instagram-feed"), 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'thumbnails,masonry,blog_style'))),
              'pagination_per_page_number' => array('name' => 'pagination_per_page_number', 'title' => __('Number of Media Per Page', "wd-instagram-feed"), 'type' => 'input', 'input_type' => 'number', 'tooltip' => __('Number of images to show on each pagination page', "wd-instagram-feed"), 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'thumbnails,masonry,blog_style'))),
              'pagination_preload_number' => array('name' => 'pagination_preload_number', 'title' => __('Pages To Preload', "wd-instagram-feed"), 'type' => 'input', 'input_type' => 'number', 'tooltip' => __('Preload all the media of several first pages', "wd-instagram-feed"), 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'thumbnails,masonry,blog_style'))),
              'image_browser_preload_number' => array('name' => 'image_browser_preload_number', 'title' => __('Number of Media for Initial Preload', "wd-instagram-feed"), 'type' => 'input', 'input_type' => 'number', 'tooltip' => __('A number of first images/videos are preloaded', "wd-instagram-feed"), 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'image_browser'))),
              'image_browser_load_number' => array('name' => 'image_browser_load_number', 'title' => __('Number of Media for Pagination Preload', "wd-instagram-feed"), 'type' => 'input', 'input_type' => 'number', 'tooltip' => "", 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'image_browser'))),
              'resort_after_load_more' => array('name' => 'resort_after_load_more', 'title' => __('Combine and Sort Again After Loading More', "wd-instagram-feed"), 'type' => 'checkbox', 'tooltip' => __('If this option is enabled, both newly loaded and existing media are mixed then resorted together', "wd-instagram-feed"), 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'thumbnails,masonry,blog_style'))),
              'disable_mobile_layout' => array('name' => 'disable_mobile_layout', 'title' => __('Make Layout Not Responsive', "wd-instagram-feed"), 'type' => 'checkbox', 'tooltip' => __('When checked, layout does not become single-column on mobile. Columns number stays the same', "wd-instagram-feed"), 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'thumbnails,masonry'))),
            )
          )
        ),
        "advanced" => array(
          "title" => "Advanced",
          "type" => "half",
          "column" => "one",
          "section_name"=>"wdi_advanced",
          "elements" => array(
            array(
              'theme_id' => array('switched' => 'off', 'label' => array('place' => 'after', 'class' => 'wdi_pro_only', 'text' => __("Changing Theme is available only in premium version", "wd-instagram-feed"), 'br' => 'true'), 'name' => 'theme_id', 'title' => __('Theme', "wd-instagram-feed"), 'valid_options' => $themes, 'type' => 'select', 'tooltip' => __('Styling theme of the feed. You can create themes in themes menu', "wd-instagram-feed"), 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'thumbnails,masonry,blog_style,image_browser'))),
              'feed_resolution' => array('name' => 'feed_resolution', 'title' => __('Feed Media Resolution', "wd-instagram-feed"), 'type' => 'select', 'label' => array('text' => '', 'place' => 'after'), 'valid_options' => array('optimal' => 'Optimal', 'standard' => 'Standard (640 pixels)', 'low' => 'Low (320 pixels)', 'thumbnail' => 'Thumbnail (150 pixels)'), 'tooltip' => 'If set optimal, loaded media size is calculated according to container size. Fast loading and no stretched images.', 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'thumbnails,masonry,blog_style,image_browser'))),
              'thumb_user' => array('name' => 'thumb_user', 'title' => __('Featured Image', "wd-instagram-feed"), 'valid_options' => array(), 'type' => 'select', 'tooltip' => __('Select featured image for header section', "wd-instagram-feed"), 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'thumbnails,masonry,blog_style,image_browser'))),
              'display_header' => array('name' => 'display_header', 'title' => __('Show Feed Header', "wd-instagram-feed"), 'type' => 'checkbox', 'tooltip' => __('Header includes feed title and featured image', "wd-instagram-feed"), 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'thumbnails,masonry,blog_style,image_browser'))),
              'show_usernames' => array('name' => 'show_usernames', 'title' => __('Show User Data', "wd-instagram-feed"), 'type' => 'checkbox', 'tooltip' => '','hide_ids' => array('display_user_info','display_user_post_follow_number','follow_on_instagram_btn'), 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'thumbnails,masonry,blog_style,image_browser'))),
              'follow_on_instagram_btn' => array('name' => 'follow_on_instagram_btn', 'title' => __('Show "Follow On Instagram" button', "wd-instagram-feed"), 'type' => 'checkbox', 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'thumbnails,masonry,blog_style,image_browser'))),
              'display_user_post_follow_number' => array('name' => 'display_user_post_follow_number', 'title' => __('Show User Posts and Followers count', "wd-instagram-feed"), 'type' => 'checkbox', 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'thumbnails,masonry,blog_style,image_browser'))),
              'display_user_info' => array('name' => 'display_user_info', 'title' => __('Show User Bio and Website', "wd-instagram-feed"), 'type' => 'checkbox', 'tooltip' => __('User bio will be displayed if feed has only one user', "wd-instagram-feed"), 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'thumbnails,masonry,blog_style,image_browser'))),
              'show_description' => array('switched' => 'off', 'name' => 'show_description', 'title' => __('Show Media Caption', "wd-instagram-feed"), 'type' => 'checkbox', 'label' => array('place' => 'after', 'class' => 'wdi_pro_only', 'text' => __("This feature is available only in premium version", "wd-instagram-feed"), 'br' => 'true'), 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'thumbnails,masonry,blog_style,image_browser'))),
              'show_likes' => array('switched' => 'off', 'name' => 'show_likes', 'title' => __('Show Number of Likes', "wd-instagram-feed"), 'type' => 'checkbox', 'label' => array('place' => 'after', 'class' => 'wdi_pro_only', 'text' => __("This feature is available only in premium version", "wd-instagram-feed"), 'br' => 'true'), 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'thumbnails,masonry,blog_style,image_browser'))),
              'show_comments' => array('switched' => 'off', 'name' => 'show_comments', 'title' => __('Show Number of Comments', "wd-instagram-feed"), 'type' => 'checkbox', 'label' => array('place' => 'after', 'class' => 'wdi_pro_only', 'text' => __("This feature is available only in premium version", "wd-instagram-feed"), 'br' => 'true'), 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'thumbnails,masonry,blog_style,image_browser'))),
              'show_username_on_thumb' => array('switched' => 'off', 'name' => 'show_username_on_thumb', 'title' => __('Show Username On Image Thumb', "wd-instagram-feed"), 'type' => 'checkbox', 'label' => array('place' => 'after', 'class' => 'wdi_pro_only', 'text' => __("This feature is available only in premium version", "wd-instagram-feed"), 'br' => 'true'), 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'thumbnails,masonry'))),
              'show_full_description' => array('name' => 'show_full_description', 'title' => __('Show Full Description', "wd-instagram-feed"), 'type' => 'checkbox', 'tooltip' => __('Discription will be shown no matter how long it is', "wd-instagram-feed"), 'attr' => array(array('name' => 'tab', 'value' => 'feed_settings'), array('name' => 'section', 'value' => 'masonry'))),
            )
          )
        ),
      ),
      "lightbox_settings" => array(
        "general" => array(
          "title" => "General",
          "type" => "full",
          "column" => "two",
          "visibility" =>"show",
          "section_name"=>"wdi_lightbox_general",
          "elements" => array(
            array(
              'popup_fullscreen' => array('name' => 'popup_fullscreen', 'title' => __('Full width lightbox', "wd-instagram-feed"), 'type' => 'radio', 'valid_options' => array('1' => __('Yes', "wd-instagram-feed"), '0' => __('No', "wd-instagram-feed")), 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'lightbox_settings')), 'hide_ids' => array('1' => 'popup_width,popup_height')),
              'popup_width' => array('name' => 'popup_width', 'title' => __('Lightbox Width', "wd-instagram-feed"), 'type' => 'input', 'input_type' => 'number', 'label' => array('text' => 'px', 'place' => 'after'), 'tooltip' => '', 'attr' => array(array('name' => 'class', 'value' => 'small_input'), array('name' => 'tab', 'value' => 'lightbox_settings'))),
              'popup_height' => array('name' => 'popup_height', 'title' => __('Lightbox Height', "wd-instagram-feed"), 'type' => 'input', 'input_type' => 'number', 'label' => array('text' => 'px', 'place' => 'after'), 'tooltip' => '', 'attr' => array(array('name' => 'class', 'value' => 'small_input'), array('name' => 'tab', 'value' => 'lightbox_settings'))),
              'popup_type' => array('name' => 'popup_type', 'title' => __('Lightbox Effect', "wd-instagram-feed"), 'valid_options' => array('none' => 'None', 'cubeH' => 'Cube Horizontal', 'cubeV' => 'Cube Vertical', 'fade' => 'Fade', 'sliceH' => 'Slice Horizontal', 'sliceV' => 'Slice Vertical', 'slideH' => 'Slide Horizontal', 'slideV' => 'Slide Vertical', 'scaleOut' => 'Scale Out', 'scaleIn' => 'Scale In', 'blockScale' => 'Block Scale', 'kaleidoscope' => 'Kaleidoscope', 'fan' => 'Fan', 'blindH' => 'Blind Horizontal', 'blindV' => 'Blinde Vertical', 'random' => 'Random'), 'disabled_options' => array('cubeH', 'cubeV', 'sliceH', 'sliceV', 'slideH', 'slideV', 'scaleOut', 'scaleIn', 'blockScale', 'kaleidoscope', 'fan', 'blindH', 'blindV', 'random'), 'disabled' => array('text' => __("Effects are available only in premium version", "wd-instagram-feed")), 'type' => 'select', 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'lightbox_settings'))),
            ),
            array(
              'popup_autoplay' => array('name' => 'popup_autoplay', 'title' => __('Lightbox autoplay', "wd-instagram-feed"), 'type' => 'radio', 'valid_options' => array('1' => __('Yes', "wd-instagram-feed"), '0' => __('No', "wd-instagram-feed")), 'hide_ids' => array('0' => 'popup_interval'), 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'lightbox_settings'))),
              'popup_interval' => array('name' => 'popup_interval', 'title' => __('Autoplay Interval', "wd-instagram-feed"), 'type' => 'input', 'input_type' => 'number', 'label' => array('text' => 'sec', 'place' => 'after'), 'tooltip' => '', 'attr' => array(array('name' => 'class', 'value' => 'small_input'), array('name' => 'tab', 'value' => 'lightbox_settings'))),
            )
          )
        ),
        "advanced" => array(
          "title" => "Advanced",
          "type" => "full",
          "column" => "two",
          "section_name"=>"wdi_lightbox_advanced",
          "elements" => array(
            array(
              'popup_enable_filmstrip' => array('disabled_options' => array('1' => '', '0' => ''), 'label' => array('place' => 'after', 'class' => 'wdi_pro_only', 'text' => __("This feature is available only in premium version", "wd-instagram-feed"), 'br' => 'true'), 'name' => 'popup_enable_filmstrip', 'title' => __('Enable Filmstrip', "wd-instagram-feed"), 'type' => 'radio', 'valid_options' => array('1' => __('Yes', "wd-instagram-feed"), '0' => __('No', "wd-instagram-feed")), 'hide_ids' => array('0' => 'popup_filmstrip_height'), 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'lightbox_settings'))),
              'popup_filmstrip_height' => array('name' => 'popup_filmstrip_height', 'title' => __('Filmstrip Thumbnail Size', "wd-instagram-feed"), 'type' => 'input', 'input_type' => 'number', 'label' => array('text' => 'px', 'place' => 'after'), 'tooltip' => '', 'attr' => array(array('name' => 'class', 'value' => 'small_input'), array('name' => 'tab', 'value' => 'lightbox_settings'))),
              'autohide_lightbox_navigation' => array('name' => 'autohide_lightbox_navigation', 'title' => __('Show Next / Previous Buttons', "wd-instagram-feed"), 'type' => 'radio', 'valid_options' => array('1' => __('On Hover', "wd-instagram-feed"), '0' => __('Always', "wd-instagram-feed")), 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'lightbox_settings'))),
              'popup_info_always_show' => array('disabled_options' => array('1' => '', '0' => ''), 'name' => 'popup_info_always_show', 'title' => __('Caption Displayed by Default', "wd-instagram-feed"), 'type' => 'radio', 'label' => array('place' => 'after', 'class' => 'wdi_pro_only', 'text' => __("This feature is available only in premium version", "wd-instagram-feed"), 'br' => 'true'), 'valid_options' => array('1' => __('Yes', "wd-instagram-feed"), '0' => __('No', "wd-instagram-feed")), 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'lightbox_settings'))),
              'popup_info_full_width' => array('disabled_options' => array('1' => '', '0' => ''), 'name' => 'popup_info_full_width', 'title' => __('Full Width Caption', "wd-instagram-feed"), 'type' => 'radio', 'label' => array('place' => 'after', 'class' => 'wdi_pro_only', 'text' => __("This feature is available only in premium version", "wd-instagram-feed"), 'br' => 'true'), 'valid_options' => array('1' => __('Yes', "wd-instagram-feed"), '0' => __('No', "wd-instagram-feed")), 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'lightbox_settings'))),
              'enable_loop' => array('name' => 'enable_loop', 'title' => __('Enable Loop', "wd-instagram-feed"), 'type' => 'radio', 'valid_options' => array('1' => __('Yes', "wd-instagram-feed"), '0' => __('No', "wd-instagram-feed")), 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'lightbox_settings'))),
              'popup_image_right_click' => array('name' => 'popup_image_right_click', 'title' => __('Right Click Protection', "wd-instagram-feed"), 'type' => 'radio', 'valid_options' => array('1' => __('Yes', "wd-instagram-feed"), '0' => __('No', "wd-instagram-feed")), 'tooltip' => __('Protect lightbox images from downloading', "wd-instagram-feed"), 'attr' => array(array('name' => 'tab', 'value' => 'lightbox_settings'))),
            ),
            array(
              'popup_enable_ctrl_btn' => array('name' => 'popup_enable_ctrl_btn', 'title' => __('Enable Control Buttons', "wd-instagram-feed"), 'type' => 'radio', 'valid_options' => array('1' => __('Yes', "wd-instagram-feed"), '0' => __('No', "wd-instagram-feed")), 'hide_ids' => array('0' => 'popup_enable_info,popup_enable_fullscreen,popup_enable_info,popup_enable_comment,popup_enable_download,popup_enable_share_buttons,popup_enable_fullsize_image'), 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'lightbox_settings'))),
              'popup_enable_info' => array('disabled_options' => array('1' => '', '0' => ''), 'name' => 'popup_enable_info', 'title' => __('Enable Caption Control', "wd-instagram-feed"), 'type' => 'radio', 'label' => array('place' => 'after', 'class' => 'wdi_pro_only', 'text' => __("This feature is available only in premium version", "wd-instagram-feed"), 'br' => 'true'), 'valid_options' => array('1' => 'Yes', '0' => 'No'), 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'lightbox_settings'))),
              'popup_enable_fullscreen' => array('name' => 'popup_enable_fullscreen', 'title' => __('Show Fullscreen Control Button', "wd-instagram-feed"), 'type' => 'radio', 'valid_options' => array('1' => __('Yes', "wd-instagram-feed"), '0' => __('No', "wd-instagram-feed")), 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'lightbox_settings'))),
              'popup_enable_comment' => array('switched' => 'off', 'disabled_options' => array('1' => '', '0' => ''), 'label' => array('place' => 'after', 'class' => 'wdi_pro_only', 'text' => __("This feature is available only in premium version", "wd-instagram-feed"), 'br' => 'true'), 'name' => 'popup_enable_comment', 'title' => __('Enable Comments Control', "wd-instagram-feed"), 'type' => 'radio', 'valid_options' => array('1' => __('Yes', "wd-instagram-feed"), '0' => __('No', "wd-instagram-feed")), 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'lightbox_settings'))),
              'popup_enable_fullsize_image' => array('name' => 'popup_enable_fullsize_image', 'title' => __('Add Link to Instagram Post', "wd-instagram-feed"), 'type' => 'radio', 'valid_options' => array('1' => __('Yes', "wd-instagram-feed"), '0' => __('No', "wd-instagram-feed")), 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'lightbox_settings'))),
              'popup_enable_download' => array('name' => 'popup_enable_download', 'title' => __('Enable Download Button', "wd-instagram-feed"), 'type' => 'radio', 'valid_options' => array('1' => __('Yes', "wd-instagram-feed"), '0' => __('No', "wd-instagram-feed")), 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'lightbox_settings'))),
              'popup_enable_share_buttons' => array('disabled_options' => array('1' => '', '0' => ''), 'label' => array('place' => 'after', 'class' => 'wdi_pro_only', 'text' => __("This feature is available only in premium version", "wd-instagram-feed"), 'br' => 'true'), 'name' => 'popup_enable_share_buttons', 'title' => __('Show Share Buttons', "wd-instagram-feed"), 'type' => 'radio', 'valid_options' => array('1' => __('Yes', "wd-instagram-feed"), '0' => __('No', "wd-instagram-feed")), 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'lightbox_settings'))),
              'popup_enable_facebook' => array('status' => 'disabled', 'name' => 'popup_enable_facebook', 'title' => __('Enable Facebook button', "wd-instagram-feed"), 'type' => 'radio', 'valid_options' => array('1' => __('Yes', "wd-instagram-feed"), '0' => __('No', "wd-instagram-feed")), 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'lightbox_settings'))),
              'popup_enable_twitter' => array('status' => 'disabled', 'name' => 'popup_enable_twitter', 'title' => __('Enable Twitter button', "wd-instagram-feed"), 'type' => 'radio', 'valid_options' => array('1' => __('Yes', "wd-instagram-feed"), '0' => __('No', "wd-instagram-feed")), 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'lightbox_settings'))),
              'popup_enable_google' => array('status' => 'disabled', 'name' => 'popup_enable_google', 'title' => __('Enable Google+ button', "wd-instagram-feed"), 'type' => 'radio', 'valid_options' => array('1' => __('Yes', "wd-instagram-feed"), '0' => __('No', "wd-instagram-feed")), 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'lightbox_settings'))),
              'popup_enable_pinterest' => array('status' => 'disabled', 'name' => 'popup_enable_pinterest', 'title' => __('Enable Pinterest button', "wd-instagram-feed"), 'type' => 'radio', 'valid_options' => array('1' => __('Yes', "wd-instagram-feed"), '0' => __('No', "wd-instagram-feed")), 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'lightbox_settings'))),
              'popup_enable_tumblr' => array('status' => 'disabled', 'name' => 'popup_enable_tumblr', 'title' => __('Enable Tumblr button', "wd-instagram-feed"), 'type' => 'radio', 'valid_options' => array('1' => __('Yes', "wd-instagram-feed"), '0' => __('No', "wd-instagram-feed")), 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'lightbox_settings'))),
              'show_image_counts' => array('status' => 'disabled', 'name' => 'show_image_counts', 'title' => __('Show Images Count', "wd-instagram-feed"), 'type' => 'radio', 'valid_options' => array('1' => __('Yes', "wd-instagram-feed"), '0' => __('No', "wd-instagram-feed")), 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'lightbox_settings'))),
            )
          )
        ),
      ),
      "conditional_filters" => array(
        "" => array(
          "title" => __("This is free version, Conditional filters are available only in premium version", "wd-instagram-feed"),
          "type" => "full",
          "column" => "one",
          "visibility" =>"show",
          "section_name"=>"wdi_conditional_filters",
          "elements" => array(
            array(
              'conditional_filter_enable' => array('name' => 'conditional_filter_enable', 'title' => __('Enable Conditional Filters', "wd-instagram-feed"), 'type' => 'radio', 'valid_options' => array('1' => __('Yes', "wd-instagram-feed"), '0' => __('No', "wd-instagram-feed")), 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'conditional_filters'))),
              'conditional_filter_type' => array('name' => 'conditional_filter_type', 'title' => __('Filter Logic', "wd-instagram-feed"), 'type' => 'select', 'label' => array('text' => '', 'place' => 'after'), 'valid_options' => array('AND' => 'AND', 'OR' => 'OR', 'NOR' => 'NOR'), 'tooltip' => '', 'attr' => array(array('name' => 'tab', 'value' => 'conditional_filters'))),
            )
          )
        )
      ),
      "how_to_publish" => array(
        "" => array(
          "title" => __("How to Publish Feed", "wd-instagram-feed"),
          "type" => "full",
          "column" => "one",
          "visibility" =>"show",
          "section_name"=>"wdi_how_to_publish",
          "elements" => array(
            array(
              'how_to_publish' => array(
                'name' => 'how_to_publish',
                'type' => 'how_to_publish',
                'title' => "",
                'tooltip' => ''
              )
            )
          )
        )
      )
    );
    $return = array('tabs' => $tabs, 'current_id' => $current_id);
    return $return;
  }


public function genarateFeedViews()
{
  ?>
  <div class="wdi_border_wrapper">
          <div id="wdi_layout_section" class="wdi_layout_section display_type_content wdi_section">
              <h3 data-section_name="wdi_layout_section" class="wdi_display_content wdi_section_name wdi_section_close">Select layout</h3>
      <div data-display="table" class="display_type_container wdi_clear_tag wdi_elements">
		<div class="display_type" tab="feed_settings">
		  <div style="text-align:center;padding:2px;"><input type="radio" id="thumbnails" name="feed_type"
															 value="thumbnails"><label for="thumbnails">Thumbnails</label>
		  </div>
		  <label for="thumbnails"><img src="<?php echo plugins_url('../../images/feed_views/thumbnails.png', __FILE__); ?>"></label>
		</div>

		<div class="display_type wdi_tooltip" wdi-tooltip="<?php _e('Available In Premium Version') ?>" tab="feed_settings">
		  <div style="text-align:center;padding:2px;"><input type="radio" disabled id="masonry" name="feed_type"
															 value="masonry"><label for="masonry" class="wdi_pro_only">Masonry</label>
		  </div>
		  <label for="masonry" class="wdi_pro_only_op"><img
			  src="<?php echo plugins_url('../../images/feed_views/masonry.png', __FILE__); ?>"></label>
		</div>

		<div class="display_type wdi_tooltip" wdi-tooltip="<?php _e('Available In Premium Version') ?>" tab="feed_settings">
		  <div style="text-align:center;padding:2px;"><input disabled type="radio" id="blog_style" name="feed_type"
															 value="blog_style"><label for="blog_style"
																					   class="wdi_pro_only">Blog
			  Style</label></div>
		  <label for="blog_style" class="wdi_pro_only_op"><img
			  src="<?php echo plugins_url('../../images/feed_views/blog_style.png', __FILE__); ?>"></label>
		</div>

		<div class="display_type" tab="feed_settings">
		  <div style="text-align:center;padding:2px;"><input type="radio" id="image_browser" name="feed_type"
															 value="image_browser"><label for="image_browser">Image
			  Browser</label></div>
		  <label for="image_browser"><img
			  src="<?php echo plugins_url('../../images/feed_views/image_browser.png', __FILE__); ?>"></label>
		</div>
      </div>
    </div>

    <?php
    }

    public function generateTabs()
    {
      ?>
      <div id="wdi_feed_tabs">
        <div class="wdi_feed_tabs" id="wdi_feed_settings" onclick="wdi_controller.switchFeedTabs('feed_settings');">
          <span class="dashicons dashicons-before dashicons-admin-generic"></span>
          <span class="wdi_feed_tab_title"><?php _e('Feed Settings', "wd-instagram-feed") ?></span>
        </div>
        <div class="wdi_feed_tabs" id="wdi_lightbox_settings" onclick="wdi_controller.switchFeedTabs('lightbox_settings');">
          <span class="dashicons dashicons-before dashicons-admin-page"></span>
          <span class="wdi_feed_tab_title"><?php _e('Lightbox Settings', "wd-instagram-feed") ?></span>
        </div>
        <div class="wdi_feed_tabs" id="wdi_conditional_filters" onclick="wdi_controller.switchFeedTabs('conditional_filters');">
          <span class="dashicons dashicons-before dashicons-filter"></span>
          <span class="wdi_feed_tab_title"><?php _e('Conditional Filters', "wd-instagram-feed") ?></span>
        </div>
        <div class="wdi_feed_tabs" id="wdi_how_to_publish" onclick="wdi_controller.switchFeedTabs('how_to_publish');">
          <span class="dashicons dashicons-before dashicons-editor-help"></span>
          <span class="wdi_feed_tab_title"><?php _e('How To Publish Feed', "wd-instagram-feed") ?></span>
        </div>
      </div>
      <?php
    }

    public function generateForm($current_id = ''){
    if ( $current_id==="" ) {
      $wdi_preview_btn = false;
      $save_btn_name = __('Publish', "wd-instagram-feed");
    }
    else {
      $wdi_preview_btn = true;
      $save_btn_name = __('Update', "wd-instagram-feed");
    }

    $formInfo = $this->getFormElements($current_id);
    $tabs = $formInfo['tabs'];
    $wdi_preview_link = $this->model->get_instagram_preview_post();

    global $wdi_options;
    //for edit
    $edit = false;
    if ($current_id != '') {
      $feed_row = WDILibrary::objectToarray($this->model->get_feed_row($current_id));
      $edit = true;
    }
    else {
      $feed_row = '';
    }
    $feed_row_id = "";
    if(isset($feed_row["id"])){
      $feed_row_id = $feed_row["id"];
    }

    if(isset($feed_row['liked_feed'])) {
      $feed_row['liked_feed'] = 'userhash';
    }

    ?>
    <div class="update-nag wdi_help_bar_wrap">
      <span class="wdi_help_bar_text">
        <?php _e('Here You Can Change Feed Parameters.', "wd-instagram-feed"); ?>
        <a style="color: #5CAEBD; text-decoration: none;border-bottom: 1px dotted;" class="wdi_hb_t_link" target="_blank"
           href="https://help.10web.io/hc/en-us/articles/360016497251-Creating-Instagram-Feed"><?php _e('Read More in User Guide', "wd-instagram-feed"); ?></a>
      </span>
      <div class="wdi_hb_buy_pro">
        <a class="wdi_support_link" href="https://wordpress.org/support/plugin/wd-instagram-feed" target="_blank">
          <img src="<?php echo WDI_URL; ?>/images/i_support.png" >
          <?php _e("Support Forum", "gmwd"); ?>
        </a>
        <a class="wdi_update_pro_link" target="_blank" href="https://web-dorado.com/files/fromInstagramFeedWD.php">
          <?php _e("UPGRADE TO PREMIUM VERSION", "wd-instagram-feed"); ?>
        </a>
      </div>
    </div>
    <div class="wrap">
      <h2 class="wdi-h2-message"></h2>
      <form method="post" action="admin.php?page=wdi_feeds" id='wdi_save_feed'>
        <div class="wdi-page-header">
          <h1 class="wp-heading-inline"><?php echo __('Feed Title', "wd-instagram-feed")?></h1>
          <input id="WDI_feed_name" class="WDI_title_input" name="wdi_feed_settings[feed_name]"  type="text" value="<?php echo ($edit == true && isset($feed_row['feed_name'])) ? $feed_row['feed_name'] : "Sample Feed";?>">
          <div class="wdi_buttons">
            <div id="wdi_save_feed_apply" class="button button-primary"><?php echo $save_btn_name;?></div>
            <button class="button preview-button button-large"<?php if (!$wdi_preview_btn) echo ' disabled="disabled"' ?> <?php echo ($wdi_preview_btn) ? 'onclick="window.open(\''. add_query_arg( array('feed_id' => $feed_row_id), $wdi_preview_link ) .'\', \'_blank\'); return false;"' : ''; ?>><?php  echo __('Preview', "wd-instagram-feed");?></button>
          </div>
        </div>
        <?php $this->generateTabs(); ?>
        <?php $this->genarateFeedViews(); ?>
        <?php wp_nonce_field('nonce_wd', 'nonce_wd'); ?>
        <input type="hidden" id="wdi_feed_type" name='<?php echo WDI_FSN . '[feed_type]' ?>'>
        <input type="hidden" id="task" name='task'>
        <input type="hidden" id="wdi_feed_thumb" name="<?php echo WDI_FSN . '[feed_thumb]' ?>">
        <input type="hidden" id="wdi_access_token" name="access_token"
               value="<?php echo $wdi_options['wdi_access_token']; ?>">
        <input type="hidden" id="wdi_add_or_edit" name="add_or_edit" value="<?php echo $current_id; ?>">
        <input type="hidden" id="wdi_thumb_user"
               value="<?php echo isset($feed_row['thumb_user']) ? $feed_row['thumb_user'] : $wdi_options['wdi_user_name']; ?>">
        <input type="hidden" id="wdi_default_user" value="<?php echo $wdi_options['wdi_user_name']; ?>">
        <input type="hidden" id="wdi_default_user_id" value="<?php echo $wdi_options['wdi_user_id']; ?>">
        <input type="hidden" name="<?php echo WDI_FSN . '[published]' ?>"
               value="<?php echo isset($feed_row['published']) ? $feed_row['published'] : '1'; ?>">
        <input type="hidden" id="wdi_current_id" name="current_id" value=''>
        <input type="hidden" id="wdi_refresh_tab" name="wdi_refresh_tab">
        <div class="form-table">
          <?php foreach ($tabs as $key => $tab) { ?>
          <div id="<?php echo $key; ?>_tab" class="wdi_tab" style="<?php echo $key == "feed_settings" ? "display:block;" : ""; ?>">
            <?php foreach ($tab as $key => $section) {
              $section_class = "wdi_section_open";
              if(isset($section["visibility"]) && $section["visibility"]==="show"){
                $section_class = "wdi_section_close";
              }
			     ?>
				<div id="<?php echo $key; ?>_section" class="wdi_section <?php echo $section["type"]; ?> <?php echo $section["column"]; ?>">
                              <!--<span class="wdi_section_button <?php /*echo $section_class;*/?>"></span>-->
                              <h3 data-section_name="<?php echo $section['section_name']?>" class="wdi_section_name  <?php echo $section_class;?>"><?php echo $section["title"];  ?></h3>
					<div class="wdi_elements wdi_clear_tag">
					<?php foreach ($section["elements"] as $elements) { ?>
						<div class="section_col">
						<?php  foreach ($elements as $key => $element) {
						  if ($element['name'] == 'conditional_filter_enable') { ?>
							  <div id="wdi-conditional-filters-ui" class="wdi_demo_img">
								<div class="wdi-pro-overlay"><img src="<?php echo WDI_URL . '/demo_images/filters.png'; ?>" alt=""></div>
							  </div><?php
							  continue;
						  }

						  if ($element['name'] == 'conditional_filter_type') {
							  continue;
						  }

						  if (isset($element['status'])) {
							  if ($element['status'] == 'disabled') {
								continue;
							  }
						  } ?>

						 <div class="wdi_element wdi_element_name_<?php echo $element['name'] ; ?>">
							<div class="wdi_element_title">
								<span class="wdi_settings_link"  ><?php echo $element['title']; ?></span>
							</div>
							<div class="wdi_element_content">

							  <?php $this->buildField($element, $feed_row); ?>
							  <!-- FEED USERS -->
							  <?php if ($element['name'] == 'feed_users'): ?>
								<input type="text" id="wdi_add_user_ajax_input">
								<div id="wdi_add_user_ajax" class="button"><?php _e('Add', "wd-instagram-feed"); ?></div>
								<div id="wdi_feed_users">
								  <?php $this->display_feed_users($feed_row); ?>
								</div>
							  <?php endif; ?>
							  <!-- END FEED USERS -->
							  <?php
							  if($element['tooltip'] && $element['tooltip']!=""){
								echo "<p class='wdi_about_filed'>".$element['tooltip']."</p>";
							  }
							  ?>
							</div>
						 </div>
					   <?php } ?>
					  </div>
					<?php } ?>
					</div>
				 </div>
			   <?php } ?>
			</div><?php
          }
          ?>
        </div>
      </form>
    </div>
  </div>
  <?php
}
  private function buildField($element, $feed_row = '')
  {
    require_once(WDI_DIR . '/framework/WDI_form_builder.php');
    $element['defaults'] = $this->model->wdi_get_feed_defaults();
    $element['CONST'] = WDI_FSN;
    $builder = new WDI_form_builder();
    switch ($element['type']) {
      case 'input': {
        $builder->input($element, $feed_row);
        break;
      }
      case 'select': {
        $builder->select($element, $feed_row);
        break;
      }
      case 'radio': {
        $builder->radio($element, $feed_row);
        break;
      }
      case 'checkbox': {
        $builder->checkbox($element, $feed_row);
        break;
      }
      case 'how_to_publish': {
        $builder->how_to_publish($element, $feed_row);
        break;
      }
    }
  }


  public function display_feed_users($feed_row){
    global $wdi_options;

    $users = isset($feed_row['feed_users']) ? $feed_row['feed_users'] : "";
    $users = json_decode($users);

    if ($users === null) {
      $users = array();
    }

    $token = WDILibrary::get_user_access_token($users);
    ?>
    <script>
      jQuery(document).ready(function ()
      {

          var users_list = JSON.parse(wdi_options.wdi_authenticated_users_list);
          if (typeof users_list !== 'object') {
              users_list = {};
          }

          var usersnames = [wdi_options.wdi_user_name];
          for(var i in users_list){
              usersnames.push(users_list[i].user_name);
          }

        wdi_controller.users_list = users_list;
        wdi_controller.usersnames = usersnames;
        wdi_controller.instagram = new WDIInstagram();
        wdi_controller.feed_users = [];
        wdi_controller.instagram.addToken(<?php echo '"' . $token . '"'; ?>);

        wdi_controller.updateFeaturedImageSelect(<?php echo '"' . $wdi_options['wdi_user_name'] . '"'; ?>, 'add', 'selected');

        <?php foreach ($users as $user) : ?>
        wdi_controller.makeInstagramUserRequest(<?php echo '"' . $user->username . '"'?>, true);
        <?php endforeach; ?>
      });
    </script>
    <?php

  }


}





