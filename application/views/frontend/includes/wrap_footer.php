<div id="wrap_footer" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col col-sm-6 text_left">
                <a class="link_logo" href="<?=F_URL?>">
                    <img src="<?=ASSETS_URL?>frontend/images/logo.png" />
                </a>
                <ul class="nav navbar-nav hidden-xs">
                    <li<?if (isset($nav_active) && $nav_active=="gioithieu") { ?> class="active"<? } ?>>
                        <a href="<?=F_URL?>gioi-thieu">Giới thiệu</a>
                    </li>
                    <li<?if (isset($nav_active) && $nav_active=="banggia") { ?> class="active"<? } ?>>
                        <a href="<?=F_URL?>bang-gia">Bảng giá</a>
                    </li>
                    <li<?if (isset($nav_active) && $nav_active=="tintuc") { ?> class="active"<? } ?>>
                        <a href="<?=F_URL?>tin-tuc?cat=tt">Tin tức</a>
                    </li>
                    <li<?if (isset($nav_active) && $nav_active=="lienhe") { ?> class="active"<? } ?>>
                        <a href="<?=F_URL?>lien-he">Liên hệ</a>
                    </li>
                </ul>
            </div>
            <div class="col col-sm-6 text_right">
                <p class="company_name">Công Ty TNHH TM NHẬT QUANG</p>
    			<p class="company_address">
                    12 Hoàng Diệu, Phường 2, Tp Cà Mau, Việt Nam<br/>
    			    Phone : +84 7803 515 555 | +84 7806 515 555</br/>
                    Fax : +84 7806 251 022</br/>
                    Email : dntntannhatquang@gmail.com
                </p>
            </div>
        </div>
    </div>
</div>
