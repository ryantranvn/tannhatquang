<?=$this->load->view('backend/includes/breadcrumb','',TRUE)?>
<!-- widget grid -->
<section id="widget-grid">
	<?=$this->load->view('backend/includes/reply','',TRUE)?>
    <!-- row -->
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget jarviswidget-color-blue" data-widget-editbutton="false" data-widget-deletebutton="false">
            <!-- header -->
                <header>
                    <h2> </h2>
                </header>
                <!-- end header -->
                <div id="wrap_form" class="custom-scroll table-responsive" class="row" style="position: relative; overflow-x: hidden; overflow-y: scroll">
                    <?=$frmProduct['open']?>
	                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
	                        <label class="control-label">Chuyên mục <sup>*</sup></label>
	                        <?=$this->load->view('backend/includes/tree','',TRUE)?>
	                    </div>
	                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
	                    <!-- Code & Manufacturer -->
	                        <div class="row">
	                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
	                                <fieldset>
	                                    <div class="form-group">
	                                        <div class="col-sm-12 col-md-12 col-lg-12">
	                                            <label class="control-label">Mã sản phẩm <sup>*</sup></label>
	                                            <input type="text" class="form-control" name="code_product" <? if (isset($frmData)) { ?> value="<?=$frmData['code']?>" <? } ?> style="text-transform: uppercase" />
	                                            <span class="charLimit" id="code_product_limit"></span>
	                                        </div>
	                                    </div>
	                                </fieldset>
	                            </div>
	                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
	                                <fieldset>
	                                    <div class="form-group">
	                                        <div class="col-sm-12 col-md-12 col-lg-12">
	                                            <label class="control-label">Thương hiệu: </label>
	                                            <input type="text" class="form-control" name="manufacturer_product" <? if (isset($frmData)) { ?> value="<?=$frmData['manufacturer']?>" <? } ?>/>
	                                            <span class="charLimit" id="manufacturer_product_limit"></span>
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
	                                            <input type="text" class="form-control" name="name_product" <? if (isset($frmData)) { ?> value="<?=$frmData['name']?>" <? } ?>/>
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
	                                                <input type="text" class="form-control" name="url_product" <? if (isset($frmData)) { ?> value="<?=$frmData['url']?>" <? } ?> disabled/>
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
	                                            <textarea class="form-control resizeVer" name="desc_product"><? if (isset($frmData)) { ?><?=$frmData['description']?><? } ?></textarea>
	                                            <span class="charLimit" id="desc_product_limit"></span>
	                                        </div>
	                                    </div>
	                                </fieldset>
	                            </div>
	                        </div>
	                    <!-- Price - quantity - unit - status - order -->
	                        <div class="row">
	                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
	                                <div class="row">
	                                    <fieldset>
	                                        <div class="form-group">
	                                            <div class="col-sm-12 col-md-12 col-lg-12">
	                                                <label class="control-label">Giá: </label>
	                                                <div class="input-group">
	                                                    <input type="text" class="form-control positive-integer" name="price_product" <? if (isset($frmData)) { ?> value="<?=$frmData['price']?>" <? } ?>/>
	                                                    <span class="input-group-addon">VND</span>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </fieldset>
	                                </div>
	                                <div class="row" style="min-height: 42px">
	                                    <fieldset>
	                                        <div class="form-group">
	                                            <div class="col-sm-12 col-md-12 col-lg-12">
	                                                <label class="control-label">Khuyến mãi: </label>
	                                                <span class="onoffswitch">
	                                                    <? if (isset($frmData) && $frmData['price_sale'] != "" && $frmData['price_sale'] > 0) { ?>
	                                                    <input type="checkbox" class="onoffswitch-checkbox" id="have_sale" checked="checked">
	                                                    <? } else { ?>
	                                                    <input type="checkbox" class="onoffswitch-checkbox" id="have_sale">
	                                                    <? } ?>
	                                                    <label class="onoffswitch-label" for="have_sale">
	                                                        <span class="onoffswitch-inner" data-swchon-text="YES" data-swchoff-text="NO"></span>
	                                                        <span class="onoffswitch-switch"></span>
	                                                    </label>
	                                                </span>
	                                                <input type="text" name="have_sale" value="0" class="hiddenInput" />
	                                            </div>
	                                        </div>
	                                    </fieldset>
	                                </div>
	                                <div class="row" id="sale_wrap" style="display: none;">
	                                    <fieldset>
	                                        <div class="form-group">
	                                            <div class="col-sm-12 col-md-12 col-lg-12">
	                                                <label class="control-label">Giá khuyến mãi: </label>
	                                                <div class="input-group">
	                                                    <? if (isset($frmData) && $frmData['price_sale'] != "" && $frmData['price_sale'] > 0) { ?>
	                                                    <input type="text" class="form-control positive-integer" name="price_product_sale" value="<?=$frmData['price_sale']?>" />
	                                                    <? } else { ?>
	                                                    <input type="text" class="form-control positive-integer" name="price_product_sale" />
	                                                    <? } ?>
	                                                    <span class="input-group-addon">VND</span>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </fieldset>
	                                    <fieldset style="margin-top: 10px;">
	                                        <div class="form-group">
	                                            <div class="col-sm-12 col-md-12 col-lg-12">
	                                                <label class="control-label">% khuyến mãi: </label>
	                                                <div class="input-group">
	                                                    <? if (isset($frmData) && $frmData['price_sale_percent'] != "" && $frmData['price_sale_percent'] > 0) { ?>
	                                                    <input type="text" class="form-control positive-integer" name="price_product_sale_percent" value="<?=$frmData['price_sale_percent']?>" />
	                                                    <? } else { ?>
	                                                    <input type="text" class="form-control positive-integer" name="price_product_sale_percent" />
	                                                    <? } ?>
	                                                    <span class="input-group-addon">%</span>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </fieldset>
	                                </div>
	                            </div>
	                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
	                                <div class="row">
	                                    <fieldset>
	                                        <div class="form-group">
	                                            <div class="col-sm-12 col-md-12 col-lg-12">
	                                                <label class="control-label">Số lượng: </label>
	                                                <div class="input-group">
	                                                    <input type="text" class="form-control positive-integer" name="quantity_product" <? if (isset($frmData)) { ?> value="<?=$frmData['quantity']?>" <? } ?>/>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </fieldset>
	                                </div>
	                                <div class="row">
	                                    <fieldset>
	                                        <div class="form-group">
	                                            <div class="col-sm-12 col-md-12 col-lg-12">
	                                                <label class="control-label">Đơn vị: </label>
	                                                <div class="input-group">
	                                                    <input type="text" class="form-control" name="unit_product" <? if (isset($frmData)) { ?> value="<?=$frmData['unit']?>" <? } ?>/>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </fieldset>
	                                </div>
	                            </div>
	                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
	                                <div class="row">
	                                    <fieldset>
	                                        <div class="form-group">
	                                            <label class="control-label">Thứ tự</label>
	                                            <input type="text" class="form-control spinner-both orderSpinner positive-integer" name="order" <? if (isset($frmData)) { ?> value="<?=$frmData['order']?>" <? } else { ?>value="0"<? } ?> />
	                                        </div>
	                                    </fieldset>
	                                </div>
	                                <div class="row">
	                                    <fieldset>
	                                        <div id="statusAdd" class="form-group row radioWrapper">
	                                            <label class="control-label">Trạng thái</label>
	                                            <div class="row">
	                                                <?=$this->load->view('backend/includes/group_status_btn','',TRUE)?>
	                                            </div>
	                                        </div>
	                                    </fieldset>
	                                </div>
	                            </div>
	                        </div>
	                    <!-- Picture -->
	                        <div class="row" style="margin-top: 20px">
	                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	                                    <div class="row">
	                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	                                            <fieldset>
	                                                <div class="form-group">
	                                                    <label class="control-label">Hình sản phẩm</label>
	                                                    <p>
	                                                        <span class="label label-warning">
	                                                        NOTE</span> &nbsp; Chỉ chấp nhận file *.png, *.jpg &amp; size <=5MBs.
	                                                    </p>
	                                                    <div class="input-group">
	                                                        <input type="text" name="thumbnail" class="inputThumbnail form-control" readonly <? if (isset($picture_input)) { ?> value='<?=$picture_input?>' <? } ?>>
	                                                        <div class="input-group-btn">
	                                                            <button class="btn btn-default btnSelectThumbnail" type="button">
	                                                                Select File
	                                                            </button>
	                                                        </div>
	                                                    </div>
	                                                    <div class="thumbnailWrapper" style="margin-top: 10px">
	                                                        <? if (isset($pictures) && count($pictures)>0) {
	                                                            foreach ($pictures as $picture) { ?>
	                                                                <div class="thumbnailItem">
	                                                                    <img src="<?=$picture['url']?>" class="thumbnail" />
	                                                                    <a class="thumbnailDel"><i class="fa fa-trash-o"></i></a>
	                                                                </div>
	                                                            <? } ?>
	                                                        <? } else  { ?>
	                                                        <img class="thumbnail" src="<?php echo assetsUrl('common','images','default.jpg'); ?>" />
	                                                        <? } ?>
	                                                    </div>
	                                                </div>
	                                            </fieldset>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                    <!-- Detail -->
	                        <div class="row">
	                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	                                <fieldset style="margin: 20px 0px;">
	                                    <div class="form-group">
	                                        <div class="col-sm-12 col-md-12 col-lg-12">
	                                            <label class="control-label">Nội dung chi tiết</label>
	                                            <textarea name="content_product" class="form-control resizeVer">
	                                                <? if (isset($frmData)) { ?><?=$frmData['detail']?><? } ?>
	                                            </textarea>
	                                        </div>
	                                    </div>
	                                </fieldset>
	                            </div>
	                        </div>
	                    </div>
	                    <!-- Buttons -->
	                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	                        <div class="row">
                                <input type="text" name="post_id" class="hiddenInput" <? if (isset($frmData)) { ?> value="<?=$frmData['id']?>" <? } ?> />
	                            <button class="btn btn-sm btn-success pull-right" type="submit">
	                                <i class="fa fa-lg fa-save"></i> Submit
	                            </button>
	                            <button class="btnCancel btn btn-sm .bg-color-blueLight pull-right" type="button" style="margin-right: 10px;">
	                                <i class="fa fa-times"></i> Cancel
	                            </button>
	                        </div>
	                    </div>
	                <?=$frmProduct['close']?>
                </div>
            </div>
        </article>
    </div>
    <!-- end row -->
</section>
<!-- end widget grid -->
