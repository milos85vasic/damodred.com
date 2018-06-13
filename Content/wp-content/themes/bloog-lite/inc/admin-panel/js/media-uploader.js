/**
 * Bloog Lite media
 *
 * @package Bloog Lite
 */
jQuery(document).ready(function($){    
    $('#favicon_upload_btn').click(function(e) {
		e.preventDefault();
        var fav = $(this);
		var image = wp.media({ 
			title: 'Upload Image',
			// mutiple: true if you want to upload multiple files at once
			multiple: false
		}).open()
		.on('select', function(e){
			// This will return the selected image from the Media Uploader, the result is an object
			var uploaded_image = image.state().get('selection').first();
			// We convert uploaded_image to a JSON object to make accessing it easier
			// Output to the console uploaded_image
			console.log(uploaded_image);
			var image_url = uploaded_image.toJSON().url;
			// Let's assign the url value to the input field
			$('#favicon').val(image_url);
            $(fav).next('.favicon_preview').children('img').attr("src",image_url);
            $(fav).next('.favicon_preview').fadeIn();
		});
	});
    
    $('.slide-upload-button').click(function(e) {
		e.preventDefault();
        var self = $(this);
		var image = wp.media({ 
			title: 'Upload Image',
			// mutiple: true if you want to upload multiple files at once
			multiple: false
		}).open()
		.on('select', function(e){
			// This will return the selected image from the Media Uploader, the result is an object
			var uploaded_image = image.state().get('selection').first();
			// We convert uploaded_image to a JSON object to make accessing it easier
			// Output to the console uploaded_image
			console.log(uploaded_image);
			var image_url = uploaded_image.toJSON().url;
			// Let's assign the url value to the input field
			//$('#slide1').val(image_url);
            $(self).prev('.slide-image-url').val(image_url);
            $(self).next('.slide_preview').children('img').attr("src",image_url);
            $(self).next('.slide_preview').fadeIn();
		});
	});
    
    $(document).on('click' , '.upload-button', function(e) {
		e.preventDefault();
        var $this = $(this);
		var image = wp.media({ 
			title: 'Upload Image',
			// mutiple: true if you want to upload multiple files at once
			multiple: false
		}).open()
		.on('select', function(e){
			// This will return the selected image from the Media Uploader, the result is an object
			var uploaded_image = image.state().get('selection').first();
			// We convert uploaded_image to a JSON object to make accessing it easier
			// Output to the console uploaded_image
			var image_url = uploaded_image.toJSON().url;
			// Let's assign the url value to the input field
			$this.prev('.upload').val(image_url);
            
            var img = "<img src='"+image_url+"' width='125px' height='125px' /><a class='remove-image remove-screenshot'>Remove</a>";
            $this.next('.screenshot').html(img);
		});
	});
    
    $(document).on('click' , '.remove-screenshot', function(e) {
        $(this).parent().prev().prev('.upload').val('');
        $(this).parent().html('');
	});
});