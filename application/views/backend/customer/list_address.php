<div class="row">
    <a style="margin-bottom: 15px;" class="btn btn-success btnAdd" data-toggle="modal" data-target="#modal_address">
        <i class="fa fa-plus"></i>
        Thêm mới
    </a>
</div>
<? foreach ($addresses as $key => $address) { ?>
<div class="well well-lg">
    <table class="tbl_address" width="100%">
        <tr>
            <td width="7%" valign="top">#</i></td>
            <td width="60%">
                <?=$address['address']?>&nbsp;&dash;
                <?=$address['district']?><br/>
                <?=$address['province']?>
                <? if ($address['status']==1) { ?>
                    <br/>
                    <span class="label label-primary">Địa chỉ mặc định</span>
                <? } ?>
            </td>
            <td align="right" width="33%">
                <a class="btn btn-warning btnEdit" data-toggle="modal" data-target="#modal_address">
                    <i class="fa fa-edit"></i>
                    <span class="hiddenInput address_id">
                        <? if (isset($address['id']) && $address['id'] != 0) { echo $address['id']; } ?>
                    </span>
                    <span class="hiddenInput address">
                        <? if (isset($address['address']) && $address['address'] != 0) { echo $address['address']; } ?>
                    </span>
                    <span class="hiddenInput district_id">
                        <? if (isset($address['district_id']) && $address['district_id'] != 0) { echo $address['district_id']; } ?>
                    </span>
                    <span class="hiddenInput province_id">
                        <? if (isset($address['province_id']) && $address['province_id'] != 0) { echo $address['province_id']; } ?>
                    </span>
                </a>
                <a class="btn btn-danger btnDelete"><i class="fa fa-trash-o"></i></a>
            </td>
        </tr>
    </table>
</div>
<? } ?>
<!-- Address Modal -->
<div class="modal fade" id="modal_address" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?=$frmCustomerAddress['open']?>
            <input type="text" class="hiddenInput" name="current_address_id" />
            <input type="text" class="hiddenInput" name="current_address" />
            <input type="text" class="hiddenInput" name="current_province_id" />
            <input type="text" class="hiddenInput" name="current_district_id" />
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Customer Address</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label for="province">Tỉnh/Thành phố <sup>*</sup></label>
                    <select class="select2" name="province_id">
                        <? foreach ($provinces as $province) { ?>
                            <option value="<?=$province['id']?>"><?=$province['name']?></option>
                        <? } ?>
                    </select>
                </div>
                <div class="row">
                    <label for="province">Quận/Huyện <sup>*</sup></label>
                    <select class="select2" name="district_id">
                    </select>
                </div>
                <div class="row">
                    <label class="control-label">Địa chỉ <sup>*</sup></label>
                    <input type="text" class="form-control" name="address" />
                    <span class="charLimit" id="address_limit"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ĐÓNG</button>
                <button type="submit" class="btn btn-primary">LƯU</button>
            </div>
            <?=$frmCustomerAddress['close']?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->
