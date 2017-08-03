<!-- row -->
	<div id="<?=$activeModule?>Page" class="mainContainer row">

		<!-- col -->
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
			<h1 class="page-title txt-color-blueDark">
				<!-- PAGE HEADER -->
				<i class="<?=$modules[$activeModule]['icon']?>"></i>
				<a href="<?=$breadcrumb[0]['url']?>"><?=$breadcrumb[0]['name']?></a>
				<i class="fa fa-angle-right"></i>
				<a href="<?=$breadcrumb[1]['url']?>"><?=$breadcrumb[1]['name']?></a>
			</h1>
		</div>
		<!-- end col -->
	</div>
<!-- end row -->
<!-- widget grid -->
	<section id="widget-grid" class="">
		<?=$this->load->view('backend/includes/reply','',TRUE)?>

	<!-- row -->
		<div class="row">
		<!-- INFO -->
		<? if ($member['username']!="admin") { ?>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<?=$this->load->view('backend/member/frmEditInfo','',TRUE)?>
			</div>
		<? } ?>
		<!-- /INFO -->
		<!-- CHANGE PASS -->
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<?=$this->load->view('backend/member/frmEditPassword','',TRUE)?>
			</div>
		<!-- /CHANGE PASS -->

		<!-- PERMISSION -->
		<? if ($member['username']!="admin") { ?>
			<? if (!isset($noPermissionModule)) { ?>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<?=$this->load->view('backend/member/frmEditPermission','',TRUE)?>
				</div>
			<? } ?>
		<? } ?>
		<!-- /PERMISSION -->
		</div>
	<!-- end row -->
</section>
<!-- end widget grid -->
