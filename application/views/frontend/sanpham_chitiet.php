<div id="wrap_sanpham" class="container-fluid">
    <div class="container">
        <div class="row">
            <div id="wrap_left" class="col col-sm-3">
                <?=$this->load->view('frontend/includes/wrap_product_category','',TRUE)?>
                <?=$this->load->view('frontend/includes/wrap_hot_product','',TRUE)?>
            </div>
            <div id="wrap_right" class="col col-sm-9">
                <div class="row">
                    <div class="wrap_sanpham_detail container-fluid">
                        <div class="row">
                            <div class="wrap_product_picture col col-sm-6 no_padding">
                                <?=$this->load->view('frontend/includes/wrap_product_image','',TRUE)?>
                            </div>
                            <div class="wrap_product_info col col-sm-6">
                                <?=$this->load->view('frontend/includes/wrap_product_info','',TRUE)?>
                            </div>
                        </div>
                        <div class="row wrap_price">
                            <? if ($product['price'] > 0) { ?>
                                <p class="product_prize">VND <?=$product['price']?></p>
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
                            <a class="add_cart" href="#">THÊM VÀO GIỎ HÀNG</a>
                            <div class="item_number btn-group" role="group">
                                <button type="button" class="btn btn-default btn_decrease" disabled>-</button>
                                <input type="text" name="item_number" value="1" data-id="<?=$product['id']?>" class="btn btn-default number_input" oncopy="return false" onpaste="return false" oncut="return false" />
                                <button type="button" class="btn btn-default btn_increase">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <h3 class="text_center red" style="line-height: 40px">Sản phẩm liên quan</h3>
                    <? if (isset($related_products) && count($related_products)>0) { ?>
                        <div id="related_products" class="wrap_sanpham_list container-fluid">
                            <? foreach ($related_products as $key => $product) { ?>
                                <div class="col col-sm-4">
                                    <div class="row item_sanpham">
                                        <div class="col col-sm-12">
                                            <div class="wrap_thumbnail">
                                                <? if ($product['thumbnail'] != "")  { ?>
                                                    <img class="media-object thumbnail_product" src="<?=F_URL?><?=$product['thumbnail']?>" alt="<?=IMG_ALT?>">
                                                <? } else { ?>
                                                    <img class="media-object thumbnail_product" src="<?=NO_IMG?>" alt="<?=IMG_ALT?>">
                                                <? } ?>
                                            </div>
                                            <a href="<?=F_URL?>san-pham/<?=$product['url']?>" class="link_full"></a>
                                        </div>
                                        <div class="product_information col col-sm-12">
                                            <p class="product_desc">
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
                                                <p class="product_prize">VND <?=$product['price']?></p>
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
                                            <a href="<?=F_URL?><?=$product['url']?>" class="link_full"></a>
                                        </div>
                                        <?/*
                                        <div class="col col-sm-12">
                                            <a href="#" class="add_cart">Thêm vào giỏ hàng</a>
                                        </div>
                                        */?>
                                    </div>
                                </div>
                            <? } ?>
                        </div>
                        <? if (isset($related_products) && count($related_products)>PAGING_NUMBER_NOWS) { ?>
                        <div class="wrap_paging wrap_paging_jpages"></div>
                        <? } ?>
                    <? } ?>
                </div>
            </div>
        </div>
    </div>
</div>