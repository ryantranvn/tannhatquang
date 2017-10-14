<div id="wrap_giohang" class="container-fluid">
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
                    <h4>Thông tin đơn hàng</h4>
                    <table>
                        <tr>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                        <? foreach ($session_cart['list'] as $product) { ?>
                        <tr>
                            <td><?=$product['info']['code']?></td>
                            <td><?=$product['info']['name']?></td>
                            <td>
                            <? if ($product['info']['price_sale']>0) { ?>
                                <?=$product['info']['price_sale']?>
                            <? } else { ?>
                                <?=$product['info']['price']?>
                            <? } ?>
                            </td>
                            <td><?=$product['info']['quantity']?></td>
                            <td></td>
                        </tr>
                        <? } ?>
                    </table>
                </div>
            </div>
        </div>


    </div>
</div>