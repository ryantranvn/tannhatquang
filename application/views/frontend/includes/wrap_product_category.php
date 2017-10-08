<div class="product_category">
    <p class="title">Danh mục sản phẩm <i class="fa fa-caret-down"></i></p>
    <? if (isset($categories) && count($categories)>0) { ?>
    <ul class="parent">
        <? foreach ($categories as $category) { ?>
        <li>
            <a href="<?=F_URL?>san-pham/<?=$category['url']?>?cat=sp"><?=$category['name']?></a>
            <? if (isset($category['sub']) && count($category['sub'])>0) { ?>
            <ul class="child">
                <? foreach ($category['sub'] as $sub) { ?>
                <li>
                    <a href="<?=F_URL?>san-pham/<?=$sub['url']?>?cat=sp"><?=$sub['name']?></a>
                </li>
                <? } ?>
            </ul>
            <? } ?>
        </li>
        <? } ?>
    </ul>
    <? } ?>
</div>
