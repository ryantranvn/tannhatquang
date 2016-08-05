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
				<article id="editContainer" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="jarviswidget jarviswidget-color-blue" data-widget-editbutton="false" data-widget-deletebutton="false" id="editService">
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
									<?=$frmEdit['open']?>
									<!-- SERVICE -->
										<div class="row">
											<div class="col-sm-12 col-md-12 col-lg-12">
												<fieldset>
													<div class="form-group">
														<div class="row">
															<div class="col-sm-12 col-md-12 col-lg-12">
																<label class="control-label">Service <sup>*</sup></label><br/>
																<div id="categoryWrapper">
																	<? foreach ($arrService as $key => $service) { ?>
																		<a class="category btn btn-default <? if ($service['id']==$editPost['parent_id']) { echo "btn-success"; } ?>" data-save="<?=$service['id']?>"><?=$service['name']?></a>
																	<? } ?>
																</div>
																<input name="category" type="text" value="<?=$editPost['parent_id']?>" class="hiddenInput" />
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
																<input type="text" name="title" class="form-control" value="<?=$editPost['title']?>" />
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
																<input type="text" name="titleEN" class="form-control" value="<?=$editPost['title_en']?>" />
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
																<input type="text" class="form-control" name="url" value="<?=$editPost['url']?>" />
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
																<input type="text" class="form-control" name="urlEN" value="<?=$editPost['url_en']?>" />
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
																<textarea name="desc" class="form-control resizeVer" rows="5"><?=$editPost['desc']?></textarea>
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
																<textarea name="descEN" class="form-control resizeVer" rows="5"><?=$editPost['desc_en']?></textarea>
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
																	<input type="text" class="form-control spinner-both orderSpinner positive-integer" name="order" value="<?=$editPost['order']?>" />
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
																	<label class="btn btn-default<?php if ($editPost['status'] == "active") { ?> active<?php } ?>">
																		<input type="radio" name="status" value="active" />
																		Active <i class="fa fa-eye"></i></label>
																	<label class="btn btn-default<?php if ($editPost['status'] == "inactive") { ?> active<?php } ?>">
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
																	<input type="text" name="thumbnail" class="inputThumbnail form-control" value="<?=$editPost['thumbnail']?>" readonly>
																	<div class="input-group-btn">
																		<button class="btn btn-default btnSelectThumbnail" type="button">
																			Select File
																		</button>
																	</div>
																</div>
																<div class="thumbnailWrapper" style="margin-top: 10px">
																	<?php if ($editPost['thumbnail'] == "") { ?>
																		<img class="thumbnail" src="<?php echo assetsUrl('common','images','default.jpg'); ?>" />
																	<?php } else { ?>
																		<img class="thumbnail" src="<?=$editPost['thumbnail']?>" />
																		<a class="thumbnailDel"><i class="fa fa-trash-o"></i></a>
																	<?php } ?>
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
															<textarea name="contentService" class="form-control resizeVer"></textarea>
														</div>
													</div>
												</fieldset>
											</div>
											<div class="col-sm-12 col-md-6 col-lg-6">
												<fieldset>
													<div class="form-group">
														<div class="col-sm-12 col-md-12 col-lg-12">
															<label class="control-label">CONTENT EN</label>
															<textarea name="contentServiceEN" class="form-control resizeVer"></textarea>
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
									<?=$frmEdit['close']?>
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