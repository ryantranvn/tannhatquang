<?=$this->load->view('backend/includes/breadcrumb','',TRUE)?>
<!-- widget grid -->
<section id="widget-grid" class="order_form">
    <?=$this->load->view('backend/includes/reply','',TRUE)?>
    <!-- row -->
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget jarviswidget-color-blue" data-widget-editbutton="false" data-widget-deletebutton="false">
                <!-- header -->
                <header>
                    <h2>Thông tin đơn hàng</h2>
                </header>
                <!-- end header -->
                <div id="wrap_form" class="custom-scroll table-responsive" class="row" style="position: relative; overflow-x: hidden; overflow-y: scroll; padding-top: 20px;">
                    <?=$frmOrder['open']?>
                    <div class="customer_info row">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <h6>Khách hàng: </h6>
                            <span class="fullname"><i class="fa fa-user"></i>&nbsp;&nbsp;<?=$frmData['fullname']?></span><br/>
                            <span class="phone"><i class="fa fa-phone"></i>&nbsp;&nbsp;<?=$frmData['phone']?></span><br/>
                            <span class="email"><i class="fa fa-envelope"></i>&nbsp;&nbsp;<?=$frmData['email']?></span>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <h6>Địa chỉ:</h6>
                            <? if (isset($customer_address)) { ?>
                            <span class="address"><?=$customer_address['address']?></span><br/>
                            <span class="district"><?=$customer_address['district_type']?>&nbsp;<?=$customer_address['district']?></span><br/>
                            <span class="province"><?=$customer_address['province_type']?>&nbsp;<?=$customer_address['province']?></span>
                            <? } else { ?>
                            <span class="address"></span><br/>
                            <span class="district"></span><br/>
                            <span class="province"></span>
                            <? } ?>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <h6>Địa chỉ giao hàng: </h6>
                            <? if (isset($order_address)) { ?>
                                <span class="address"><?=$order_address['address']?></span><br/>
                                <span class="district"><?=$order_address['district_type']?>&nbsp;<?=$order_address['district']?></span><br/>
                                <span class="province"><?=$order_address['province_type']?>&nbsp;<?=$order_address['province']?></span>
                            <? } else { ?>
                                <span class="address"></span><br/>
                                <span class="district"></span><br/>
                                <span class="province"></span>
                            <? } ?>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <h6>Trạng thái đơn hàng: </h6>
                            <span class="order_status" data-id="<?=$frmData['id']?>" data-value="<?=$frmData['status']?>"></span>
                        </div>
                    </div>
                    <div class="order_info row">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><h6>#</h6></th>
                                    <th><h6>Sản phẩm</h6></th>
                                    <th><h6>Giá</h6></th>
                                    <th><h6>Số lượng</h6></th>
                                    <th><h6>Tạm tính</h6></th>
                                </tr>
                            </thead>
                            <tbody class="">
                                <? foreach ($order_detail as $key => $order) { ?>
                                <tr>
                                    <td align="center"><?=$key+1?></td>
                                    <td>
                                        <? if ($order['thumbnail'] != "")  { ?>
                                            <img class="media-object thumbnail_product" src="<?=F_URL?><?=$order['thumbnail']?>" alt="<?=IMG_ALT?>"/>
                                        <? } else { ?>
                                            <img class="media-object thumbnail_product" src="<?=NO_IMG?>" alt="<?=IMG_ALT?>"/>
                                        <? } ?>
                                        <p class="product_name">
                                            <?
                                            $substr = substr($order['name'],0,30);
                                            if (strlen($substr)<strlen($order['name'])) {
                                                $substr .= "...";
                                            }
                                            echo $substr;
                                            ?>
                                            <br/>
                                            <?=$order['code']?>
                                        </p>
                                    </td>
                                    <td align="right">
                                        <? if ($order['price_sale']>0) { ?>
                                            <?=number_format($order['price_sale'], 0, ',', '.')?>
                                        <? } else { ?>
                                            <?=number_format($order['price'], 0, ',', '.')?>
                                        <? } ?>
                                    </td>
                                    <td align="right">
                                        <?=$order['quantity']?>
                                    </td>
                                    <td align="right">
                                        <?=number_format($order['sub_total'], 0, ',', '.')?>
                                    </td>
                                </tr>
                                <? } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" align="right">
                                        Tổng cộng:
                                    </td>
                                    <td align="right" style="color: red">
                                        <?=number_format($frmData['total'], 0, ',', '.')?>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="row">
                        <button class="btnCancel btn btn-primary pull-left" type="button" style="margin-right: 10px;">
                            <i class="fa fa-reply"></i> Back
                        </button>
                    </div>
                    <?=$frmOrder['close']?>
                </div>
            </div>
        </article>
    </div>
    <!-- end row -->
    <!-- Status Modal -->
    <div class="modal fade" id="modalStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row_id"></div>
                    <div class="old_value"></div>
                    <div class="ajax_url"></div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</section>
<!-- end widget grid -->