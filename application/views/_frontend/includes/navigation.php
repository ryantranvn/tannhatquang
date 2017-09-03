<div id="navigatorContainer" class="fullContainer">
	<div class="centerContainer">
		<div class="row">
			<a class="linkLogo float-left show-for-medium" href="<?=F_URL?>"><img src="<?=assetsUrl('frontend','images','logo.png');?>" /></a>
			<!-- <a class="linkLogo show-for-small-only" href="<?=F_URL?>"><img src="<?=assetsUrl('frontend','images','logo-mobile.png');?>" /></a> -->
			<form id="frmSearch" class="float-right">
				<input name="searchValue" placeholder="Tìm kiếm sản phẩm" />
				<button><i class="fa fa-search"></i></button>
			</form>
		</div>
		<div id="navigator" class="row">
			<!-- nav Sanpham -->
			<div id="navSanPham" class="float-left">
				<a>Sản phẩm <i class="fa fa-caret-down"></i></a>
			</div>
			<!-- nav -->
			<div id="nav" class="float-right">
				<ul>
					<li<? if ($activeNav=="gioithieu") { ?> class="activeNav"<? } ?>>
						<a href="<?=F_URL?>gioi-thieu">Giới thiệu</a>
					</li>
					<li<? if ($activeNav=="banggia") { ?> class="activeNav"<? } ?>>
						<a href="<?=F_URL?>bang-gia">Bảng giá</a>
					</li>
					<li<? if ($activeNav=="tintuc") { ?> class="activeNav"<? } ?>>
						<a href="<?=F_URL?>tin-tuc">Tin tức</a>
					</li>
					<li<? if ($activeNav=="lienhe") { ?> class="activeNav"<? } ?>>
						<a href="<?=F_URL?>lien-he">Liên hệ</a>
					</li>
				</ul>
			</div>
			<!-- auth -->
			<div id="authWrapper">
				<i class="fa fa-user"></i>
				<span>Đăng nhập</span>
				<span>Tài khoản và đơn hàng</span>
				<ul id="authBox" class="arrow_box">
					<li class="signin">
						<a href="">Đăng nhập</a>
					</li>
					<li class="signup">
						<a href="">Tạo tài khoản</a>
					</li>
				</ul>
			</div>
			<!-- cart icon -->
			<div id="cart">
				Giỏ hàng
				<span id="cartNumber">10</span>
				<a class="linkFull" href="<?=F_URL?>"></a>
				<!-- gio-hang -->
			</div>
			<div id="mobileMenuButton">
			</div>
		</div>
	</div>
</div>
