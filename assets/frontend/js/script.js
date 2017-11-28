var document_height = $(document).height();
var screen_height = $(window).height();
var footer_height = $('#wrap_footer').height();

// $.ajaxSetup({
//     complete : function (xhr, status) {
//
//     }
// });
// invalid alert
    if (js_data.invalid) {
        swal(
            'Rất tiếc...',
            js_data.invalid,
            'error'
        )
    }

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

    var in_cart = false;
    if ($('#wrap_giohang').length>0) {
        in_cart = true;
    }
$(document).ready( function() {
// valid
    var sweetalert_title = "";
    var sweetalert_msg = "";
    var reply_msg = "";
    if (js_data.valid != undefined) {
        reply_msg = js_data.valid;
    }
    else if (js_data.invalid != undefined) {
        reply_msg = js_data.invalid;
    }
    switch (reply_msg) {
        case 'checkout_success':
            sweetalert_title = 'Cám ơn bạn!';
            sweetalert_msg = 'Đơn hàng của bạn đã được tiếp nhận. <br/>Chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất.';
            show_sweetalert(sweetalert_title, sweetalert_msg, 'success');
            break;
        case 'checkout_error':
            sweetalert_title = 'Rất tiếc!';
            sweetalert_msg = 'Đơn hàng của bạn chưa được tiếp nhận. <br/>Vui lòng liên hệ với chúng tôi để được hỗ trợ tốt hơn.';
            show_sweetalert(sweetalert_title, sweetalert_msg, 'error');
            break;
        default:
            break;
    }


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
        number_input('.number_input');
        add_cart();
    }

// cart
    if ($('#wrap_giohang').length>0) {
        // if ($('#wrap_footer').position().top <= screen_height - $('#wrap_footer').height()) {
        //     $('#wrap_footer').addClass('fixed_bottom');
        // }
        $('.wrap_giohang_item').find('.delete_item').click(function (e) {
            e.preventDefault();
            var item = $(this).parent().parent('.wrap_giohang_item');
            var post_id = $(this).attr('data-id');
            swal({
                title: 'Tân Nhật Quang',
                text: "Bạn có thật sự muốn xóa sản phẩm này khỏi giỏ hàng ?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Không'
            }).then(function () {
                $.ajax({
                    url: fUrl + 'ajax_delete_cart',
                    type: 'POST',
                    cache: false,
                    dataType: 'json',
                    data: {
                        'csrf_hash': $.cookie('csrf_cookie_ci'),
                        'post_id': post_id
                    },
                    success: function (data) {
                        if (data.error == 1) {
                            swal(
                                'Rất tiếc...',
                                data.msg,
                                'error'
                            )
                        }
                        else {
                            item.fadeOut('slow');
                            // update cart
                            if (data.total_item<=99) {
                                $('#wrap_cart #cart_number').html(data.total_item);
                                if (data.total_item==0) {
                                    $('.btn_dathang').remove();
                                }
                            }
                            else {
                                $('#wrap_cart #cart_number').html("99<plus>+</plus>");
                            }
                            // update row
                            var sub_total = $.number( data.sub_total, 0, ',', '.' );
                            $('.wrap_item_'+post_id).find('.col_sub_total').find('.sub_total').children('span:last-child').html(sub_total);
                            var total = $.number( data.total, 0, ',', '.' );
                            $('.wrap_giohang_tong').find('.total').html(total);
                            $('.wrap_lbl_giohang').find('.number_item').html(data.total_item);
                        }
                    },
                    error: function () {
                    }
                });
            })

        });
    }

// checkout
    if ($('#wrap_checkout').length>0) {
        if ($('#frmCustomer').length>0) {
            /* init select province & district */
            var province_1 = $('select[name="province_id_1"]');
            var province_2 = $('select[name="province_id_2"]');
            var district_1 = $('select[name="district_id_1"]');
            var district_2 = $('select[name="district_id_2"]');

            init_select2(province_1, "Chọn tỉnh/thành phố");
            init_select2(province_2, "Chọn tỉnh/thành phố");
            init_select2(district_1, "Chọn quận/huyện");
            init_select2(district_2, "Chọn quận/huyện");

            /* main address */
            var province_id;
            province_1.change(function () {
                province_id = $(this).val();
                district_1.val("").trigger('change');
                district_1.select2({
                    minimumResultsForSearch: -1,
                    ajax: {
                        url: fUrl + 'ajax_get_district',
                        dataType: 'json',
                        method: 'post',
                        data: function () {
                            return {
                                'csrf_hash': $.cookie('csrf_cookie_ci'),
                                'province_id': province_id
                            }
                        },
                        processResults: function (data) {
                            return {
                                results: data
                            };
                        }
                    }
                });
            });
            /* different address */
            $('input[name="same_address"]').change(function () {
                if ($(this).val() == 0) {
                    $('.different_address').slideDown()
                    $('input[name="address_2"]').val('');
                }
                else {
                    $('.different_address').slideUp()
                }
            });
            province_2.change(function () {
                province_id = $(this).val();
                district_2.val("").trigger('change');
                district_2.select2({
                    minimumResultsForSearch: -1,
                    ajax: {
                        url: fUrl + 'ajax_get_district',
                        dataType: 'json',
                        method: 'post',
                        data: function () {
                            return {
                                'csrf_hash': $.cookie('csrf_cookie_ci'),
                                'province_id': province_id
                            }
                        },
                        processResults: function (data) {
                            $('input[name="csrf_hash"]').val($.cookie('csrf_cookie_ci'));
                            return {
                                results: data
                            };
                        }
                    }
                });
            });

            justNum($('input[name="phone"]'));
            /* validation */
            var validator = $("#frmCustomer").validate({
                rules: {
                    fullname: {
                        required: true,
                        maxlength: 512
                    },
                    phone: {
                        required: true,
                        maxlength: 20
                    },
                    email: {
                        email: true
                    }
                },
                messages: {
                    fullname: {
                        required: "bắt buộc nhập",
                        maxlength: "tối đa 512 ký tự"
                    },
                    phone: {
                        required: "bắt buộc nhập",
                        maxlength: "tối đa 20 số"
                    },
                    email: {
                        email: "email không đúng định dạng"
                    }
                },
                highlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                unhighlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                },
                errorElement: 'span',
                errorClass: 'help-block',
                errorPlacement: function (error, element) {
                    if (element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function (form) {
                    $('input[name="csrf_hash"]').attr('value', $.cookie('csrf_cookie_ci'));
                    form.submit();
                }
            });
        }
    }

// search
    $('#frmSearch').find('.product_search').keypress(function(e) {
        e.preventDefault();
        if(e.which == 13) {
            alert('You pressed enter!');

            return false;
        }

    });
    $('#frmSearch').find('.btn').click( function(e) {
        e.preventDefault();
        var product_search = $('#frmSearch').find('input[name="product_search"]').val().trim();
        if (product_search.length==0) {
            swal(
                'Rất tiếc...',
                'Vui lòng nhập tên hoặc mã sản phẩm cần tìm kiếm',
                'error'
            )
        }
        else {
           //$('#frmSearch').submit();
            var params = { cat : 'sp', search : product_search };
            var params_str = jQuery.param( params );
            window.location.href = fUrl + 'san-pham?' + params_str;
        }
    });

});

function ajax_update_cart(post_id, number_item) {
    $.ajax({
        url: fUrl + 'ajax_update_cart',
        type: 'POST',
        cache: false,
        dataType: 'json',
        data: {
            'csrf_hash' : $.cookie('csrf_cookie_ci'),
            'post_id' : post_id,
            'number_item' : number_item
        },
        success: function (data) {
            if (data.error == 1) {
                swal(
                    'Rất tiếc...',
                    data.msg,
                    'error'
                )
            }
            else {
            // update cart
                if (data.total_item<=99) {
                    $('#wrap_cart #cart_number').html(data.total_item);
                }
                else {
                    $('#wrap_cart #cart_number').html("99<plus>+</plus>");
                }
            // update row
                var sub_total = $.number( data.sub_total, 0, ',', '.' );
                $('.wrap_item_'+post_id).find('.col_sub_total').find('.sub_total').children('span:last-child').html(sub_total);
                var total = $.number( data.total, 0, ',', '.' );
                $('.wrap_giohang_tong').find('.total').html(total);
                $('.wrap_lbl_giohang').find('.number_item').html(data.total_item);
            }
        },
        error: function () {
        }
    });
}

function add_cart() {
    $('.add_cart').click( function(e) {
        e.preventDefault();
        // get data
        var number_item = 0;
        var arr_data = new Array();
        $('body').find('.number_input').each( function() {
            var input_val = parseInt($(this).val());
            number_item += input_val;
            var id = $(this).attr('data-id');
            arr_data.push({post_id:id, number_item:number_item})
        });
        if (number_item>0 && arr_data.length>0) {
            $.ajax({
                url: fUrl + 'ajax_add_cart',
                type: 'POST',
                cache: false,
                dataType: 'json',
                data: {
                    'csrf_hash' : $.cookie('csrf_cookie_ci'),
                    'arr_data' : arr_data
                },
                success: function (data) {

                    if (data.error == 1) {
                        swal(
                            'Rất tiếc...',
                            data.msg,
                            'error'
                        )
                    }
                    else {
                        if (data.total_item<=99) {
                            $('#wrap_cart #cart_number').html(data.total_item);
                        }
                        else {
                            $('#wrap_cart #cart_number').html("99<plus>+</plus>");
                        }
                        swal(
                            'Cám ơn bạn!',
                            'Sản phẩm đã được thêm vào giỏ hàng.',
                            'success'
                        )
                    }
                },
                error: function () {
                    swal(
                        'Rất tiếc...',
                        'Lỗi không thể thêm sản phẩm vào giỏ hàng.',
                        'error'
                    )
                }
            });
        }
    });
}

function number_input(input_class_name) {
    $('body').on('keypress', input_class_name, function(event) {
        var kC = event.keyCode || event.which;1
        if (kC >= 48 && kC <=57) {
            return true;
        }
        event.preventDefault();
    });
    $('body').on('keyup', input_class_name, function() {
        var input = $(this);
        var number_length = $.trim(input.val()).length;
        if (number_length==1 && input.val()=="0") {
            input.val("1");
        }
        if (number_length>=5) {
            input.val(input.val().substr(0,4));
        }
        return true;
    });
    $('body').on('focus', input_class_name, function(event) {
        var input = $(this);
        if (input.val()=="") input.val('1');
    });
    $('body').on('blur', input_class_name, function(event) {
        var input = $(this);
        var number_length = $.trim(input.val()).length;
        if (number_length==0) {
            input.val("1");
        }
        else if (number_length>=5) {
            input.val(input.val().substr(0,4));
        }
        if (in_cart) {
            var post_id = input.attr('data-id');
            var number_item = input.val();
            ajax_update_cart(post_id, number_item);
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
        if (in_cart && current_value>=1 && current_value<js_data.max_number_item_cart) {
            var post_id = input.attr('data-id');
            var number_item = current_value;
            ajax_update_cart(post_id, number_item);
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
        if (in_cart && new_value<js_data.max_number_item_cart) {
            var post_id = input.attr('data-id');
            var number_item = new_value;
            ajax_update_cart(post_id, number_item);
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
        if (in_cart && new_value>=1) {
            var post_id = input.attr('data-id');
            var number_item = new_value;
            ajax_update_cart(post_id, number_item);
        }
    });
}

function init_select2(select_element, placeholder, default_val) {
    select_element.val("").trigger('change');
    select_element.select2({
        placeholder: placeholder,
        matcher: matchCustom
    });
    if (default_val != undefined && default_val != "") {
        select_element.val(default_val).trigger('change')
    }
}
// adapt for select2
function matchCustom(params, data) {
    // If there are no search terms, return all of the data
    if ($.trim(params.term) === '') {
        return data;
    }

    // Do not display the item if there is no 'text' property
    if (typeof data.text === 'undefined') {
        return null;
    }

    // `params.term` should be the term that is used for searching
    // `data.text` is the text that is displayed for the data object
    var change_case_text = data.text.toLowerCase();
    var search_term = params.term.toLowerCase();
    if (change_case_text.indexOf(search_term) > -1) {
        var modifiedData = $.extend({}, data, true);
        // modifiedData.text += ' (matched)';

        // You can return modified objects from here
        // This includes matching the `children` how you want in nested data sets
        return modifiedData;
    }

    // Return `null` if the term should not be displayed
    return null;
}

function show_sweetalert(sweetalert_title, sweetalert_msg, type)
{
    swal(
        sweetalert_title,
        sweetalert_msg,
        type
    )
}