<!-- row -->
	<div id="add" class="mainContainer row">

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
									<?=$frmCategory['open']?>
										<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
										<!-- tree -->
											<fieldset>
												<label class="control-label">Parent <sup>*</sup></label>
												<div class="tree smart-form">
													<ul>
														<li>
															<span id="root" data-id="0" data-path="0-"><i class="fa fa-sm fa-minus-circle"></i> ROOT</span>
															<ul>
															<?php if (count($categories)>1) { ?>
																<li>
																	<!-- the first -->
																	<span class="label-success" data-id="<?=$categories[0]['id']?>" data-path="<?=$categories[0]['path']?>" data-indent="<?=$categories[0]['indent']?>">
																		<i class="fa fa-lg fa-plus-circle"></i> <?=$categories[0]['name']?>
																	</span>
																	<?php for($i=1; $i<=count($categories)-1; $i++) { ?>
																		<?php if ($categories[$i]['indent'] == $categories[$i-1]['indent']) { ?>
																		</li>
																			<li>
																		<?php } else if ($categories[$i]['indent'] > $categories[$i-1]['indent']) { ?>
																			<ul><li>
																		<?php } else { ?>
																			<?php for ($j=0; $j<($categories[$i-1]['indent']-$categories[$i]['indent']); $j++) { ?>
																			</li></ul>
																			<?php } ?>
																			<li>
																		<?php } ?>
																		<span data-id="<?=$categories[$i]['id']?>" data-path="<?=$categories[$i]['path']?>" data-indent="<?=$categories[$i]['indent']?>">
																			<i class="fa fa-lg fa-plus-circle"></i> <?=$categories[$i]['name']?>
																		</span>
																	<?php } ?>
																</li>
															</ul>
															<?php } ?>
														</li>
													</ul>
												</div>
												<input type="text" name="parent_id" class="hiddenInput" value="<?=$default_parent_id?>" />
												<input type="text" id="is_sub_category" class="hiddenInput" value="<?=$is_sub_category?>" />
											</fieldset>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
											<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
											<!-- Name -->
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
														<fieldset>
															<div class="form-group">
																<div class="row">
																	<div class="col-sm-12 col-md-12 col-lg-12">
																		<label class="control-label">Name <sup>*</sup></label>
																		<input type="text" class="form-control" name="name" />
																		<span class="charLimit" id="nameLimit"></span>
																	</div>
																</div>
															</div>
														</fieldset>
													</div>
												</div>
											<!-- URL -->
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
														<fieldset>
															<div class="form-group">
																<div class="row">
																	<div class="col-sm-12 col-md-12 col-lg-12">
																		<label class="control-label">URL <sup>*</sup></label>
																		<input type="text" class="form-control" name="url" />
																		<span class="charLimit" id="urlLimit"></span>
																	</div>
																</div>
															</div>
														</fieldset>
													</div>
												</div>
											<!-- Desc -->
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
														<fieldset>
															<div class="form-group">
																<div class="row">
																	<div class="col-sm-12 col-md-12 col-lg-12">
																		<label class="control-label">Description </label>
																		<textarea name="desc" class="form-control resizeVer" rows="5"></textarea>
																		<span class="charLimit" id="descLimit"></span>
																	</div>
																</div>
															</div>
														</fieldset>
													</div>
												</div>
											<!-- Order -->
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
												</div>
											<!-- Status -->
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
														<fieldset>
															<div id="statusAdd" class="form-group row radioWrapper">
																<label class="col-sm-12 col-md-3 col-lg-3 control-label" style="line-height: 32px">Status</label>
																<div class="col-sm-12 col-md-9 col-lg-9">
																	<?=$this->load->view('backend/includes/group_status_btn','',TRUE)?>
																</div>
															</div>
														</fieldset>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
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
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<button class="btn btn-sm btn-success pull-right" type="submit">
												<i class="fa fa-lg fa-save"></i> Submit
											</button>
											<button class="btnCancel btn btn-sm .bg-color-blueLight pull-right" type="button" style="margin-right: 10px;">
												<i class="fa fa-times"></i> Cancel
											</button>
										</div>
									<?=$frmCategory['close']?>
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
