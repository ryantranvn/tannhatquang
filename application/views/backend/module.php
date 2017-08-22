<?=$this->load->view('backend/includes/breadcrumb','',TRUE)?>
<!-- widget grid -->
    <section id="widget-grid">
        <!-- reply -->
            <?=$this->load->view('backend/includes/reply','',TRUE)?>
        <!-- row -->
			<div class="row">
            <!-- ADD -->
                <?php if ($permissionsMember['Module']['2'] == 1 || $permissionsMember['Module']['3'] == 1) { ?>
                    <article class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="jarviswidget jarviswidget-color-blue" data-widget-editbutton="false" data-widget-deletebutton="false">
                        <!-- header -->
							<header>
							</header>
                        <!-- end header -->
                        <!-- widget content -->
                            <div class="wrap_left" style="position: relative; overflow-x: hidden; overflow-y: scroll">
                                <?=$frmModule['open']?>
                                <!-- Name -->
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <fieldset>
                                                <div class="form-group">
                                                    <label class="control-label">Name <sup>*</sup></label>
                                                    <input type="text" class="form-control" name="name_module" />
                                                    <span class="charLimit" id="name_module_limit"></span>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                <!-- URL -->
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <fieldset>
                                                <div class="form-group">
                                                    <label class="control-label">URL</label>
                                                    <input type="text" class="form-control" name="url" readonly />
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                <!-- Icon -->
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <fieldset>
                                                <div class="form-group">
                                                    <label class="control-label">Icon</label>
                                                    <input type="text" class="form-control" name="icon" readonly />
                                                    <div class="iconWrapper">
                                                        <?=$this->load->view('backend/includes/icon_list','',TRUE)?>
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
                                                    <label class="control-label">Description</label>
                                                    <textarea name="desc" class="form-control resizeVer" rows="5"></textarea>
                                                    <span class="charLimit" id="desc_limit"></span>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                <!-- Order -->
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <fieldset>
                                                <div class="form-group">
                                                    <label class="col-sm-12 col-md-3 col-lg3 control-label">Order</label>
                                                    <div class="col-sm-12 col-md-9 col-lg-9">
                                                        <input type="text" class="form-control spinner-both orderSpinner positive-integer" name="order" value="0" />
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                <!-- Buttons -->
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <input type="text" name="id" class="hiddenInput" />
                                            <?php if ($permissionsMember['Module']['2'] == 1) { ?>
                                            <button class="btn btn-sm btn-success pull-right btnSubmit" type="submit">Save</button>
                                            <button class="btn btn-sm btn-default pull-right btnClear" style="margin-right: 10px;">Clear</button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?=$frmModule['close']?>
                            </div>
                        <!-- end widget content -->
                        </div>
                    </article>
                <?php } ?>
            <!-- LIST -->
				<?php if ($permissionsMember['Module']['2'] == 1 || $permissionsMember['Module']['3'] == 1) { ?>
					<article class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<?php } else { ?>
					<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?php } ?>
                        <div class="jarviswidget jarviswidget-color-blue" data-widget-editbutton="false" data-widget-deletebutton="false">
                        <!-- header -->
							<header>
							</header>
						<!-- end header -->
                            <div class="wrap_right" style="position: relative; overflow-x: hidden; overflow-y: scroll">
    							<div class="wrap_content">
    								<?=$this->load->view('backend/includes/table_list','',TRUE)?>
    							</div>
                            </div>
                        </div>
                    </article>
            </div>
		<!-- end row -->
	</section>
<!-- end widget grid -->
