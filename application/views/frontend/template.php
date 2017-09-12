<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?=PAGE_TITLE?></title>
    <link rel="shortcut icon" href="<?=assetsUrl('frontend','images','icon.png');?>">
    <?=$this->load->view('frontend/includes/meta','',TRUE)?>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="<?=LIB_URL?>bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=LIB_URL?>font-awesome/css/font-awesome.min.css" />
    <!-- <link rel="stylesheet" type="text/css" href="<?=LIB_URL?>bxslider/css/jquery.bxslider.min.css" /> -->
    <link rel="stylesheet" type="text/css" href="<?=LIB_URL?>jPages/css/jPages.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=ASSETS_URL?>frontend/css/compressed/style.min.css" />

    <link rel="stylesheet" type="text/css" href="<?=LIB_URL?>slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="<?=LIB_URL?>slick/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="<?=LIB_URL?>popover/jquery.webui-popover.css" />
    <!-- css block -->
    <? foreach ($cssBlock as $css) {
        echo $css;
    } ?>
    <!-- check old browser -->
        <script type="text/javascript">
        var $buoop = {};
            $buoop.ol = window.onload;
            window.onload=function(){
             try {if ($buoop.ol) $buoop.ol();}catch (e) {}
             var e = document.createElement("script");
             e.setAttribute("type", "text/javascript");
             e.setAttribute("src", "//browser-update.org/update.js");
             document.body.appendChild(e);
            }
        </script>
    <!-- GA -->
        <? if (ONAIR==0) { ?>
            <?=$this->load->view('frontend/includes/ga','',TRUE)?>
        <? }?>
    </head>
    <body>
        <?=$this->load->view('frontend/includes/wrap_top','',TRUE)?>
        <?=$this->load->view('frontend/includes/wrap_search','',TRUE)?>
        <?=$this->load->view('frontend/includes/wrap_navigation','',TRUE)?>
        <?=$this->load->view('frontend/includes/wrap_banner','',TRUE)?>
        <?=$this->load->view('frontend/includes/wrap_hotline','',TRUE)?>
        <?=$content?>
        <div id="gotoTop"></div>
        <div id="pos"></div>
        <?=$this->load->view('frontend/includes/wrap_footer','',TRUE)?>
        <!-- JS -->
        <script language="javascript" type="text/javascript" src="<?=ASSETS_URL?>frontend/js/compressed/jquery.min.js"></script>
        <script language="javascript" type="text/javascript" src="<?=LIB_URL?>bootstrap/js/bootstrap.min.js"></script>
        <!-- <script language="javascript" type="text/javascript" src="<?=LIB_URL?>bxslider/js/jquery.bxslider.min.js"></script> -->
        <script type="text/javascript" src="<?=LIB_URL?>slick/slick.min.js"></script>
        <script type="text/javascript" src="<?=LIB_URL?>popover/jquery.webui-popover.js"></script>
        <script language="javascript" type="text/javascript" src="<?=LIB_URL?>jPages/js/jPages.min.js"></script>
        <!-- js block -->
        <? foreach ($jsBlock as $js) {
            echo $js;
        } ?>
        <script language="javascript" type="text/javascript" src="<?=ASSETS_URL?>common/js/jquery.validate.min.js"></script>
        <script language="javascript" type="text/javascript" src="<?=ASSETS_URL?>common/js/jquery.cookie.min.js"></script>
        <script language="javascript" type="text/javascript" src="<?=ASSETS_URL?>common/js/script.min.js"></script>
        <script language="javascript" type="text/javascript" src="<?=ASSETS_URL?>frontend/js/compressed/script.min.js"></script>

    </body>
</html>
