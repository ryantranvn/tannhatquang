<?
// for demo
/*
$max = 2;
$arr_images = array(
    'http://images.triumphmotorcycles.co.uk/media-library/images/bikes/scaled-help-me-choose-images%20-%20do%20not%20use/rhs%20my15/mfv_my14_bonneville-t100-black_rhs.png?w=600',
    'https://auto.ndtvimg.com/bike-images/colors/triumph/bonneville-t100/triumph-bonneville-t100-new-england-white-intense-orange.png?v=27',
    'http://www.automobilenews.net/wp-content/uploads/2010/11/2011-Triumph-Bonneville-T100-1.jpg',
    'http://images.triumphmotorcycles.co.uk/media-library/images/configurator/modern%20classics/db/intense_orange_new_england_white_db_rhs.png?w=600',
    'https://auto.ndtvimg.com/bike-images/big/triumph/bonneville-t120/triumph-bonneville-t120.jpg?v=5',
    'http://images.mcn.bauercdn.com/pagefiles/484658/em556944_lowres.jpg',
    'http://www.motorcyclistonline.com/sites/motorcyclistonline.com/files/styles/1000_1x_/public/images/2016/01/triumph-bonneville-08.jpg?itok=lPACm20D',
    'http://www.musicswapshoppe.com/images/belstaff-triumph-bonneville-01.jpg'
);
*/
?>
<div class="wrap_thumbnail">
    <? if (count($product['pictures'])==0) { ?>
        <img class="media-object thumbnail_product" src="<?=NO_IMG?>" alt="<?=IMG_ALT?>">
    <? } else { ?>
        <? if (count($product['pictures'])<=4) { ?>
        <ul>
            <? foreach($product['pictures'] as $picture) { ?>
            <li>
                <a href="#" data-large="<?=$picture?>">
                    <? if (file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$picture)) { ?>
                        <img class="thumbnail_product" src="<?=F_URL.$picture?>" alt="<?=IMG_ALT?>">
                    <? } else { ?>
                        <img class="thumbnail_product" src="<?=NO_IMG?>" alt="<?=IMG_ALT?>">
                    <? }?>
                </a>
            </li>
            <? } ?>
        </ul>
        <? } else { ?>
        <ul id="carousel" class="elastislide-list">
            <? foreach($product['pictures'] as $picture) { ?>
            <li>
                <? if (file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$picture)) { ?>
                <a href="#" data-large="<?=$picture?>">
                    <img class="thumbnail_product" src="<?=F_URL.$picture?>" alt="<?=IMG_ALT?>">
                </a>
                <? } else { ?>
                    <img class="thumbnail_product" src="<?=NO_IMG?>" alt="<?=IMG_ALT?>">
                <? }?>
            </li>
            <? } ?>
        </ul>
        <? } ?>
    <? } ?>
</div>
<div class="wrap_large_picture">
    <? if (count($product['pictures'])>0) { ?>
        <? if (file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$product['pictures'][0])) { ?>
            <img class="product_zoom" src="<?=F_URL.$product['pictures'][0]?>" data-zoom-image="<?=F_URL.$product['pictures'][0]?>" alt="<?=IMG_ALT?>">
        <? } else { ?>
            <img class="thumbnail_product" src="<?=NO_IMG?>" alt="<?=IMG_ALT?>">
        <? } ?>
    <? } ?>
</div>
