<div id="wrap_search" class="container-fluid">
    <div class="container">
        <div class="row">
            <div id="wrap_logo" class="col col-sm-3 pull-left">
                <a class="link_logo" href="<?=F_URL?>">
                    <img src="<?=ASSETS_URL?>frontend/images/logo.png" />
                </a>
            </div>
            <div id="wrap_frmSearch" class="col col-sm-9 pull-right">
                <?=$frmSearch['open']?>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm">
                    <span class="btn input-group-addon">
                        <i class="fa fa-search"></i>
                    </span>
                </div>
                <?=$frmSearch['close']?>
            </div>
        </div>
    </div>
</div>
