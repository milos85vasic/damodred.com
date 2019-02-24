<?php
class WDIViewSettings_wdi{
////////////////////////////////////////////////////////////////////////////////////////
// Variables                                                                          //
////////////////////////////////////////////////////////////////////////////////////////
private $model;
////////////////////////////////////////////////////////////////////////////////////////
// Constructor and Destructor                                                         //
////////////////////////////////////////////////////////////////////////////////////////
	public function __construct($model){
		$this->model = $model;
	}
////////////////////////////////////////////////////////////////////////////////////////
// Public Methods                                                                     //
////////////////////////////////////////////////////////////////////////////////////////
	public function display(){
		global $wdi_options;
		require_once(WDI_DIR . '/framework/WDI_admin_view.php');
		if(isset($_GET['access_token'])) {

			/*dismiss api update notice*/
			$admin_notices_option = get_option('wdi_admin_notice', array());
			$admin_notices_option['api_update_token_reset'] = array(
					'start' => current_time("n/j/Y"),
					'int'   => 0,
					'dismissed' => 1,
				);
			update_option('wdi_admin_notice', $admin_notices_option);

			?>
			<script>
			  wdi_controller.instagram = new WDIInstagram();
			  if(wdi_controller.getCookie('wdi_autofill') != 'false'){
			  	wdi_controller.apiRedirected();
			  	document.cookie = "wdi_autofill=false";
			  	jQuery(document).ready(function(){
			  		jQuery(document).on('wdi_settings_filled',function(){
			  			jQuery('#submit').trigger('click');
			  		})
			  	});
			  	
			  }
			</script>
			<?php
		} 
		?>
    <div class="update-nag wdi_help_bar_wrap">
      <span class="wdi_help_bar_text">
        <?php _e('This section allows you to set API parameters.', "wd-instagram-feed"); ?>
        <a style="color: #5CAEBD; text-decoration: none;border-bottom: 1px dotted;" class="wdi_hb_t_link" target="_blank"
           href="https://help.10web.io/hc/en-us/articles/360016277532-Configuring-Instagram-Access-Token"><?php _e('Read More in User Guide', "wd-instagram-feed"); ?></a>
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


		<h1 id="settings_wdi_title"><?php _e('Instagram Settings', "wd-instagram-feed"); ?></h1>
		<form method="post" action="options.php" class="wdi_settings_form">
			<input type="hidden"id="wdi_user_id" name="<?php echo WDI_OPT.'[wdi_user_id]' ?>">
            <?php settings_fields('wdi_all_settings'); ?>
            <?php do_settings_sections('settings_wdi'); ?>
							<div id="wdi_options_page_buttons_wrapper">
        <div id="wdi_reset_access_token"
             class="button button-secondary"><?php _e("Reset Primary Access Token", "wd-instagram-feed") ?></div>
							 <?php submit_button(); ?>
							</div>
		</form>
        <style>
            <?php if((!isset($wdi_options['wdi_access_token']) || empty($wdi_options['wdi_access_token'])) && empty($wdi_options['fb_token'])){ ?>
            body.instagram-feed_page_wdi_settings table:nth-of-type(2) {
                display: none;
            }

            body.toplevel_page_wdi_settings table:nth-of-type(2) {
                display: none;
            }

            body.instagram-feed_page_wdi_settings table:nth-of-type(3) {
                display: none;
            }

            body.toplevel_page_wdi_settings table:nth-of-type(3) {
                display: none;
            }

            <?php } ?>
        </style>
	            <script>
		 	        jQuery(document).ready(function(){

                jQuery(".wdi_settings_form").submit(function () {
                  jQuery.ajax({
                    type: "POST",
                    url: wdi_ajax.ajax_url,
                    dataType:"json",
                    data: {
                      wdi_nonce:wdi_ajax.wdi_nonce,
                      action:"wdi_set_reset_cache"
                    },
                    success: function(data){

                    }
                  });
                });

		 	            jQuery('#wdi_reset_access_token').on('click',function(){
		 	                if(confirm("<?php _e('Are you sure that you want to reset access token and username, after resetting it you will need to log in with Instagram again for using plugin','wd-instagram-feed')?>")){
                          jQuery.ajax({
                          type: "POST",
                          url: wdi_ajax.ajax_url,
                          dataType:"json",
                          data: {
                            wdi_nonce:wdi_ajax.wdi_nonce,
                            action:"wdi_set_reset_cache"
                          },
                          success: function(data){

                          }
                        });


		 	                    jQuery('#wdi_access_token').attr('value','');
		 	                    jQuery('#wdi_user_name').attr('value','');
                                jQuery('#business_account_id').attr('value', '');
                                jQuery('#fb_token').attr('value', '');
                                document.cookie = "wdi_autofill=false";
                          <?php if(get_option("wdi_token_error_flag") === "1"):?>
                          jQuery.ajax({
                            type: "POST",
                            url: "<?php echo admin_url('admin-ajax.php');?>",
                            dataType: 'json',
                            data: {
                              action: "wdi_delete_token_flag",
                              wdi_token_flag_nonce: "<?php echo wp_create_nonce('');?>",
                            },
                            success: function(data){

                            }
                          });
                          <?php endif; ?>
		 	                    jQuery(this).parent().parent().find('#submit').trigger('click');
		 	                }
		 	            });
		 	        });
	         	</script>
		<?php
	}
}