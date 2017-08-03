<!-- page title  -->
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
			<!-- ADD -->
				<?php if ($permissionsMember['Module']['2'] == 1 || $permissionsMember['Module']['3'] == 1) { ?>
					<article id="addContainer" class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<div class="jarviswidget jarviswidget-color-blue" data-widget-editbutton="false" data-widget-deletebutton="false" id="add<?=$breadcrumb[0]['name']?>">
							<!-- header -->
								<header>
									<h2>Add Form </h2>
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
										<?=$frmModule['open']?>
											<div class="row">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
													<fieldset>
													<!-- Name -->
														<div class="form-group">
															<div class="row">
																<div class="col-sm-12 col-md-12 col-lg-12">
																	<label class="control-label">Name <sup>*</sup></label>
																	<input type="text" class="form-control" name="name" />
																	<span class="charLimit" id="nameLimit"></span>
																</div>
															</div>
														</div>
													<!-- URL -->
														<div class="form-group">
															<div class="row">
																<div class="col-sm-12 col-md-12 col-lg-12">
																	<label class="control-label">URL</label>
																	<input type="text" class="form-control" name="url" readonly />
																</div>
															</div>
														</div>
													<!-- Icon -->
														<div class="form-group">
															<div class="row">
																<div class="col-sm-12 col-md-12 col-lg-12">
																	<label class="control-label">Icon</label>
																	<input type="text" class="form-control" name="icon" readonly />
																	<div class="iconWrapper">
																		<?=$this->load->view('backend/includes/icon_list','',TRUE)?>
																	</div>
																</div>
															</div>
														</div>
													<!-- Desc -->
														<div class="form-group">
															<div class="row">
																<div class="col-sm-12 col-md-12 col-lg-12">
																	<label class="control-label">Description</label>
																	<textarea name="desc" class="form-control resizeVer" rows="5"></textarea>
																	<span class="charLimit" id="descLimit"></span>
																</div>
															</div>
														</div>
													<!-- Order -->
															<div class="form-group">
																<div class="row">
																	<label class="col-sm-12 col-md-3 col-lg3 control-label">Order</label>
																	<div class="col-sm-12 col-md-9 col-lg-9">
																		<input type="text" class="form-control spinner-both orderSpinner positive-integer" name="order" value="0" />
																	</div>
																</div>
															</div>
													</fieldset>
												</div>
											</div>
											<div class="actions">
												<input type="text" name="oper" value="add" class="hiddenInput" />
												<input type="text" name="id" class="hiddenInput" />
												<?php if ($permissionsMember['Module']['2'] == 1) { ?>
												<button class="btn btn-sm btn-success pull-right btnSubmit" type="submit">
													<i class="fa fa-lg fa-plus"></i> Submit
												</button>
												<?php } ?>
											</div>
										<?=$frmModule['close']?>
									</div>
								<!-- end widget content -->

								</div>
							<!-- end widget div -->
						</div>
					</article>
				<?php } ?>
			<!-- LIST -->
				<?php if ($permissionsMember['Module']['2'] == 1 || $permissionsMember['Module']['3'] == 1) { ?>
					<article id="listContainer" class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<?php } else { ?>
					<article id="listContainer" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<?php } ?>
						<div class="jarviswidget jarviswidget-color-blue" data-widget-editbutton="false" data-widget-deletebutton="false" id="list<?=$breadcrumb[0]['name']?>">
							<!-- header -->
								<header>
									<h2>List </h2>
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
											<table id="jqgrid"></table>
											<div id="pjqgrid"></div>
										<!-- for multi delete -->
											<?php if (isset($frmTopButtons)) { ?>
												<?=$frmTopButtons['open']?>
		                                            <input type="text" name="ids[]" id="ids" class="hiddenInput" />
		                                        <?=$frmTopButtons['close']?>
											<? } ?>
									<!-- end widget content -->
								</div>
							<!-- end widget div -->
						</div>
					</article>
			</div>
		<!-- end row -->
	</section>
<!-- end widget grid -->
