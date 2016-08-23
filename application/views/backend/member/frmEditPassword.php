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