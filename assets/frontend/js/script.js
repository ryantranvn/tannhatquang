var document_height = $(document).height();
var screen_height = $(window).height();
var footer_height = $('#wrap_footer').height();

// scroll top
    $('#gotoTop').affix({offset: {bottom: (footer_height+80)} });
    $(window).scroll(function (event) {
        var scroll = $(window).scrollTop();

        if (scroll >= 200) {
            $('#gotoTop').fadeIn('fast')
        }
        else {
            $('#gotoTop').fadeOut('fast');
        }
    });
    $('body').on('click', '#gotoTop', function() {
        $("html, body").animate({ scrollTop: 0 }, 600, function() {
            $('#gotoTop').fadeOut('fast');
        });
    });

$(document).ready(function(){
// navigation
    $('[rel="popover"]').popover({
        container: 'body',
        placement: 'bottom',
        html: true,
        content: function () {
            var clone = $($(this).data('popover-content')).clone(true).removeClass('hide');
            return clone;
        }
    });
    $('#nav_sanpham').webuiPopover({
        url : '#nav_sanpham_popover',
        placement : 'bottom-right',
        onShow: function($element) {
            $("html, body").animate({ scrollTop: 0 }, 600, function() {
                $('body').addClass('fixed');
                $('#nav_sanpham_bg').fadeIn('fast');
            });
        },
        onHide: function($element) {
            $('body').removeClass('fixed');
            $('#nav_sanpham_bg').fadeOut('fast');
        }
    });

    /*
    $.ajax({
        url : fUrl + 'get_product_categories',
        type: 'POST',
        cache: false,
        dataType: 'json',
        data: { 'csrf_hash' : $.cookie('csrf_cookie_ci') },
        success: function(data) {
            if (data.err==1) {
            }
            else {
                list = '';
                $.each(data.categories, function(index, item) {
                    list += '<div class="category">' + item['name'];
                    if (item['sub'].length==0) {
                        list += '</div>';
                    }
                    else {
                        list += '<ul>';
                        $.each(item['sub'], function(index_sub, sub) {
                            list += '<li><a href="'+ sub['url'] +'">' + sub['name'] + '</a></li>';
                        });
                        list += '</ul></div>';
                    }
                });
                $.each(data.categories, function(index, item) {
                    list += '<div class="category">' + item['name'];
                    if (item['sub'].length==0) {
                        list += '</div>';
                    }
                    else {
                        list += '<ul>';
                        $.each(item['sub'], function(index_sub, sub) {
                            list += '<li><a href="'+ sub['url'] +'">' + sub['name'] + '</a></li>';
                        });
                        list += '</ul></div>';
                    }
                });
                $.each(data.categories, function(index, item) {
                    list += '<div class="category">' + item['name'];
                    if (item['sub'].length==0) {
                        list += '</div>';
                    }
                    else {
                        list += '<ul>';
                        $.each(item['sub'], function(index_sub, sub) {
                            list += '<li><a href="'+ sub['url'] +'">' + sub['name'] + '</a></li>';
                        });
                        list += '</ul></div>';
                    }
                });

                $('#nav_sanpham_popover').html('').html(list);
            }
        },
        error: function() {
        }
    });
    */
// slick

    $('#slick_hotline').slick({
        infinite: true,
        lazyLoad: 'ondemand',
        slidesToShow: 4,
        slidesToScroll: 1
    });
    $('#slick_hot_product').slick({
        infinite: true,
        lazyLoad: 'ondemand',
        slidesToShow: 3,
        slidesToScroll: 1
    });
    $('#slick_sale_product').slick({
        infinite: true,
        lazyLoad: 'ondemand',
        slidesToShow: 3,
        slidesToScroll: 1
    });



});
