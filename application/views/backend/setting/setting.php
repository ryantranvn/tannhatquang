<!-- page title  -->
	<div id="<?=$activeModule?>Page" class="mainContainer row">

		<!-- col -->
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
			<h1 class="page-title txt-color-blueDark">
				<!-- PAGE HEADER -->
				<i class="<?=$modules[$activeModule]['icon']?>"></i>
				<a href="<?=$breadcrumb[0]['url']?>"><?=$breadcrumb[0]['name']?></a>
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
				<!-- Meta -->
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<?=$this->load->view('backend/setting/frmEditMeta','',TRUE)?>
				</div>
				<!-- /INFO -->
			</div>
		<!-- end row -->
	</section>
<!-- end widget grid -->
