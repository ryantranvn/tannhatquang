<div id="wrap_banggia" class="container-fluid">
    <div class="container">
        <div class="row">
            <div id="wrap_left" class="col col-sm-3">
                <?=$this->load->view('frontend/includes/wrap_product_category','',TRUE)?>
                <?=$this->load->view('frontend/includes/wrap_hot_product','',TRUE)?>
            </div>
            <div id="wrap_right" class="col col-sm-9">
                <h3 class="text_left red" style="margin-bottom: 20px"><?php echo $news['title']; ?></h3>
                <div class="row">
                    <div class="col col-sm-4" style="text-align: center">
                        <? if ($news['thumbnail'] != "")  { ?>
                            <img class="media-object thumbnail_product" src="<?=F_URL?><?=$news['thumbnail']?>" alt="<?=IMG_ALT?>"/>
                        <? } else { ?>
                            <img class="media-object thumbnail_product" src="<?=NO_IMG?>" alt="<?=IMG_ALT?>"/>
                        <? } ?>
                    </div>
                    <div class="col col-sm-8">
                        <?php echo $news['description']; ?>
                    </div>
                </div>
                <div class="row">
                    <?php echo $news['detail']; ?>
                </div>
            <!-- Related news -->
                <div class="row">
                    <h3 class="text_left red" style="line-height: 40px">Tin tức liên quan</h3>
                    <? if (isset($related_news) && count($related_news)>0) { ?>
                        <div class="wrap_tintuc_sanpham container-fluid">
                            <? foreach ($related_news as $key => $news) { ?>
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
                            <? if (isset($related_products) && count($related_products)>PAGING_NUMBER_NOWS) { ?>
                                <div class="wrap_paging wrap_paging_jpages"></div>
                            <? } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
