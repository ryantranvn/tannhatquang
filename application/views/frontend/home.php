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
                        <? foreach ($hot_products as $product) { ?>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="product_box">
                                    <div class="wrap_thumbnail">
                                        <? if ($product['thumbnail'] != "")  { ?>
                                            <img class="thumbnail_product" src="<?=F_URL?><?=$product['thumbnail']?>" alt="<?=IMG_ALT?>"/>
                                        <? } else { ?>
                                            <img class="thumbnail_product" src="<?=NO_IMG?>" alt="<?=IMG_ALT?>"/>
                                        <? } ?>
                                    </div>
	                                <p class="desc">
                                        <?
                                        $substr = substr($product['name'],0,30);
                                        if (strlen($substr)<strlen($product['name'])) {
                                            $substr .= "...";
                                        }
                                        echo $substr;
                                        ?>
                                        <br/>
                                        <?=$product['code']?>
                                    </p>
                                    <? if ($product['price'] > 0) { ?>
                                        <p class="price">VND <?=number_format($product['price'], 0, ',', '.')?></p>
                                    <? } else { ?>
                                        <p class="price" style="font-size: 14px;">(vui lòng liên hệ)</p>
                                    <? } ?>
                                    <? if ($product['price_sale'] > 0) { ?>
                                        <p class="price_old">
                                            <span>VND <?=$product['price_sale']?> </span>&nbsp;
                                            <? if ($product['price_sale_percent'] > 0) { ?>
                                                <?=$product['price_sale_percent']?>%
                                            <? } ?>
                                        </p>
                                    <? } ?>
                                    <a href="<?=F_URL?>san-pham/<?=$product['url']?>" class="link_full"></a>
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
                        <? foreach ($sale_products as $product) { ?>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="product_box">
                                    <div class="wrap_thumbnail">
                                        <? if ($product['thumbnail'] != "")  { ?>
                                            <img class="thumbnail_product" src="<?=F_URL?><?=$product['thumbnail']?>" alt="<?=IMG_ALT?>"/>
                                        <? } else { ?>
                                            <img class="thumbnail_product" src="<?=NO_IMG?>" alt="<?=IMG_ALT?>"/>
                                        <? } ?>
                                    </div>
	                                <p class="desc">
                                        <?
                                        $substr = substr($product['name'],0,30);
                                        if (strlen($substr)<strlen($product['name'])) {
                                            $substr .= "...";
                                        }
                                        echo $substr;
                                        ?>
                                        <br/>
                                        <?=$product['code']?>
                                    </p>
                                    <? if ($product['price'] > 0) { ?>
                                        <p class="price">VND <?=number_format($product['price'], 0, ',', '.')?></p>
                                    <? } else { ?>
                                        <p class="price" style="font-size: 14px;">(vui lòng liên hệ)</p>
                                    <? } ?>
	                                <p class="price_old"><span>VND 240.000 </span>  50%</p>
                                    <a href="<?=F_URL?>san-pham/<?=$product['url']?>" class="link_full"></a>
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
