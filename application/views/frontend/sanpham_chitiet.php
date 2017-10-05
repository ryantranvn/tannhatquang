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
                            <p class="product_prize">VND 120.000</p>
                            <p class="product_prize_old"><span>VND 240.000 </span> 50%</p>
                            <a class="add_cart" href="#">THÊM VÀO GIỎ HÀNG</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <h3 class="text_center red" style="line-height: 40px">Sản phẩm liên quan</h3>
                    <? if (isset($related_products) && count($related_products)>0) { ?>
                        <div id="related_products" class="wrap_sanpham_list container-fluid">
                            <? foreach ($related_products as $key => $product) { ?>
                                <div class="col col-sm-4 item_sanpham">
                                    <div class="row">
                                        <div class="col col-sm-12">
                                            <div class="wrap_thumbnail">
                                                <? if ($product['thumbnail'] != "")  { ?>
                                                    <img class="media-object thumbnail_product" src="<?=$product['thumbnail']?>" alt="<?=IMG_ALT?>">
                                                <? } else { ?>
                                                    <img class="media-object thumbnail_product" src="<?=F_URL?>assets/frontend/images/light.png" alt="<?=IMG_ALT?>">
                                                <? } ?>
                                            </div>
                                            <a href="<?=F_URL?><?=$product['url']?>" class="link_full"></a>
                                        </div>
                                        <div class="col col-sm-12">
                                            <p class="product_desc"><?=$product['name']?> - <?=$product['code']?></p>
                                            <p class="product_prize">VND 120.000</p>
                                            <p class="product_prize_old"><span>VND 240.000 </span> 50%</p>
                                            <a href="<?=F_URL?><?=$product['url']?>" class="link_full"></a>
                                        </div>
                                        <div class="col col-sm-12">
                                            <a href="#" class="add_cart">Thêm vào giỏ hàng</a>
                                        </div>
                                    </div>
                                </div>
                            <? } ?>
                        </div>
                        <div class="wrap_paging wrap_paging_jpages"></div>
                    <? } ?>
                </div>
            </div>
        </div>
    </div>
</div>