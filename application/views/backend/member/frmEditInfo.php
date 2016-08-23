<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="jarviswidget jarviswidget-color-blue" data-widget-editbutton="false" data-widget-deletebutton="false" id="editInfoMember">
		<!-- header -->
			<header>
				<h2>Info </h2>
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
						<?=$frmEditInfo['open']?>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<fieldset>
										<!-- Username -->
											<div class="form-group">
												<div class="row">
													<div class="col-sm-12 col-md-12 col-lg-12">
														<label class="control-label">Username <sup>*</sup></label>
														<input type="text" class="form-control" name="username" value="<?=$member['username']?>" />
														<span class="charLimit" id="usernameLimit"></span>
													</div>
												</div>
											</div>
										<!-- Thumbnail -->
											<div class="form-group">
												<label class="control-label">Thumbnail</label>
												<p>
													<span class="label label-warning">
													NOTE</span> &nbsp; Accept file *.png, *.jpg &amp; size <=5MBs.
												</p>
												<div class="input-group">
													<input type="text" name="thumbnail" class="inputThumbnail form-control" value="<?=$member['thumbnail']?>" readonly>
													<div class="input-group-btn">
														<button class="btn btn-default btnSelectThumbnail" type="button">
															Select File
														</button>
													</div>
												</div>
												<div class="thumbnailWrapper" style="margin-top: 10px">
													<?php if ($member['thumbnail'] == "") { ?>
														<img class="thumbnail" src="<?php echo assetsUrl('common','images','default.jpg'); ?>" />
													<?php } else { ?>
														<img class="thumbnail" src="<?=$member['thumbnail']?>" />
														<a class="thumbnailDel"><i class="fa fa-trash-o"></i></a>
													<?php } ?>
												</div>
											</div>
										<!-- Status -->
											<div class="row">
												<div class="col-sm-12 col-md-12 col-lg-12">
													<div id="statusEdit" class="form-group row statusWrapper">
														<label class="col-lg-3 control-label" style="line-height: 32px">Status</label>
														<div class="col-lg-9">
															<div class="btn-group" data-toggle="buttons">
																<label class="btn btn-default<?php if ($member['status'] == "active") { ?> active<?php } ?>">
																	<input type="radio" name="status" value="active" />
																	Active <i class="fa fa-eye"></i></label>
																<label class="btn btn-default<?php if ($member['status'] == "inactive") { ?> active<?php } ?>">
																	<input type="radio" name="status" value="inactive" />
																	Inactive <i class="fa fa-eye-slash"></i></label>
																<label class="btn btn-default<?php if ($member['status'] == "block") { ?> active<?php } ?>">
																	<input type="radio" name="status" value="block" />
																	Block <i class="fa fa-eye-lock"></i></label>
															</div>
														</div>
													</div>
												</div>
											</div>
									</fieldset>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 actions">
									<button class="btn btn-sm btn-success pull-right" type="submit">
										<i class="fa fa-lg fa-save"></i> Save
									</button>
								</div>
							</div>
						<?=$frmEditInfo['close']?>
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