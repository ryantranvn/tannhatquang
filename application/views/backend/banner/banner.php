<!-- row -->
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
				<article id="addContainer" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="jarviswidget jarviswidget-color-blue" data-widget-editbutton="false" data-widget-deletebutton="false" id="addService">
						<!-- header -->
							<header>
								<h2><?=$breadcrumb[0]['name']?> Form </h2>
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
									<?=$frmAdd['open']?>
									<!-- Page -->
										<div class="row">
											<div class="col-sm-12 col-md-12 col-lg-12">
												<fieldset>
													<div class="form-group">
														<div class="row">
															<div class="col-sm-12 col-md-12 col-lg-12">
																<label class="control-label">Page <sup>*</sup></label><br/>
																<div id="categoryWrapper">
																	<a class="category btn btn-default btn-success" data-save="home">Home</a>
																	<a class="category btn btn-default" data-save="service-introduction">Service-Introduction</a>
																	<a class="category btn btn-default" data-save="service-service">Service-Service</a>
																	<a class="category btn btn-default" data-save="service-certification">Service-Certification</a>
																	<a class="category btn btn-default" data-save="booking">Booking</a>
																	<a class="category btn btn-default" data-save="gallery-beforeafter">Gallery-BeforeAfter</a>
																	<a class="category btn btn-default" data-save="gallery-event">Gallery-Event</a>
																	<a class="category btn btn-default" data-save="news">News</a>
																	<a class="category btn btn-default" data-save="news-detail">News-Detail</a>
																	<a class="category btn btn-default" data-save="contact">Contact</a>
																</div>
																<input name="page" type="text" value="home" class="hiddenInput" />
															</div>
														</div>
													</div>
												</fieldset>
											</div>
										</div>
									<div id="allWrapper" class="row">
									<!-- home -->
										<div class="row uploadWrapper active">
										<!-- home 1 banner -->
											<div class="row">
												<div class="col-sm-12 col-md-6 col-lg-6">
													<fieldset>
														<div class="form-group">
															<label class="control-label">Banner Top VN</label>
															<p>
																<span class="label label-warning">
																NOTE</span> &nbsp; Accept file *.png, *.jpg &amp; size <=5MBs.<br/>
																<em>Click and choose multiple files with the Ctrl/Command key.<br/>Then right click on one of them and choose "Select"</em>
															</p>
															<div class="input-group">
																<div class="input-group-btn">
																	<button class="btn btn-default btnSelectBannerHome_1VN" type="button">
																		Select File
																	</button>
																</div>
																<input type="text" name="bannerHome_1VN[]" class="hiddenInput" style="width: 100%" />
															</div>
															<div class="thumbnailWrapper" style="width: 100%;">
																<? if (count($banner['bannerHome_1VN'])>0) { 
																	foreach ($banner['bannerHome_1VN'] as $item) { ?>
																		<div class="imgWrapper imgWrapperOld home_1VN">
																			<img src="<?=$item?>" />
																			<i class="fa fa-trash-o" data="<?=$item?>"></i>
																		</div>
																	<?}
																} ?>
															</div>
															<input type="text" name="bannerHome_1VN_del[]" class="hiddenInput" style="width: 100%" />
														</div>
													</fieldset>
												</div>
												<div class="col-sm-12 col-md-6 col-lg-6">
													<fieldset>
														<div class="form-group">
															<label class="control-label">Banner Top EN</label>
															<p>
																<span class="label label-warning">
																NOTE</span> &nbsp; Accept file *.png, *.jpg &amp; size <=5MBs.<br/>
																<em>Click and choose multiple files with the Ctrl/Command key.<br/>Then right click on one of them and choose "Select"</em>
															</p>
															<div class="input-group">
																<div class="input-group-btn">
																	<button class="btn btn-default btnSelectBannerHome_1EN" type="button">
																		Select File
																	</button>
																</div>
																<input type="text" name="bannerHome_1EN[]" class="hiddenInput" />
															</div>
															<div class="thumbnailWrapper" style="width: 100%;">
																<? if (count($banner['bannerHome_1EN'])>0) { 
																	foreach ($banner['bannerHome_1EN'] as $item) { ?>
																		<div class="imgWrapper imgWrapperOld home_1EN">
																			<img src="<?=$item?>" />
																			<i class="fa fa-trash-o" data="<?=$item?>"></i>
																		</div>
																	<?}
																} ?>
															</div>
															<input type="text" name="bannerHome_1EN_del[]" class="hiddenInput" style="width: 100%" />
														</div>
													</fieldset>
												</div>
											</div>
										<!-- home 2 banner -->
											<div class="row" style="margin-top: 50px;">
												<div class="col-sm-12 col-md-6 col-lg-6">
													<fieldset>
														<div class="form-group">
															<label class="control-label">Banner Middle VN</label>
															<p>
																<span class="label label-warning">
																NOTE</span> &nbsp; Accept file *.png, *.jpg &amp; size <=5MBs.<br/>
																<em>Click and choose multiple files with the Ctrl/Command key.<br/>Then right click on one of them and choose "Select"</em>
															</p>
															<div class="input-group">
																<div class="input-group-btn">
																	<button class="btn btn-default btnSelectBannerHome_2VN" type="button">
																		Select File
																	</button>
																</div>
																<input type="text" name="bannerHome_2VN[]" class="hiddenInput" />
															</div>
															<div class="thumbnailWrapper" style="width: 100%;">
																<? if (count($banner['bannerHome_2VN'])>0) { 
																	foreach ($banner['bannerHome_2VN'] as $item) { ?>
																		<div class="imgWrapper imgWrapperOld home_2VN">
																			<img src="<?=$item?>" />
																			<i class="fa fa-trash-o" data="<?=$item?>"></i>
																		</div>
																	<?}
																} ?>
															</div>
															<input type="text" name="bannerHome_2VN_del[]" class="hiddenInput" style="width: 100%" />
														</div>
													</fieldset>
												</div>
												<div class="col-sm-12 col-md-6 col-lg-6">
													<fieldset>
														<div class="form-group">
															<label class="control-label">Banner Middle EN</label>
															<p>
																<span class="label label-warning">
																NOTE</span> &nbsp; Accept file *.png, *.jpg &amp; size <=5MBs.<br/>
																<em>Click and choose multiple files with the Ctrl/Command key.<br/>Then right click on one of them and choose "Select"</em>
															</p>
															<div class="input-group">
																<div class="input-group-btn">
																	<button class="btn btn-default btnSelectBannerHome_2EN" type="button">
																		Select File
																	</button>
																</div>
																<input type="text" name="bannerHome_2EN[]" class="hiddenInput" />
															</div>
															<div class="thumbnailWrapper" style="width: 100%;">
																<? if (count($banner['bannerHome_2EN'])>0) { 
																	foreach ($banner['bannerHome_2EN'] as $item) { ?>
																		<div class="imgWrapper imgWrapperOld home_2EN">
																			<img src="<?=$item?>" />
																			<i class="fa fa-trash-o" data="<?=$item?>"></i>
																		</div>
																	<?}
																} ?>
															</div>
															<input type="text" name="bannerHome_2EN_del[]" class="hiddenInput" style="width: 100%" />
														</div>
													</fieldset>
												</div>
											</div>
										</div>
									<!-- service introduction -->
										<div class="row uploadWrapper">
											<div class="col-sm-12 col-md-6 col-lg-6">
												<fieldset>
													<div class="form-group">
														<label class="control-label">Banner VN</label>
														<p>
															<span class="label label-warning">
															NOTE</span> &nbsp; Accept file *.png, *.jpg &amp; size <=5MBs.
														</p>
														<div class="input-group">
															<input type="text" name="serviceIntroductionVN" class="inputThumbnail form-control" readonly>
															<div class="input-group-btn">
																<button class="btn btn-default btnSelectBannerVN" type="button">
																	Select File
																</button>
															</div>
														</div>
														<div class="thumbnailWrapper" style="margin-top: 10px">
															<img class="thumbnail" src="<?php echo assetsUrl('common','images','default.jpg'); ?>" />
														</div>
													</div>
												</fieldset>
											</div>
											<div class="col-sm-12 col-md-6 col-lg-6">
												<fieldset>
													<div class="form-group">
														<label class="control-label">Banner EN</label>
														<p>
															<span class="label label-warning">
															NOTE</span> &nbsp; Accept file *.png, *.jpg &amp; size <=5MBs.
														</p>
														<div class="input-group">
															<input type="text" name="serviceIntroductionEN" class="inputThumbnail form-control" readonly>
															<div class="input-group-btn">
																<button class="btn btn-default btnSelectBannerEN" type="button">
																	Select File
																</button>
															</div>
														</div>
														<div class="thumbnailWrapper" style="margin-top: 10px">
															<img class="thumbnail" src="<?php echo assetsUrl('common','images','default.jpg'); ?>" />
														</div>
													</div>
												</fieldset>
											</div>
										</div>
									</div>
									<!-- button -->
										<div class="row" style="margin: 20px">
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
												<button class="btn btn-sm btn-success pull-right" type="submit">
													<i class="fa fa-lg fa-save"></i> Submit
												</button>
												<button class="btnCancel btn btn-sm .bg-color-blueLight pull-right" type="button" style="margin-right: 10px;">
													<i class="fa fa-times"></i> Cancel
												</button>
											</div>
										</div>
									<?=$frmAdd['close']?>
								</div>
							<!-- end widget content -->
							</div>
						<!-- end widget div -->
						<!-- note -->
							<div class="col-sm-12 col-md-12 col-lg-12">
								<label><sup>*</sup> Required</label>
							</div>
						<!-- end note -->
					</div>
				</article>
			</div>
		<!-- end row -->
	</section>
<!-- end widget grid