<style>
#post-social-1{
	background-image: url('<?php echo WEBLIZAR_PINIT_PLUGIN_URL.'img/image-8.jpg'; ?>');
}
#post-social-2{
	background-image: url('<?php echo WEBLIZAR_PINIT_PLUGIN_URL.'img/image-1.jpg'; ?>');
}
#post-social-3{
	background-image: url('<?php echo WEBLIZAR_PINIT_PLUGIN_URL.'img/image-2.jpg'; ?>');
}
#post-social-4{
	background-image: url('<?php echo WEBLIZAR_PINIT_PLUGIN_URL.'img/image-3.jpg'; ?>');
}
#post-social-5{
	
	background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url('<?php echo WEBLIZAR_PINIT_PLUGIN_URL.'img/pattern-1.png'; ?>') left top repeat, url('<?php echo WEBLIZAR_PINIT_PLUGIN_URL.'img/bg1.jpg'; ?>') center center fixed;
}
}
#post-social-6{
	background-image: url('<?php echo WEBLIZAR_PINIT_PLUGIN_URL.'img/image-5.jpg'; ?>');
}
#post-social-7{
	background-image: url('<?php echo WEBLIZAR_PINIT_PLUGIN_URL.'img/image-6.jpg'; ?>');
}
#post-social-8{
	background-image: url('<?php echo WEBLIZAR_PINIT_PLUGIN_URL.'img/image-7.jpg'; ?>');
}

::-webkit-scrollbar {
	width: 12px;
}
 
::-webkit-scrollbar-track {
	outline: 0px solid slategrey;
	 background: transparent;
	border-radius: 0px;
	border:0px
}
 
::-webkit-scrollbar-thumb {
	border-radius: 0px;
	background: rgba(71,204,232,0.9);
	border:0px;
	outline: 0px solid slategrey;
}
a:focus {
	-webkit-box-shadow: none !important;
	box-shadow:none !important;
}
.wp-color-result{
	height:24px;
}
.wp-color-result:hover {
	text-underline:none;
}
	
.page-wrapper {
	border-left: 1px solid #19191d;
	margin: 0 0 0 250px;
	padding: 15px 15px;
	position: inherit;
}
</style>
<div id="wrapper">
	<!-- Navigation -->
	<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
		<div class="navbar-header">
			<a class="sidebar-toggle hidden-xs" href="javascript:void(0);"><i class="fa fa-bars fa-2x"></i></a>
			<a class="navbar-brand coming-soon-admin-title" href="#">Pinterest Pin It Button On Image Hover And In Post</a>
		</div>

		<ul class="nav navbar-top-links navbar-right coming-soon-top">
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					
				</a>
			</li>
		</ul>

		<div class="navbar-default sidebar" role="navigation">
			<div class="sidebar-nav navbar-collapse">
				<ul class="nav " id="side-menu">
					<li class="sidebar-profile text-center">
						<span class="sidebar-profile-picture">
							<img src="<?php echo esc_url(WEBLIZAR_PINIT_PLUGIN_URL.'img/photo.jpg' ); ?>" alt="Profile Picture"/>
						</span>
						<p class="sidebar-profile-description">Powered By</p>
						<h3 class="sidebar-profile-name">Weblizar</h3>
						<style>
						.acl-rate-us  span.dashicons{
						width: 30px;
						height: 30px;
						}
						.acl-rate-us  span.dashicons-star-filled:before {
						content: "\f155";
						font-size: 30px;
						}
						.acl-rate-us {
							color : #FBD229 !important;
							padding-top:5px !important;
						}
						.acl-rate{
							color:#fff;
							margin-top:10px !important;
							margin-bottom:5px !important;
						}
						</style>
						<h5 style="color:#fff" class="acl-rate">Show Us Some Love (Rate Us)</h5>
						<a class="acl-rate-us" style="text-align:center; text-decoration: none;font:normal 30px/l;" href="https://wordpress.org/plugins/pinterest-pin-it-button-on-image-hover-and-post/" target="_blank">
							<span class="dashicons dashicons-star-filled"></span>
							<span class="dashicons dashicons-star-filled"></span>
							<span class="dashicons dashicons-star-filled"></span>
							<span class="dashicons dashicons-star-filled"></span>
							<span class="dashicons dashicons-star-filled"></span>
						</a>
					</li>
					
				</ul>
			</div>
		</div>
	</nav>
	  
	<div class="page-wrapper ui-tabs-panel active" id="option-ui-id-1">	
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="margin-none" style="font-size: 28px;">
					<?php _e('Pin It Button Settings', WEBLIZAR_PINIT_TD); ?>
				</h4>
				<p class="margin-none text-s text-muted"><?php _e('Configure Plugin Settings Here', WEBLIZAR_PINIT_TD); ?></p>
			</div>
			<div class="panel-body">
				<!-- Nav tabs -->
				<ul class="nav nav-pills">
					<li class="active text-m"><a data-toggle="tab" href="#pinit-settings-tab"><strong><?php _e('Settings Tab', WEBLIZAR_PINIT_TD); ?></strong> <span class="pull-right close-conversation margin-left "><i class="fa fa-cog"></i></span></a></li>
					<li class=""><a data-toggle="tab" href="#plug-recom"><strong><?php _e('Plugin Recommendation', WEBLIZAR_PINIT_TD); ?></strong> <span class="pull-right close-conversation margin-left "><i class="fa fa-plug"></i></span></a></li>
					<li class=""><a data-toggle="tab" href="#need-help-tab"><strong><?php _e('Need Help', WEBLIZAR_PINIT_TD); ?></strong> <span class="pull-right close-conversation margin-left "><i class="fa fa-exclamation-circle"></i></span></a></li>
					<!--<li class=""><a data-toggle="tab" href="#weblizar-tab"><strong>Weblizar</strong>  <span class="pull-right close-conversation margin-left "><i class="fa fa-wordpress"></i></span></a></li>-->
				</ul>
				
				<!-- Tab panes -->
				<div class="tab-content">
				
					<!-- Plugin Settings Tab -->
					<div id="pinit-settings-tab" class="tab-pane fade active in">
						<hr>
						<div>
							<p><?php _e('Show Pin It Button', WEBLIZAR_PINIT_TD); ?> <strong><?php _e('In Post', WEBLIZAR_PINIT_TD); ?></strong></p>
							<?php
							$PinItPost = get_option("WL_Enable_Pinit_Post"); 
							if(!isset($PinItPost)) {
								$PinItPost = 1;
							}
							?>
							<input id="pinitpost" name="pinitpost" type="radio" value="1" <?php if($PinItPost == 1) echo "checked=checked"; ?>> <?php _e('Yes', WEBLIZAR_PINIT_TD); ?> 
							<input id="pinitpost" name="pinitpost" type="radio" value="0" <?php if($PinItPost == 0) echo "checked=checked"; ?>> <?php _e('No', WEBLIZAR_PINIT_TD); ?>
						</div>
						<hr>
						
						<div>
							<p><?php _e('Show Pin It Button', WEBLIZAR_PINIT_TD); ?> <strong><?php _e('In Page', WEBLIZAR_PINIT_TD); ?></strong></p>
							<?php
							$PinItPage = get_option("WL_Enable_Pinit_Page");
							if(!isset($PinItPage)) {
								$PinItPage = 1;
							}
							?>
							<input id="pinitpage" name="pinitpage" type="radio" value="1" <?php if($PinItPage == 1) echo "checked=checked"; ?>> <?php _e('Yes', WEBLIZAR_PINIT_TD); ?> 
							<input id="pinitpage" name="pinitpage" type="radio" value="0" <?php if($PinItPage == 0) echo "checked=checked"; ?>> <?php _e('No', WEBLIZAR_PINIT_TD); ?>
						</div>
						<hr>
						
						<div>
							<p><?php _e('Show Pin It Button', WEBLIZAR_PINIT_TD); ?> <strong><?php _e('On Image Hover', WEBLIZAR_PINIT_TD); ?></strong></p>
							<?php
							 $PinItOnHover = get_option("WL_Pinit_Btn_On_Hover");
							if(!isset($PinItOnHover)) {
								$PinItOnHover = "true";
							}
							?>
							<input id="pinitonhover" name="pinitonhover" type="radio" value="true" <?php if($PinItOnHover == "true") echo "checked=checked"; ?>> <?php _e('Yes', WEBLIZAR_PINIT_TD); ?> 
							<input id="pinitonhover" name="pinitonhover" type="radio" value="false" <?php if($PinItOnHover == "false") echo "checked=checked"; ?>> <?php _e('No', WEBLIZAR_PINIT_TD); ?>
						</div>
						<hr>
						
						<div>
							<p><?php _e('Show Pin It Button', WEBLIZAR_PINIT_TD); ?> <strong><?php _e('On Mobile / Portable Devices', WEBLIZAR_PINIT_TD); ?></strong></p>
							<?php
							$PinItStatus = get_option("WL_Mobile_Status");
							if(!isset($PinItStatus)) {
								$PinItStatus = 1;
							}
							?>
							<input id="pinitstatus" name="pinitstatus" type="radio" value="1" <?php if($PinItStatus == 1) echo "checked=checked"; ?>> <?php _e('Yes', WEBLIZAR_PINIT_TD); ?> 
							<input id="pinitstatus" name="pinitstatus" type="radio" value="0" <?php if($PinItStatus == 0) echo "checked=checked"; ?>> <?php _e('No', WEBLIZAR_PINIT_TD); ?>
						</div>
						<hr>
						
						<!-- <div>
							<p>Pin It Button Design</p>
							<?php
							/* $PinItDesign	= get_option("WL_Pinit_Btn_Design");
							if($PinItDesign == "") {
								$PinItDesign = "rectangle";
							} */
							?>
							<select id="pinitdesign" name="pinitdesign">
								<option value="rectangle" <?php //if($PinItDesign == "rectangle") echo "selected=selected"; ?>>Rectangle</option>
								<option value="circular" <?php //if($PinItDesign == "circular") echo "selected=selected"; ?>>Circular</option>
							</select>
						</div>
						<hr> -->
						
						<div>
							<p><?php _e('Pin It Button Color (On Image Hover)', WEBLIZAR_PINIT_TD); ?></p>
							<?php
							$PinItColor	= get_option("WL_Pinit_Btn_Color");
							if(!isset($PinItColor)) {
								$PinItColor = "red";
							}
							?>
							<select id="pinitcolor" name="pinitcolor">
								<option value="red" <?php if($PinItColor == "red") echo "selected=selected"; ?>>Red</option>
								<option value="gray" <?php if($PinItColor == "gray") echo "selected=selected"; ?>>Gray</option>
								<option value="white" <?php if($PinItColor == "white") echo "selected=selected"; ?>>White</option>
							</select>
						</div>
						<hr>
						
						<div>
							<p><?php _e('Pin It Button Size (On Image Hover)', WEBLIZAR_PINIT_TD); ?></p>
							<?php
							$PinItSize = get_option("WL_Pinit_Btn_Size");
							if(!isset($PinItSize)) {
								$PinItSize = "small";
							}
							?>
							<select id="pinitsize" name="pinitsize">
								<option value="small" <?php if($PinItSize == "small") echo "selected=selected"; ?>><?php _e('Small', WEBLIZAR_PINIT_TD); ?></option>
								<option value="large" <?php if($PinItSize == "large") echo "selected=selected"; ?>><?php _e('Large', WEBLIZAR_PINIT_TD); ?></option>
							</select>
						</div>
						<hr>
						
						<button id="pinitsave" name="pinitsave" class="button button-primary button-hero" type="button" onclick="return SaveSettings();"><strong><i class="fa fa-save"></i>&nbsp;&nbsp;<?php _e('Settings', WEBLIZAR_PINIT_TD); ?></strong></button>
						<p id="loading" name="loading" style="display: none;"><i class="fa fa-cog fa-spin fa-5x"></i></p>
					</div>
					
					<!-- Plugin Recommendation Tab -->
					<div id="plug-recom" class="tab-pane fade">
						<?php  require_once("recommendations.php"); ?>
					</div>
					
					<!-- Need Help Tab -->
					<div id="need-help-tab" class="tab-pane fade">
						<h4>Need Help Tab</h4>
						<hr>
						<p>Simply after install and activate plugin go on plugin's "Pinterest PinIt Button" admin menu page.</p>
						<p>Select the Settings tab and configure Pin It Button settings according to you.</p>
						<p>&nbsp;</p>
						<h4>Plugin allows to configure following settings</h4>
						<p>&nbsp;</p>
						<p><strong>1. Enable Pin It Button In Post -</strong> This settings show Pinterest Pin It button after the post content. So, you can easily pined all your post content to your Pinterest Bord.</p>
						<p><strong>2. Enable Pin It Button in Page -</strong> This settings show Pinterest Pin It button after the Page content. So, you can easily pined all your Page content to your Pinterest Bord.</p>
						<p><strong>3. Show Pin It Button On Image Hover -</strong> Setting shows Pin It Button on each your blog Post/Page image when your hover mouse on any image.</p>
						<p><strong>4. Show Pin It Button On Mobile -</strong> Settings allows to enable/disable pin button appearing on site if uer visit site using mobile devices.</p>
						<p><strong>5. Pin It Button Color (On Image Hover) -</strong> This settings work if Image hover setting is enable. You can change three various colors Red, Gray, White which is best suites to your site.</p>
						<p><strong>6. Pin It Button Size (On Image Hover) -</strong> This settings work if Image hover setting is enable. Through that setting you can show small or large pin it button on image.</p>
						<hr>
					</div>
					<div id="weblizar-tab" class="tab-pane fade">
						<h4>Weblizar </h4>
						<p></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	<div class="page-wrapper ui-tabs-panel deactive" id="option-ui-id-2">	
	  Plugin Help Here
	</div>
	<div class="page-wrapper ui-tabs-panel deactive" id="option-ui-id-3">	
	  Premium Product Details Here
	</div>
</div>
<script>
function SaveSettings(){
	jQuery('#pinitsave').hide();
	jQuery('#loading').show();
	jQuery.ajax({
		type: "POST",
		url: ajaxurl,
		data: { action: "save_pinit", 
			PinItPost: jQuery("input[name=pinitpost]:radio:checked").val(),
			PinItPage: jQuery("input[name=pinitpage]:radio:checked").val(),
			PinItOnHover: jQuery("input[name=pinitonhover]:radio:checked").val(),
			PinItStatus: jQuery("input[name=pinitstatus]:radio:checked").val(),
			PinItColor: jQuery("select#pinitcolor").val(),
			PinItDesign: jQuery("select#pinitdesign").val(),
			PinItSize: jQuery("select#pinitsize").val(),			
		},
		dataType: 'html',
		complete : function() {  },
		success: function(data) {
			jQuery('#loading').hide();
			jQuery('#pinitsave').show();
		}
	});
}
</script>