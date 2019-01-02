jQuery(document).ready(function($) {

    $(".gallerywp-nav-secondary .gallerywp-secondary-nav-menu").addClass("gallerywp-secondary-responsive-menu").before('<div class="gallerywp-secondary-responsive-menu-icon"></div>');

    $(".gallerywp-secondary-responsive-menu-icon").click(function(){
        $(this).next(".gallerywp-nav-secondary .gallerywp-secondary-nav-menu").slideToggle();
    });

    $(window).resize(function(){
        if(window.innerWidth > 1112) {
            $(".gallerywp-nav-secondary .gallerywp-secondary-nav-menu, nav .sub-menu, nav .children").removeAttr("style");
            $(".gallerywp-secondary-responsive-menu > li").removeClass("gallerywp-secondary-menu-open");
        }
    });

    $(".gallerywp-secondary-responsive-menu > li").click(function(event){
        if (event.target !== this)
        return;
        $(this).find(".sub-menu:first").slideToggle(function() {
            $(this).parent().toggleClass("gallerywp-secondary-menu-open");
        });
        $(this).find(".children:first").slideToggle(function() {
            $(this).parent().toggleClass("gallerywp-secondary-menu-open");
        });
    });

    $("div.gallerywp-secondary-responsive-menu > ul > li").click(function(event) {
        if (event.target !== this)
            return;
        $(this).find("ul:first").slideToggle(function() {
            $(this).parent().toggleClass("gallerywp-secondary-menu-open");
        });
    });

    if(gallerywp_ajax_object.sticky_menu){
    // grab the initial top offset of the navigation 
    var gallerywpstickyNavTop = $('.gallerywp-primary-menu-container').offset().top;
    
    // our function that decides weather the navigation bar should have "fixed" css position or not.
    var gallerywpstickyNav = function(){
        var gallerywpscrollTop = $(window).scrollTop(); // our current vertical position from the top
             
        // if we've scrolled more than the navigation, change its position to fixed to stick to top,
        // otherwise change it back to relative
        if(gallerywp_ajax_object.sticky_menu_mobile){
            if (gallerywpscrollTop > gallerywpstickyNavTop) {
                $('.gallerywp-primary-menu-container').addClass('gallerywp-fixed');
            } else {
                $('.gallerywp-primary-menu-container').removeClass('gallerywp-fixed'); 
            }
        } else {
            
                if(window.innerWidth > 1112) {
                    if (gallerywpscrollTop > gallerywpstickyNavTop) {
                        $('.gallerywp-primary-menu-container').addClass('gallerywp-fixed');
                    } else {
                        $('.gallerywp-primary-menu-container').removeClass('gallerywp-fixed'); 
                    }
                }
            
        }
    };

    gallerywpstickyNav();
    // and run it again every time you scroll
    $(window).scroll(function() {
        gallerywpstickyNav();
    });
    }

    $(".gallerywp-nav-primary .gallerywp-nav-primary-menu").addClass("gallerywp-primary-responsive-menu").before('<div class="gallerywp-primary-responsive-menu-icon"></div>');

    $(".gallerywp-primary-responsive-menu-icon").click(function(){
        $(this).next(".gallerywp-nav-primary .gallerywp-nav-primary-menu").slideToggle();
    });

    $(window).resize(function(){
        if(window.innerWidth > 1112) {
            $(".gallerywp-nav-primary .gallerywp-nav-primary-menu, nav .sub-menu, nav .children").removeAttr("style");
            $(".gallerywp-primary-responsive-menu > li").removeClass("gallerywp-primary-menu-open");
        }
    });

    $(".gallerywp-primary-responsive-menu > li").click(function(event){
        if (event.target !== this)
        return;
        $(this).find(".sub-menu:first").slideToggle(function() {
            $(this).parent().toggleClass("gallerywp-primary-menu-open");
        });
        $(this).find(".children:first").slideToggle(function() {
            $(this).parent().toggleClass("gallerywp-primary-menu-open");
        });
    });

    $("div.gallerywp-primary-responsive-menu > ul > li").click(function(event) {
        if (event.target !== this)
            return;
        $(this).find("ul:first").slideToggle(function() {
            $(this).parent().toggleClass("gallerywp-primary-menu-open");
        });
    });

    $(".gallerywp-social-search-icon").on('click', function (e) {
        e.preventDefault();
        $('.gallerywp-social-search-box').slideToggle(400);
    });

    $(".post").fitVids();

    $( 'body' ).prepend( '<div class="gallerywp-scroll-top"></div>');
    var scrollButtonEl = $( '.gallerywp-scroll-top' );
    scrollButtonEl.hide();

    $( window ).scroll( function () {
        if ( $( window ).scrollTop() < 20 ) {
            $( '.gallerywp-scroll-top' ).fadeOut();
        } else {
            $( '.gallerywp-scroll-top' ).fadeIn();
        }
    } );

    scrollButtonEl.click( function () {
        $( "html, body" ).animate( { scrollTop: 0 }, 300 );
        return false;
    } );

    if(gallerywp_ajax_object.sticky_sidebar){
    $('.gallerywp-main-wrapper, .gallerywp-sidebar-one-wrapper').theiaStickySidebar({
        containerSelector: ".gallerywp-content-wrapper",
        additionalMarginTop: 0,
        additionalMarginBottom: 0,
        minWidth: 890,
    });
    }

});