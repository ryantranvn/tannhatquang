<div id="wrap_navigation" class="container-fluid">
    <div class="container">
        <div class="row">
        <!-- nav Sanpham -->
			<div id="nav_sanpham" class="col col-sm-3">
				<a href="#">Sản phẩm <i class="fa fa-caret-down"></i></a>
			</div>
            <div id="nav_others" class="col col-sm-7">
                <ul class="nav navbar-nav">
                    <li<?if (isset($nav_active) && $nav_active=="gioithieu") { ?> class="active"<? } ?>>
                        <a href="<?=F_URL?>gioi-thieu">Giới thiệu</a>
                    </li>
                    <li<?if (isset($nav_active) && $nav_active=="banggia") { ?> class="active"<? } ?>>
                        <a href="<?=F_URL?>bang-gia">Bảng giá</a>
                    </li>
                    <li<?if (isset($nav_active) && $nav_active=="tintuc") { ?> class="active"<? } ?>>
                        <a href="<?=F_URL?>tin-tuc">Tin tức</a>
                    </li>
                    <li<?if (isset($nav_active) && $nav_active=="lienhe") { ?> class="active"<? } ?>>
                        <a href="<?=F_URL?>lien-he">Liên hệ</a>
                    </li>
                </nav>
                <!--
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link <?if (isset($nav_active) && $nav_active=="gioithieu") { ?>active<? } ?>" href="<?=F_URL?>gioi-thieu">Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?if (isset($nav_active) && $nav_active=="banggia") { ?>active<? } ?>" href="<?=F_URL?>bang-gia">Bảng giá</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?if (isset($nav_active) && $nav_active=="tintuc") { ?>active<? } ?>" href="<?=F_URL?>tin-tuc">Tin tức</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?if (isset($nav_active) && $nav_active=="lienhe") { ?>active<? } ?>" href="<?=F_URL?>lien-he">Liên hệ</a>
                    </li>
				</ul>
            -->
            </div>
            <div id="wrap_cart" class="col col-sm-2 text-right">
                Giỏ hàng
                <span id="cart_number">10</span>
				<a class="link_full" href="<?=F_URL?>"></a>
            </div>
        </div>
    </div>
    <div id="nav_sanpham_popover">
    </div>
</div>
