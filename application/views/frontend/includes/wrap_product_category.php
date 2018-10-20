<div class="manufacturer">
    <p class="title">Thương hiệu <i class="fa fa-caret-down"></i></p>
    <? if (isset($brands) && count($brands)>0) { ?>
    <i class="glyphicon glyphicon-chevron-down visible-xs-block"></i>
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
<div class="product_category">
    <p class="title">Danh mục sản phẩm <i class="fa fa-caret-down"></i></p>
    <? if (isset($categories) && count($categories)>0) { ?>
    <i class="glyphicon glyphicon-chevron-down visible-xs-block"></i>
    <ul class="parent hidden-xs">
        <? 
        if (!isset($paramsUrl) || $paramsUrl == "") {
            $paramsUrl = "";
        }
        ?>
        <? foreach ($categories as $category) { ?>
            <? if (isset($category['sub']) && count($category['sub'])>0) { ?>
            <li class="hasSub <? if (isset($activeMainCategoryUrl) && $category['url']==$activeMainCategoryUrl) { ?>active<? } ?>">
                <a href="<?=F_URL.$category['url'].'/c'.$category['id'].'?'.$paramsUrl?>"><?=$category['name']?></a>
                <i class="fa fa-caret-down"></i>
                <ul class="child">
                    <? foreach ($category['sub'] as $sub) { ?>
                    <li>
                        <a href="<?=F_URL.$sub['url'].'/c'.$sub['id'].'?'.$paramsUrl?>"><?=$sub['name']?></a>
                    </li>
                    <? } ?>
                </ul>
            </li>
        <? } else { ?>
            <li <? if (isset($activeMainCategoryUrl) && $category['url']==$activeMainCategoryUrl) { ?>class="active"<? } ?>>
                <a href="<?=F_URL.$category['url'].'/c'.$category['id'].'?'.$paramsUrl?>"><?=$category['name']?></a>
            </li>
        <? } ?>
    <? } ?>
    </ul>
    <? } ?>
</div>
