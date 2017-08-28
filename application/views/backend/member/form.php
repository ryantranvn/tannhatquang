<?=$this->load->view('backend/includes/breadcrumb','',TRUE)?>
<!-- widget grid -->
    <section id="widget-grid">
        <!-- reply -->
            <?=$this->load->view('backend/includes/reply','',TRUE)?>
        <!-- row -->
			<div class="row">
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="jarviswidget jarviswidget-color-blue" data-widget-editbutton="false" data-widget-deletebutton="false">
                    <!-- header -->
                        <header>
                            <h2></h2>
                        </header>
                    <!-- end header -->
                        <div id="wrap_form" style="position: relative; overflow-x: hidden; overflow-y: scroll">
                            <?=$frmMember['open']?>
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <legend>Information</legend>
                                <!-- Username -->
                                    <div class="row">
                                        <fieldset>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                                        <label class="control-label">Username <sup>*</sup></label>
                                                        <input type="text" class="form-control" name="username" <? if (isset($frmData)) { ?> value="<?=$frmData['username']?>" disabled="disabled"<? } ?>/>
                                                        <span class="charLimit" id="usernameLimit"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                <!-- Password -->
                                    <div class="row password_contain">
                                        <? if (isset($frmData)) { ?>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <button class="btn" id="change_password">Change Password</button>
                                            </div>
                                        </div>
                                        <fieldset>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                                        <label class="control-label">Old Password </label>
                                                        <input class="form-control" type="password" name="old_password" />
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <? } ?>
                                        <fieldset>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                                        <label class="control-label">Password <sup>*</sup></label>
                                                        <div class="input-group">
                                                            <input class="form-control" id="appendbutton" type="text" name="password" value="23456" />
                                                            <div class="input-group-btn">
                                                                <button id="randomPass" class="btn btn-success" type="button">Random</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <label class="control-label">Confirm Password <sup>*</sup></label>
                                                    <input type="password" class="form-control" name="confirm_password" value="23456" />
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    </div>
                                <!-- Thumbnail -->
                                    <div class="row">
                                        <fieldset>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-12 col-lg-12">
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
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                <!-- Status -->
                                    <div class="row">
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div id="statusAdd" class="form-group row radioWrapper">
                                                        <label class="col-sm-12 col-md-4 col-lg-4 control-label" style="line-height: 32px">Trạng thái</label>
                                                        <div class="col-sm-12 col-md-8 col-lg-8">
                                                            <?=$this->load->view('backend/includes/group_status_btn','',TRUE)?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                    <div class="row">
                                        <fieldset id="permissions">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <legend>Permissions</legend>
                                                    <?php foreach ($modules as $module) { ?>
                                                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                                            <div class="jarviswidget jarviswidget-color-white" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false" role="widget">
                                                                <header role="heading">
																	<span class="widget-icon"> <i class="<?=$module['icon']?>"></i> </span>
																	<h2><?=$module['name']?></h2>
																	<span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
																</header>
                                                                <div class="form-group permission" id="module_<?=$module['id']?>">
																	<div class="checkbox">
																		<label>
																		  <input type="checkbox" class="checkbox style-0 permissionFull" name="<?=$module['name']?>_full" <? if (isset($module['permission']) && $module['permission'][0]==1) { ?>checked="checked"<? } ?>/>
																		  <span>Full permission</span>
																		</label>
																	</div>
																	<div class="checkbox">
																		<label>
																		  <input type="checkbox" class="checkbox style-0 permissionRead" name="<?=$module['name']?>_read" <? if (isset($module['permission']) && $module['permission'][1]==1) { ?>checked="checked"<? } ?>/>
																		  <span>Read</span>
																		</label>
																	</div>
																	<div class="checkbox">
																		<label>
																		  <input type="checkbox" class="checkbox style-0 permissionAdd" name="<?=$module['name']?>_add" <? if (isset($module['permission']) && $module['permission'][2]==1) { ?>checked="checked"<? } ?>/>
																		  <span>Add</span>
																		</label>
																	</div>
																	<div class="checkbox">
																		<label>
																		  <input type="checkbox" class="checkbox style-0 permissionEdit" name="<?=$module['name']?>_edit" <? if (isset($module['permission']) && $module['permission'][3]==1) { ?>checked="checked"<? } ?>/>
																		  <span>Edit</span>
																		</label>
																	</div>
																	<div class="checkbox">
																		<label>
																		  <input type="checkbox" class="checkbox style-0 permissionDelete" name="<?=$module['name']?>_delete" <? if (isset($module['permission']) && $module['permission'][4]==1) { ?>checked="checked"<? } ?>/>
																		  <span>Delete</span>
																		</label>
																	</div>
																</div>
                                                            </div>
                                                        </div>
                                                    <? } ?>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <input type="text" name="id" class="hiddenInput" <? if (isset($frmData)) { ?> value="<?=$frmData['id']?>" <? } ?> />
                                    <button class="btn btn-sm btn-success pull-right" type="submit">Save</button>
                                    <button class="btnCancel btn btn-sm btn-primary pull-right" type="button" style="margin-right: 10px;">Cancel</button>
                                </div>
                            <?=$frmMember['close']?>
                        </div>
                    </div>
                </article>
            </div>
		<!-- end row -->
	</section>
<!-- end widget grid -->
