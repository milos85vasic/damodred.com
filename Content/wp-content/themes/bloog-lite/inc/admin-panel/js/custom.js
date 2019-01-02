/**
 * Bloog Lite Custom js
 *
 * @package Bloog Lite
 */
/**
 * Custom scripts needed for the colorpicker, image button selectors,
 * and navigation tabs.
 */

jQuery(document).ready(function($) {
	function accesspresslite_tabs() {

		// Hides all the .group sections to start
		$('.group').hide();

		// Find if a selected tab is saved in localStorage
		var active_tab = '';
		//if ( typeof(localStorage) != 'undefined' ) {
		//	active_tab = localStorage.getItem("active_tab");
		//}

		// If active tab is saved and exists, load it's .group
		if (active_tab != '' && $(active_tab).length ) {
			$(active_tab).fadeIn();
			$(active_tab + '-tab').addClass('nav-tab-active');
		} else {
			$('.group:first').fadeIn();
			$('.nav-tab-wrapper a:first').addClass('nav-tab-active');
		}

		// Bind tabs clicks
		$('.nav-tab-wrapper a').click(function(evt) {

			evt.preventDefault();

			// Remove active class from all tabs
			$('.nav-tab-wrapper a').removeClass('nav-tab-active');

			$(this).addClass('nav-tab-active').blur();

			var group = $(this).attr('href');

			//if (typeof(localStorage) != 'undefined' ) {
			//	localStorage.setItem("active_tab", $(this).attr('href') );
			//}

			$('.group').hide();
			$(group).fadeIn();
		});
	}

  $('#single_post_slider').click(function(){
    $('.post-as-slider').show();
    $('.cat-as-slider').hide();
  });

  $('#cat_post_slider').click(function(){
    $('.cat-as-slider').show();
    $('.post-as-slider').hide();
  });

  if($('#single_post_slider input').is(':checked')){
  	$('.post-as-slider').show();
  }

  if($('#cat_post_slider input').is(':checked')){
  	$('.cat-as-slider').show();
  }

	// Loads tabbed sections if they exist
	if ( $('.nav-tab-wrapper').length > 0 ) {
		accesspresslite_tabs();
	}

	$('.ap-popup-bg, .ap-popup-close').click(function(){
		$('.ap-popup-bg, .ap-popup-wrapper').fadeOut();
	});

	$('#upload-btn').click(function(){
		$('#form_options').attr('action','');
	});


	/** Ajax Plugin Installation **/
	$(".install").on('click', function (e) {
		e.preventDefault();
		var el = $(this);

		is_loading = true;
    	el.addClass('installing');
    	var plugin = $(el).attr('data-slug');
    	var plugin_file = $(el).attr('data-file');
    	var ajaxurl = bloogWelcomeObject.ajaxurl;
    	var plhref = $(el).attr('href');
    	var newPlhref = plhref.split('&');
    	var plNonce = newPlhref[newPlhref.length-1];
    	var newPlhref = plNonce.split('=');
    	var plNonce = newPlhref[newPlhref.length-1];
    	if(plNonce==''){
    		var plNonce = bloogWelcomeObject.admin_nonce;
    	}

		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {
				action: 'bloog_lite_plugin_installer',
				plugin: plugin,
				plugin_file: plugin_file,
				nonce: plNonce,
			},
			success: function(response) {

		   		if(response == 'success'){
			   		
				   		el.attr('class', 'installed button');
				   		el.html(bloogWelcomeObject.installed_btn);
			   			
		   		}

		   		el.removeClass('installing');
		   		is_loading = false;
		   		//location.reload();
			},
			error: function(xhr, status, error) {
	  		console.log(status);
	  		el.removeClass('installing');
	  		is_loading = false;
			}
		});
	});

	/** Ajax Plugin Installation (Offlines) **/
	$('.install-offline').on('click', function (e) {
		e.preventDefault();
		var el = $(this);

		is_loading = true;
    	el.addClass('installing');

		var file_location = el.attr('href');
		var github = $(el).attr('data-github');
		var slug = $(el).attr('data-slug');
		var file = el.attr('data-file');
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {
				action: 'bloog_lite_plugin_offline_installer',
				file_location: file_location,
				file: file,
				slug: slug,
				github: github,
				dataType: 'json'
			},
			success: function(response) {

		   		if(response == 'success'){
			   		
			   		el.attr('class', 'installed button');
			   		el.html(bloogWelcomeObject.installed_btn);
			   			
		   		}

		   		is_loading = false;
		   		location.reload();
			},
			error: function(xhr, status, error) {
	  		el.removeClass('installing');
	  		is_loading = false;
			}
		});
	});

	/** Ajax Plugin Activation **/
	$(".activate").on('click', function (e) {
		
		var el = $(this);
		var plugin = $(el).attr('data-slug');

    	var ajaxurl = bloogWelcomeObject.ajaxurl;
    	
    	
		$.ajax({
	   		type: 'POST',
	   		url: ajaxurl,
	   		data: {
	   			action: 'bloog_lite_plugin_activation',
	   			plugin: plugin,
	   			nonce: bloogWelcomeObject.activate_nonce,
	   			dataType: 'json'
	   		},
	   		success: function(response) {
		   		if(response){
			   		if(response.status === 'success'){
				   		el.attr('class', 'installed button');
				   		el.html(bloogWelcomeObject.installed_btn);
			   		}
		   		}
		   		is_loading = false;
		   		location.reload();
	   		},
	   		error: function(xhr, status, error) {
	      		console.log(status);
	      		is_loading = false;
	   		}
	   	});
	});

	/** Ajax Plugin Activation Offline **/
	$('.activate-offline').on('click', function (e) {
		e.preventDefault();
		
		var el = $(this);
		var plugin = $(el).attr('data-slug');

		$.ajax({
	   		type: 'POST',
	   		url: ajaxurl,
	   		data: {
	   			action: 'bloog_lite_plugin_offline_activation',
	   			plugin: plugin,
	   			nonce: bloogWelcomeObject.activate_nonce,
	   			dataType: 'json'
	   		},
	   		success: function(response) {
		   		if(response){
			   		el.attr('class', 'installed button');
			   		el.html(bloogWelcomeObject.installed_btn);
		   		}
		   		is_loading = false;
		   		location.reload();
	   		},
	   		error: function(xhr, status, error) {
	      		console.log(status);
	      		is_loading = false;
	   		}
	   	});
	});
});//document.ready close