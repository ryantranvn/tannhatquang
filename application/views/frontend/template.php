<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js">
    <head>
        <?=$this->load->view('frontend/includes/pageTop','',TRUE)?>
        <link rel="stylesheet" type="text/css" href="<?=libsUrl('foundation12','css','foundation.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?=libsUrl('jqueryui','css','redmond/jquery-ui.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?=libsUrl('font-awesome','css','font-awesome.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?=libsUrl('jPages','css','jPages.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?=libsUrl('jPages','css','animate.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?=libsUrl('bxslider','css','jquery.bxslider.min.css') ?>" />
        <!-- css block -->
        <? foreach ($cssBlock as $css) {
            echo $css;
        } ?>
        <link rel="stylesheet" type="text/css" href="<?=assetsUrl('frontend','css','owl.carousel.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?=assetsUrl('frontend','css','style.min.css') ?>" />

        <!--[if lt IE 9]>
            <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]-->
        <!-- <noscript>
			<link rel="stylesheet" type="text/css" href="css/nojs.css" />
		</noscript> -->

        <!-- check old browser -->
            <script type="text/javascript">
            // var $buoop = {};
            //     $buoop.ol = window.onload;
            //     window.onload=function(){
            //      try {if ($buoop.ol) $buoop.ol();}catch (e) {}
            //      var e = document.createElement("script");
            //      e.setAttribute("type", "text/javascript");
            //      e.setAttribute("src", "//browser-update.org/update.js");
            //      document.body.appendChild(e);
            //     }
            </script>
        <!-- SCRIPT -->
        <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script> -->
        <script language="javascript" type="text/javascript" src="<?=assetsUrl('common','js','jquery.js')?>"></script>
        <script language="javascript" type="text/javascript" src="<?=libsUrl('foundation12','js','vendor/foundation.min.js') ?>"></script>
        <script language="javascript" type="text/javascript" src="<?=libsUrl('jqueryui','js','jquery-ui.min.js') ?>"></script>

        <? if (ONAIR==0) { ?>
            <?=$this->load->view('frontend/includes/ga','',TRUE)?>
        <? }?>
    </head>
    <body>
        <!-- mobile Navigator -->
        <div class="mobileNav">
            <ul>
                <li<? if ($activeNav=="home") { ?> class="active"<? } ?>><a href="<?=F_URL?>">TRANG CHỦ</a></li>

                <? if (isset($authUser) && is_array($authUser) && count($authUser)>0) { ?>
                <li><i class="fa fa-user"></i>&nbsp;&nbsp;Tài khoản</li>
                <li><a <? if ($activeNav=="user") { ?> class="active"<? } ?> href="#"><?=$authUser['username']?></a></li>
                <li><a href="<?=F_URL?>thoat">Thoát</a></li>
                <li><a class="linkChangePass<? if ($activeNav=="user") { ?> active<? } ?>" href="<?=F_URL?>doi-mat-khau">Đổi mật khẩu</a></li>
                <? } else { ?>
                <li><a <? if ($activeNav=="dangky") { ?> class="active"<? } ?> href="<?=F_URL?>dang-ky">ĐĂNG KÝ</a></li>
                <li><a <? if ($activeNav=="dangnhap") { ?> class="active"<? } ?> href="<?=F_URL?>dang-nhap">ĐĂNG NHẬP</a></li>
                <? } ?>
            </ul>
        </div>
    <!-- container -->
        <div class="container fullContainer">
            <!-- layout ================================================== -->
                <?=$this->load->view('frontend/includes/top','',TRUE)?>
                <?=$this->load->view('frontend/includes/navigation','',TRUE)?>
                <?=$this->load->view('frontend/includes/banner','',TRUE)?>
                <?=$this->load->view('frontend/includes/hotline','',TRUE)?>
                <?=$content?>
                <div id="gotoTop"></div>
                <?=$this->load->view('frontend/includes/footer','',TRUE)?>
                <?=$this->load->view('frontend/includes/popup','',TRUE)?>
                <div class="processing"><img src="<?=assetsUrl('frontend','images','processing.gif');?>" /></div>
            <!--================================================== -->
        </div>

    <!-- Pass to script -->
        <script language="javascript">
            var authUser = <?=json_encode($varJS['authUser']); ?>;
            var invalidUser = <?=json_encode($varJS['invalidUser']); ?>;
		</script>

    <!-- SCRIPT -->
        <script language="javascript" type="text/javascript" src="<?=assetsUrl('common','js','jquery.validate.min.js') ?>"></script>
		<script language="javascript" type="text/javascript" src="<?=assetsUrl('common','js','jquery.cookie.min.js') ?>"></script>
        <script language="javascript" type="text/javascript" src="<?=assetsUrl('common','js','jquery.transit.min.js') ?>"></script>

        <script language="javascript" type="text/javascript" src="<?=libsUrl('bxslider','js','jquery.bxslider.min.js')?>"></script>
        <script language="javascript" type="text/javascript" src="<?=libsUrl('lightbox','js','lightbox-min.js')?>"></script>
        <script language="javascript" type="text/javascript" src="<?=libsUrl('nanoGallery','js','jquery.nanogallery.min.js')?>"></script>
        <script language="javascript" type="text/javascript" src="<?=libsUrl('jPages','js','jPages.min.js')?>"></script>

        <script language="javascript" type="text/javascript" src="<?=assetsUrl('common','js','script.min.js')?>"></script>
        <!-- js block -->
        <? foreach ($jsBlock as $js) {
            echo $js;
        } ?>
        <script language="javascript" type="text/javascript" src="<?=assetsUrl('frontend','js','owl.carousel.min.js')?>"></script>
        <script language="javascript" type="text/javascript" src="<?=assetsUrl('frontend','js','sly.min.js')?>"></script>
        <script language="javascript" type="text/javascript" src="<?=assetsUrl('frontend','js','script.js')?>"></script>

    </body>
</html>
