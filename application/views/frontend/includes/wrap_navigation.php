<div id="wrap_navigation" class="container-fluid">
    <div class="container">
        <div class="row">
        <!-- nav Sanpham -->
			<div id="nav_sanpham" class="col col-sm-3">
				<a href="#">Sản phẩm <i class="fa fa-caret-down"></i></a>
			</div>
            <div id="nav_others" class="col col-sm-7">
                <ul class="nav navbar-nav">
                    <li<?if (isset($active_nav) && $active_nav=="gioithieu") { ?> class="active"<? } ?>>
                        <a href="<?=F_URL?>gioi-thieu">Giới thiệu</a>
                    </li>
                    <li<?if (isset($active_nav) && $active_nav=="banggia") { ?> class="active"<? } ?>>
                        <a href="<?=F_URL?>bang-gia">Bảng giá</a>
                    </li>
                    <li<?if (isset($active_nav) && $active_nav=="tintuc") { ?> class="active"<? } ?>>
                        <a href="<?=F_URL?>tin-tuc">Tin tức</a>
                    </li>
                    <li<?if (isset($active_nav) && $active_nav=="lienhe") { ?> class="active"<? } ?>>
                        <a href="<?=F_URL?>lien-he">Liên hệ</a>
                    </li>
                </nav>
            </div>
            <div id="wrap_cart" class="col col-sm-2 text-right">
                Giỏ hàng
                <span id="cart_number">10</span>
				<a class="link_full" href="<?=F_URL?>"></a>
            </div>
        </div>
    </div>
    <div id="nav_sanpham_popover">
        <? foreach ($categories as $category) { ?>
            <div class="item">
                <p class="nav_parent">
                    <a href="<?=F_URL?><?=$category['url']?>?cat=sp"><?=$category['name']?></a>
                </p>
                <? if (count($category['sub'])>0) { ?>
                    <? foreach ($category['sub'] as $sub) { ?>
                        <p class="nav_child">
                            <a href="<?=F_URL?><?=$sub['url']?>?cat=sp&sub=<?=$category['url']?>"><?=$sub['name']?></a>
                        </p>
                    <? } ?>
                <? } ?>
            </div>
        <? } ?>
    </div>
    <div id="nav_sanpham_bg"></div>
</div>
