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
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<!-- INFO -->
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
																<div class="row">
																	<div class="col-sm-12 col-md-12 col-lg-12">
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
			<!-- /INFO -->
			</div>
			<!-- CHANGE PASS -->
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="jarviswidget jarviswidget-color-blue" data-widget-editbutton="false" data-widget-deletebutton="false" id="editPasswordMember">
						<!-- header -->
							<header>
								<h2>Change Password </h2>
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
										<?=$frmEditPassword['open']?>
											<div class="row">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
													<fieldset>
														<div class="form-group">
															<div class="row">
																<div class="col-sm-12 col-md-12 col-lg-12">
																	<label class="control-label">Old Password <sup>*</sup></label>
																	<input class="form-control" type="password" name="old_password" />
																</div>
															</div>
															<div class="row">
																<div class="col-sm-12 col-md-12 col-lg-12">
																	<label class="control-label">New Password <sup>*</sup></label>
																	<div class="input-group">
																		<input class="form-control" id="appendbutton" type="text" name="password" />
																		<div class="input-group-btn">
																			<button id="randomPass" class="btn btn-success" type="button">Random</button>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-sm-12 col-md-12 col-lg-12">
																	<label class="control-label">Confirm Password <sup>*</sup></label>
																	<input type="password" class="form-control" name="confirm_password" />
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
										<?=$frmEditPassword['close']?>
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
			<!-- /CHANGE PASS -->
			</div>
			<? if (!isset($noPermissionModule)) { ?>
				<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<!-- PERMISSION -->
					<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="jarviswidget jarviswidget-color-blue" data-widget-editbutton="false" data-widget-deletebutton="false" id="editPermissionMember">
							<!-- header -->
								<header>
									<h2>Permissions </h2>
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
											<?=$frmEditPermission['open']?>
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
														<fieldset>
															<?php foreach ($modules as $module) { ?>
															<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
																<div class="jarviswidget jarviswidget-color-white" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false" role="widget" id="editPermissionBox">
																	<header role="heading">
																		<span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
																		<h2><?=$module['name']?></h2>
																		<span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
																	</header>
																	<div class="form-group">
																		<div class="checkbox">
																			<label>
																			<?php if ($module['permission_read'] == 1 && $module['permission_add'] == 1 && $module['permission_edit'] == 1 && $module['permission_delete'] == 1) { ?>
																				<input type="checkbox" class="checkbox style-0 permissionFull" name="<?=$module['name']?>_full" checked="checked" />
																			<?php } else { ?>
																				<input type="checkbox" class="checkbox style-0 permissionFull" name="<?=$module['name']?>_full" />
																			<?php } ?>
																			  <span>Full permission</span>
																			</label>
																		</div>
																		<div class="checkbox">
																			<label>
																			  <input type="checkbox" class="checkbox style-0 permissionRead" name="<?=$module['name']?>_read"<?php if ($module['permission_read'] == 1) { ?> checked="checked"<?php } ?> />
																			  <span>Read</span>
																			</label>
																		</div>
																		<div class="checkbox">
																			<label>
																			  <input type="checkbox" class="checkbox style-0 permissionAdd" name="<?=$module['name']?>_add"<?php if ($module['permission_add'] == 1) { ?> checked="checked"<?php } ?> />
																			  <span>Add</span>
																			</label>
																		</div>
																		<div class="checkbox">
																			<label>
																			  <input type="checkbox" class="checkbox style-0 permissionEdit" name="<?=$module['name']?>_edit"<?php if ($module['permission_edit'] == 1) { ?> checked="checked"<?php } ?> />
																			  <span>Edit</span>
																			</label>
																		</div>
																		<div class="checkbox">
																			<label>
																			  <input type="checkbox" class="checkbox style-0 permissionDelete" name="<?=$module['name']?>_delete"<?php if ($module['permission_delete'] == 1) { ?> checked="checked"<?php } ?> />
																			  <span>Delete</span>
																			</label>
																		</div>
																	</div>
																</div>
															</div>
															<?php } ?>
														</fieldset>
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 actions">
													<button class="btn btn-sm btn-success pull-right" type="submit">
														<i class="fa fa-lg fa-save"></i> Save
													</button>
												</div>
											<?=$frmEditPermission['close']?>
										</div>
									<!-- end widget content -->
								</div>
							<!-- end widget div -->
						</div>
					</article>
				<!-- /PERMISSION -->
				</div>
			<? } ?>

		</div>
	<!-- end row -->
</section>
<!-- end widget grid -->