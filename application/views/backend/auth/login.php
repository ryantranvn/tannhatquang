<!DOCTYPE html>
<html lang="en-us" id="extr-page">
	<head>
		<?=$this->load->view('backend/includes/pageTop','',TRUE)?>
		<?=$this->load->view('backend/includes/cssSmartAdmin','',TRUE)?>
		<link rel="stylesheet" type="text/css" href="<?php echo assetsUrl('backend','css','style-min.css') ?>" />
	</head>
	<body class="animated fadeInDown">

		<header id="header">

			<div id="logo-group">
				<span id="logo"> <img src="<?php echo LOGO_URL; ?>" alt=""> </span>
			</div>
			<img id="logoCi" src="<?php echo assetsUrl('common','images','logo-dev-black.png'); ?>" class="pull-right display-image" alt="" style="max-height: 90%; margin: 0;">
			<!--
			<span id="extr-page-header-space"> <span class="hidden-mobile hiddex-xs">Need an account?</span> <a href="register.html" class="btn btn-danger">Create account</a> </span>
			-->
		</header>

		<div id="main" role="main">

			<!-- MAIN CONTENT -->
			<div id="content" class="container">

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
						<h1 class="txt-color-red login-header-big"><?php echo PAGE_NAME ?></h1>
						<div class="hero">

							<div class="pull-left login-desc-box-l">
								<h4 class="paragraph-header">Không phải admin, đi chỗ khách chơi...</h4>
								<div class="login-app-icons">
									<a href="<?php echo F_URL ?>" target="_blank" class="btn btn-danger btn-sm">Frontend Page</a>
								</div>
							</div>
							
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
						<?php if (isset($invalidAuthMember)) { ?>
						<div class="alert alert-danger fade in">
							<button class="close" data-dismiss="alert">
								×
							</button>
							<i class="fa-fw fa fa-times"></i>
							<strong><?php echo $invalidAuthMember ?></strong> 
						</div>
						<?php } ?>
						<div class="well no-padding">
							<?=$frmLogin['open'] ?>
								<header>
									Sign In
								</header>

								<fieldset>
									
									<section>
										<label class="label">Username</label>
										<label class="input"> <i class="icon-append fa fa-user"></i>
											<input type="text" name="username" tabindex="1">
											<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter username</b>
										</label>
									</section>

									<section>
										<label class="label">Password</label>
										<label class="input"> <i class="icon-append fa fa-lock"></i>
											<input type="password" name="password" tabindex="2">
											<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> 
										</label>
										<!-- <div class="note">
											<a href="forgotpassword.html">Forgot password?</a>
										</div> -->
									</section>

									<section>
										<label class="label">Captcha</label>
										<?php echo $captcha_img ?>
										<a id="captcha_refesh" href="javascript:void(0);" class="btn btn-default" rel="tooltip" data-placement="right" data-original-title="Refesh Captcha" data-html="true" style="margin-left: 10px; padding: 5px;">
											<i class="glyphicon glyphicon-refresh"></i>
										</a>
										<p>Please enter characters above.</p>
										<label class="input"> <i class="icon-append fa fa-lock"></i>
											<input type="text" name="captcha" tabindex="3">
											<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter security code</b> 
										</label>
										<!-- <label class="checkbox">
											<input type="checkbox" name="remember" checked="">
											<i></i>Stay signed in
										</label> -->
									</section>
								</fieldset>
								<footer>
									<button type="submit" class="btn btn-primary" tabindex="4">
										Sign in
									</button>
								</footer>
							<?=$frmLogin['close'] ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!--================================================== -->	
		
		<?=$this->load->view('backend/includes/jsSmartAdmin', '', TRUE)?>
		<script language="javascript" type="text/javascript" src="<?=assetsUrl('common','js','jquery.cookie.js') ?>"></script>
		<script language="javascript" type="text/javascript" src="<?php echo assetsUrl('common','js','script-min.js') ?>"></script>
		<script language="javascript" type="text/javascript" src="<?php echo assetsUrl('backend','js','script-min.js') ?>"></script>
	</body>
</html>