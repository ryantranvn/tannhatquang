<div id="wrap_checkout" class="container-fluid">
    <div class="container">
        <div class="wrap_steps">
            <div class="stepwizard">
                <div class="stepwizard-row">
                    <div class="stepwizard-step">
                        <button type="button" class="btn btn-primary btn-circle">1</button>
                        <p>Xác nhận đơn hàng</p>
                    </div>
                    <div class="stepwizard-step">
                        <button type="button" class="btn btn-default btn-circle" disabled="disabled">2</button>
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
                <div class="wrap_order_review">
                    <h4 class="title">Thông tin đơn hàng</h4>
                    <table class="tbl_order">
                        <tr>
                            <th width="12%">Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th width="15%">Đơn giá</th>
                            <th width="12%">Số lượng</th>
                            <th width="20%">Thành tiền</th>
                        </tr>
                        <? foreach ($session_cart['list'] as $product) { ?>
                        <tr>
                            <td class="text_center"><?=$product['info']['code']?></td>
                            <td class="text_left"><?=$product['info']['name']?></td>
                            <td class="text_right">
                            <? if ($product['info']['price_sale']>0) { ?>
                                <?=number_format($product['info']['price_sale'], 0, ',', '.')?>
                            <? } else { ?>
                                <?=number_format($product['info']['price'], 0, ',', '.')?>
                            <? } ?>
                            </td>
                            <td class="text_center"><?=$product['number_item']?></td>
                            <td class="text_right">
                                <?=number_format($product['sub_total'], 0, ',', '.')?>
                            </td>
                        </tr>
                        <? } ?>
                        <tr class="tr_tongcong">
                            <td class="text_right" colspan="4">Tổng cộng</td>
                            <td class="text_right"><span style="float: left">VND</span><?=number_format($session_cart['total'], 0, ',', '.')?></td>
                        </tr>
                    </table>
                    <p class="note"><?=NOTE_PRICE_NEED_CONTACT?></p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col col-sm-12">
                <button class="btn btn_blue btn_muahang" onclick="window.open('<?=F_URL?>gio-hang', '_self')">XEM LẠI GIỎ HÀNG</button>
                <button class="btn btn_yellow btn_xacnhan" onclick="window.open('<?=F_URL?>checkout/confirm', '_self')">XÁC NHẬN</button>
            </div>
        </div>
    </div>
</div>