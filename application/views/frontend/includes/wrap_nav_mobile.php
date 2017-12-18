<nav role='navigation' class="visible-xs-block">
    <div id="menuToggle">
        <input type="checkbox" />
        <span></span>
        <span></span>
        <span></span>
        <ul id="menu">
            <li<?if (isset($active_nav) && $active_nav=="sanpham") { ?> class="active"<? } ?>>
                <a href="<?=F_URL?>san-pham?cat=sp">Sản phẩm</a>
            </li>
            <li<?if (isset($active_nav) && $active_nav=="gioithieu") { ?> class="active"<? } ?>>
                <a href="<?=F_URL?>gioi-thieu">Giới thiệu</a>
            </li>
            <li<?if (isset($active_nav) && $active_nav=="banggia") { ?> class="active"<? } ?>>
                <a href="<?=F_URL?>bang-gia">Bảng giá</a>
            </li>
            <li<?if (isset($active_nav) && $active_nav=="tintuc") { ?> class="active"<? } ?>>
                <a href="<?=F_URL?>tin-tuc?cat=tt">Tin tức</a>
            </li>
            <li<?if (isset($active_nav) && $active_nav=="lienhe") { ?> class="active"<? } ?>>
                <a href="<?=F_URL?>lien-he">Liên hệ</a>
            </li>
        </ul>
    </div>
</nav>