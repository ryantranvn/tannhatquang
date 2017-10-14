<div id="wrap_giohang" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col col-sm-12">
                <div class="wrap_lbl_giohang">
                    <h4>Giỏ hàng
                        (<span class="number_item"><? if (count($session_cart)>0) { ?><?=$session_cart['total_item']?>
                        <? } else { ?>0<? } ?>
                        </span> sản phẩm)
                        <span class="btn_text">THÔNG TIN MUA HÀNG</span>
                    </h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-sm-12">
                <div class="wrap_giohang_danhsach">
                <? if (count($session_cart)==0) { ?>
                    <p style="text-indent: 20px;">Chưa có sản phẩm trong giỏ hàng</p>
                <? } else { ?>
                    <? foreach ($session_cart['list'] as $product) { ?>
                    <div class="wrap_giohang_item <? if ($product['sub_total']==0) { ?>need_contact<? } ?> wrap_item_<?=$product['info']['id']?>">
                        <div class="col col-sm-2 col_thumbail">
                            <? if ($product['info']['thumbnail'] != "")  { ?>
                                <img class="thumbnail_product" src="<?=F_URL?><?=$product['info']['thumbnail']?>" alt="<?=IMG_ALT?>"/>
                            <? } else { ?>
                                <img class="thumbnail_product" src="<?=NO_IMG?>" alt="<?=IMG_ALT?>"/>
                            <? } ?>
                        </div>
                        <div class="col col-sm-3 col_name">
                            <p class="product_name"><?=$product['info']['name']?></p>
                            <a class="delete_item" data-id="<?=$product['info']['id']?>" href="#">Xóa</a>
                        </div>
                        <div class="col col-sm-2 col_prize">
                        <? if ($product['info']['price_sale'] > 0)  { ?>
                            <p class="product_prize">
                                <span>Giá</span><br/>
                                <span><?=number_format($product['info']['price_sale'], 0, ',', '.')?></span>
                            </p>
                            <p class="product_prize_old"><?=number_format($product['info']['price'], 0, ',', '.')?></p>
                        <? } else { ?>
                            <p class="product_prize">
                                <span>Giá</span><br/>
                                <span><?=number_format($product['info']['price'], 0, ',', '.')?></span>
                            </p>
                        <? } ?>
                        <? if ($product['sub_total']==0) { ?>
                            <p class="contact_price">Sản phẩm cần liên hệ<br/>để biết giá</p>
                        <? } ?>
                        </div>
                        <div class="col col-sm-3 col_number_item">
                            <span>Số lượng</span><br/>
                            <div class="item_number btn-group" role="group">
                                <button type="button" class="btn btn-default btn_decrease" <?if ($product['number_item']==1) {?> disabled <? } ?> >-</button>
                                <input type="text" name="item_number" value="<?=$product['number_item']?>" data-id="<?=$product['info']['id']?>" class="btn btn-default number_input" oncopy="return false" onpaste="return false" oncut="return false" />
                                <button type="button" class="btn btn-default btn_increase">+</button>
                            </div>
                        </div>
                        <div class="col col-sm-2 col_sub_total">
                            <p class="sub_total">
                                <span class="lbl">Thành tiền</span><br/>
                                <span class="text_right"><?=number_format($product['sub_total'], 0, ',', '.')?></span>
                            </p>
                        </div>
                    </div>
                    <? } ?>
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
                        <span class="total">
                        <? if (count($session_cart)==0) { ?>
                            0
                        <? } else { ?>
                            <?=number_format($session_cart['total'], 0, ',', '.')?></span>
                        <? } ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-sm-12">
            <? if (count($session_cart)==0) { ?>
                <button class="btn btn_blue btn_muahang" onclick="window.open('<?=F_URL?>san-pham?cat=sp', '_self')">MUA HÀNG</button>
            <? } else { ?>
                <button class="btn btn_blue btn_muahang" onclick="window.open('<?=F_URL?>san-pham?cat=sp', '_self')">TIẾP TỤC MUA HÀNG</button>
                <button class="btn btn_yellow btn_dathang" onclick="window.open('<?=F_URL?>checkout', '_self')">TIẾN HÀNH ĐẶT HÀNG</button>
            <? } ?>
            </div>
        </div>
    </div>
</div>