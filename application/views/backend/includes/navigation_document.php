<!-- #NAVIGATION -->
<aside id="left-panel" style="position: fixed">
    <!-- NAVIGATION : This navigation is also responsive-->
    <nav>
        <ul style="margin-top: 20px;">
            <li class="<?php if (isset($activeNav) && $activeNav == 'introduction') { ?>active<? } ?>">
                <a href="<?=B_URL?>document">
                    <i class="fa fa-th-large"></i>
                    Mở đầu
                </a>
            </li>
            <li class="<?php if (isset($activeNav) && $activeNav == 'category') { ?>active<? } ?>">
                <a href="<?=B_URL?>document/category">
                    <i class="fa fa-th-large"></i>
                    Quản lý danh mục
                </a>
            </li>
            <li class="<?php if (isset($activeNav) && $activeNav == 'product') { ?>active<? } ?>">
                <a href="<?=B_URL?>document/product">
                    <i class="fa fa-th-large"></i>
                    Quản lý sản phẩm
                </a>
            </li>
            <li class="<?php if (isset($activeNav) && $activeNav == 'Dashboard') { ?>active<? } ?>">
                <a href="<?=B_URL?>">
                    <i class="fa fa-th-large"></i>
                    Quản lý đơn hàng
                </a>
            </li>
            <li class="<?php if (isset($activeNav) && $activeNav == 'Dashboard') { ?>active<? } ?>">
                <a href="<?=B_URL?>">
                    <i class="fa fa-th-large"></i>
                    Quản lý khách hàng
                </a>
            </li>
            <li class="<?php if (isset($activeNav) && $activeNav == 'Dashboard') { ?>active<? } ?>">
                <a href="<?=B_URL?>">
                    <i class="fa fa-th-large"></i>
                    Quản lý tin tức
                </a>
            </li>
            <li class="<?php if (isset($activeNav) && $activeNav == 'Dashboard') { ?>active<? } ?>">
                <a href="<?=B_URL?>">
                    <i class="fa fa-th-large"></i>
                    Quản lý bảng giá
                </a>
            </li>
        </ul>
    </nav>

    <span class="minifyme" data-action="minifyMenu">
			<i class="fa fa-arrow-circle-left hit"></i>
		</span>
</aside>
<!-- END NAVIGATION -->