<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js">
    <head>
        <?=$this->load->view('frontend/includes/pageTop','',TRUE)?>
        <!--
        <link rel="stylesheet" type="text/css" href="<?=libsUrl('foundation6','css','foundation.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?=libsUrl('foundation6','css','app.css') ?>" />
        -->
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
        
    </head>
    <body>
    <!-- mobile Top -->
        <div class="mobileTop show-for-small-only">
            <a href="<?=F_URL?>" class="logoLink">
                <img class="logo" src="<?=assetsUrl('frontend','images','mobile/logo.png');?>" />
            </a>
            <div class="hotline">
                <a href="tel:0903001365">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <span>Hotline: <strong>0903 001 365</strong></span>
                </a>
            </div>
            <div id="mobileMenuButton" class="show-for-small-only">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    <!-- mobile Navigator -->
        <div class="mobileNav show-for-small-only">
            <ul>
                <li<? if ($activeMenu=='home') { ?> class="active"<? } ?>>
                    <a href="<?=$links['home']?>"><?=$navigator['home']?></a>
                </li>
                <li<? if ($activeMenu=='service') { ?> class="active"<? } ?>>
                    <a href="<?=$links['service']['introduction']?>">
                        <?=$navigator['service']?> &nbsp;
                    </a>
                    <ul class="submenu submenuService<? if ($activeMenu=='service') { ?> active<? } ?><? if ($lang=='en') { ?> submenuService_en<? } ?>">
                        <li<? if ($activeSubMenu=='introduction') { ?> class="active"<? } ?>>
                            <a href="<?=$links['service']['introduction']?>" class="linkSub">
                                <?=$navigatorSub['service']['introduction']?>
                            </a>
                        </li>
                        <li<? if ($activeSubMenu=='service') { ?> class="active"<? } ?>>
                            <a href="<?=$links['service']['service']?>" class="linkSub">
                                <?=$navigatorSub['service']['service']?>
                            </a>
                        </li>
                        <li<? if ($activeSubMenu=='certification') { ?> class="active"<? } ?>>
                            <a href="<?=$links['service']['certification']?>" class="linkSub">
                                <?=$navigatorSub['service']['certification']?>
                            </a>
                        </li>
                    </ul>
                </li>
                <li<? if ($activeMenu=='booking') { ?> class="active"<? } ?>>
                    <a href="<?=$links['booking']?>">
                        <?=$navigator['booking']?>
                    </a>
                </li>
                <li<? if ($activeMenu=='gallery') { ?> class="active"<? } ?>>
                    <a href="<?=$links['gallery']['beforeafter']?>">
                        <?=$navigator['gallery']?>
                    </a>
                    <ul class="submenu submenuGallery<? if ($activeMenu=='gallery') { ?> active<? } ?><? if ($lang=='en') { ?> submenuGallery_en<? } ?>">
                        <li<? if ($activeSubMenu=='beforeafter') { ?> class="active"<? } ?>>
                            <a href="<?=$links['gallery']['beforeafter']?>" class="linkSub">
                                <?=$navigatorSub['gallery']['beforeafter']?>
                            </a>
                        </li>
                        <li<? if ($activeSubMenu=='event') { ?> class="active"<? } ?>>
                            <a href="<?=$links['gallery']['event']?>" class="linkSub">
                                <?=$navigatorSub['gallery']['event']?>
                            </a>
                        </li>
                    </ul>
                </li>
                <li<? if ($activeMenu=='news') { ?> class="active"<? } ?>>
                    <a href="<?=$links['news']?>"><?=$navigator['news']?></a>
                </li>
                <li<? if ($activeMenu=='contact') { ?> class="active"<? } ?>>
                    <a href="<?=$links['contact']?>"><?=$navigator['contact']?></a>
                </li>
            </ul>
        </div>
    <!-- container -->
        <div class="container fullContainer">
            <!-- layout ================================================== -->  
                <?=$this->load->view('frontend/includes/navigation','',TRUE)?>
                <?=$content?>
                <?=$this->load->view('frontend/includes/footer','',TRUE)?>
                <? if ($page != "contact" && $page != "booking") { echo $this->load->view('frontend/includes/contactBox','',TRUE); } ?>
                <?=$this->load->view('frontend/includes/popup','',TRUE)?>
                <div class="processing"><img src="<?=assetsUrl('frontend','images','processing.gif');?>" /></div>
            <!--================================================== -->
        </div>

    <!-- Pass to script -->
        <script language="javascript">
            var authUser = <?=json_encode($varJS['authUser']); ?>;
			var invalid = <?=json_encode($varJS['invalid']); ?>;
            var errorText = <?=json_encode($varJS['errorText']); ?>;
		</script>

    <!-- SCRIPT -->
    <!-- SCRIPT -->
        <script language="javascript" type="text/javascript" src="<?=assetsUrl('common','js','jquery-min.js')?>"></script>
        
        <!--
        <script language="javascript" type="text/javascript" src="<?=libsUrl('foundation6','js','vendor/what-input.js') ?>"></script>
        <script language="javascript" type="text/javascript" src="<?=libsUrl('foundation6','js','vendor/foundation.js') ?>"></script>
        <script language="javascript" type="text/javascript" src="<?=libsUrl('foundation6','js','app.js') ?>"></script>
        -->
        <script language="javascript" type="text/javascript" src="<?=libsUrl('foundation24','js','foundation/foundation.js') ?>"></script>
        <script language="javascript" type="text/javascript" src="<?=libsUrl('jqueryui','js','jquery-ui.min.js') ?>"></script>
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