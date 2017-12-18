<div class="product_name hidden-xs"><?=$product['name']?></div>

<? if (isset($product['price_sale']) && $product['price_sale']>0) {?>
<p class="attr_name">Khuyến mãi:</p>
<p class="attr_value color_blue"><?=number_format($product['price_sale'], 0, ',', '.')?></p>
<? } ?>

<!--
<p class="attr_name">Loại sản phẩm:</p>
<p class="attr_value color_blue">Đèn Led Âm trần - Libastar - Việt Nam</p>
-->

<? if (isset($product['manufacturer']) && $product['manufacturer']!="") {?>
<p class="attr_name">Thương hiệu:</p>
<p class="attr_value color_blue"><?=$product['manufacturer']?></p>
<? } ?>

<? if (isset($product['description']) && $product['description']!="") {?>
<p class="attr_name">Thông tin chi tiết:</p>
<div class="attr_value"><?=$product['description']?></div>
<? } ?>