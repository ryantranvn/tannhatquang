<? foreach ($addresses as $key => $address) { ?>
    <div class="well well-lg">
        <i class="fa fa-lg fa-book"></i>
        <?=$address['address']?>&nbsp;&dash;
        <?=$address['district']?>&nbsp;&dash;
        <?=$address['province']?>
        <? if ($address['status']==1) { ?>
            <span style="margin-left: 20px;" class="label label-primary">Địa chỉ chính</span>
        <? } ?>
        <a class="btn btn-warning"><i class="fa fa-edit"></i></a>
        <a class="btn btn-success"><i class="fa fa-edit"></i></a>
        <a class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
    </div>
<? } ?>
