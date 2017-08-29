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
                    <?=$frmNews['open']?>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label class="control-label">Chuyên mục <sup>*</sup></label>
                            <?=$this->load->view('backend/includes/tree','',TRUE)?>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <!-- Title -->
	                        <div class="row">
	                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	                                <fieldset>
	                                    <div class="form-group">
	                                        <div class="col-sm-12 col-md-12 col-lg-12">
	                                            <label class="control-label">Tiêu đề <sup>*</sup></label>
	                                            <input type="text" class="form-control" name="title" <? if (isset($frmData)) { ?> value="<?=$frmData['title']?>" <? } ?>/>
	                                            <span class="charLimit" id="title_limit"></span>
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
	                                                <input type="text" class="form-control" name="url" <? if (isset($frmData)) { ?> value="<?=$frmData['url']?>" <? } ?>/>
	                                                <span class="charLimit" id="url_limit"></span>
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
	                                            <textarea class="form-control resizeVer" name="desc"><? if (isset($frmData)) { ?><?=$frmData['description']?><? } ?></textarea>
	                                            <span class="charLimit" id="desc_limit"></span>
	                                        </div>
	                                    </div>
	                                </fieldset>
	                            </div>
	                        </div>
                        <!-- Status - order - Thumbnail -->
	                        <div class="row">
	                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
    	                                    <fieldset>
    	                                        <div class="form-group">
    	                                            <label class="control-label">Thứ tự</label>
    	                                            <input type="text" class="form-control spinner-both orderSpinner positive-integer" name="order" <? if (isset($frmData)) { ?> value="<?=$frmData['order']?>" <? } else { ?>value="0"<? } ?> />
    	                                        </div>
    	                                    </fieldset>
                                        </div>
	                                </div>
	                                <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
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
                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="control-label">Thumbnail</label>
                                            <p>
                                                <span class="label label-warning">
                                                NOTE</span> &nbsp; Accept file *.png, *.jpg &amp; size <=5MBs.
                                            </p>
                                            <div class="input-group">
                                                <input type="text" name="thumbnail" class="inputThumbnail form-control" <? if (isset($frmData)) { ?> value="<?=$frmData['thumbnail']?>" <? } ?> readonly>
                                                <div class="input-group-btn">
                                                    <button class="btn btn-default btnSelectThumbnail" type="button">
                                                        Select File
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="thumbnailWrapper" style="margin-top: 10px">
                                                <?php if (!isset($frmData) || $frmData['thumbnail'] == "") { ?>
                                                    <img class="thumbnail" src="<?php echo assetsUrl('common','images','default.jpg'); ?>" />
                                                <?php } else { ?>
                                                    <div class="thumbnailItem">
                                                        <img class="thumbnail" src="<?=$frmData['thumbnail']?>" />
                                                        <a class="thumbnailDel"><i class="fa fa-trash-o"></i></a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        <!-- Detail -->
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <fieldset style="margin: 20px 0px;">
                                        <div class="form-group">
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <label class="control-label">Nội dung chi tiết</label>
                                                <textarea name="detail" class="form-control resizeVer">
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
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    	                            <input type="text" name="id" class="hiddenInput" <? if (isset($frmData)) { ?> value="<?=$frmData['id']?>" <? } ?> />
    	                            <button class="btn btn-sm btn-success pull-right" type="submit">
    	                                <i class="fa fa-lg fa-save"></i> Submit
    	                            </button>
    	                            <button class="btnCancel btn btn-sm .bg-color-blueLight pull-right" type="button" style="margin-right: 10px;">
    	                                <i class="fa fa-times"></i> Cancel
    	                            </button>
                                </div>
	                        </div>
	                    </div>

                    <?=$frmNews['close']?>
                </div>
            </div>
        </article>
    </div>
    <!-- end row -->
</section>
<!-- end widget grid -->
