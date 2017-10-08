<!DOCTYPE html>
<html lang="en-us" id="extr-page">
	<head>
		<?=$this->load->view('backend/includes/pageTop','',TRUE)?>
		<?=$this->load->view('backend/includes/cssSmartAdmin','',TRUE)?>
		<?/*<link rel="stylesheet" type="text/css" href="<?=assetsUrl('backend','css','style.min.css')?>?ver=<?=$css_version?>" />*/?>
        <link rel="stylesheet" type="text/css" href="<?=assetsUrl('backend','css','compressed/style.css')?>" />
		<link rel="stylesheet" type="text/css" href="<?=assetsUrl('backend','css','wheelmenu.css')?>" />
		<link rel="stylesheet" type="text/css" href="<?=libsUrl('fancybox','css','jquery.fancybox.css')?>" />
		<link rel="stylesheet" type="text/css" href="<?=libsUrl('jqueryui','css','lightness/jquery-ui.css')?>" />
		<!-- css block -->
        <?php
			if (count($cssBlock)>0) {
				foreach ($cssBlock as $css) {
	            	echo $css;
				}
			}
        ?>
	</head>
	<body class="menu-on-top">
		<!-- layout ================================================== -->
		<?=$this->load->view('backend/includes/header','',TRUE)?>
		<?=$this->load->view('backend/includes/navigation','',TRUE)?>
		<?=$content; ?>
		<?=$this->load->view('backend/includes/footer','',TRUE)?>
		<?=$this->load->view('backend/includes/processing','',TRUE)?>
		<!--================================================== -->
		<script language="javascript">
            var authMember = <?=json_encode($varJS['authMember']); ?>;
			var permissionsMember = <?=json_encode($varJS['permissionsMember']); ?>;
			var currentModule = <?=json_encode($varJS['currentModule']); ?>;
			var replyErrorContent = <?=json_encode($varJS['replyErrorContent']); ?>;
			var url = <?=json_encode($varJS['url']); ?>;
		</script>
		<?=$this->load->view('backend/includes/jsSmartAdmin', '', TRUE)?>

		<script language="javascript" type="text/javascript" src="<?=libsUrl('fancybox','js','jquery.fancybox.pack.js') ?>"></script>
		<script language="javascript" type="text/javascript" src="<?=libsUrl('ckeditor','','ckeditor.js')?>"></script>
		<script language="javascript" type="text/javascript" src="<?=libsUrl('ckeditor','','config.js')?>"></script>
		<script language="javascript" type="text/javascript" src="<?=assetsUrl('common','js','script.js?')?>"></script>
		<script language="javascript" type="text/javascript" src="<?=assetsUrl('common','js','jquery.cookie.js') ?>"></script>
		<script language="javascript" type="text/javascript" src="<?=assetsUrl('common','js','jquery.numeric.js') ?>"></script>
		<script language="javascript" type="text/javascript" src="<?=assetsUrl('common','js','jquery.limit.js') ?>"></script>
		<script language="javascript" type="text/javascript" src="<?=assetsUrl('backend','js','jquery.wheelmenu.min.js') ?>"></script>
		<script language="javascript" type="text/javascript" src="<?=assetsUrl('backend','js','init_height.js')?>?ver=<?=$js_version?>"></script>
		<script language="javascript" type="text/javascript" src="<?=assetsUrl('backend','js','script.js')?>?ver=<?=$js_version?>"></script>
		<!-- js block -->
        <?php
			if (count($jsBlock)>0) {
				foreach ($jsBlock as $js) {
	            	echo $js;
				}
			}
		?>
	</body>
</html>
