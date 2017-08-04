    var fUrl = window.location.protocol + "//" + window.location.host + "/"
    var assetsUrl = fUrl + "assets/"
    var bUrl = fUrl + "backend/"
    var apiUrl = fUrl + "api/"
    var libsUrl = fUrl + "library/"
    var uploadDir = fUrl + 'upload/'

// URL
    function lastUrl()
    {
        arrUrl = window.location.pathname.split('/');
        url = arrUrl[arrUrl.length-1]=="" ? arrUrl[arrUrl.length-2] : arrUrl[arrUrl.length-1];
        return url;
    }

// Layout
    function scrollup()
    {
        $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        });
        $('.scrollup').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });
    }

// DATE & TIME
    // today
        function nowDate()
        {
            var d=new Date();
            var weekday=new Array(7);
            weekday[0]="Chủ Nhật";
            weekday[1]="Thứ Hai";
            weekday[2]="Thứ Ba";
            weekday[3]="Thứ Tư";
            weekday[4]="Thứ Năm";
            weekday[5]="Thứ Sáu";
            weekday[6]="Thứ Bảy";

            document.write(weekday[d.getDay()]+", "+d.getDate()+"/"+d.getMonth()+"/"+d.getFullYear());
        }
    // datepicker
        function myDatePicker(ele)
        {
            ele.datepicker({
                dateFormat: 'dd-mm-yy',
                changeMonth: true,
                changeYear: true,
                minDate: "-Y",
                maxDate: "31-12-2030",
                defaultDate: new Date(),
                // minDate: "-Y",
                // maxDate: "100Y",//new Date(),
                // yearRange: "-0:10"
            });
        }

// STRING
    function trim_space(str)
    {
        return str.replace(/\s+/g, " ").trim();
    }
    function cut_string(obj_class, num_obj, pos_space)
    {
        obj = new Array();
        for (i=0; i<num_obj; i++) {
            obj[i] = $(obj_class+':eq('+i+')').text();
        }
        jQuery.each(obj, function(index, value) {
            arr_str = value.split(" ");

            if (arr_str.length>pos_space) {
                chuoi = '';
                for(i=0; i<pos_space; i++) {
                    chuoi += arr_str[i]+' ';
                }
                $(obj_class+':eq('+index+')').text(chuoi+'...');
            }
        });
    }

    function randString(n, type)
    {
        if(!n)
        {
            n = 5;
        }

        var text = '';
        if (type == "alpha") {
            var possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        }
        else if (type == "alphaNum") {
            var possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        }

        for(var i=0; i < n; i++)
        {
            text += String(possible).charAt(Math.floor(Math.random() * String(possible).length));
        }

        return text;
    }

    function randPassword(n)
    {
        if(!n)
        {
            n = 5;
        }

        var text = '';
        var possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()';

        for(var i=0; i < n; i++)
        {
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        }

        return text;
    }

    function make_url(str)
    {
        str= str.toLowerCase();
        str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");
        str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");
        str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");
        str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");
        str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
        str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
        str= str.replace(/đ/g,"d");
        str= str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g,"-");

        str= str.replace(/-+-/g,"-"); //thay thế 2- thành 1-
        str= str.replace(/^\-+|\-+$/g,"");

        return str;
    }

    function fill_url(value, el)
    {
        el.val(make_url(value));
    }

    // Generate URL from title
    function gen_url(getElement, setElement)
    {
        getElement.blur( function() {
            value = $(this).val();
            fill_url(value, setElement);
        });
    }

// NUMBER
    function genRanNum(min,max)
    {
        var random = Math.floor(Math.random() * (max - min + 1)) + min;
        return (random < 4 && random > -4) ? GenerateRandomNumber() : random;
    }

// FORM
    function reset_form(form)
    {
        form.ready( function() {
            form.find('input[type="text"], textarea').val('').find('input[type="checkbox"]').attr('checked','checked');
        });
    }
    function preventUnicode(fieldInput)
    {
        var str = fieldInput.val();// lấy chuỗi dữ liệu nhập vào
        str= str.toLowerCase();// chuyển chuỗi sang chữ thường để xử lý
        /* tìm kiếm và thay thế tất cả các nguyên âm có dấu sang không dấu*/
        str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");
        str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");
        str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");
        str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");
        str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
        str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
        str= str.replace(/đ/g,"d");
        str= str.replace(/!|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\:|\;|\'| |\"|\&|\#|\[|\]|~|$/g,"");
        //str= str.replace("\.","-");
        //str= str.replace("_","-");
        //str= str.replace("@","-");
        /* tìm và thay thế các kí tự đặc biệt trong chuỗi sang kí tự - */
        //str= str.replace(/-+-/g,"-"); //thay thế 2- thành 1-
        str= str.replace(/^[0-9]/g,"");//cắt bỏ ký tự [0-9] ở đầu
        str= str.replace(/^@/g,"");//cắt bỏ ký tự @ ở đầu
        //str= str.replace(/^\-+|\-+$/g,"");//cắt bỏ ký tự - ở đầu và cuối chuỗi
        fieldInput.val(str);// xuất kết quả xữ lý ra
    }
    function preventBeginWith(element, keycode)
    {
        $('body').on('keypress', element, function(e) {
            if ($.trim($(element).val()).length==0) {
                if (e.keyCode==keycode) {
                    e.preventDefault();
                }
            }
        });
    }
    function preventLongMore_Number(element, max_length)
    {
        $('body').on('keypress', element, function(e) {
            if ($.trim($(element).val()).length>0) {
                if ($.trim($(element).val()).length >= max_length) {
                    e.preventDefault();
                }
            }
        });
    }
    function preventLongMore(className, classCompare)
    {
        $('body').on('keypress', '.'+className, function(e) {
            if ($.trim($('.'+className).val()).length>0) {
                if ($.trim($('.'+className).val()).length >= $.trim($('.'+classCompare).val()).length) {
                    e.preventDefault();
                }
            }
        });
    }
// Validate
    // notEqualValue
        jQuery.validator.addMethod("notEqualValue", function(value, element, param) {
            return this.optional(element) || value != param;
        }, "Please specify a different (non-default) value");

    // valid domain in email
        // function isPruEmail(email)
        // {
        //     var re = /^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/
        //     if (email.indexOf('@prudential.com.vn', email.length - '@prudential.com.vn'.length) !== -1) {
        //         return true
        //     } else {
        //         return false
        //     }
        // }
        // jQuery.validator.addMethod("pruEmail", function(value, element) {
        // // allow any non-whitespace characters as the host part
        //     if (isPruEmail(value)) {
        //         return true
        //     }
        // }, 'Vui lòng nhập email của prudential.');


    function isUrl(url) {
        return /^(http(s)?:\/\/)?(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(url);
    }
    // count word
        function getWordCount(wordString) {
            var words = wordString.split(" ");
            words = words.filter(function(words) {
                return words.length > 0
            }).length;
            return words;
        }
        //add the custom validation method
        jQuery.validator.addMethod("wordCount", function(value, element, params) {
            var count = getWordCount(value);
            if(count >= params[0]) {
                return true;
            }
        }, "A minimum of {0} words is required here.");

// KEY PRESS
    // key press alpha num
        function justAlphaNum(inputElement)
        {
            inputElement.keypress(function(event)
            {
                var kC = event.keyCode || event.which
                if ( kC == 8 || (kC >= 65 && kC <= 90) || (kC >= 97 && kC <= 122) || (kC >= 48 && kC <=58) || kC == 44) {
                    return true;
                }
                event.preventDefault();
            });
        }
    // disable enter Input
        function disableEnter(inputElement)
        {
            inputElement.keypress(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                }
            });
        }

// FancyBox
    // function fancybox()
    // {
    //     $(".fancybox").fancybox({
    //         padding: 0,
    //         openEffect : 'elastic',
    //         openSpeed  : 150,
    //         closeEffect : 'elastic',
    //         closeSpeed  : 150,
    //         closeClick : true,
    //         helpers : {
    //             overlay : {
    //                 css : {
    //                     'background' : 'rgba(0,0,0, 0.5)'
    //                 }
    //             }
    //         }
    //     });
    // }

// Brownsers
    // javascript
    var ie = (function(){
        var undef,
            v = 3,
            div = document.createElement('div'),
            all = div.getElementsByTagName('i');

        while (
            div.innerHTML = '<!--[if gt IE ' + (++v) + ']><i></i><![endif]-->',
            all[0]
        );

        return v > 4 ? v : undef;

    }());

    // Jquery
    var BrowserDetect =
    {
        init: function ()
        {
            this.browser = this.searchString(this.dataBrowser) || "Other";
            this.version = this.searchVersion(navigator.userAgent) ||       this.searchVersion(navigator.appVersion) || "Unknown";
        },

        searchString: function (data)
        {
            for (var i=0 ; i < data.length ; i++)
            {
                var dataString = data[i].string;
                this.versionSearchString = data[i].subString;

                if (dataString.indexOf(data[i].subString) != -1)
                {
                    return data[i].identity;
                }
            }
        },

        searchVersion: function (dataString)
        {
            var index = dataString.indexOf(this.versionSearchString);
            if (index == -1) return;
            return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
        },

        dataBrowser:
        [
            { string: navigator.userAgent, subString: "Chrome",  identity: "Chrome" },
            { string: navigator.userAgent, subString: "MSIE",    identity: "Explorer" },
            { string: navigator.userAgent, subString: "Firefox", identity: "Firefox" },
            { string: navigator.userAgent, subString: "Safari",  identity: "Safari" },
            { string: navigator.userAgent, subString: "Opera",   identity: "Opera" }
        ]

    };
    BrowserDetect.init();

// is Function
    function isFunction(functionToCheck)
    {
        var getType = {};
        return functionToCheck && getType.toString.call(functionToCheck) === '[object Function]';
    }

// CLEAR CONSOLE
    function clearconsole() {
        console.log(window.console);
        if(window.console || window.console.firebug) {
            console.clear();
        }
    }

// YOUTUBE
    /* get ID from URL */
    function getYouTubeIDFromURL(url)
    {
        if (url.indexOf('www.youtube.com/')==-1) {
            var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
            var match = url.match(regExp);
            if (match&&match[7].length==11){
                console.log(match[7])
                return match[7];
            }else{
                alert("Url incorrecta");
            }
        }
        else {
            console.log(url.match(/\?v=([^&]*)/)[1])
            return url.match(/\?v=([^&]*)/)[1];

        }
    }

// add link on copy content
    function addLink()
    {
        //Get the selected text and append the extra info
        var body_element = document.getElementsByTagName('body')[0];
        var selection;
        selection = window.getSelection();
        var pagelink = "<br /><br /> Nguồn bài viết : <a href='"+document.location.href+"'>"+document.location.href+"</a>";
        var copytext = selection + pagelink;
        var newdiv = document.createElement('div');

        //hide the newly created container
        newdiv.style.position='absolute';
        newdiv.style.left='-99999px';

        //insert the container, fill it with the extended text, and define the new selection
        body_element.appendChild(newdiv);
        newdiv.innerHTML = copytext;
        selection.selectAllChildren(newdiv);

        window.setTimeout(function() {
            body_element.removeChild(newdiv);
        },0);
    }

// click out element
    function clickOut(element, fn)
    {
        $(document).mouseup(function (e) {
            e.stopPropagation();
            var clickedElement = e.target;
            if (element.has(e.target).length === 0) {
                if(typeof fn == "function"){
                    fn();
                }
            }
        });
    }

// findButNotNested
    $.fn.findButNotInside = function(selector) {
        var origElement = $(this);
        return origElement.find(selector).filter(function() {
            var nearestMatch = $(this).parent().closest(selector);
            return nearestMatch.length == 0 || origElement.find(nearestMatch).length == 0;
        });
    };
