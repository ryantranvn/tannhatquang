<div id="wrap_sanpham" class="container-fluid">
    <div class="container">
        <div class="row">
            <div id="wrap_left" class="col col-sm-3">
                <?=$this->load->view('frontend/includes/wrap_product_category','',TRUE)?>
                <?=$this->load->view('frontend/includes/wrap_hot_product','',TRUE)?>
            </div>
            <div id="wrap_right" class="col col-sm-9">
                <div class="row">
                    <? if (count($products)>0) { ?>
                    <div class="wrap_sanpham_list container-fluid">
                        <? foreach ($products as $key => $product) { ?>
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