<?php

class WDIViewThumbnails_view
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

    $this->pass_feed_data_to_js();
    $feed_row = $this->model->get_feed_row();
    $wdi_feed_counter = $this->model->wdi_feed_counter;
    $this->add_theme_styles();
    $this->generate_feed_styles($feed_row);
    $style = $this->model->theme_row;
    $container_class = 'wdi_feed_theme_' . '1' . ' wdi_feed_thumbnail_' . '1';
    $wdi_data_ajax = defined('DOING_AJAX') && DOING_AJAX ? 'data-wdi_ajax=1' : '';

    ?>

    <div id="wdi_feed_<?php echo $wdi_feed_counter ?>" class="wdi_feed_main_container wdi_layout_th <?php echo $container_class; ?>" <?php echo $wdi_data_ajax; ?> >
      <?php wdi_feed_frontend_messages();?>
      <div id="wdi_spider_popup_loading_<?php echo $wdi_feed_counter ?>" class="wdi_spider_popup_loading"></div>
      <div id="wdi_spider_popup_overlay_<?php echo $wdi_feed_counter ?>" class="wdi_spider_popup_overlay"
           onclick="wdi_spider_destroypopup(1000)"></div>
      <div class="wdi_feed_container">
        <div class="wdi_feed_info">
          <div id="wdi_feed_<?php echo $wdi_feed_counter ?>_header" class='wdi_feed_header'></div>
          <div id="wdi_feed_<?php echo $wdi_feed_counter ?>_users" class='wdi_feed_users'></div>
        </div>
        <?php
        if ($feed_row['feed_display_view'] === 'pagination' && $style['pagination_position_vert'] === 'top') {
          ?>
          <div id="wdi_pagination" class="wdi_pagination">
          <div class="wdi_pagination_container"><i id="wdi_first_page"
                                                   title="<?php echo __('First Page', "wd-instagram-feed") ?>"
                                                   class="fa fa-step-backward wdi_pagination_ctrl wdi_disabled"></i><i
              id="wdi_prev" title="<?php echo __('Previous Page', "wd-instagram-feed") ?>"
              class="fa fa-arrow-left wdi_pagination_ctrl"></i><i id="wdi_current_page" class="wdi_pagination_ctrl"
                                                                  style="font-style:normal">1</i><i id="wdi_next"
                                                                                                    title="<?php echo __('Next Page', "wd-instagram-feed") ?>"
                                                                                                    class="fa fa-arrow-right wdi_pagination_ctrl"></i>
            <i id="wdi_last_page" title="<?php echo __('Last Page', "wd-instagram-feed") ?>"
               class="fa fa-step-forward wdi_pagination_ctrl wdi_disabled"></i></div></div> <?php
        }
        ?>
        <div class="wdi_feed_wrapper <?php echo 'wdi_col_' . $feed_row['number_of_columns'] ?>"
             wdi-res='<?php echo 'wdi_col_' . $feed_row['number_of_columns'] ?>'></div>
        <div class="wdi_clear"></div>

        <?php switch ($feed_row['feed_display_view']) {
          case 'load_more_btn': {
            ?>
            <div class="wdi_load_more wdi_hidden">
              <div class="wdi_load_more_container">
                <div class="wdi_load_more_wrap">
                  <div class="wdi_load_more_wrap_inner">
                    <div class="wdi_load_more_text"><?php echo __('Load More', "wd-instagram-feed"); ?></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="wdi_spinner ">
              <div class="wdi_spinner_container">
                <div class="wdi_spinner_wrap">
                  <div class="wdi_spinner_wrap_inner"><i class="wdi_load_more_spinner fa fa-spinner"></i></div>
                </div>
              </div>
            </div>
            <?php
            break;
          }
          case 'pagination': {
            if ($style['pagination_position_vert'] === 'bottom') {
              ?>
              <div id="wdi_pagination" class="wdi_pagination">
              <div class="wdi_pagination_container"><i id="wdi_first_page"
                                                       title="<?php echo __('First Page', "wd-instagram-feed") ?>"
                                                       class="fa fa-step-backward wdi_disabled wdi_pagination_ctrl"></i><i
                  id="wdi_prev" title="<?php echo __('Previous Page', "wd-instagram-feed") ?>"
                  class="fa fa-arrow-left wdi_pagination_ctrl"></i><i id="wdi_current_page" class="wdi_pagination_ctrl"
                                                                      style="font-style:normal">1</i><i id="wdi_next"
                                                                                                        title="<?php echo __('Next Page', "wd-instagram-feed") ?>"
                                                                                                        class="fa fa-arrow-right wdi_pagination_ctrl"></i>
                <i id="wdi_last_page" title="<?php echo __('Last Page', "wd-instagram-feed") ?>"
                   class="fa fa-step-forward wdi_pagination_ctrl wdi_disabled"></i></div></div> <?php
            }

            break;
          }
          case 'infinite_scroll': {
            ?>
            <div id="wdi_infinite_scroll" class="wdi_infinite_scroll"></div> <?php
          }
        }
        ?>
      </div>
        <div class="wdi_front_overlay"></div>
    </div>
    <?php

  }

  public function pass_feed_data_to_js()
  {
    global $wdi_options;
    $feed_row = $this->model->get_feed_row();

    $users = isset($feed_row['feed_users']) ? json_decode($feed_row['feed_users']) : null;
    if($users === null) {
      $users = array();
    }

    $feed_row = $this->model->get_feed_row();
    $wdi_feed_counter = $this->model->wdi_feed_counter;
    $feed_row['access_token'] = WDILibrary::get_user_access_token($users);
    $feed_row['wdi_feed_counter'] = $wdi_feed_counter;


    wp_localize_script("wdi_frontend", 'wdi_feed_' . $wdi_feed_counter, array('feed_row' => $feed_row, 'data' => array(), 'usersData' => array(), 'dataCount' => 0));
    wp_localize_script("wdi_frontend", 'wdi_theme_' . $this->model->theme_row['id'], $this->model->theme_row);
    wp_localize_script("wdi_frontend", 'wdi_front', array('feed_counter' => $wdi_feed_counter));

    if(WDILibrary::is_ajax() || WDILibrary::elementor_is_active()) {
      wdi_load_frontend_scripts_ajax();
    }
  }

  private function add_theme_styles(){

    if(WDILibrary::is_ajax() || WDILibrary::elementor_is_active()) {
      $style_tag = "<link rel='stylesheet' id='%s'  href='%s' type='text/css' media='all' />";
      echo sprintf($style_tag, 'wdi_default_theme', WDI_URL . '/css/default_theme.css' . '?ver=' . WDI_VERSION);
    } else {
      wp_enqueue_style("wdi_default_theme",WDI_URL . '/css/default_theme.css',array(),WDI_VERSION);
    }

    /*THIS METHOD FOR PAID VERSION*/
  }

  /**
   * @param $generator WDI_generate_styles
   * @return boolean
   * */
  private function load_theme_css_file($generator){
    /*THIS METHOD FOR PAID VERSION*/
    return false;
  }

  public function generate_feed_styles($feed_row)
  {
    $style = $this->model->theme_row;
    $wdi_feed_counter = $this->model->wdi_feed_counter;
    $colNum = (100 / $feed_row['number_of_columns']);
    ?>
    <style type="text/css">

      #wdi_feed_<?php echo $wdi_feed_counter?> .wdi_feed_header {
        display: <?php echo ($feed_row['display_header']=='1')? 'block' : 'none'?>; /*if display-header is true display:block*/
      }

      <?php

      if($feed_row['display_user_post_follow_number'] == '1'){
        $header_text_padding =(intval($style['user_img_width']) - intval($style['users_text_font_size']))/4;
      }else{
        $header_text_padding =(intval($style['user_img_width']) - intval($style['users_text_font_size']))/2;
      }
      ?>
      #wdi_feed_<?php echo $wdi_feed_counter?> .wdi_header_user_text {
        padding-top: <?php echo $header_text_padding; ?>px;

      }

      #wdi_feed_<?php echo $wdi_feed_counter?> .wdi_header_user_text h3 {
        margin-top: <?php echo $header_text_padding ?>px;
      }

      #wdi_feed_<?php echo $wdi_feed_counter?> .wdi_media_info {
        display: <?php echo ($feed_row['display_user_post_follow_number'] == '1') ? 'block' : 'none'; ?>
      }

      #wdi_feed_<?php echo $wdi_feed_counter?> .wdi_feed_item {
        width: <?php echo $colNum.'%'?>; /*thumbnail_size*/
      }


      <?php  if($feed_row['disable_mobile_layout']=="0"){
        ?>
      @media screen and (min-width: 800px) and (max-width: 1024px) {
        #wdi_feed_<?php echo $wdi_feed_counter?> .wdi_feed_item {
          width: <?php echo ($colNum<33.33) ? '33.333333333333%' : $colNum.'%'?>; /*thumbnail_size*/
          margin: 0;
          display: inline-block;
          vertical-align: top;
          overflow: hidden;
        }

        #wdi_feed_<?php echo $wdi_feed_counter?> .wdi_feed_container {
          width: 100%;
          margin: 0 auto;
          background-color: <?php echo $style['feed_container_bg_color']?>; /*feed_container_bg_color*/
        }

      }

      @media screen and (min-width: 480px) and (max-width: 800px) {
        #wdi_feed_<?php echo $wdi_feed_counter?> .wdi_feed_item {
          width: <?php echo ($colNum<50) ? '50%' : $colNum.'%'?>; /*thumbnail_size*/
          margin: 0;
          display: inline-block;
          vertical-align: top;
          overflow: hidden;
        }

        #wdi_feed_<?php echo $wdi_feed_counter?> .wdi_feed_container {
          width: 100%;
          margin: 0 auto;
          background-color: <?php echo $style['feed_container_bg_color']?>; /*feed_container_bg_color*/
        }
      }

      @media screen and (max-width: 480px) {
        #wdi_feed_<?php echo $wdi_feed_counter?> .wdi_feed_item {
          width: <?php echo ($colNum<100) ? '100%' : $colNum.'%'?>; /*thumbnail_size*/
          margin: 0;
          display: inline-block;
          vertical-align: top;
          overflow: hidden;
        }

        #wdi_feed_<?php echo $wdi_feed_counter?> .wdi_feed_container {
          width: 100%;
          margin: 0 auto;
          background-color: <?php echo $style['feed_container_bg_color']?>; /*feed_container_bg_color*/
        }
      }

      <?php } ?>
    </style>
    <?php
  }


}

?>