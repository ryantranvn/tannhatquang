<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js">
    <head>
        <?=$this->load->view('frontend/includes/pageTop','',TRUE)?>
        <link rel="stylesheet" type="text/css" href="<?=libsUrl('foundation24','css','foundation.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?=libsUrl('jqueryui','css','redmond/jquery-ui.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?=libsUrl('font-awesome','css','font-awesome.min.css') ?>" />

        <link rel="stylesheet" type="text/css" href="<?=libsUrl('bxslider','css','jquery.bxslider.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?=libsUrl('lightbox','css','lightbox.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?=libsUrl('nanoGallery','css','nanogallery.min.css') ?>" />
        

        <link rel="stylesheet" type="text/css" href="<?=assetsUrl('frontend','css','style-min.css') ?>" />
        <!--[if lt IE 9]>
            <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]-->
        <!-- <noscript>
			<link rel="stylesheet" type="text/css" href="css/nojs.css" />
		</noscript> -->
        
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
        <!-- SCRIPT -->
        <script language="javascript" type="text/javascript" src="<?=assetsUrl('common','js','jquery-min.js')?>"></script>
        <script language="javascript" type="text/javascript" src="<?=libsUrl('foundation24','js','what-input.js') ?>"></script>
        <script language="javascript" type="text/javascript" src="<?=libsUrl('foundation24','js','foundation.min.js') ?>"></script>
        <script language="javascript" type="text/javascript" src="<?=libsUrl('jqueryui','js','jquery-ui.min.js') ?>"></script>
    </head>
    <body>
        <div class="off-canvas-wrapper">
            <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>

            <!-- off-canvas title bar for 'small' screen -->
                <div class="title-bar show-for-small-only">
                    <a href="<?=F_URL?>"><img class="logo" src="<?=assetsUrl('frontend','images','logo.png');?>" /></a>
                    <div class="title-bar-right">
                        <button class="c-hamburger c-hamburger--htx menu-icon iconNav" type="button" data-toggle="offCanvasRight"><span></span></button>
                    </div>
                </div>
            <!-- off-canvas right menu -->
                <div class="off-canvas position-right show-for-small-only" id="offCanvasRight" data-off-canvas data-position="right">
                    <ul class="vertical dropdown menu" data-dropdown-menu>
                    </ul>
                </div>

            <!-- original content goes in this container -->
                <div class="off-canvas-content" data-off-canvas-content>
                	<!-- layout ================================================== -->	
					<?=$this->load->view('frontend/includes/navigation','',TRUE)?>
					<?=$content?>
					<?=$this->load->view('frontend/includes/footer','',TRUE)?>
					<? if ($page != "contact" && $page != "booking") { echo $this->load->view('frontend/includes/contactBox','',TRUE); } ?>
                    <?=$this->load->view('frontend/includes/popup','',TRUE)?>
					<!--================================================== -->
                </div>

            <!-- close wrapper, no more content after this -->
            </div>
        </div>

    <!-- Pass to script -->
        <script language="javascript">
            var authUser = <?=json_encode($varJS['authUser']); ?>;
			var invalid = <?=json_encode($varJS['invalid']); ?>;
            var errorText = <?=json_encode($varJS['errorText']); ?>;
		</script>

    <!-- SCRIPT -->
        <script language="javascript" type="text/javascript" src="<?=assetsUrl('common','js','jquery.validate.js') ?>"></script>
		<script language="javascript" type="text/javascript" src="<?=assetsUrl('common','js','jquery.cookie.js') ?>"></script>
        <script language="javascript" type="text/javascript" src="<?=assetsUrl('common','js','jquery.transit.min.js') ?>"></script>
        <script language="javascript" type="text/javascript" src="<?=assetsUrl('common','js','jquery.lettering.js')?>"></script>
        <script language="javascript" type="text/javascript" src="<?=libsUrl('bxslider','js','jquery.bxslider.min.js')?>"></script>
        <script language="javascript" type="text/javascript" src="<?=libsUrl('lightbox','js','lightbox-min.js')?>"></script>
        <script language="javascript" type="text/javascript" src="<?=libsUrl('nanoGallery','js','jquery.nanogallery.min.js')?>"></script>
        
        <script language="javascript" type="text/javascript" src="<?=assetsUrl('common','js','jquery.easing.1.3.js')?>"></script>
        <script language="javascript" type="text/javascript" src="<?=assetsUrl('common','js','jquery.numeric.js') ?>"></script>
        <script language="javascript" type="text/javascript" src="<?=assetsUrl('common','js','jquery.form.js') ?>"></script>
        <script language="javascript" type="text/javascript" src="<?=assetsUrl('common','js','jquery.limit-min.js') ?>"></script>
		  
        <script language="javascript" type="text/javascript" src="<?=assetsUrl('common','js','script-min.js')?>"></script>
        <script language="javascript" type="text/javascript" src="<?=assetsUrl('frontend','js','script-min.js')?>"></script>
    </body>
</html>