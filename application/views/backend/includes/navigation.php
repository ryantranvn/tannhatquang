<!-- #NAVIGATION -->
	<!-- Left panel : Navigation area -->
	<!-- Note: This width of the aside area can be adjusted through LESS variables -->
	<aside id="left-panel">

		<!-- User info -->
		<div class="login-info">
			<span> <!-- User image size is adjusted inside CSS, it should stay as it -->
				<a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
					<i class="fa fa-user" style="font-size: 20px; margin-top: 3px;"></i>
					<span style="padding-left: 10px; line-height: 18px;"><?=$authMember['username']?></span>
				</a>
			</span>
		</div>
		<!-- end user info -->

		<!-- NAVIGATION : This navigation is also responsive-->
		<nav>
			<ul>
			<!-- Dashboard - default show -->
				<li class="<?php if (isset($activeNav) && $activeNav == 'Dashboard') { ?>active<? } ?>">
					<a href="<?=B_URL.$modules['Dashboard']['url']?>">
						<i class="<?=$modules['Dashboard']['icon']?>"></i>
						<?/*=$modules['Dashboard']['name']*/?>
                        Trang chủ
					</a>
				</li>
			<!-- Product -->
			<? if ((isset($permissionsMember['Product_category']) && $permissionsMember['Product_category'][1] == 1)
			|| (isset($permissionsMember['Product']) && $permissionsMember['Product'][1] == 1)) { ?>
				<li class="<?php if (isset($activeNav) && ($activeNav == 'Product_category' || $activeNav == 'Product')) { ?>active<? } ?>">
					<a href="#">
						<i class="fa fa-th-large"></i>
						<span class="menu-item-parent">Sản phẩm</span>
					</a>
					<ul>
					<? if (isset($permissionsMember['Product_category']) && $permissionsMember['Product_category'][1] == 1) { ?>
						<li><a href="<?=B_URL.$modules['Product_category']['url']?>">Phân loại sản phẩm</a></li>
					<? } ?>
					<? if (isset($permissionsMember['Product']) && $permissionsMember['Product'][1] == 1) { ?>
						<li><a href="<?=B_URL.$modules['Product']['url']?>">Sản phẩm</a></li>
					<? } ?>
					</ul>
				</li>
			<? } ?>
			<!-- News -->
                <? if (isset($permissionsMember['News']) && $permissionsMember['News'][1] == 1) { ?>
                <li class="<?php if (isset($activeNav) && $activeNav == 'News') { ?>active<? } ?>">
                    <a href="<?=B_URL.$modules['News']['url']?>">
                        <i class="fa fa-th-large"></i>
                        <span class="menu-item-parent">Tin tức</span>
                    </a>
                </li>
                <? }?>
			<?/* if ((isset($permissionsMember['News_category']) && $permissionsMember['News_category'][1] == 1)
			|| (isset($permissionsMember['News']) && $permissionsMember['News'][1] == 1)) { ?>
				<li class="<?php if (isset($activeNav) && ($activeNav == 'News_category' || $activeNav == 'News')) { ?>active<? } ?>">
					<a href="#">
						<i class="fa fa-th-large"></i>
						<span class="menu-item-parent">Tin tức</span>
					</a>
					<ul>
					<? if (isset($permissionsMember['News_category']) && $permissionsMember['News_category'][1] == 1) { ?>
						<li><a href="<?=B_URL.$modules['News_category']['url']?>">Phân loại tin tức</a></li>
					<? } ?>
					<? if (isset($permissionsMember['News']) && $permissionsMember['News'][1] == 1) { ?>
						<li><a href="<?=B_URL.$modules['News']['url']?>">Tin tức</a></li>
					<? } ?>
					</ul>
				</li>
			<? } */?>

            <!-- Order -->
            <? if ($permissionsMember['Order'][1] == 1) { ?>
                <li class="<?php if (isset($activeNav) && $activeNav == 'Order') { ?>active<? } ?>">
                    <a href="<?=B_URL.$modules['Order']['url']?>">
                        <i class="<?=$modules['Order']['icon']?>"></i>
                        <?/*=$modules['Order']['name']*/?>
                        Đơn hàng
                    </a>
                </li>
            <? } ?>

			<!-- Customer -->
			<? if ($permissionsMember['Customer'][1] == 1) { ?>
				<li class="<?php if (isset($activeNav) && $activeNav == 'Customer') { ?>active<? } ?>">
					<a href="<?=B_URL.$modules['Customer']['url']?>">
						<i class="<?=$modules['Customer']['icon']?>"></i>
                        Khách hàng
					</a>
				</li>
			<? } ?>
            <!-- Price List -->
            <? if ($permissionsMember['Price_list'][1] == 1) { ?>
                <li class="<?php if (isset($activeNav) && $activeNav == 'Price_list') { ?>active<? } ?>">
                    <a href="<?=B_URL.$modules['Price_list']['url']?>">
                        <i class="<?=$modules['Price_list']['icon']?>"></i>
                        Bảng giá
                    </a>
                </li>
            <? } ?>
            <?php /*
			<!-- Setting -->
			<? if ($permissionsMember['Setting'][1] == 1) { ?>
				<li class="moduleSystem <?php if (isset($activeNav) && $activeNav == 'Setting') { ?>active<? } ?>">
					<a href="<?=B_URL.$modules['Setting']['url']?>">
						<i class="<?=$modules['Setting']['icon']?>"></i>
						<?=$modules['Setting']['name']?>
					</a>
				</li>
			<? } ?>
			<!-- Member -->
			<? if ($permissionsMember['Member'][1] == 1) { ?>
				<li class="moduleSystem <?php if (isset($activeNav) && $activeNav == 'Member') { ?>active<? } ?>">
					<a href="<?=B_URL.$modules['Member']['url']?>">
						<i class="<?=$modules['Member']['icon']?>"></i>
						<?=$modules['Member']['name']?>
					</a>
				</li>
			<? } ?>
			<!-- Module -->
			<? if ($permissionsMember['Module'][1] == 1) { ?>
				<li class="moduleSystem <?php if (isset($activeNav) && $activeNav == 'Module') { ?>active<? } ?>">
					<a href="<?=B_URL.$modules['Module']['url']?>">
						<i class="<?=$modules['Module']['icon']?>"></i>
						<?=$modules['Module']['name']?>
					</a>
				</li>
			<? } ?>
			<!-- Category -->
			<? if ($permissionsMember['Category'][1] == 1) { ?>
				<li class="moduleSystem <?php if (isset($activeNav) && $activeNav == 'Category') { ?>active<? } ?>">
					<a href="<?=B_URL.$modules['Category']['url']?>">
						<i class="<?=$modules['Category']['icon']?>"></i>
						<?=$modules['Category']['name']?>
					</a>
				</li>
			<? } ?>
                */ ?>
			</ul>
		</nav>
		<span class="minifyme" data-action="minifyMenu">
			<i class="fa fa-arrow-circle-left hit"></i>
		</span>
	</aside>
<!-- END NAVIGATION -->
