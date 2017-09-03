<div id="wrap_hot_product" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="wrap_title col col-md-3">
                <img src="<?=ASSETS_URL?>frontend/images/hand.png" alt="<?=IMG_ALT?>">
                <p>SẢN PHẨM <br />NỔI BẬT</p>
                <a href="#">Xem thêm &#62;</a>
			</div>
            <div class="wrap_slick col col-md-9">
                <div class="row">
                    <div id="slick_hot_product" class="slick_container col-xs-12 col-sm-12 col-md-12">
                        <? for ($i=1; $i<=20; $i++) { ?>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="product_box">
	                                <img src="<?=ASSETS_URL?>frontend/images/light.png" alt="<?=IMG_ALT?>" />
	                                <p class="desc">It is a long established fact that a reader will be distracted fact.</p>
	                                <p class="prize">VND 120.000</p>
	                                <p class="prize_old"><span>VND 240.000 </span>  50%</p>
	                                <a href="#" class="link_full"></a>
								</div>
                            </div>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="wrap_sale_product" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="wrap_slick col col-md-9">
                <div class="row">
                    <div id="slick_sale_product" class="slick_container col-xs-12 col-sm-12 col-md-12">
                        <? for ($i=1; $i<=20; $i++) { ?>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="product_box">
	                                <img src="<?=ASSETS_URL?>frontend/images/light.png" alt="<?=IMG_ALT?>" />
	                                <p class="desc">It is a long established fact that a reader will be distracted fact.</p>
	                                <p class="prize">VND 120.000</p>
	                                <p class="prize_old"><span>VND 240.000 </span>  50%</p>
	                                <a href="#" class="link_full"></a>
								</div>
                            </div>
                        <? } ?>
                    </div>
                </div>
            </div>
            <div class="wrap_title col col-md-3">
                <img src="<?=ASSETS_URL?>frontend/images/ticket.png" alt="<?=IMG_ALT?>">
                <p>SẢN PHẨM <br />KHUYẾN MÃI</p>
                <a href="#">Xem thêm &#62;</a>
			</div>
        </div>
    </div>
</div>
