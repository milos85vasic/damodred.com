jQuery(document).ready(function($){
    $('.menu-toggle').toggle(function() {
        $('ul.nav-menu').addClass('menu-open');
    }, function(){
        $('ul.nav-menu').removeClass('menu-open');
    });

    // for scroll top
    $(window).scroll(function() {
        if ($(this).scrollTop() > 200) {
            $('.move_to_top_bloog').fadeIn();
        } else {
            $('.move_to_top_bloog').fadeOut();
        }
    });
    
        // scroll body to 0px on click
        $('.move_to_top_bloog').click(function() {
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });

        $('.search_header .fa.fa-search').click(function(){
            $('.search_form_wrap').addClass('form-active');
        });
        
        $('body').on('click','.search_close',function(){
           $('.search_form_wrap').removeClass('form-active');
       });

        $(function () {

          var msie6 = $.browser == 'msie' && $.browser.version < 7;
          var winWidth = $(window).width();
          var wrapperWidth = $('.bloog-wrapper').width();
          var gapWidth = parseInt(winWidth) - parseInt(wrapperWidth);
          var halfGap = parseInt(gapWidth/2);

          if (!msie6 && $('.sidebar').offset()!=null) {
            var top = $('.sidebar').offset().top - parseFloat($('.sidebar').css('margin-top').replace(/auto/, 0));
            var height = $('.sidebar').height();
            var winHeight = $(window).height(); 
            var footerTop = $('.site-footer').offset().top - parseFloat($('.site-footer').css('margin-top').replace(/auto/, 0));
            var gap = 7;
            $(window).scroll(function (event) {
      // what the y position of the scroll is
      var y = $(this).scrollTop();

      // whether that's below the form
      if (y+winHeight >= top+ height+gap && y+winHeight<=footerTop) {
        // if so, ad the fixed class
        $('.sidebar').addClass('sidebarfixed').css('top',winHeight-height-gap +'px');
        $('.sidebar').css('right', halfGap + 'px');
    } 
    else if (y+winHeight>footerTop) {
        // if so, ad the fixed class
        $('.sidebar').addClass('sidebarfixed').css('top',footerTop-height-y-gap+'px');
        $('.sidebar').css('right', halfGap + 'px');
    } 
    else    
    {
        // otherwise remove it
        $('.sidebar').removeClass('sidebarfixed').css('top','0px');
        $('.sidebar').css('right', '0px');
    }
});
        }  
    });


    });