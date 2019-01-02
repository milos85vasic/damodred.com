jQuery(document).ready(function($){
	
	eventOnResize();
	juliet_responsive_videos();
	$(window).resize(function(){eventOnResize();});
	$(window).load(function(){eventOnResize();});
	/* eventOnScroll();
	$(window).scroll(function(){eventOnScroll();}); */
	
	$(".header-row-1-toggle").click(function(){
		$('.header-row-1').toggleClass('open');
        return false;
    });
	$(".side-page-toggle").click(function(){
		$('#side-page-overlay').fadeIn();
		$('#side-page').animate({left:0},400);
        return false;
    });
	$(".side-page-close").click(function(){
		$('#side-page-overlay').fadeOut();
		$('#side-page').animate({left:-351},400);
        return false;
    });
	/* Woocommerce */
    $(".shop-filter-sortby .dropdown-menu li a").click(function(e){
    	e.preventDefault();
        $('select.orderby').val($(this).data('id')).trigger('change');
    });

	if ($(".woocommerce.single-product .juliet-products").length) {
		$(".woocommerce.single-product .juliet-products").slick({
			speed: 1000,
			dots: false,
			arrows: true,
			slidesToShow: 4,
			autoplay: true,
			infinite: true,
			prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><i class="fa fa-long-arrow-left"></i></button>',
			nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><i class="fa fa-long-arrow-right"></i></button>',
			variableWidth:false,
			responsive:[
				{
					breakpoint: 768,
					settings: {slidesToShow: 3,variableWidth:false}
				},
				{
					breakpoint: 480,
					settings: {slidesToShow: 2,variableWidth:false}
				},
				{
					breakpoint: 320,
					settings: {slidesToShow: 1,variableWidth:false}
				}
			]
		}).on('afterChange',function(){
			fixVerticalArrows();
		}).trigger('afterChange');

		$(window).resize(function(){
			fixVerticalArrows();
		});
	}
	
    /* Vertically center arrows in Slick Carousel */

    function fixVerticalArrows(){
        var h = ($('.slick-active').find("img").height()/2);
        $('.slick-arrow').css('top',h+'px');
    }

});

function eventOnScroll(){
	
}
function eventOnResize(){
	var header2_height = jQuery('.header-row-2').innerHeight();
	if(!jQuery('.header-row-2').parent().hasClass('header-row-2-wrapp')){
		jQuery('.header-row-2').wrap('<div class="header-row-2-wrapp"></div>');
	}
	jQuery('.header-row-2-wrapp').css('min-height',header2_height);
	fluidBox();
}

function fluidBox(){
	if(jQuery('[data-fluid]').length>0){
		jQuery('[data-fluid]').each(function(){
			var data = jQuery(this).attr('data-fluid');
			var dataFloat = jQuery(this).attr('data-float');
			var dataFixed = jQuery(this).attr('data-fluid-fixed');
			var _container = jQuery(this);
			var dataSplit = data.split(',');
			if(_container.hasClass('carousel')){
				_container.find('.item').addClass('show');
			}
			for(i=0;i<dataSplit.length;i++){
				if(dataSplit[i]!=''){
					if(jQuery(dataSplit[i],_container).length>0){
						if(dataFixed=='true')
							jQuery(dataSplit[i],_container).css('height','auto');
						else
							jQuery(dataSplit[i],_container).css('min-height','inherit');
						if( dataFloat=='true' && jQuery(dataSplit[i],_container).parent().css('float')!='none' ){
							var newH = 0;
							if(jQuery(dataSplit[i],_container).length>0){
								jQuery(dataSplit[i],_container).each(function(){
									var thisH = jQuery(this).innerHeight();
									if( newH<thisH ) newH = thisH;
								});
								if(dataFixed=='true')
									jQuery(dataSplit[i],_container).css('height',newH);
								else
									jQuery(dataSplit[i],_container).css('min-height',newH);
							}
						}else if(dataFloat!='true'){
							var newH = 0;
							if(jQuery(dataSplit[i],_container).length>0){
								jQuery(dataSplit[i],_container).each(function(){
									var thisH = jQuery(this).innerHeight();
									if( newH<thisH ) newH = thisH;
								});
								if(dataFixed=='true')
									jQuery(dataSplit[i],_container).css('height',newH);
								else
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
function juliet_responsive_videos(){
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