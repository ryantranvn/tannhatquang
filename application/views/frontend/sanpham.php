<div id="wrap_sanpham" class="container-fluid">
    <div class="container">
        <div class="row">
            <div id="wrap_left" class="col col-sm-3">
                <?=$this->load->view('frontend/includes/wrap_product_category','',TRUE)?>
                <?=$this->load->view('frontend/includes/wrap_hot_product','',TRUE)?>
            </div>
            <div id="wrap_right" class="col col-sm-9">
                <div class="row">
                    <? if (isset($products) && count($products)>0) { ?>
                    <div class="wrap_sanpham_list container-fluid">
                        <? foreach ($products as $key => $product) { ?>
                        <div class="col col-sm-4">
                            <div class="row item_sanpham">
                                <div class="col col-sm-12">
                                    <div class="wrap_thumbnail">
                                        <? if ($product['thumbnail'] != "")  { ?>
                                        <img class="media-object thumbnail_product" src="<?=F_URL?><?=$product['thumbnail']?>" alt="<?=IMG_ALT?>"/>
                                        <? } else { ?>
                                        <img class="media-object thumbnail_product" src="<?=NO_IMG?>" alt="<?=IMG_ALT?>"/>
                                        <? } ?>
                                    </div>
                                    <a href="<?=F_URL?>san-pham/<?=$product['url']?>" class="link_full"></a>
                                </div>
                                <div class="product_information col col-sm-12">
                                    <p class="product_name">
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
                                    <p class="product_prize">VND <?=number_format($product['price'], 0, ',', '.')?></p>
                                    <? } else { ?>
                                    <p class="product_prize" style="font-size: 14px;">(vui lòng liên hệ)</p>
                                    <? } ?>
                                    <? if ($product['price_sale'] > 0) { ?>
                                    <p class="product_prize_old">
                                        <span>VND <?=$product['price_sale']?> </span>&nbsp;
                                        <? if ($product['price_sale_percent'] > 0) { ?>
                                            <?=$product['price_sale_percent']?>%
                                        <? } ?>
                                    </p>
                                    <? } ?>
                                    <a href="<?=F_URL?>san-pham/<?=$product['url']?>" class="link_full"></a>
                                </div>
                                <?/*
                                <div class="col col-sm-12">
                                    <a href="#" class="add_cart">Thêm vào giỏ hàng</a>
                                </div>
                                */?>
                            </div>
                        </div>
                        <? } ?>
                        <div class="wrap_paging">
                            <?=$paging?>
                        </div>
                    </div>
                    <? } ?>
                </div>
            </div>
        </div>
    </div>
</div>