<!DOCTYPE html>
<html lang="en-us" id="extr-page">
	<head>
		<?=$this->load->view('backend/includes/pageTop','',TRUE)?>
		<?=$this->load->view('backend/includes/cssSmartAdmin','',TRUE)?>
		<link rel="stylesheet" type="text/css" href="<?=assetsUrl('backend','css','style-min.css') ?>" />
		<link rel="stylesheet" type="text/css" href="<?=assetsUrl('backend','css','wheelmenu.css') ?>" />
		<link rel="stylesheet" type="text/css" href="<?=libsUrl('fancybox','css','jquery.fancybox.css') ?>" />
		<link rel="stylesheet" type="text/css" href="<?=libsUrl('jqueryui','css','lightness/jquery-ui.css') ?>" />

	</head>
	<body class="menu-on-top">
		<!-- layout ================================================== -->	
		<?=$this->load->view('backend/includes/header','',TRUE)?>
		<?=$this->load->view('backend/includes/navigation','',TRUE)?>
		<?=$content; ?>
		<?=$this->load->view('backend/includes/footer','',TRUE)?>
		<!--================================================== -->	
		<script language="javascript">
            // var varPHP = <?=json_encode($varJS); ?>;
            var authMember = <?=json_encode($varJS['authMember']); ?>;
			var permissionsMember = <?=json_encode($varJS['permissionsMember']); ?>;
			var replyErrorContent = <?=json_encode($varJS['replyErrorContent']); ?>;
		</script>
		<?=$this->load->view('backend/includes/jsSmartAdmin', '', TRUE)?>

		<script language="javascript" type="text/javascript" src="<?=libsUrl('fancybox','js','jquery.fancybox.pack.js') ?>"></script>
		<script language="javascript" type="text/javascript" src="<?=libsUrl('ckeditor','','ckeditor.js')?>"></script>
		<script language="javascript" type="text/javascript" src="<?=libsUrl('ckeditor','','config.js')?>"></script>
		<script language="javascript" type="text/javascript" src="<?=assetsUrl('common','js','script-min.js')?>"></script>
		<script language="javascript" type="text/javascript" src="<?=assetsUrl('common','js','jquery.cookie.js') ?>"></script>
		<script language="javascript" type="text/javascript" src="<?=assetsUrl('common','js','jquery.numeric.js') ?>"></script>
		<script language="javascript" type="text/javascript" src="<?=assetsUrl('common','js','jquery.limit.js') ?>"></script>
		<script language="javascript" type="text/javascript" src="<?=assetsUrl('backend','js','jquery.wheelmenu.min.js') ?>"></script>
		
		<script language="javascript" type="text/javascript" src="<?=assetsUrl('backend','js','script.js')?>"></script>
	</body>
</html>