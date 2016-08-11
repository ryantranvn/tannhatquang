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
									<!-- NEWS -->
										<div class="row">
											<div class="col-sm-12 col-md-12 col-lg-12">
												<fieldset>
													<div class="form-group">
														<div class="row">
															<div class="col-sm-12 col-md-12 col-lg-12">
																<label class="control-label">News <sup>*</sup></label><br/>
																<div id="categoryWrapper">
																	<? foreach ($arrNews as $key => $news) { ?>
																		<a class="category btn btn-default <? if ($news['id']==8) { echo "btn-success"; } ?>" data-save="<?=$news['id']?>"><?=$news['name']?></a>
																	<? } ?>
																</div>
																<input name="category" type="text" value="8" class="hiddenInput" />
															</div>
														</div>
													</div>
												</fieldset>
											</div>
										</div>
									<!-- TITLE -->
										<div class="row">
											<div class="col-sm-12 col-md-6 col-lg-6">
												<fieldset>
													<div class="form-group">
														<div class="row">
															<div class="col-sm-12 col-md-12 col-lg-12">
																<label class="control-label">TITLE VN<sup>*</sup></label>
																<input type="text" name="title" class="form-control" />
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
																<input type="text" name="titleEN" class="form-control" />
																<span class="charLimit" id="titleENLimit"></span>
															</div>
														</div>
													</div>
												</fieldset>
											</div>
										</div>
									<!-- URL -->
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
												<fieldset>
													<div class="form-group">
														<div class="row">
															<div class="col-sm-12 col-md-12 col-lg-12">
																<label class="control-label">URL VN<sup>*</sup></label>
																<input type="text" class="form-control" name="url" />
																<span class="charLimit" id="urlLimit"></span>
															</div>
														</div>
													</div>
												</fieldset>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
												<fieldset>
													<div class="form-group">
														<div class="row">
															<div class="col-sm-12 col-md-12 col-lg-12">
																<label class="control-label">URL EN<sup>*</sup></label>
																<input type="text" class="form-control" name="urlEN" />
																<span class="charLimit" id="urlENLimit"></span>
															</div>
														</div>
													</div>
												</fieldset>
											</div>
										</div>
									<!-- DESC -->
										<div class="row">
											<div class="col-sm-12 col-md-6 col-lg-6">
												<fieldset>
													<div class="form-group">
														<div class="row">
															<div class="col-sm-12 col-md-12 col-lg-12">
																<label class="control-label">DESCRIPTION VN<sup>*</sup></label>
																<textarea name="desc" class="form-control resizeVer" rows="5"></textarea>
																<span class="charLimit" id="descLimit"></span>
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
																<label class="control-label">DESCRIPTION EN<sup>*</sup></label>
																<textarea name="descEN" class="form-control resizeVer" rows="5"></textarea>
																<span class="charLimit" id="descENLimit"></span>
															</div>
														</div>
													</div>
												</fieldset>
											</div>
										</div>
									<!-- OTHER -->
										<div class="row">
											<div class="col-sm-12 col-md-6 col-lg-6">
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
											<div class="col-sm-12 col-md-6 col-lg-6">
												<div class="row">
													<div class="col-sm-12 col-md-12 col-lg-12">
														<fieldset>
														<!-- Thumbnail -->
															<div class="form-group">
																<label class="control-label">Thumbnail</label>
																<p>
																	<span class="label label-warning">
																	NOTE</span> &nbsp; Accept file *.png, *.jpg &amp; size <=5MBs.
																</p>
																<div class="input-group">
																	<input type="text" name="thumbnail" class="inputThumbnail form-control" readonly>
																	<div class="input-group-btn">
																		<button class="btn btn-default btnSelectThumbnail" type="button">
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
									<!-- CONTENT -->
										<div class="row">
											<div class="col-sm-12 col-md-6 col-lg-6">
												<fieldset>
													<div class="form-group">
														<div class="col-sm-12 col-md-12 col-lg-12">
															<label class="control-label">CONTENT VN</label>
															<textarea name="contentNews" class="form-control resizeVer"></textarea>
														</div>
													</div>
												</fieldset>
											</div>
											<div class="col-sm-12 col-md-6 col-lg-6">
												<fieldset>
													<div class="form-group">
														<div class="col-sm-12 col-md-12 col-lg-12">
															<label class="control-label">CONTENT EN</label>
															<textarea name="contentNewsEN" class="form-control resizeVer"></textarea>
														</div>
													</div>
												</fieldset>
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