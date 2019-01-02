/*** Kale - JS ***/
jQuery(document).ready(function($){

	kale_responsive_videos();

    $("#toggle-main_search").on("click", function (event) {
        var x = setTimeout('jQuery(".main_search .form-control").focus()', 700);
    });
});
jQuery(document).ready(function($){
	fluidBox();
	$(window).load(function(){fluidBox();})
	$(window).resize(function(){fluidBox();});
	$('body').addClass('js');
	$(".owl-carousel").owlCarousel({
		lazyContent:true,
		loop:true,
		nav:true,
		dots:false,
        autoplay: true,
		items:1,
		animateOut: 'fadeOut',
		animateIn: 'fadeIn'
	});
	$("select.form-control").selectpicker();
	$(".header-row-1-toggle").click(function(){
		$(this).toggleClass('open');
		$('.header-row-1').toggleClass('open');
		return false;
	});
	$('.checkbox label,.checkbox-inline label,.radio label,.radio-inline label').click(function(){
		setupLabel();
	});
	setupLabel();

	$('.search-trigger').on( 'click', function() {
		$(this).siblings('form').find('.search-field').toggleClass('visible').focus();
	});
});
function setupLabel() {
	if (jQuery('.checkbox,.checkbox-inline').length) {
		jQuery('.checkbox label,.checkbox-inline label').each(function(){
			jQuery(this).removeClass('on');
		});
		jQuery('.checkbox input:checked,.checkbox-inline input:checked').each(function(){
			jQuery(this).parent('label').addClass('on');
		});
	};
	if (jQuery('.radio,.radio-inline').length) {
		jQuery('.radio label,.radio-inline label').each(function(){
			jQuery(this).removeClass('on');
		});
		jQuery('.radio input:checked,.radio-inline input:checked').each(function(){
			jQuery(this).parent('label').addClass('on');
		});
	};
};

function fluidBox(){
	if(jQuery('[data-fluid]').length>0){
		jQuery('[data-fluid]').each(function(){
			var data = jQuery(this).attr('data-fluid');
			var dataFloat = jQuery(this).attr('data-float');
			var _container = jQuery(this);
			var dataSplit = data.split(',');
			if(_container.hasClass('carousel')){
				_container.find('.item').addClass('show');
			}
			for(i=0;i<dataSplit.length;i++){
				if(dataSplit[i]!=''){
					if(jQuery(dataSplit[i],_container).length>0){
						jQuery(dataSplit[i],_container).css('min-height','inherit');
						if( dataFloat=='true' && jQuery(dataSplit[i],_container).parent().css('float')!='none' ){
							var newH = 0;
							if(jQuery(dataSplit[i],_container).length>0){
								jQuery(dataSplit[i],_container).each(function(){
									var thisH = jQuery(this).innerHeight();
									if( newH<thisH ) newH = thisH;
								});
								jQuery(dataSplit[i],_container).css('min-height',newH);
							}
						}else if(dataFloat!='true'){
							var newH = 0;
							if(jQuery(dataSplit[i],_container).length>0){
								jQuery(dataSplit[i],_container).each(function(){
									var thisH = jQuery(this).innerHeight();
									if( newH<thisH ) newH = thisH;
								});
								jQuery(dataSplit[i],_container).css('min-height',newH);
							}
						}
					}
				}
			}
			if(_container.hasClass('carousel')){
				_container.find('.item').removeClass('show');
			}
		});
	}
}

//http://www.skipser.com/p/2/p/auto-resize-youtube-videos-in-responsive-layout.html
function kale_responsive_videos(){
	YOUTUBE_VIDEO_MARGIN = 5;
	jQuery('.single-content iframe, .page-content iframe').each(function(index,item) {
		if(jQuery(item).attr('src').match(/(https?:)?\/\/www\.youtube\.com/)) {
			var w=jQuery(item).attr('width');
			var h=jQuery(item).attr('height');
			var ar = h/w*100;
			ar=ar.toFixed(2);
			//Style iframe
			jQuery(item).css('position','absolute');
			jQuery(item).css('top','0');
			jQuery(item).css('left','0');
			jQuery(item).css('width','100%');
			jQuery(item).css('height','100%');
			jQuery(item).css('max-width',w+'px');
			jQuery(item).css('max-height', h+'px');
			jQuery(item).wrap('<div style="max-width:'+w+'px;margin:0 auto; padding:'+YOUTUBE_VIDEO_MARGIN+'px;" />');
			jQuery(item).wrap('<div style="position: relative;padding-bottom: '+ar+'%; height: 0; overflow: hidden;" />');
		}
	});
}