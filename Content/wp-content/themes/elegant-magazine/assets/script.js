(function (e) {
    "use strict";
    var n = window.AFTHEMES_JS || {};
    n.stickyMenu = function () {
        e(window).scrollTop() > 350 ? e("#masthead").addClass("nav-affix") : e("#masthead").removeClass("nav-affix")
    },
        n.mobileMenu = {
            init: function () {
                this.toggleMenu(), this.menuMobile(), this.menuArrow()
            },
            toggleMenu: function () {
                e('#masthead').on('click', '.toggle-menu', function (event) {
                    var ethis = e('.main-navigation .menu .menu-mobile');
                    if (ethis.css('display') == 'block') {
                        ethis.slideUp('300');
                    } else {
                        ethis.slideDown('300');
                    }
                    e('.ham').toggleClass('exit');
                });
                e('#masthead .main-navigation ').on('click', '.menu-mobile a i', function (event) {
                    event.preventDefault();
                    var ethis = e(this),
                        eparent = ethis.closest('li'),
                        esub_menu = eparent.find('> .sub-menu');
                    if (esub_menu.css('display') == 'none') {
                        esub_menu.slideDown('300');
                        ethis.addClass('active');
                    } else {
                        esub_menu.slideUp('300');
                        ethis.removeClass('active');
                    }
                    return false;
                });
            },
            menuMobile: function () {
                if (e('.main-navigation .menu > ul').length) {
                    var ethis = e('.main-navigation .menu > ul'),
                        eparent = ethis.closest('.main-navigation'),
                        pointbreak = eparent.data('epointbreak'),
                        window_width = window.innerWidth;
                    if (typeof pointbreak == 'undefined') {
                        pointbreak = 991;
                    }
                    if (pointbreak >= window_width) {
                        ethis.addClass('menu-mobile').removeClass('menu-desktop');
                        e('.main-navigation .toggle-menu').css('display', 'block');
                    } else {
                        ethis.addClass('menu-desktop').removeClass('menu-mobile').css('display', '');
                        e('.main-navigation .toggle-menu').css('display', '');
                    }
                }
            },
            menuArrow: function () {
                if (e('#masthead .main-navigation div.menu > ul').length) {
                    e('#masthead .main-navigation div.menu > ul .sub-menu').parent('li').find('> a').append('<i class="fa fa-angle-down">');
                }
            }
        },


        n.DataBackground = function () {
            var pageSection = e(".data-bg");
            pageSection.each(function (indx) {
                if (e(this).attr("data-background")) {
                    e(this).css("background-image", "url(" + e(this).data("background") + ")");
                }
            });

            e('.bg-image').each(function () {
                var src = e(this).children('img').attr('src');
                e(this).css('background-image', 'url(' + src + ')').children('img').hide();
            });
        },


        /* Slick Slider */
        n.SlickCarousel = function () {
            var mainSlider = e('.main-slider');
            var slideCount = e('.slide-count');
            var slideNumCurrent = slideCount.find('.current');
            var slideNumTotal = slideCount.find('.total');

            mainSlider.on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
                var i = (currentSlide ? currentSlide : 0) + 1;
                slideNumCurrent.text(i);
                slideNumTotal.text(slick.slideCount);
            });

            mainSlider.slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 8000,
                infinite: true,
                nextArrow: '<span class="slide-icon slide-next icon-right fa fa-arrow-right"></span>',
                prevArrow: '<span class="slide-icon slide-prev icon-left fa fa-arrow-left"></span>',
                appendArrows: e('.af-navcontrols')
            });

            e(".posts-slider").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 7000,
                infinite: true,
                nextArrow: '<i class="slide-icon slide-icon-1 slide-next slide-next-1 fa fa-arrow-right"></i>',
                prevArrow: '<i class="slide-icon slide-icon-1 slide-prev slide-prev-1 fa fa-arrow-left"></i>',
            });

            e(".posts-carousel").slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                infinite: true,
                nextArrow: '<i class="slide-icon slide-icon-1 slide-next slide-next-1 fa fa-arrow-right"></i>',
                prevArrow: '<i class="slide-icon slide-icon-1 slide-prev slide-prev-1 fa fa-arrow-left"></i>',
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });

            e(".latest-posts-carousel").slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                autoplay: true,
                infinite: true,
                nextArrow: '<i class="slide-icon slide-icon-1 slide-next slide-next-1 fa fa-arrow-right"></i>',
                prevArrow: '<i class="slide-icon slide-icon-1 slide-prev slide-prev-1 fa fa-arrow-left"></i>',
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 5,
                        }
                    },
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1

                        }
                    }
                ]
            });

            e(".gallery-columns-1").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                autoplay: true,
                autoplaySpeed: 8000,
                infinite: true,
                nextArrow: '<i class="slide-icon slide-icon-1 slide-next fa fa-arrow-right"></i>',
                prevArrow: '<i class="slide-icon slide-icon-1 slide-prev fa fa-arrow-left"></i>',
                dots: true
            });

        },

        n.Preloader = function () {
            e(window).load(function () {
                e('.af-loader').fadeOut();
                e('#af-preloader').delay(1000).fadeOut('slow');
            });
        },

        n.Search = function () {
            e(window).load(function () {
                e(".af-search-click").on('click', function(){
                    e("#af-search-wrap").toggleClass("af-search-toggle");
                });
            });
        },

        n.Offcanvas = function () {
            e('.offcanvas-nav').sidr({
                side: 'left'
            });

            e('.sidr-class-sidr-button-close').click(function () {
                e.sidr('close', 'sidr');
            });
        },

        // SHOW/HIDE SCROLL UP //
        n.show_hide_scroll_top = function () {
            if (e(window).scrollTop() > e(window).height() / 2) {
                e("#scroll-up").fadeIn(300);
            } else {
                e("#scroll-up").fadeOut(300);
            }
        },

        n.scroll_up = function () {
            e("#scroll-up").on("click", function () {
                e("html, body").animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
        },

        n.jQueryMarquee = function () {
            e('.marquee').marquee({
                //duration in milliseconds of the marquee
                speed: 30000,
                //gap in pixels between the tickers
                gap: 0,
                //time in milliseconds before the marquee will start animating
                delayBeforeStart: 0,
                //'left' or 'right'
                direction: 'left',
                //true or false - should the marquee be duplicated to show an effect of continues flow
                duplicated: true,
                pauseOnHover: true,
                startVisible: true
            });
        },

        n.em_sticky = function () {
            jQuery('#secondary').theiaStickySidebar({
                additionalMarginTop: 30
            });
        },


        e(document).ready(function () {
            n.mobileMenu.init(), n.DataBackground(), n.em_sticky(), n.jQueryMarquee(), n.SlickCarousel(), n.Preloader(), n.Search(), n.Offcanvas(), n.scroll_up();
        }), e(window).scroll(function () {
        n.stickyMenu(), n.show_hide_scroll_top();
    }), e(window).resize(function () {
        n.mobileMenu.menuMobile();
    })
})(jQuery);