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
                <div id="wrap_form" class="row" style="position: relative; overflow-x: hidden; overflow-y: scroll">
                    <?=$frmCategory['open']?>
                    <? /*
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <label class="control-label">Parent <sup>*</sup></label>
                        <?php $this->load->view('backend/includes/tree','',TRUE) ?>
                    </div>
                    */?>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <?=$this->load->view('backend/includes/select_category','',TRUE)?>
                            <!-- Name -->
                                <div class="row">
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <label class="control-label">Tên chuyên mục <sup>*</sup></label>
                                                    <input type="text" class="form-control" name="name_category" <? if (isset($frmData)) { ?> value="<?=$frmData['name']?>" <? } ?>/>
                                                    <span class="charLimit" id="name_category_limit"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            <!-- URL -->
                                <div class="row">
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <label class="control-label">URL <sup>*</sup></label>
                                                    <input type="text" class="form-control" name="url_category" <? if (isset($frmData)) { ?> value="<?=$frmData['url']?>" <? } ?> disabled/>
                                                    <span class="charLimit" id="url_category_limit"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            <!-- Desc -->
                                <div class="row">
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <label class="control-label">Mô tả </label>
                                                    <textarea name="desc_category" class="form-control resizeVer" rows="5"><? if (isset($frmData)) { echo $frmData['desc']; } ?></textarea>
                                                    <span class="charLimit" id="desc_category_limit"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            <!-- Order -->
                                <div class="row">
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-12 col-md-3 col-lg3 control-label">Thứ tự</label>
                                                <div class="col-sm-12 col-md-6 col-lg-6">
                                                    <input type="text" class="form-control spinner-both orderSpinner positive-integer" name="order" <? if (isset($frmData)) { ?> value="<?=$frmData['order']?>" <? } else { ?>value="0"<? } ?> />
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            <!-- Status -->
                                <div class="row">
                                    <fieldset>
                                        <div id="statusAdd" class="form-group row radioWrapper">
                                            <label class="col-sm-12 col-md-3 col-lg-3 control-label" style="line-height: 32px">Trạng thái</label>
                                            <div class="col-sm-12 col-md-9 col-lg-9">
                                                <?=$this->load->view('backend/includes/group_status_btn','',TRUE)?>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <!-- Thumbnail -->
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
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
                        <!-- Buttons -->
                        <div class="row">
                            <input type="text" name="id_category" class="hiddenInput" <? if (isset($frmData)) { ?> value="<?=$frmData['id']?>" <? } ?> />
                            <button class="btn btn-sm btn-success pull-right" type="submit">
                                <i class="fa fa-lg fa-save"></i> Submit
                            </button>
                            <button class="btnCancel btn btn-sm .bg-color-blueLight pull-right" type="button" style="margin-right: 10px;">
                                <i class="fa fa-times"></i> Cancel
                            </button>
                        </div>
                    </div>

                    <?=$frmCategory['close']?>
                </div>
            </div>
        </article>
    </div>
    <!-- end row -->
</section>
<!-- end widget grid -->
