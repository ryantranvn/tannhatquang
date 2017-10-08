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
                $('#nav_sanpham_bg').fadeIn(100);
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

// product detail picture
    if ($('.elastislide-list').length > 0) {
        $('#carousel').elastislide({
            orientation : 'vertical',
            autoplay : false,
            minItems : 5
        });
    }
    if ($('.product_zoom').length>0) {
        $('.product_zoom').elevateZoom({
            zoomWindowWidth : 400,
            zoomWindowHeight : 400,
            zoomWindowOffetx: 10
        });
        $('.wrap_thumbnail').find('a').each( function() {
            $(this).click( function(e) {
                e.preventDefault();

                var img_src = $(this).attr('data-large');
                $('.wrap_large_picture').find('img').attr('src', img_src).attr('data-zoom-image', img_src);
                var ez =   $('.product_zoom').data('elevateZoom');
                var smallImage = img_src;
                var largeImage = img_src;
                ez.swaptheimage(smallImage, largeImage);
            })
        });
    }
// paging
    $("div.wrap_paging").jPages({
        containerID : "related_products",
        perPage : 3,
        // first       : "",
        previous    : "",
        next        : ""
        // last        : ""
    });
// item_number
    if ($('.item_number').find('input[name="item_number"]').length>0) {
    // set number of cart
        number_input('.number_input')
    }

// cart
    if ($('#wrap_giohang').length>0) {

    }


});

function number_input(input_class_name)
{
    $('body').on('keypress', input_class_name, function(event) {
        var kC = event.keyCode || event.which;1
        if (kC >= 48 && kC <=57) {
            return true;
        }
        event.preventDefault();
    });
    $('body').on('keyup', input_class_name, function(event) {
        var element = $(this);
        var number_length = $.trim(element.val()).length;
        if (number_length==1 && element.val()=="0") {
            element.val("1");
        }
        if (number_length>=5) {
            element.val(element.val().substr(0,4));
        }
        return true;
    });
    $('body').on('focus', input_class_name, function(event) {
        var element = $(this);
        if (element.val()=="") element.val('1');
    });
    $('body').on('blur', input_class_name, function(event) {
        var element = $(this);
        var number_length = $.trim(element.val()).length;
        if (number_length==0) {
            element.val("1");
        }
        else if (number_length>=5) {
            element.val(element.val().substr(0,4));
        }
    });
    $('body').on('change', input_class_name, function(event) {
        var input = $(this);
        var btn_decrease = input.prev();
        var btn_increase = input.next();
        var current_value = parseInt(input.val());
        if (current_value<=1) {
            btn_decrease.attr('disabled','disabled');
        }
        else if (current_value>=js_data.max_number_item_cart) {
            btn_increase.attr('disabled','disabled');
        }
        else {
            btn_decrease.removeAttr('disabled');
            btn_increase.removeAttr('disabled');
        }
    });
    $('.btn_increase').click( function() {
        var btn_increase = $(this)
        var input = $(this).prev();
        var btn_decrease = input.prev();
        var old_value = parseInt(input.val());
        var new_value = old_value+1;
        input.val(new_value);
        btn_decrease.removeAttr('disabled');
        if (old_value>=js_data.max_number_item_cart) {
            btn_increase.attr('disabled','disabled');
        }
    });
    $('.btn_decrease').click( function() {
        var btn_decrease = $(this);
        var input = btn_decrease.next();
        var btn_increase = input.next();
        var old_value = parseInt(input.val());
        var new_value = old_value-1;
        input.val(new_value);
        btn_increase.removeAttr('disabled');
        if (new_value==1) {
            btn_decrease.attr('disabled','disabled');
        }
    });
}