<div class="modal fade" id="productCategoryModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title">Category </h4>
			</div>
			<div class="modal-body">

                <?=$frmProductCategory['open']?>
	                <div class="row">
						<!-- Category -->
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
							<fieldset>
								<label class="control-label">Category <sup>*</sup></label>
								<div class="tree smart-form" style="margin-bottom: 20px;">
									<ul>
										<?php if (count($categories)>0) { ?>
										<li>
											<!-- the first -->
											<span class="label-success" data-id="<?=$categories[0]['id']?>" data-path="<?=$categories[0]['path']?>" data-indent="<?=$categories[0]['indent']?>">
												<i class="fa fa-lg fa-plus-circle"></i> <?=$categories[0]['name']?>
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
												</span>
											<?php } ?>
										</li>
										<?php } ?>
									</ul>
								</div>
								<input type="text" name="parent_id" value="2" class="" />
							</fieldset>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
							<!-- Name -->
			                <div class="row">
			                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			                        <fieldset>
			                            <div class="form-group">
			                                <div class="col-sm-12 col-md-12 col-lg-12">
			                                    <label class="control-label">Name <sup>*</sup></label>
			                                    <input type="text" class="form-control" name="nameCategory" />
			                                    <span class="charLimit" id="nameCategoryLimit"></span>
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
			                                <div class="col-sm-12 col-md-12 col-lg-12">
			                                    <label class="control-label">URL <sup>*</sup></label>
			                                    <input type="text" class="form-control" name="urlCategory" />
			                                    <span class="charLimit" id="urlCategoryLimit"></span>
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
			                                <div class="col-sm-12 col-md-12 col-lg-12">
			                                    <label class="control-label">Description </label>
			                                    <textarea name="descCategory" class="form-control resizeVer" rows="5"></textarea>
			                                    <span class="charLimit" id="descCategoryLimit"></span>
			                                </div>
			                            </div>
			                        </fieldset>
			                    </div>
			                </div>

			                <div class="row">
			                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			                <!-- Order -->
			                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			                            <fieldset>
			                                <div class="form-group">
			                                    <label class="control-label">Order</label>
			                                    <input type="text" class="form-control spinner-both orderSpinner positive-integer" name="order" value="0" />
			                                </div>
			                            </fieldset>
			                        </div>
			                <!-- Status -->
			                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			                            <fieldset>
			                                <div id="statusCategoryModal" class="form-group row radioWrapper">
			                                    <label class="control-label">Status</label>
			                                    <div class="btn-group" data-toggle="buttons" style="display:block">
			                                        <label class="btn btn-default">
			                                            <input type="radio" name="status" value="active" />
			                                            Active <i class="fa fa-eye"></i></label>
			                                        <label class="btn btn-default">
			                                            <input type="radio" name="status" value="inactive" />
			                                            Inactive <i class="fa fa-eye-slash"></i></label>
			                                    </div>
			                                </div>
			                            </fieldset>
			                        </div>
			                    </div>
			                </div>
						</div>
					</div>
		            <!-- footer -->
		            <div class="row" style="margin-top: 20px;">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		                    <button class="btn btn-sm btn-success pull-right" type="submit">
		                        <i class="fa fa-lg fa-save"></i> Submit
		                    </button>
                            <!-- case for edit -->
                            <input type="text" name="id" value="0" class="hiddenInput" />
		                    <!-- <button class="btnCancel btn btn-sm .bg-color-blueLight pull-right" type="button" style="margin-right: 10px;">
		                        <i class="fa fa-times"></i> Cancel
		                    </button> -->
						</div>
		            </div>
				<?=$frmProductCategory['close']?>
			</div>

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
