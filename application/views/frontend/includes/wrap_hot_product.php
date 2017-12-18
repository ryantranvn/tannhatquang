<div class="hot_product hidden-xs">
    <p class="title">Sản phẩm nổi bật</p>
    <? if (isset($hot_products) && count($hot_products)>0) { ?>
    <ul>
        <? foreach ($hot_products as $product) { ?>
            <li>
                <div class="media">
                    <div class="media-left">
                        <? if ($product['thumbnail'] != "")  { ?>
                            <img class="media-object thumbnail_product" src="<?=F_URL?>timthumb.php?src=<?=$product['thumbnail']?>&w=100&h=100&zc=1&q=100" alt="<?=IMG_ALT?>">
                        <? } else { ?>
                            <img class="media-object thumbnail_product" src="<?=NO_IMG?>" alt="<?=IMG_ALT?>">
                        <? } ?>
                    </div>
                    <div class="media-body">
                        <p class="product_name"><?=$product['name']?> - <?=$product['code']?></p>
                        <?/*
                        <p class="prize">VND <?=$product['price']?></p>
                        <? if ($product['price_sale'] > 0) { ?>
                            <p class="prize_old">
                                <span>VND <?=$product['price_sale']?> </span>&nbsp;
                                <? if ($product['price_sale_percent'] > 0) { ?>
                                    <?=$product['price_sale_percent']?>%
                                <? } ?>
                            </p>
                        <? } ?>
                        */?>
                    </div>
                    <a href="<?=F_URL?>san-pham/<?=$product['url']?>" class="link_full"></a>
                </div>
            </li>
        <? } ?>
    </ul>
    <? } ?>
</div>
