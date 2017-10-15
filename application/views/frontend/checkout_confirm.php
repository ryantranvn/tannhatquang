<div id="wrap_checkout" class="container-fluid">
    <div class="container">
        <div class="wrap_steps">
            <div class="stepwizard">
                <div class="stepwizard-row">
                    <div class="stepwizard-step">
                        <button type="button" class="btn btn-default btn-circle" disabled="disabled">1</button>
                        <p>Xác nhận đơn hàng</p>
                    </div>
                    <div class="stepwizard-step">
                        <button type="button" class="btn btn-primary btn-circle">2</button>
                        <p>Thông tin khách hàng</p>
                    </div>
                    <div class="stepwizard-step">
                        <button type="button" class="btn btn-default btn-circle" disabled="disabled">3</button>
                        <p>Hoàn tất đơn hàng</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col col-sm-12">
                <div class="wrap_customer_info">
                    <h4 class="title">Thông tin khách hàng</h4>
                    <?=$frmCustomer['open']?>
                    <div class="row">
                        <div class="col col-sm-12">
                            <div class="row">
                                <div class="col col-sm-4">
                                    <div class="form-group">
                                        <label for="fullname">Họ tên <span class="require">*</span></label>
                                        <input type="text" class="form-control" id="fullname" name="fullname">
                                    </div>
                                </div>
                                <div class="col col-sm-4">
                                    <div class="form-group">
                                        <label for="phone">Điện thoại <span class="require">*</span></label>
                                        <input type="text" class="form-control" id="phone" name="phone">
                                    </div>
                                </div>
                                <div class="col col-sm-4">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" name="email">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row frm_block">
                        <div class="col col-sm-12">
                            <div class="row">
                                <div class="col col-sm-4">
                                    <div class="form-group">
                                        <label for="province">Tỉnh/Thành phố</label>
                                        <select class="js_select2" name="province_id">
                                            <? foreach ($provinces as $province) { ?>
                                                <option value="<?=$province['id']?>"><?=$province['name']?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col col-sm-4">
                                    <div class="form-group">
                                        <label for="district">Quận/Huyện</label>
                                        <select class="js_select2" name="district_id">
                                            <option value="0">Chọn quận/huyện</option>
                                            <? foreach ($dictricts as $district) { ?>
                                                <option value="<?=$district['id']?>"><?=$district['text']?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col col-sm-4">
                                    <div class="form-group">
                                        <label for="address">Địa chỉ</label>
                                        <input type="text" class="form-control" id="address" name="address">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row frm_block">
                        <div class="col col-sm-12">
                            <label style="color: #3aa1ea">Địa chỉ giao hàng</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="same_address" value="1" checked>
                                    Giao đến cùng địa chỉ trên
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="same_address" value="0">
                                    Giao đến địa chỉ khác
                                </label>
                            </div>
                        </div>
                        <div class="col col-sm-12 different_address">
                            <div class="row">
                                <div class="col col-sm-4">
                                    <div class="form-group">
                                        <label for="province">Tỉnh/Thành phố</label>
                                        <select class="js_select2" name="province_id">
                                            <? foreach ($provinces as $province) { ?>
                                                <option value="<?=$province['id']?>"><?=$province['name']?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col col-sm-4">
                                    <div class="form-group">
                                        <label for="district">Quận/Huyện</label>
                                        <select class="js_select2" name="district_id">
                                            <option value="0">Chọn quận/huyện</option>
                                            <? foreach ($dictricts as $district) { ?>
                                                <option value="<?=$district['id']?>"><?=$district['text']?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col col-sm-4">
                                    <div class="form-group">
                                        <label for="address">Địa chỉ</label>
                                        <input type="text" class="form-control" id="address" name="address">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row frm_block">
                        <div class="col col-sm-12">
                            <div class="form-group">
                                <label for="note">Chú thích giao hàng</label>
                                <textarea class="form-control" rows="3" name="note"></textarea>
                            </div>
                        </div>
                    </div>
                    <?=$frmCustomer['close']?>
                </div>
            </div>
        </div>
    </div>
</div>