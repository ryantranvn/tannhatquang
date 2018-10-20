<div id="wrap_sanpham" class="container-fluid">
    <div class="container">
        <div class="row">
            <div id="wrap_left" class="col col-sm-3">
                <?=$this->load->view('frontend/includes/wrap_product_category','',TRUE)?>
                <?=$this->load->view('frontend/includes/wrap_hot_product','',TRUE)?>
            </div>
            <div id="wrap_right" class="col col-sm-9">
                <? if (isset($search_val)) { ?>
                <div class="wrap_search">
                    <h4>Kết quả tìm kiếm cho '<b><?=$search_val?></b>': <b><?=count($products)?></b> kết quả</h4>
                </div>
                <? } ?>
                <div class="row">
                    <? /* ?>
                    <!-- thuong hieu -->
                    <div id="brand-wrap" class="container-fluid">
                        <? if (isset($brands) && count($brands)>0) { ?>
                        <p class="title">Thương hiệu :</p>
                        <ul class="parent hidden-xs">
                            <? foreach ($brands as $brand) { ?>
                                <li class="brand-item">
                                    <? if (isset($filterBrands) && in_array($brand['url'], $filterBrands)) { ?>
                                    <input type="checkbox" value="<?=$brand['url']?>" checked />
                                    <? } else { ?>
                                    <input type="checkbox" value="<?=$brand['url']?>" />
                                    <? } ?>
                                    <label><?=$brand['name']?></label>
                                </li>
                            <? } ?>
                        </ul>
                        <? } ?>
                    </div>
                    <? */ ?>
                    <!-- //thuong hieu -->
                    <? if (isset($products) && count($products)>0) { ?>
                    <div class="wrap_sanpham_list container-fluid">
                        <p class="title visible-xs-block">Sản phẩm <i class="fa fa-caret-down"></i></p>
                        <p class="category-name"></p>
                        <? foreach ($products as $key => $product) { ?>
                        <div class="col col-sm-4">
                            <div class="row item_sanpham">
                                <div class="col col-sm-12" style="background: white">
                                    <div class="wrap_thumbnail">
                                        <? if ($product['thumbnail'] != "" && file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$product['thumbnail'])) { ?>
                                        <img class="media-object thumbnail_product" src="<?=F_URL.$product['thumbnail']?>" alt="<?=IMG_ALT?>"/>
                                        <? } else { ?>
                                        <img class="media-object thumbnail_product" src="<?=NO_IMG?>" alt="<?=IMG_ALT?>"/>
                                        <? } ?>
                                    </div>
                                    <a href="<?=F_URL.$product['url'].'/p'.$product['id']?>" class="link_full"></a>
                                </div>
                                <div class="product_information col col-sm-12">
                                    <p class="product_name">
                                        <?
                                            $substr = substr($product['name'],0,50);
                                            if (strlen($substr)<strlen($product['name'])) {
                                                $substr .= "...";
                                            }
                                            echo $substr;
                                        ?>
                                        <br/>
                                        <span class="color_blue"><?=$product['manufacturer']?></span>
                                        <br/>
                                        <span class="color_blue"><?=$product['code']?></span>
                                    </p>
                                    <? if ($product['price'] > 0) { ?>
                                    <p class="product_prize">VND <?=number_format($product['price'], 0, ',', '.')?></p>
                                    <? } else { ?>
                                    <p class="product_prize" style="font-size: 14px;">(vui lòng liên hệ)</p>
                                    <? } ?>
                                    <? if ($product['price_sale'] > 0) { ?>
                                    <p class="product_prize_old">
                                        <span>VND <?=number_format($product['price_sale'], 0, ',', '.')?> </span>&nbsp;
                                        <? if ($product['price_sale_percent'] > 0) { ?>
                                            <?=$product['price_sale_percent']?>%
                                        <? } ?>
                                    </p>
                                    <? } ?>
                                    <a href="<?=F_URL.$product['url'].'/p'.$product['id']?>" class="link_full"></a>
                                </div>
                                <?
                                /*
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