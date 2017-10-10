<div id="wrap_giohang" class="container-fluid">
    <div class="container">
        <div class="wrap_steps">
            <div class="stepwizard">
                <div class="stepwizard-row">
                    <div class="stepwizard-step">
                        <button type="button" class="btn btn-default btn-circle">1</button>
                        <p>Kiểm tra giỏ hàng</p>
                    </div>
                    <div class="stepwizard-step">
                        <button type="button" class="btn btn-primary btn-circle">2</button>
                        <p>Xác nhận đơn hàng</p>
                    </div>
                    <div class="stepwizard-step">
                        <button type="button" class="btn btn-default btn-circle" disabled="disabled">3</button>
                        <p>Thông tin khách hàng</p>
                    </div>
                    <div class="stepwizard-step">
                        <button type="button" class="btn btn-default btn-circle" disabled="disabled">4</button>
                        <p>Hoàn tất đơn hàng</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-sm-12">
                <div class="wrap_lbl_giohang">
                    <h4>Giỏ hàng (<span class="number_item">3</span> sản phẩm)<span class="btn_text">THÔNG TIN MUA HÀNG</span></h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-sm-12">
                <div class="wrap_giohang_danhsach">
                    <? for ($i=1; $i<3; $i++) { ?>
                    <div class="wrap_giohang_item">
                        <div class="col col-sm-2 col_thumbail">
                            <img class="thumbnail_product" src="<?=NO_IMG?>" alt="<?=IMG_ALT?>"/>
                        </div>
                        <div class="col col-sm-3 col_name">
                            <p class="product_name">Đèn MELOS</p>
                            <a class="delete_item" href="#">Xóa</a>
                        </div>
                        <div class="col col-sm-2 col_prize">
                            <p class="product_prize">
                                <span>Giá</span><br/>
                                <span><?=number_format(260000, 0, ',', '.')?></span>
                            </p>
                            <p class="product_prize_old"><?=number_format(300000, 0, ',', '.')?></p>
                        </div>
                        <div class="col col-sm-3 col_number_item">
                            <span>Số lượng</span><br/>
                            <div class="item_number btn-group" role="group">
                                <button type="button" class="btn btn-default btn_decrease" disabled>-</button>
                                <input type="text" name="item_number" value="1" class="btn btn-default number_input" oncopy="return false" onpaste="return false" oncut="return false" />
                                <button type="button" class="btn btn-default btn_increase">+</button>
                            </div>
                        </div>
                        <div class="col col-sm-2 col_sub_total">
                            <p class="sub_total">
                                <span>Thành tiền</span><br/>
                                <span><?=number_format(121160000, 0, ',', '.')?></span>
                            </p>
                        </div>
                    </div>
                    <? } ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-sm-12">
                <div class="wrap_giohang_tong">
                    <p>
                        <span>Tổng cộng :</span>
                        <span class="currency">VND</span>
                        <span class="total"><?=number_format(121160000, 0, ',', '.')?></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>