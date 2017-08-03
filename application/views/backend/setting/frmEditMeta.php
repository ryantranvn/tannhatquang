<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="jarviswidget jarviswidget-color-blue" data-widget-editbutton="false" data-widget-deletebutton="false" id="editInfoMember">
		<!-- header -->
			<header>
				<h2>Meta </h2>
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
						<?=$frmEditMeta['open']?>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<fieldset>
										<!-- Page Title -->
											<div class="form-group">
												<div class="row">
													<div class="col-sm-12 col-md-12 col-lg-12">
														<label class="control-label">Page Title <sup>*</sup></label>
														<input type="text" class="form-control" name="pageTitle" value="<?=$pageTitle?>" />
														<span class="charLimit" id="pageTitleLimit"></span>
													</div>
												</div>
											</div>
										<!-- Meta Keywords -->
											<div class="form-group">
                                                <div class="row">
													<div class="col-sm-12 col-md-12 col-lg-12">
														<label class="control-label">Meta Keywords </label>
                                                        <input class="form-control tagsinput" name="metaKey" value="<?=$metaKey?>" data-role="tagsinput">
                                                        <p>Press "Enter" to complete or add more keyword</p>
													</div>
												</div>
											</div>
										<!-- Meta Description -->
											<div class="form-group">
                                                <div class="row">
													<div class="col-sm-12 col-md-12 col-lg-12">
														<label class="control-label">Meta Description </label>
														<input type="text" class="form-control" name="metaDesc" value="<?=$metaDesc?>" />
														<span class="charLimit" id="metaDescLimit"></span>
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
						<?=$frmEditMeta['close']?>
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
