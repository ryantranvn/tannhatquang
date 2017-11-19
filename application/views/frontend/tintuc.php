<div id="wrap_tintuc" class="container-fluid">
    <div class="container">
        <div class="row">
            <div id="wrap_left" class="col col-sm-3">
                <?=$this->load->view('frontend/includes/wrap_product_category','',TRUE)?>
                <?=$this->load->view('frontend/includes/wrap_hot_product','',TRUE)?>
            </div>
            <div id="wrap_right" class="col col-sm-9">
                <div class="row">
                    <h3 class="text_left red" style="line-height: 40px; display: none">Tin nổi bật - Khuyến mãi </h3>
                    <div class="wrap_tintuc_noibat container-fluid">
                        <div class="col col-sm-6">
                            <img src="<?=ASSETS_URL?>frontend/images/tintuc-01.jpg" alt="<?=IMG_ALT?>" />
                        </div>
                        <div class="col col-sm-6">
                            <div class="row">
                                <div class="col col-sm-12">
                                    <img src="<?=ASSETS_URL?>frontend/images/tintuc-02.jpg" alt="<?=IMG_ALT?>" />
                                </div>
                            </div>
                            <div class="row" style="margin-top: 28px;">
                                <div class="col col-sm-6">
                                    <img src="<?=ASSETS_URL?>frontend/images/tintuc-03.jpg" alt="<?=IMG_ALT?>" />
                                </div>
                                <div class="col col-sm-6">
                                    <img src="<?=ASSETS_URL?>frontend/images/tintuc-04.jpg" alt="<?=IMG_ALT?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <h3 class="text_left red" style="line-height: 40px">Tin tức sản phẩm</h3>
                    <? if (isset($arr_news) && count($arr_news)>0) { ?>
                    <div class="wrap_tintuc_sanpham container-fluid">
                        <? foreach ($arr_news as $key => $news) { ?>
                        <div class="col col-sm-6 item_tintuc_sanpham">
                            <div class="row">
                                <div class="col col-sm-6">
                                    <? if ($news['thumbnail'] != "")  { ?>
                                        <img class="media-object thumbnail_product" src="<?=F_URL?><?=$news['thumbnail']?>" alt="<?=IMG_ALT?>"/>
                                    <? } else { ?>
                                        <img class="media-object thumbnail_product" src="<?=NO_IMG?>" alt="<?=IMG_ALT?>"/>
                                    <? } ?>
                                    <a href="<?=F_URL?>tin-tuc/<?=$news['url']?>" class="link_full"></a>
                                </div>
                                <div class="col col-sm-6">
                                    <p class="title"><?php echo $news['title'] ?></p>
                                    <p class="desc"><?php echo $news['description'] ?></p>
                                    <a href="<?=F_URL?>tin-tuc/<?=$news['url']?>" class="link_full"></a>
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
