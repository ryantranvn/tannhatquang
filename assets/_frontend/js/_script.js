    var screenHeight = $(window).height();
// isMobile
    var isMobile = false
    if (navigator.userAgent.match('Mobile')) {
        isMobile = true
    }

// select dropdown list
    function selectDropDown(selectWrapper, effect, fnCallbackSelected)
    {
        speed = 'fast'
        // show on click
            $('body').on('click', selectWrapper +' .valueShow', function () {
                if (effect=="fade") {
                    $(selectWrapper).children('ul').fadeToggle(speed);
                }
                else {
                    $(selectWrapper).children('ul').slideToggle(speed);
                }
            });

        // get value of select
            $('body').on('click', selectWrapper + ' ul li', function () {
            // get value
                selectedValue = $(this).html();
            // view
                $(selectWrapper).children('.valueShow').html(selectedValue);
            // get value for input
                $(selectWrapper).children('.valueGet').val($(this).attr('data-val'))

            // callback after slideUp list
                if (effect=="fade") {
                    $(selectWrapper).children('ul').fadeOut(speed, function() {
                        if(typeof fnCallbackSelected == "function"){
                            fnCallbackSelected();
                        }
                    });
                }
                else {
                    $(selectWrapper).children('ul').slideUp(speed, function() {
                        if(typeof fnCallbackSelected == "function"){
                            fnCallbackSelected();
                        }
                    });
                }

            });

        // slideUp on click outside
            $(document).mouseup(function (e) {
                e.stopPropagation();
                var clickedElement = e.target;
                if ($(selectWrapper).has(e.target).length === 0) {
                    if (effect=="fade") {
                        $(selectWrapper).children('ul').fadeOut(speed);
                    }
                    else {
                        $(selectWrapper).children('ul').slideUp(speed);
                    }
                }
            });
    }

// popup
    function openPopup(idPopup, titlePopup, contentPopup, fnCallbackOpen, fnCallbackClose)
    {
        if (contentPopup != undefined) {
            $('#'+idPopup).find('.popupContent').html(contentPopup)
        }
        $('#'+idPopup).find('.popupTitle').html(titlePopup).promise().done(function(){
            if(fnCallbackOpen != false && typeof fnCallbackOpen == "function"){
                fnCallbackOpen()
            }
            $('#'+idPopup).fadeIn("slow", function() {
                $('body').css({ 'overflow':'hidden' })
            });
        });
        $('#'+idPopup).on('click', '.popupClose', function() {
            $('#'+idPopup).fadeOut('fast', function() {
                $('body').css({ 'overflow':'visible' })
                if(fnCallbackClose != false && typeof fnCallbackClose == "function"){
                    fnCallbackClose();
                }
            });
        });
        $('#'+idPopup).on('click', '.popupBg', function() {
            $('#'+idPopup).fadeOut('fast', function() {
                $('body').css({ 'overflow':'visible' })
                if(fnCallbackClose != false && typeof fnCallbackClose == "function"){
                    fnCallbackClose();
                }
            });
        });
    }

// slide hotProduct
    jQuery(function($) {
      'use strict';

        (function() {
            var $frame = $('#hotProductFrame');
            var $slidee = $frame.children('ul').eq(0);
            var $wrap = $frame.parent();

            // Call Sly on frame
            $frame.sly({
              horizontal: 1,
              itemNav: 'basic',
              smart: 1,
              activateOn: 'click',
              mouseDragging: 1,
              touchDragging: 1,
              releaseSwing: 1,
              startAt: 0,
              scrollBar: $wrap.find('.scrollbar'),
              scrollBy: 1,
              pagesBar: $wrap.find('.pages'),
              activatePageOn: 'click',
              speed: 300,
              elasticBounds: 1,
              easing: 'easeOutExpo',
              dragHandle: 1,
              dynamicHandle: 1,
              clickBar: 1,

              // Buttons
              forward: $wrap.find('.forward'),
              backward: $wrap.find('.backward'),
              prev: $wrap.find('.prev'),
              next: $wrap.find('.next'),
              prevPage: $wrap.find('.prevPage'),
              nextPage: $wrap.find('.nextPage')
            });

        }());
    });

// slide saleProduct
    jQuery(function($) {
      'use strict';

        (function() {
            var $frame = $('#saleProductFrame');
            var $slidee = $frame.children('ul').eq(0);
            var $wrap = $frame.parent();

            // Call Sly on frame
            $frame.sly({
              horizontal: 1,
              itemNav: 'basic',
              smart: 1,
              activateOn: 'click',
              mouseDragging: 1,
              touchDragging: 1,
              releaseSwing: 1,
              startAt: 0,
              scrollBar: $wrap.find('.scrollbar'),
              scrollBy: 1,
              pagesBar: $wrap.find('.pages'),
              activatePageOn: 'click',
              speed: 300,
              elasticBounds: 1,
              easing: 'easeOutExpo',
              dragHandle: 1,
              dynamicHandle: 1,
              clickBar: 1,

              // Buttons
              forward: $wrap.find('.forward'),
              backward: $wrap.find('.backward'),
              prev: $wrap.find('.prev'),
              next: $wrap.find('.next'),
              prevPage: $wrap.find('.prevPage'),
              nextPage: $wrap.find('.nextPage')
            });

        }());
    });

$(document).foundation();

$(document).ready( function() {

    // mobile menu
        wMobileNav = $('.mobileNav').width()

        $('#mobileMenuButton').click(function(){
            $(this).toggleClass('open');
            if ($(this).hasClass('open')) {
                $('.mobileNav').transition({ x : wMobileNav }, 50, function() {
                    $('.mobileNav').css('opacity',1).transition({ x : 0 }, 800)
                    $('.container').transition({ x : -(wMobileNav) }, 800)
                })
            }
            else {
                $('.mobileNav').css('opacity',0).transition({ x : wMobileNav }, 800)
                $('.container').transition({ x : 0 }, 800)
            }
        });

    // positive number
        if ($(".positive-integer").length>0) {
            $(".positive-integer").numeric({ decimal: false, negative: false }, function() {
                this.value = ""; this.focus();
            });
        }

    // scroll top
        $(window).scroll(function (event) {
            var scroll = $(window).scrollTop();

            if (scroll >= 200) {
                $('#gotoTop').fadeIn('fast')
            }
            else {
                $('#gotoTop').fadeOut('fast')
            }
        });
        $('body').on('click', '#gotoTop', function() {
            $("html, body").animate({ scrollTop: 0 }, 600, function() {
                $('#gotoTop').fadeOut('fast')
            });
        });

    // view auth box
    $('body').on('mouseenter', '#authWrapper', function() {
        $('#authBox').fadeIn('fast')
    })
    $('body').on('mouseleave', '#authWrapper', function() {
        $('#authBox').fadeOut('fast')
    })

    $('#authBox').on('click', '.signin a', function(e) {
        e.preventDefault()
        openPopup('popupAuth')
    });


    // banner
        $('.carousel').carousel()
        // $(".owl-carousel").owlCarousel({
        //     items : 1,
        //     dots : true,
        //     autoplay : true,
        // });
        /*
        if ($("#banner").length>0) {
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 0,
                nav: true,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:1
                    },
                    1000:{
                        items:1
                    }
                }
            });
        }
        */
    // hotline
        if ($("#hotline").length>0) {
            $("div.holder").jPages({
                containerID : "hotlineList",
                perPage : 4,
                animation   : "fadeIn",
                pause       : 10000,
                clickStop   : true,
                first       : false,
                previous    : "span.arrowPrev",
                next        : "span.arrowNext",
                last        : false
            });
        }

    // PAGEs
    // homePage
        if ($('#homePage').length>0) {
        }
        if ($('#sanphamPage').length>0) {
            $("div.holder_sanphamList").jPages({
                containerID : "sanphamList",
                perPage     : 12,
                animation   : "fadeIn",
                first       : false,
                previous    : "span.arrowPrev_sanpham",
                next        : "span.arrowNext_sanpham",
                last        : false
            });
        }
        if ($('#sanpham_chitietPage').length>0) {
            $("div.holder_sanphamList").jPages({
                containerID : "sanphamList",
                perPage     : 9,
                animation   : "fadeIn",
                first       : false,
                previous    : "span.arrowPrev_sanpham",
                next        : "span.arrowNext_sanpham",
                last        : false
            });
        }



})
