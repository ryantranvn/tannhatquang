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
                                    <?=$frmProduct['open']?>
									<!-- tree -->
										<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="padding-bottom: 10px;">
											<fieldset>
												<label class="control-label">Chuyên mục <sup>*</sup></label>
												<div class="tree smart-form" style="margin-bottom: 20px;">
													<ul>
														<?php if (count($categories)>0) { ?>
														<li>
															<!-- the first -->
															<span class="label-success" data-id="<?=$categories[0]['id']?>" data-path="<?=$categories[0]['path']?>" data-indent="<?=$categories[0]['indent']?>">
																<i class="fa fa-lg fa-plus-circle"></i> <?=$categories[0]['name']?>
																<a data-toggle="modal" href="#productCategoryModal" class="addProductCategory btn animated btn-primary"><em class="glyphicon glyphicon-plus"></em></a>
                                                            </span>
															<?php for($i=1; $i<=count($categories)-1; $i++) { ?>
																<?php if ($categories[$i]['indent'] == $categories[$i-1]['indent']) { ?>
																	</li><li>
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

																	<a data-toggle="modal" href="#productCategoryModal" class="addProductCategory btn animated btn-primary"><em class="glyphicon glyphicon-plus"></em></a>
																	<a data-toggle="modal" href="#productCategoryModal" class="editProductCategory btn animated btn-default"><em class="glyphicon glyphicon-edit"></em></a>
																	<a class="deleteProductCategory animated btn btn-danger"><em class="glyphicon glyphicon-remove"></em></a>
                                                                </span>
															<?php } ?>
														</li>
                                                        <?php } ?>
													</ul>
												</div>
												<input type="text" name="parent_id" class="hiddenInput" value="2" />
											</fieldset>
										</div>
									<!-- info -->
										<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
										<!-- Code -->
											<div class="row">
		                                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
											        <fieldset>
											            <div class="form-group">
											                <div class="col-sm-12 col-md-12 col-lg-12">
											                    <label class="control-label">Mã sản phẩm <sup>*</sup></label>
											                    <input type="text" class="form-control" name="code_product" />
											                    <span class="charLimit" id="code_product_limit"></span>
											                </div>
											            </div>
											        </fieldset>
												</div>
											</div>
										<!-- Name -->
											<div class="row">
											    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											        <fieldset>
											            <div class="form-group">
											                <div class="col-sm-12 col-md-12 col-lg-12">
											                    <label class="control-label">Tên sản phẩm <sup>*</sup></label>
											                    <input type="text" class="form-control" name="name_product" />
											                    <span class="charLimit" id="name_product_limit"></span>
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
																	<input type="text" class="form-control" name="url_product" />
																	<span class="charLimit" id="url_product_limit"></span>
																</div>
															</div>
														</div>
													</fieldset>
												</div>
											</div>
										<!-- Description -->
											<div class="row" style="min-height: 90px;">
											    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											        <fieldset>
											            <div class="form-group">
											                <div class="col-sm-12 col-md-12 col-lg-12">
											                    <label class="control-label">Mô tả </label>
											                    <textarea type="text" class="form-control resizeVer" name="descProduct"></textarea>
											                    <span class="charLimit" id="descProductLimit"></span>
											                </div>
											            </div>
											        </fieldset>
											    </div>
											</div>
										<!-- Manufacturer -->
											<div class="row">
											    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											        <fieldset>
											            <div class="form-group">
											                <div class="col-sm-12 col-md-12 col-lg-12">
											                    <label class="control-label">Thương hiệu: </label>
											                    <input type="text" class="form-control" name="manufacturerProduct" />
											                    <span class="charLimit" id="manufacturerProductLimit"></span>
											                </div>
											            </div>
											        </fieldset>
											    </div>
											</div>
										<!-- Price -->
											<div class="row">
											    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
											        <fieldset>
											            <div class="form-group">
											                <div class="col-sm-12 col-md-12 col-lg-12">
											                    <label class="control-label">Giá: </label>
											                    <input type="text" class="form-control" name="priceProduct" />
											                </div>
											            </div>
											        </fieldset>
											    </div>
											    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
											        <fieldset>
											            <div class="form-group">
											                <div class="col-sm-12 col-md-12 col-lg-12">
											                    <label class="control-label">Giá khuyến mãi: </label>
											                    <input type="text" class="form-control" name="priceProduct_sale" />
											                </div>
											            </div>
											        </fieldset>
											    </div>
											    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
											        <fieldset>
											            <div id="statusAdd" class="form-group row radioWrapper">
											                <label class="control-label">Trạng thái</label>
											                <div class="btn-group" data-toggle="buttons" style="display: block">
											                    <label class="btn btn-default">
											                        <input type="radio" name="status" value="active"  checked="checked" />
											                        Active <i class="fa fa-eye"></i></label>
											                    <label class="btn btn-default">
											                        <input type="radio" name="status" value="inactive" />
											                        Inactive <i class="fa fa-eye-slash"></i></label>
											                </div>
											            </div>
											        </fieldset>
											    </div>
											</div>
										<!-- Detail -->
											<div class="row">
												
											</div>
										</div>
                                    <?=$frmProduct['close']?>
                                </div>
							<!-- end widget content -->
							</div>
						<!-- end widget div -->
						<!-- note -->
							<div class="col-sm-12 col-md-12 col-lg-12">
								<label><sup>*</sup> Bắt buộc</label>
							</div>
						<!-- end note -->
					</div>
				</article>
			</div>
		<!-- end row -->
	</section>
<!-- end widget grid -->
