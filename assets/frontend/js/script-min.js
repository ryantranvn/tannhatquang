function selectDropDown(e,n,t){speed="fast",$("body").on("click",e+" .valueShow",function(){"fade"==n?$(e).children("ul").fadeToggle(speed):$(e).children("ul").slideToggle(speed)}),$("body").on("click",e+" ul li",function(){selectedValue=$(this).html(),$(e).children(".valueShow").html(selectedValue),$(e).children(".valueGet").val($(this).attr("data-val")),"fade"==n?$(e).children("ul").fadeOut(speed,function(){"function"==typeof t&&t()}):$(e).children("ul").slideUp(speed,function(){"function"==typeof t&&t()})}),$(document).mouseup(function(t){t.stopPropagation();var a=t.target;0===$(e).has(t.target).length&&("fade"==n?$(e).children("ul").fadeOut(speed):$(e).children("ul").slideUp(speed))})}function openPopup(e,n,t,a){$(".popup").find(".popupContent").html(n),$(".popup").find(".popupTitle").html(e).promise().done(function(){$(".popup").fadeIn("slow",function(){$("body").css({overflow:"hidden"}),0!=t&&"function"==typeof t&&t()})}),$(".popup").on("click",".popupClose",function(){$(".popup").fadeOut("fast",function(){$("body").css({overflow:"visible"}),0!=a&&"function"==typeof a&&a()})}),$(".popup").on("click",".popupBg",function(){$(".popup").fadeOut("fast",function(){$("body").css({overflow:"visible"}),0!=a&&"function"==typeof a&&a()})})}var isMobile={Android:function(){return navigator.userAgent.match(/Android/i)},BlackBerry:function(){return navigator.userAgent.match(/BlackBerry/i)},iOS:function(){return navigator.userAgent.match(/iPhone|iPad|iPod/i)},Opera:function(){return navigator.userAgent.match(/Opera Mini/i)},Windows:function(){return navigator.userAgent.match(/IEMobile/i)},any:function(){return isMobile.Android()||isMobile.BlackBerry()||isMobile.iOS()||isMobile.Opera()||isMobile.Windows()}};$(document).foundation(),$(document).ready(function(){$(".menu").on("mouseenter","li a:not(.linkSub)",function(){li=$(this).parent("li"),$(".submenu.active").parent("li").children("a").children("i.fa.fa-caret-right").transition({rotate:"0deg"},100,"linear"),$(".submenu.active").prev(".fa.fa-caret-up").removeClass("active"),$(".submenu.active").removeClass("active"),li.find(".submenu").length>0&&(li.children("a").children("i.fa.fa-caret-right").transition({rotate:"90deg"},100,"linear"),li.find("i.fa.fa-caret-up").addClass("active"),li.find(".submenu").addClass("active"))}),$("body").on("mouseleave",".menu",function(){$(".submenu.active").parent("li").hasClass("active")||($(".submenu.active").parent("li").children("a").children("i.fa.fa-caret-right").transition({rotate:"0deg"},100,"linear"),$(".submenu.active").prev("i.fa.fa-caret-up").removeClass("active"),$(".submenu.active").removeClass("active")),$(".submenu li.active").parent("ul").parent("li").children("a").children("i.fa.fa-caret-right").transition({rotate:"90deg"},100,"linear"),$(".submenu li.active").parent("ul").addClass("active")}),$(".navigator").on("click",".langWrapper p",function(e){e.preventDefault(),$(this).next("ul").stop(!1,!1).slideToggle(500)}),$(".navigator").on("click",".langWrapper ul li a",function(e){e.preventDefault(),$(this).closest("ul").slideUp(500),window.location.href=fUrl+"switch_lang/"+$(this).attr("class")}),clickOut($(".navigator .langWrapper"),function(){$(".navigator .langWrapper ul").slideUp(500)}),$(".contactBox").length>0&&($(window).scroll(function(){$(window).scrollTop()+$(window).height()>$(document).height()-100?$(".contactBox_mini").css({bottom:"52px"}):$(".contactBox_mini").css({bottom:"0px"})}),$("body").on("click",".contactBox_mini",function(){$(this).fadeOut("fast",function(){$(".contactBox").transition({y:"-340px"},500,"linear")})}),$("body").on("click",".contactBox .titleWrapper",function(){$(".contactBox").transition({y:"0px"},500,"linear",function(){$(".contactBox_mini").fadeIn("fast")})}),selectDropDown("#serviceWrapper","fade"),$(".contactBox").on("focusout",'input[name="email"]',function(){$.ajax({url:fUrl+"ajax_get_user",type:"POST",cache:!1,dataType:"json",data:{type:"email",inputData:$('input[name="email"]').val(),csrf_hash:$.cookie("csrf_cookie_ci")},success:function(e){0==e.error&&(user=e.user,$('input[name="fullname"]').val(user.fullname),$('input[name="phone"]').val(user.phone))},error:function(){console.log("error")}})}),$(".contactBox").on("focusout",'input[name="phone"]',function(){$.ajax({url:fUrl+"ajax_get_user",type:"POST",cache:!1,dataType:"json",data:{type:"phone",inputData:$('input[name="phone"]').val(),csrf_hash:$.cookie("csrf_cookie_ci")},success:function(e){0==e.error&&(user=e.user,$('input[name="fullname"]').val(user.fullname),$('input[name="email"]').val(user.email))},error:function(){console.log("error")}})}),$("#frmContact").validate({rules:{fullname:{required:!0,maxlength:200},phone:{required:!0,minlength:8,maxlength:20},email:{required:!0,email:!0}},messages:{fullname:{required:"bắt buộc",maxlength:"nhiều nhất 200 ký tự"},phone:{required:"bắt buộc",minlength:"ít nhất 8 ký tự",maxlength:"niều nhất 20 ký tự"},email:{required:"bắt buộc",email:"email chưa đúng định dạng"}},submitHandler:function(e,n){n.preventDefault(),$.ajax({url:fUrl+"contact/ajax_submitContactBox",type:"POST",cache:!1,dataType:"json",data:{fullname:$('input[name="fullname"]').val(),email:$('input[name="email"]').val(),phone:$('input[name="phone"]').val(),service:$('input[name="service"]').val(),csrf_hash:$.cookie("csrf_cookie_ci")},success:function(e){1==e.error?openPopup(errorText.errorTitle,e.errorContent):openPopup(errorText.validContactBox_title,errorText.validContactBox_content)},error:function(){openPopup(errorText.errorTitle,errorText.ajax)}})}})),$(".positive-integer").length>0&&$(".positive-integer").numeric({decimal:!1,negative:!1},function(){this.value="",this.focus()}),$("#homePage").length>0&&($(".bxslider-1").bxSlider({auto:!0,mode:"fade"}),$(".bxslider-2").bxSlider({auto:!0,mode:"fade"}),$(".bxslider-3").bxSlider({auto:!0,mode:"fade",nextSelector:"#slider-next",prevSelector:"#slider-prev",nextText:'<img src="'+fUrl+'assets/frontend/images/icon-next.png" />',prevText:'<img src="'+fUrl+'assets/frontend/images/icon-prev.png" />'}),$("#frmContact").validate({rules:{fullname:{required:!0,maxlength:200},phone:{required:!0,minlength:8,maxlength:20},email:{required:!0,email:!0}},messages:{fullname:{required:"bắt buộc",maxlength:"nhiều nhất 200 ký tự"},phone:{required:"bắt buộc",minlength:"ít nhất 8 ký tự",maxlength:"niều nhất 20 ký tự"},email:{required:"bắt buộc",email:"email chưa đúng định dạng"}},submitHandle:function(e){e.submit()}})),$("#contactPage").length>0&&($("#frmContact").on("focusout",'input[name="email"]',function(){$.ajax({url:fUrl+"ajax_get_user",type:"POST",cache:!1,dataType:"json",data:{type:"email",inputData:$('input[name="email"]').val(),csrf_hash:$.cookie("csrf_cookie_ci")},success:function(e){0==e.error&&(user=e.user,$('input[name="fullname"]').val(user.fullname),$('input[name="phone"]').val(user.phone),$('input[name="address"]').val(user.address))},error:function(){console.log("error")}})}),$("#frmContact").on("focusout",'input[name="phone"]',function(){$.ajax({url:fUrl+"ajax_get_user",type:"POST",cache:!1,dataType:"json",data:{type:"phone",inputData:$('input[name="phone"]').val(),csrf_hash:$.cookie("csrf_cookie_ci")},success:function(e){0==e.error&&(user=e.user,$('input[name="fullname"]').val(user.fullname),$('input[name="email"]').val(user.email),$('input[name="address"]').val(user.address))},error:function(){console.log("error")}})}),$("#frmContact").validate({rules:{fullname:{required:!0,maxlength:200},phone:{required:!0,minlength:8,maxlength:20},address:{required:!0,maxlength:500},title:{required:!0,maxlength:200},content:{required:!0,maxlength:1e3},email:{required:!0,email:!0}},messages:{fullname:{required:"bắt buộc",maxlength:"nhiều nhất 200 ký tự"},phone:{required:"bắt buộc",minlength:"ít nhất 8 ký tự",maxlength:"niều nhất 20 ký tự"},address:{required:"bắt buộc",maxlength:"niều nhất 500 ký tự"},title:{required:"bắt buộc",maxlength:"niều nhất 200 ký tự"},content:{required:"bắt buộc",maxlength:"niều nhất 1000 ký tự"},email:{required:"bắt buộc",email:"email chưa đúng định dạng"}},submitHandler:function(e,n){n.preventDefault(),$.ajax({url:fUrl+"contact/ajax_submitContactPage",type:"POST",cache:!1,dataType:"json",data:{fullname:$('input[name="fullname"]').val(),email:$('input[name="email"]').val(),phone:$('input[name="phone"]').val(),address:$('input[name="address"]').val(),title:$('input[name="title"]').val(),content:$('textarea[name="content"]').val(),csrf_hash:$.cookie("csrf_cookie_ci")},success:function(e){1==e.error?openPopup(errorText.errorTitle,e.errorContent):openPopup(errorText.validContactBox_title,errorText.validContactBox_content)},error:function(){openPopup(errorText.errorTitle,errorText.ajax)}})}})),$("#bookingPage").length>0&&(selectDropDown("#carWrapper","slide",function(){"Mercedes-Benz"!=$('input[name="car"]').val()?($('input[name="model"]').val(""),$("#modelWrapper").fadeOut("fast",function(){$("#loaixeWrapper").fadeIn("fast")})):$("#loaixeWrapper").fadeOut("fast",function(){$("#modelWrapper").fadeIn("fast")})}),$('input[name="modelOther"]').change(function(){$('input[name="model"]').val($('input[name="modelOther"]').val())}),selectDropDown("#modelWrapper"),selectDropDown("#serviceWrapper"),$("body").on("click",".btnUpload",function(e){e.preventDefault(),$('input[name="ajax_files[]"]').click()}),$('input[name="ajax_files[]"]').change(function(){var e=document.getElementById("ajax_files").files.length;1>e||e>5?openPopup(errorText.errorTitle,errorText.uploadOver):$("#frmUpload").ajaxSubmit({dataType:"json",data:{csrf_hash:$.cookie("csrf_cookie_ci")},success:function(e){if($('input[name="csrf_hash"]').val($.cookie("csrf_cookie_ci")),""==e.errorText){for(files=e.files,htmlStr="",i=0;i<files.length;i++)htmlStr+='<div class="imgWrapper">',htmlStr+='<img class="thumbnail" src="'+uploadDir+"user/temps/"+files[i]+'" />',htmlStr+='<input type="text" name="filenames[]" class="filenames hiddenInput" value="'+files[i]+'" />',htmlStr+='<div class="imgDel pointer"><i class="fa fa-trash" aria-hidden="true"></i></div>',htmlStr+="</div>";$("#imgContainer").html(htmlStr)}else openPopup(errorText.errorTitle,e.errorText)},error:function(){openPopup(errorText.errorTitle,errorText.ajax)}})}),$("body").on("click",".imgWrapper .imgDel",function(){$(this).parent(".imgWrapper").remove()}),myDatePicker($('input[name="date"]')),$('input[name="title"]').limit("250","#titleLimit"),$('textarea[name="bookingContent"]').limit("2000","#bookingContentLimit"),$("#frmBooking").on("focusout",'input[name="email"]',function(){$.ajax({url:fUrl+"ajax_get_user",type:"POST",cache:!1,dataType:"json",data:{type:"email",inputData:$('input[name="email"]').val(),csrf_hash:$.cookie("csrf_cookie_ci")},success:function(e){0==e.error&&(user=e.user,$('input[name="fullname"]').val(user.fullname),$('input[name="phone"]').val(user.phone),$('input[name="address"]').val(user.address))},error:function(){console.log("error")}})}),$("#frmBooking").on("focusout",'input[name="phone"]',function(){$.ajax({url:fUrl+"ajax_get_user",type:"POST",cache:!1,dataType:"json",data:{type:"phone",inputData:$('input[name="phone"]').val(),csrf_hash:$.cookie("csrf_cookie_ci")},success:function(e){0==e.error&&(user=e.user,$('input[name="fullname"]').val(user.fullname),$('input[name="email"]').val(user.email),$('input[name="address"]').val(user.address))},error:function(){console.log("error")}})}),$("#frmBooking").validate({rules:{fullname:{required:!0,maxlength:200},email:{required:!0,email:!0},phone:{required:!0,minlength:8,maxlength:20},address:{required:!0,maxlength:500},title:{required:!0,maxlength:200},bookingContent:{required:!0,maxlength:2e3},date:{notEqualValue:"Ngày/Tháng/Năm"},model:{required:!0},modelOther:{required:!0}},messages:{fullname:{required:"bắt buộc",maxlength:"nhiều nhất 200 ký tự"},email:{required:"bắt buộc",email:"email chưa đúng định dạng"},phone:{required:"bắt buộc",minlength:"ít nhất 8 ký tự",maxlength:"niều nhất 20 ký tự"},address:{required:"bắt buộc",maxlength:"niều nhất 500 ký tự"},title:{required:"bắt buộc",maxlength:"nhiều nhất 200 ký tự"},bookingContent:{required:"bắt buộc",maxlength:"nhiều nhất 2000 ký tự"},date:{notEqualValue:"bắt buộc"},model:{required:"bắt buộc"},modelOther:{required:"bắt buộc"}},submitHandler:function(e,n){n.preventDefault(),0==$("#imgContainer").find(".imgWrapper").length?openPopup(errorText.errorTitle,errorText.uploadOver):$.ajax({url:fUrl+"booking/ajax_submitBooking",type:"POST",cache:!1,dataType:"json",data:{fullname:$('input[name="fullname"]').val(),email:$('input[name="email"]').val(),phone:$('input[name="phone"]').val(),address:$('input[name="address"]').val(),car:$('input[name="car"]').val(),model:$('input[name="model"]').val(),service:$('input[name="service"]').val(),date:$('input[name="date"]').val(),filenames:$('input[name="filenames[]').serializeArray(),title:$('input[name="title"]').val(),content:$('textarea[name="bookingContent"]').val(),csrf_hash:$.cookie("csrf_cookie_ci")},success:function(e){1==e.error?openPopup(errorText.errorTitle,e.errorContent):openPopup(errorText.validContactBox_title,errorText.validContactBox_content)},error:function(){openPopup(errorText.errorTitle,errorText.ajax)}})}})),$("#newsPage").length>0&&$("div.holder").jPages({containerID:"itemContainer",perPage:3,first:"",previous:"span.arrowPrev",next:"span.arrowNext",last:""})});