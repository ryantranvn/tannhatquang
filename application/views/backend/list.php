<!-- page title  -->
	<div class="mainContainer row">

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
				<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="jarviswidget jarviswidget-color-blue" data-widget-editbutton="false" data-widget-deletebutton="false">
						<!-- header -->
							<header>
								<h2>List </h2>
							</header>
						<!-- end header -->

						<!-- widget div-->
							<div>
								<!-- widget edit box -->
									<div class="jarviswidget-editbox">
										<!-- This area used as dropdown edit box -->
										<input class="form-control" type="text">
									</div>
								<!-- end widget edit box -->

								<!-- widget content -->
									<div class="widget-body">
										<table id="jqgrid"></table>
										<div id="pjqgrid"></div>
									<!-- for multi delete -->
									<?php if (isset($frmTopButtons)) { ?>
										<?=$frmTopButtons['open']?>
                                            <input type="text" name="ids[]" id="ids" class="hiddenInput" />
                                        <?=$frmTopButtons['close']?>
									<? } ?>
									<!-- Import -->
									<?php if (isset($frmImport)) { ?>
                                        <?=$frmImport['open']?>
                                            <input type="file" name="importFile" class="hiddenInput" />
                                        <?=$frmImport['close']?>
									<? } ?>
									</div>
								<!-- end widget content -->

							</div>
						<!-- end widget div -->
					</div>
				</article>
			</div>
		<!-- end row -->
	</section>
	<!-- end widget grid -->
	<!-- Modal -->
		<div class="modal fade" id="modalStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<? foreach ($statusArr as $status) {
							echo $status;
						} ?>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>
	<!-- /.modal -->
