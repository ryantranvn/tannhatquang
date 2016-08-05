// isMobile
    var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };

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
    function openPopup(titlePopup, contentPopup, fnCallbackOpen, fnCallbackClose)
    {
        $('.popup').find('.popupContent').html(contentPopup)
        $('.popup').find('.popupTitle').html(titlePopup).promise().done(function(){
            $('.popup').fadeIn("slow", function() {
                $('body').css({ 'overflow':'hidden' })
                if(fnCallbackOpen != false && typeof fnCallbackOpen == "function"){
                    fnCallbackOpen();
                }
            });
        });
        $('.popup').on('click', '.popupClose', function() {
            $('.popup').fadeOut('fast', function() {
                $('body').css({ 'overflow':'visible' })
                if(fnCallbackClose != false && typeof fnCallbackClose == "function"){
                    fnCallbackClose();
                }
            });
        });
        $('.popup').on('click', '.popupBg', function() {
            $('.popup').fadeOut('fast', function() {
                $('body').css({ 'overflow':'visible' })
                if(fnCallbackClose != false && typeof fnCallbackClose == "function"){
                    fnCallbackClose();
                }
            });
        });
    }

$(document).foundation();

/* load */
$(document).ready( function() {
        
    // menu
        /*
        var activeObj = $('.menu li.active')
        var wObj = activeObj.width()-20;
        var leftObj = activeObj.position().left+10;
        var bar = $('.activeBar')
        var speed = 300
        var activeSubmenu = $('.submenu li.active')
        bar.css({ 'width':(wObj)+'px', 'left' : (leftObj)+'px' })
        */
        
        // hover a of menu
            $('.menu').on('mouseenter', 'li a:not(.linkSub)', function() {
                li = $(this).parent('li')
                $('.submenu.active').parent('li').children('a').children('i.fa.fa-caret-right').transition({ rotate: '0deg' },100,'linear');
                $('.submenu.active').prev('.fa.fa-caret-up').removeClass('active')
                $('.submenu.active').removeClass('active')

                if (li.find('.submenu').length>0) {
                    li.children('a').children('i.fa.fa-caret-right').transition({ rotate: '90deg' },100,'linear');
                    li.find('i.fa.fa-caret-up').addClass('active')
                    li.find('.submenu').addClass('active')
                }
            })
        // move bar on hover a of menu
            /*
            $('.menu').children('li').children('a').mouseenter( function() {
                wNewObj = $(this).parent('li').width()
                leftNewObj = $(this).parent('li').position().left
                
                bar.stop(false,true).animate({
                    'left' : (leftNewObj)+'px',
                    'width' : (wNewObj)+'px'
                }, speed, "linear")
            })
            */
        // out menu
            $('body').on('mouseleave', '.menu', function() {
            /*
            // back location of bar
                bar.stop(false,true).animate({
                    'left' : (leftObj)+'px',
                    'width' : (wObj)+'px'
                }, speed, "linear")
            */
            // hide submenu does not active
                if (!$('.submenu.active').parent('li').hasClass('active')) {
                    $('.submenu.active').parent('li').children('a').children('i.fa.fa-caret-right').transition({ rotate: '0deg' },100,'linear');
                    $('.submenu.active').prev('i.fa.fa-caret-up').removeClass('active')
                    $('.submenu.active').removeClass('active')
                }
            // re-show submenu active
                $('.submenu li.active').parent('ul').parent('li').children('a').children('i.fa.fa-caret-right').transition({ rotate: '90deg' },100,'linear');
                $('.submenu li.active').parent('ul').addClass('active')
            })
    
    // lang
        $('.navigator').on('click', '.langWrapper p', function(e) {
            e.preventDefault()

            $(this).next('ul').stop(false, false).slideToggle(500)
        })
        $('.navigator').on('click', '.langWrapper ul li a', function(e) {
            e.preventDefault()

            $(this).closest('ul').slideUp(500)
            window.location.href = fUrl + 'switch_lang/' + $(this).attr('class')
        });
        clickOut($('.navigator .langWrapper'), function() {
            $('.navigator .langWrapper ul').slideUp(500)
        })
        
    // contactBox
        if ($('.contactBox').length>0) {
            // $('#arcText').circleType({radius: 98, dir: 1.5});
            // $('#arcText').circleType({fitText:true, radius: 60});

            $(window).scroll(function() {
                if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
                   $('.contactBox_mini').css({ 'bottom' : '52px' })
                }
                else {
                    $('.contactBox_mini').css({ 'bottom' : '0px' })
                }
            });
            $('body').on('click', '.contactBox_mini', function() {
                $(this).fadeOut('fast', function() {
                    $('.contactBox').transition({ y: '-340px' },500,'linear')
                })
            })
            $('body').on('click', '.contactBox .titleWrapper', function() {
                $('.contactBox').transition({ y: '0px' },500,'linear', function() {
                    $('.contactBox_mini').fadeIn('fast')    
                })
                
            });

            selectDropDown('#serviceWrapper', "fade")
        // autofill
            $('.contactBox').on('focusout','input[name="email"]', function() {
                $.ajax({
                    url: fUrl + 'ajax_get_user',
                    type: 'POST',
                    cache: false,
                    dataType: 'json',
                    data: { 
                        type : 'email', 
                        inputData : $('input[name="email"]').val(),
                        csrf_hash : $.cookie('csrf_cookie_ci')
                    },
                    success: function(data) {
                        if (data.error == 0) {
                            user = data.user
                            $('input[name="fullname"]').val(user['fullname'])
                            $('input[name="phone"]').val(user['phone'])
                        }
                    },
                    error: function() {
                        console.log('error')
                    }
                });
            })
            $('.contactBox').on('focusout','input[name="phone"]', function() {
                $.ajax({
                    url: fUrl + 'ajax_get_user',
                    type: 'POST',
                    cache: false,
                    dataType: 'json',
                    data: { 
                        type : 'phone', 
                        inputData : $('input[name="phone"]').val(),
                        csrf_hash : $.cookie('csrf_cookie_ci')
                    },
                    success: function(data) {
                        if (data.error == 0) {
                            user = data.user
                            $('input[name="fullname"]').val(user['fullname'])
                            $('input[name="email"]').val(user['email'])
                        }
                    },
                    error: function() {
                        console.log('error')
                    }
                });
            })

        // validation
            $("#frmContact").validate({
                rules: {
                    fullname: { required: true, maxlength: 200 },
                    phone: { required: true, minlength: 8, maxlength: 20 },
                    email: { required: true, email: true }
                },
                messages: {
                    fullname: {
                        required: "bắt buộc",
                        maxlength: "nhiều nhất 200 ký tự"
                    },
                    phone: {
                        required: "bắt buộc",
                        minlength: "ít nhất 8 ký tự",
                        maxlength: "niều nhất 20 ký tự"
                    },
                    email: {
                        required: "bắt buộc",
                        email: "email chưa đúng định dạng"
                    }
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    $.ajax({
                        url: fUrl + 'contact/ajax_submitContactBox',
                        type: 'POST',
                        cache: false,
                        dataType: 'json',
                        data: { 
                            fullname : $('input[name="fullname"]').val(), 
                            email : $('input[name="email"]').val(), 
                            phone : $('input[name="phone"]').val(),
                            service : $('input[name="service"]').val(),
                            csrf_hash : $.cookie('csrf_cookie_ci')

                        },
                        success: function(data) {
                            if (data.error == 1) {
                                openPopup(errorText.errorTitle, data.errorContent)
                            }
                            else {
                                openPopup(errorText.validContactBox_title, errorText.validContactBox_content)
                            }
                        },
                        error: function() {
                            openPopup(errorText.errorTitle,errorText.ajax);
                        }
                    });
                }
            });
        }
    // positive number
        if ($(".positive-integer").length>0) {
            $(".positive-integer").numeric({ decimal: false, negative: false }, function() { 
                this.value = ""; this.focus(); 
            });
        }
// PAGEs
    // homePage
        if ($('#homePage').length>0) {
            $('.bxslider-1').bxSlider({
                auto : true,
                mode : 'fade'
            });
            $('.bxslider-2').bxSlider({
                auto : true,
                mode : 'fade'
            });
            $('.bxslider-3').bxSlider({
                auto : true,
                mode : 'fade',
                // pager : false,
                nextSelector: '#slider-next',
                prevSelector: '#slider-prev',
                nextText: '<img src="'+fUrl+'assets/frontend/images/icon-next.png" />',
                prevText: '<img src="'+fUrl+'assets/frontend/images/icon-prev.png" />'
            });

            // validation
            $("#frmContact").validate({
                rules: {
                    fullname: { required: true, maxlength: 200 },
                    phone: { required: true, minlength: 8, maxlength: 20 },
                    email: { required: true, email: true }
                },
                messages: {
                    fullname: {
                        required: "bắt buộc",
                        maxlength: "nhiều nhất 200 ký tự"
                    },
                    phone: {
                        required: "bắt buộc",
                        minlength: "ít nhất 8 ký tự",
                        maxlength: "niều nhất 20 ký tự"
                    },
                    email: {
                        required: "bắt buộc",
                        email: "email chưa đúng định dạng"
                    }
                },
                submitHandle: function(form) {
                    form.submit();
                    
                    /*$.ajax({
                        url: fUrl + 'ajax_validExisted',
                        type: 'POST',
                        cache: false,
                        dataType: 'text',
                        data: { email:$('input[name="email"]').val(), phone:$('input[name="phone"]').val(), 'csrf_ci' : $('input[name="csrf_ci"]').val() },
                        success: function(data) {
                            if (data == "email") {
                                alert('Email này đã tồn tại')
                                return false;
                            }
                            else if (data == "phone") {
                                alert('Số điện thoại này đã tồn tại')
                                return false;
                            }
                            else {
                                // form.submit();
                                return false;
                            }
                        },
                        error: function() {
                            console.log('Can not send data');
                        }
                    });*/
                }
            });
        }
    // contactPage
        if ($('#contactPage').length>0) {

        // autofill
            $('#frmContact').on('focusout','input[name="email"]', function() {
                $.ajax({
                    url: fUrl + 'ajax_get_user',
                    type: 'POST',
                    cache: false,
                    dataType: 'json',
                    data: { 
                        type : 'email', 
                        inputData : $('input[name="email"]').val(),
                        csrf_hash : $.cookie('csrf_cookie_ci')
                    },
                    success: function(data) {
                        if (data.error == 0) {
                            user = data.user
                            $('input[name="fullname"]').val(user['fullname'])
                            $('input[name="phone"]').val(user['phone'])
                            $('input[name="address"]').val(user['address'])
                        }
                    },
                    error: function() {
                        console.log('error')
                    }
                });
            })
            $('#frmContact').on('focusout','input[name="phone"]', function() {
                $.ajax({
                    url: fUrl + 'ajax_get_user',
                    type: 'POST',
                    cache: false,
                    dataType: 'json',
                    data: { 
                        type : 'phone', 
                        inputData : $('input[name="phone"]').val(),
                        csrf_hash : $.cookie('csrf_cookie_ci')
                    },
                    success: function(data) {
                        if (data.error == 0) {
                            user = data.user
                            $('input[name="fullname"]').val(user['fullname'])
                            $('input[name="email"]').val(user['email'])
                            $('input[name="address"]').val(user['address'])
                        }
                    },
                    error: function() {
                        console.log('error')
                    }
                });
            })
        // validation
            $("#frmContact").validate({
                rules: {
                    fullname: { required: true, maxlength: 200 },
                    phone: { required: true, minlength: 8, maxlength: 20 },
                    address: { required: true, maxlength: 500 },
                    title: { required: true, maxlength: 200 },
                    content: { required: true, maxlength: 1000 },
                    email: { required: true, email: true }
                },
                messages: {
                    fullname: {
                        required: "bắt buộc",
                        maxlength: "nhiều nhất 200 ký tự"
                    },
                    phone: {
                        required: "bắt buộc",
                        minlength: "ít nhất 8 ký tự",
                        maxlength: "niều nhất 20 ký tự"
                    },
                    address: {
                        required: "bắt buộc",
                        maxlength: "niều nhất 500 ký tự"
                    },
                    title: {
                        required: "bắt buộc",
                        maxlength: "niều nhất 200 ký tự"
                    },
                    content: {
                        required: "bắt buộc",
                        maxlength: "niều nhất 1000 ký tự"
                    },
                    email: {
                        required: "bắt buộc",
                        email: "email chưa đúng định dạng"
                    }
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    $.ajax({
                        url: fUrl + 'contact/ajax_submitContactPage',
                        type: 'POST',
                        cache: false,
                        dataType: 'json',
                        data: { 
                            fullname : $('input[name="fullname"]').val(), 
                            email : $('input[name="email"]').val(), 
                            phone : $('input[name="phone"]').val(),
                            address : $('input[name="address"]').val(), 
                            title : $('input[name="title"]').val(),
                            content : $('textarea[name="content"]').val(),
                            csrf_hash : $.cookie('csrf_cookie_ci')
                        },
                        success: function(data) {
                            if (data.error == 1) {
                                openPopup(errorText.errorTitle, data.errorContent)
                            }
                            else {
                                openPopup(errorText.validContactBox_title, errorText.validContactBox_content)
                            }
                        },
                        error: function() {
                            openPopup(errorText.errorTitle,errorText.ajax);
                        }
                    });
                }
            });

            // titlePopup = "Chúc mừng bạn đã hoàn tất"
            // contentPopup = '<p>Chúng tôi đã nhận được thông tin và sẽ liên hệ quý khách sớm nhất. <br/>Cảm ơn đã lựa chọn Trung tâm đồng sơn Vietnam Star - Địa chỉ đáng tin cậy cho chiếc xe yêu quý của quý khách!</p><a class="btnBlue btnBackHome" href="'+fUrl+'">Quay lại trang chủ</a>'
            // openPopup(titlePopup, contentPopup)
        }
    // bookingPage
        if ($('#bookingPage').length>0) {

        // select dropdown list
            selectDropDown('#carWrapper', "slide", function() {
                if ($('input[name="car"]').val()!="Mercedes-Benz") {
                    $('input[name="model"]').val('')
                    $('#modelWrapper').fadeOut('fast', function() {
                        $('#loaixeWrapper').fadeIn('fast')    
                    })
                }
                else {
                    $('#loaixeWrapper').fadeOut('fast', function() {
                        $('#modelWrapper').fadeIn('fast')    
                    })
                }
            })
            $('input[name="modelOther"]').change( function() {
                $('input[name="model"]').val($('input[name="modelOther"]').val())
            })
            selectDropDown('#modelWrapper')
            selectDropDown('#serviceWrapper')

        // upload file
            $('body').on('click','.btnUpload', function(e) {
                e.preventDefault();
                $('input[name="ajax_files[]"]').click()
            });
            $('input[name="ajax_files[]"]').change( function() {
                var totalFiles = document.getElementById("ajax_files").files.length;
                if (totalFiles<1 || totalFiles>5) {
                    openPopup(errorText.errorTitle,errorText.uploadOver);
                }
                else {
                    $('#frmUpload').ajaxSubmit({
                        dataType:  'json',
                        data: { csrf_hash : $.cookie('csrf_cookie_ci') },
                        success: function(data) {
                            $('input[name="csrf_hash"]').val($.cookie('csrf_cookie_ci'));
                            if (data.errorText=="") {
                                files = data.files;
                                htmlStr = '';
                                for (i=0; i<files.length; i++) {
                                    htmlStr += '<div class="imgWrapper">';
                                        htmlStr += '<img class="thumbnail" src="'+uploadDir+'user/temps/'+files[i]+'" />';
                                        htmlStr += '<input type="text" name="filenames[]" class="filenames hiddenInput" value="'+files[i]+'" />'
                                        htmlStr += '<div class="imgDel pointer"><i class="fa fa-trash" aria-hidden="true"></i></div>'
                                    htmlStr += '</div>';
                                }
                                $('#imgContainer').html(htmlStr)
                            }
                            else {
                                openPopup(errorText.errorTitle, data.errorText);
                            }
                        },
                        error: function() {
                            openPopup(errorText.errorTitle,errorText.ajax);
                        }
                    });
                }
            })
            
            $('body').on('click', '.imgWrapper .imgDel', function() {
                $(this).parent('.imgWrapper').remove()
            })
        
            myDatePicker($('input[name="date"]'))
            $('input[name="title"]').limit('250','#titleLimit');
            $('textarea[name="bookingContent"]').limit('2000','#bookingContentLimit');
            
        // autofill
            $('#frmBooking').on('focusout','input[name="email"]', function() {
                $.ajax({
                    url: fUrl + 'ajax_get_user',
                    type: 'POST',
                    cache: false,
                    dataType: 'json',
                    data: { 
                        type : 'email', 
                        inputData : $('input[name="email"]').val(),
                        csrf_hash : $.cookie('csrf_cookie_ci')
                    },
                    success: function(data) {
                        if (data.error == 0) {
                            user = data.user
                            $('input[name="fullname"]').val(user['fullname'])
                            $('input[name="phone"]').val(user['phone'])
                            $('input[name="address"]').val(user['address'])
                        }
                    },
                    error: function() {
                        console.log('error')
                    }
                });
            })
            $('#frmBooking').on('focusout','input[name="phone"]', function() {
                $.ajax({
                    url: fUrl + 'ajax_get_user',
                    type: 'POST',
                    cache: false,
                    dataType: 'json',
                    data: { 
                        type : 'phone', 
                        inputData : $('input[name="phone"]').val(),
                        csrf_hash : $.cookie('csrf_cookie_ci')
                    },
                    success: function(data) {
                        if (data.error == 0) {
                            user = data.user
                            $('input[name="fullname"]').val(user['fullname'])
                            $('input[name="email"]').val(user['email'])
                            $('input[name="address"]').val(user['address'])
                        }
                    },
                    error: function() {
                        console.log('error')
                    }
                });
            })

        // validation
            $("#frmBooking").validate({
                rules: {
                    fullname: { required: true, maxlength: 200 },
                    email: { required: true, email: true },
                    phone: { required: true, minlength: 8, maxlength: 20 },
                    address: { required: true, maxlength: 500 },
                    title: { required: true, maxlength: 200 },
                    bookingContent: { required: true, maxlength: 2000 },
                    date: { notEqualValue : "Ngày/Tháng/Năm" },
                    model: { required: true },
                    modelOther: { required: true }
                },
                messages: {
                    fullname: {
                        required: "bắt buộc",
                        maxlength: "nhiều nhất 200 ký tự"
                    },
                    email: {
                        required: "bắt buộc",
                        email: "email chưa đúng định dạng"
                    },
                    phone: {
                        required: "bắt buộc",
                        minlength: "ít nhất 8 ký tự",
                        maxlength: "niều nhất 20 ký tự"
                    },
                    address: {
                        required: "bắt buộc",
                        maxlength: "niều nhất 500 ký tự"
                    },
                    title: {
                        required: "bắt buộc",
                        maxlength: "nhiều nhất 200 ký tự"
                    },
                    bookingContent: {
                        required: "bắt buộc",
                        maxlength: "nhiều nhất 2000 ký tự"
                    },
                    date: { 
                        notEqualValue : "bắt buộc" 
                    },
                    model: {
                        required: "bắt buộc"
                    },
                    modelOther: {
                        required: "bắt buộc"
                    }
                },
                submitHandler: function(form, event) {
                    event.preventDefault()

                    if ($('#imgContainer').find('.imgWrapper').length==0) {
                        openPopup(errorText.errorTitle, errorText.uploadOver)
                    }
                    else {

                        $.ajax({
                            url: fUrl + 'booking/ajax_submitBooking',
                            type: 'POST',
                            cache: false,
                            dataType: 'json',
                            data: { 
                                fullname : $('input[name="fullname"]').val(), 
                                email : $('input[name="email"]').val(), 
                                phone : $('input[name="phone"]').val(),
                                address : $('input[name="address"]').val(),
                                car : $('input[name="car"]').val(),
                                model : $('input[name="model"]').val(),
                                service : $('input[name="service"]').val(),
                                date : $('input[name="date"]').val(),
                                filenames : $('input[name="filenames[]').serializeArray(),
                                title : $('input[name="title"]').val(),
                                content : $('textarea[name="bookingContent"]').val(),
                                csrf_hash : $.cookie('csrf_cookie_ci')
                            },
                            success: function(data) {
                                if (data.error == 1) {
                                    openPopup(errorText.errorTitle, data.errorContent)
                                }
                                else {
                                    openPopup(errorText.validContactBox_title, errorText.validContactBox_content)
                                }
                            },
                            error: function() {
                                openPopup(errorText.errorTitle,errorText.ajax);
                            }
                        });
                    }
                }
            });
        }
})