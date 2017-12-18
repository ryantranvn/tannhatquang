<div class="product_category">
    <p class="title">Danh mục sản phẩm <i class="fa fa-caret-down"></i></p>
    <? if (isset($categories) && count($categories)>0) { ?>
    <i class="glyphicon glyphicon-chevron-down visible-xs-block"></i>
    <ul class="parent hidden-xs">
        <? foreach ($categories as $category) { ?>
        <li <? if (isset($category_url) && $category['url']==$category_url) { ?>class="active"<? } ?>>
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
