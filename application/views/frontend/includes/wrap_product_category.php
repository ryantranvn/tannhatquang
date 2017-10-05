<div class="product_category">
    <p class="title">Danh mục sản phẩm <i class="fa fa-caret-down"></i></p>
    <? if (isset($categories) && count($categories)>0) { ?>
    <ul class="parent">
        <? foreach ($categories as $category) { ?>
        <li>
            <a href="#"><?=$category['name']?></a>
            <? if (isset($category['sub']) && count($category['sub'])>0) { ?>
            <ul class="child">
                <? foreach ($category['sub'] as $sub) { ?>
                <li>
                    <a href="#"><?=$sub['name']?></a>
                </li>
                <? } ?>
            </ul>
            <? } ?>
        </li>
        <? } ?>
    </ul>
    <? } ?>
</div>
