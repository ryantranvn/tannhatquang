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
									<!-- GALLERY -->
										<div class="row">
											<div class="col-sm-12 col-md-12 col-lg-12">
												<fieldset>
													<div class="form-group">
														<div class="row">
															<div class="col-sm-12 col-md-12 col-lg-12">
																<label class="control-label">Gallery <sup>*</sup></label><br/>
																<div id="categoryWrapper">
																	<? foreach ($arrGallery as $key => $gallery) { ?>
																		<a class="category btn btn-default <? if ($gallery['id']==9) { echo "btn-success"; } ?>" data-save="<?=$gallery['id']?>"><?=$gallery['name']?></a>
																	<? } ?>
																</div>
																<input name="category" type="text" value="9" class="hiddenInput" />
															</div>
														</div>
													</div>
												</fieldset>
											</div>
										</div>
									<!-- TITLE -->
										<div class="row eventWrapper" style="display: none">
											<div class="col-sm-12 col-md-6 col-lg-6">
												<fieldset>
													<div class="form-group">
														<div class="row">
															<div class="col-sm-12 col-md-12 col-lg-12">
																<label class="control-label">TITLE VN<sup>*</sup></label>
																<input type="text" name="title" class="form-control" value="Title here" />
																<span class="charLimit" id="titleLimit"></span>
															</div>
														</div>
													</div>
												</fieldset>
											</div>
											<div class="col-sm-12 col-md-6 col-lg-6">
												<fieldset>
													<div class="form-group">
														<div class="row">
															<div class="col-sm-12 col-md-12 col-lg-12">
																<label class="control-label">TITLE EN<sup>*</sup></label>
																<input type="text" name="titleEN" class="form-control" value="Title EN here" />
																<span class="charLimit" id="titleENLimit"></span>
															</div>
														</div>
													</div>
												</fieldset>
											</div>
										</div>
									<!-- CAR INFORMATION -->
										<div class="row beforeafterWrapper">
											<div class="col-sm-12 col-md-6 col-lg-6">
												<fieldset>
													<div class="form-group">
														<div class="row">
															<div class="col-sm-12 col-md-12 col-lg-12">
																<label class="control-label">CAR INFORMATION VN<sup>*</sup></label>
																<input type="text" name="carInformation" class="form-control" />
																<span class="charLimit" id="carInformationLimit"></span>
															</div>
														</div>
													</div>
												</fieldset>
											</div>
											<div class="col-sm-12 col-md-6 col-lg-6">
												<fieldset>
													<div class="form-group">
														<div class="row">
															<div class="col-sm-12 col-md-12 col-lg-12">
																<label class="control-label">CAR INFORMATION EN<sup>*</sup></label>
																<input type="text" name="carInformationEN" class="form-control" />
																<span class="charLimit" id="carInformationENLimit"></span>
															</div>
														</div>
													</div>
												</fieldset>
											</div>
										</div>
									<!-- SERVICE -->
										<div class="row beforeafterWrapper">
											<div class="col-sm-12 col-md-6 col-lg-6">
												<fieldset>
													<div class="form-group">
														<div class="row">
															<div class="col-sm-12 col-md-12 col-lg-12">
																<label class="control-label">SERVICE VN<sup>*</sup></label>
																<input type="text" name="service" class="form-control" />
																<span class="charLimit" id="serviceLimit"></span>
															</div>
														</div>
													</div>
												</fieldset>
											</div>
											<div class="col-sm-12 col-md-6 col-lg-6">
												<fieldset>
													<div class="form-group">
														<div class="row">
															<div class="col-sm-12 col-md-12 col-lg-12">
																<label class="control-label">SERVICE EN<sup>*</sup></label>
																<input type="text" name="serviceEN" class="form-control" />
																<span class="charLimit" id="serviceENLimit"></span>
															</div>
														</div>
													</div>
												</fieldset>
											</div>
										</div>
									<!-- OTHER -->
										<div class="row">
											<div class="col-sm-12 col-md-4 col-lg-4">
												<div class="row">
													<fieldset>
														<div class="form-group">
															<div class="row">
																<label class="col-sm-12 col-md-3 col-lg3 control-label">Order</label>
																<div class="col-sm-12 col-md-6 col-lg-6">
																	<input type="text" class="form-control spinner-both orderSpinner positive-integer" name="order" value="0" />
																</div>
															</div>
														</div>
													</fieldset>
												</div>
												<div class="row">
													<fieldset>
														<div id="statusAdd" class="form-group row statusWrapper">
															<label class="col-sm-12 col-md-3 col-lg-3 control-label" style="line-height: 32px">Status</label>
															<div class="col-sm-12 col-md-9 col-lg-9">
																<div class="btn-group" data-toggle="buttons">
																	<label class="btn btn-default">
																		<input type="radio" name="status" value="active" />
																		Active <i class="fa fa-eye"></i></label>
																	<label class="btn btn-default">
																		<input type="radio" name="status" value="inactive" />
																		Inactive <i class="fa fa-eye-slash"></i></label>
																</div>
															</div>
														</div>
													</fieldset>
												</div>
											</div>
											<div class="col-sm-12 col-md-8 col-lg-8 eventWrapper" style="display: none">
												<div class="row">
													<div class="col-sm-12 col-md-12 col-lg-12">
														<fieldset>
															<div class="form-group">
																<label class="control-label">Type <sup>*</sup></label><br/>
																<div id="categoryWrapper">
																	<a class="type btn btn-default btn-success" data-save="album">Album</a>
																	<a class="type btn btn-default" data-save="video">Video</a>
																</div>
																<input name="type" type="text" value="album" class="hiddenInput" />
															</div>
														</fieldset>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-12 col-md-12 col-lg-12">
														<fieldset class="albumWrapper">
														<!-- Event album -->
															<div class="form-group">
																<label class="control-label">Event Album</label>
																<p>
																	<span class="label label-warning">
																	NOTE</span> &nbsp; Accept file *.png, *.jpg &amp; size <=5MBs.<br/>
																	<em>Click and choose multiple files with the Ctrl/Command key.<br/>Then right click on one of them and choose "Select"</em>
																</p>
																<div class="input-group">
																	<div class="input-group-btn">
																		<button class="btn btn-default btnSelectEventAlbum" type="button">
																			Select Files
																		</button>
																	</div>
																	<input type="text" name="inputGallery[]" class="hiddenInput" />
																</div>
																<div class="thumbnailWrapper" style="width: 100%;"></div>
															</div>
														</fieldset>
														<fieldset class="videoWrapper" style="display: none">
														<!-- Event video -->
															<div class="form-group">
																<label class="control-label">Event Video</label>
																<p>
																	<span class="label label-warning">
																	NOTE</span> &nbsp; Accept file *.mp4, *.swf *.flv *.avi *.mpg *.mpeg *.mov *.wmv *.ogg &amp; size <=100MBs.<br/>
																</p>
																<div class="input-group">
																	<input type="text" name="inputVideo" class="inputThumbnail form-control" readonly>
																	<div class="input-group-btn">
																		<button class="btn btn-default btnSelectEventVideo" type="button">
																			Select File
																		</button>
																	</div>
																</div>
																<div class="thumbnailWrapper" style="width: 100%;"></div>
															</div>
														</fieldset>
													</div>
												</div>
											</div>
											<div class="col-sm-12 col-md-8 col-lg-8 beforeafterWrapper">
												<div class="row">
													<div class="col-sm-12 col-md-6 col-lg-6">
														<fieldset>
														<!-- Before -->
															<div class="form-group">
																<label class="control-label">Before</label>
																<p>
																	<span class="label label-warning">
																	NOTE</span> &nbsp; Accept file *.png, *.jpg &amp; size <=5MBs.
																</p>
																<div class="input-group">
																	<input type="text" name="before" class="inputThumbnail form-control" readonly>
																	<div class="input-group-btn">
																		<button class="btn btn-default btnSelectBefore" type="button">
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
														<!-- After -->
															<div class="form-group">
																<label class="control-label">After</label>
																<p>
																	<span class="label label-warning">
																	NOTE</span> &nbsp; Accept file *.png, *.jpg &amp; size <=5MBs.
																</p>
																<div class="input-group">
																	<input type="text" name="after" class="inputThumbnail form-control" readonly>
																	<div class="input-group-btn">
																		<button class="btn btn-default btnSelectAfter" type="button">
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