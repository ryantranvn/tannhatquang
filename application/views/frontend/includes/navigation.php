<div class="navigator fullContainer">
	<div class="centerContainer">

		<a class="logo" href="<?=F_URL?>" title="<?=LINK_TITLE?>">
			<img src="<?=assetsUrl('frontend','images','logo.png');?>" />
		</a>

		<ul class="menu">
			<li<? if ($activeMenu=='home') { ?> class="active"<? } ?>>
				<a href="<?=$links['home']?>"><?=$navigator['home']?></a>
				<span>&#124;</span>
			</li>
			<li<? if ($activeMenu=='service') { ?> class="active"<? } ?>>
				<a href="<?=$links['service']['introduction']?>">
					<?=$navigator['service']?> &nbsp;
					<i class="fa fa-caret-right" aria-hidden="true"></i>
				</a>
				<span>&#124;</span>
				<i class="fa fa-caret-up<? if ($activeMenu=='service') { ?> active<? } ?>" aria-hidden="true"></i>
				<ul class="submenu submenuService<? if ($activeMenu=='service') { ?> active<? } ?><? if ($lang=='en') { ?> submenuService_en<? } ?>">
					<li<? if ($activeSubMenu=='introduction') { ?> class="active"<? } ?>>
						<a href="<?=$links['service']['introduction']?>" class="linkSub">
							<?=$navigatorSub['service']['introduction']?>
						</a>
						<span>&#124;</span>
					</li>
					<li<? if ($activeSubMenu=='service') { ?> class="active"<? } ?>>
						<a href="<?=$links['service']['service']?>" class="linkSub">
							<?=$navigatorSub['service']['service']?>
						</a>
						<span>&#124;</span>
					</li>
					<li<? if ($activeSubMenu=='certification') { ?> class="active"<? } ?>>
						<a href="<?=$links['service']['certification']?>" class="linkSub">
							<?=$navigatorSub['service']['certification']?>
						</a>
					</li>
				</ul>
			</li>
			<li<? if ($activeMenu=='booking') { ?> class="active"<? } ?>>
				<a href="<?=$links['booking']?>">
					<?=$navigator['booking']?>
				</a>
				<span>&#124;</span>
			</li>
			<li<? if ($activeMenu=='gallery') { ?> class="active"<? } ?>>
				<a href="<?=$links['gallery']['beforeafter']?>">
					<?=$navigator['gallery']?> &nbsp;
					<i class="fa fa-caret-right" aria-hidden="true"></i>
				</a>
				<span>&#124;</span>
				<i class="fa fa-caret-up" aria-hidden="true"></i>
				<ul class="submenu submenuGallery<? if ($activeMenu=='gallery') { ?> active<? } ?><? if ($lang=='en') { ?> submenuGallery_en<? } ?>">
					<li<? if ($activeSubMenu=='beforeafter') { ?> class="active"<? } ?>>
						<a href="<?=$links['gallery']['beforeafter']?>" class="linkSub">
							<?=$navigatorSub['gallery']['beforeafter']?>
						</a>
						<span>&#124;</span>
					</li>
					<li<? if ($activeSubMenu=='event') { ?> class="active"<? } ?>>
						<a href="<?=$links['gallery']['event']?>" class="linkSub">
							<?=$navigatorSub['gallery']['event']?>
						</a>
					</li>
				</ul>
			</li>
			<li<? if ($activeMenu=='news') { ?> class="active"<? } ?>>
				<a href="<?=$links['news']?>"><?=$navigator['news']?></a>
				<span>&#124;</span>
			</li>
			<li<? if ($activeMenu=='contact') { ?> class="active"<? } ?>>
				<a href="<?=$links['contact']?>"><?=$navigator['contact']?></a>
			</li>
			<!-- <li class='activeBar'></li> -->
		</ul>

		<div class="hotline">
			<i class="fa fa-phone" aria-hidden="true"></i>
			<span>Hotline: <strong>0903 001 365</strong></span>
		</div>

		<div class="langWrapper">
			<p>
				<? if ($lang == 'vn') { ?>
				<a href="<?=$url['vn']?>"><img src="<?=assetsUrl('frontend','images','icon-vn.png');?>" />Tiếng Việt</a>
				<? } else { ?>
				<a href="<?=$url['en']?>"><img src="<?=assetsUrl('frontend','images','icon-en.png');?>" />English</a>
				<? } ?>
				<i class="fa fa-caret-down" aria-hidden="true"></i>
			</p>
			<ul>
				<li><a class="vn" href="<?=$url['vn']?>"><img src="<?=assetsUrl('frontend','images','icon-vn.png');?>" />Tiếng Việt</a></li>
				<li><a class="en" href="<?=$url['en']?>"><img src="<?=assetsUrl('frontend','images','icon-en.png');?>" />English</a></li>
			</ul>
		</div>
	</div>
</div>