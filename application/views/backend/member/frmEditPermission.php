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