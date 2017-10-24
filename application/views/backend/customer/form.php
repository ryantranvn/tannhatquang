<?=$this->load->view('backend/includes/breadcrumb','',TRUE)?>
<!-- widget grid -->
<section id="widget-grid" class="customer_form">
    <?=$this->load->view('backend/includes/reply','',TRUE)?>
    <!-- row -->
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
            <div class="jarviswidget jarviswidget-color-blue" data-widget-editbutton="false" data-widget-deletebutton="false">
                <!-- header -->
                <header>
                    <h2>Thông tin cá nhân</h2>
                </header>
                <!-- end header -->
                <div id="wrap_form" class="custom-scroll table-responsive" class="row" style="position: relative; overflow-x: hidden; overflow-y: scroll; padding-top: 20px;">
                    <?=$frmCustomer['open']?>
                        <div class="row">
                            <label class="control-label">Họ tên <sup>*</sup></label>
                            <input type="text" class="form-control" name="fullname" <? if (isset($frmData)) { ?> value="<?=$frmData['fullname']?>" <? } ?> />
                            <span class="charLimit" id="fullname_limit"></span>
                        </div>
                        <div class="row">
                            <label class="control-label">Điện thoại <sup>*</sup></label>
                            <input type="text" class="form-control" name="phone" <? if (isset($frmData)) { ?> value="<?=$frmData['phone']?>" <? } ?> />
                            <span class="charLimit" id="phone_limit"></span>
                        </div>
                        <div class="row">
                            <label class="control-label">Email</label>
                            <input type="text" class="form-control" name="email" <? if (isset($frmData)) { ?> value="<?=$frmData['email']?>" <? } ?> />
                            <span class="charLimit" id="email_limit"></span>
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
                    <!-- Buttons -->
                        <div class="row">
                            <input type="text" name="customer_id" class="hiddenInput" <? if (isset($frmData)) { ?> value="<?=$frmData['id']?>" <? } ?> />
                            <button type="submit" class="btn btn-primary pull-right">LƯU</button>
                        </div>
                    <?=$frmCustomer['close']?>
                </div>
            </div>
        </article>
        <article class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
            <div class="jarviswidget jarviswidget-color-blue" data-widget-editbutton="false" data-widget-deletebutton="false">
                <!-- header -->
                <header>
                    <ul id="widget-tab-1" class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#tab_1">
                                <i class="fa fa-lg fa-credit-card"></i>
                                <span class="hidden-mobile hidden-tablet"> Đơn hàng </span>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#tab_2">
                                <i class="fa fa-lg fa-book"></i>
                                <span class="hidden-mobile hidden-tablet"> Địa chỉ </span>
                            </a>
                        </li>
                    </ul>
                </header>
                <!-- end header -->
                <div id="wrap_tab" class="wrap_tab custom-scroll table-responsive" class="row" style="position: relative; overflow-x: hidden; overflow-y: scroll; padding-top: 20px;">
                    <div class="tab-content padding-10">
                        <div class="tab-pane fade in active" id="tab_1">
                            <?=$this->load->view('backend/includes/table_list','',TRUE)?>
                        </div>
                        <div class="tab-pane fade" id="tab_2">
                            <?=$this->load->view('backend/customer/list_address','',TRUE)?>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>

    <!-- end row -->
</section>
<!-- end widget grid -->