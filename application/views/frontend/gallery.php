<div id="<?=$page?>Page" class="fullContainer">
<!-- banner -->
	<div class="banner fullContainer">
		<img src="<?=uploadUrl('images','banner/gallery.jpg');?>" />
	</div>

<!-- breadcrumb -->
	<div class="breadcrumb fullContainer">
		<div class="centerContainer">
			<div class="left small-24 medium-24 large-24 columns">
				<i class="fa fa-home" aria-hidden="true"></i>
				<i class="fa fa-angle-right" aria-hidden="true"></i>
				<span><?=$breadcrumb[$page]['root']?></span>
				<i class="fa fa-angle-right" aria-hidden="true"></i>
				<span><?=$breadcrumb[$page][$subCat]?></span>
			</div>
			<div class="right small-0 medium-8 large-8 columns">&nbsp;</div>
		</div>
	</div>

<!-- tab -->
	<div class="fullContainer">
		<div class="centerContainer">
			<div class="tab">
				<div class="tabItem<? if ($activeSubMenu=='beforeafter') { ?> active<? } ?>">
					<a href="<?=$links['gallery']['beforeafter']?>">Xe trước & sau dịch vụ</a>
				</div>
				<div class="tabItem<? if ($activeSubMenu=='event') { ?> active<? } ?>">
					<a href="<?=$links['gallery']['event']?>">Sự kiện khác</a>
				</div>
			</div>
		</div>
	</div>

<!-- tab content -->
	<div class="tabContent fullContainer">
		<? if ($activeSubMenu=='beforeafter') { ?> 
		<div class="tabContentItem active">
			<div class="centerContainer">
				<? for ($i=1; $i<4; $i++) { ?>
				<div class="item small-24 medium-12 large-12 columns">
					<div class="imgWrapper small-12 medium-12 large-12 columns noPadding">
						<a href="<?=uploadUrl('images','gallery/before/1.jpg');?>" data-lightbox="left-<?=$i?>" data-title="Mercedes GLS">
							<img src="<?=uploadUrl('images','gallery/before/1.jpg');?>" />
						</a>
						<div class="caption">BAN ĐẦU</div>
					</div>
					<div class="imgWrapper small-12 medium-12 large-12 columns noPadding">
						<a href="<?=uploadUrl('images','gallery/after/1.jpg');?>" data-lightbox="left-<?=$i?>" data-title="Mercedes GLS">
							<img src="<?=uploadUrl('images','gallery/after/1.jpg');?>" />
						</a>
						<div class="caption">LÚC SAU</div>
					</div>
					<p class="infoCar"><strong>Thông tin xe:</strong> Mercedes GLS</p>
					<p class="infoCar"><strong>Dịch vụ:</strong> Chỉnh móp đầu xe, khôi phục vết xước sơn xe.</p>
				</div>
				<div class="item small-24 medium-12 large-12 columns">
					<div class="imgWrapper small-12 medium-12 large-12 columns noPadding">
						<a href="<?=uploadUrl('images','gallery/before/2.jpg');?>" data-lightbox="right-<?=$i?>" data-title="Mercedes GLS">
							<img src="<?=uploadUrl('images','gallery/before/2.jpg');?>" />
						</a>
						<div class="caption">BAN ĐẦU</div>
					</div>
					<div class="imgWrapper small-12 medium-12 large-12 columns noPadding">
						<a href="<?=uploadUrl('images','gallery/after/2.jpg');?>" data-lightbox="right-<?=$i?>" data-title="Mercedes GLS">
							<img src="<?=uploadUrl('images','gallery/after/2.jpg');?>" />
						</a>
						<div class="caption">LÚC SAU</div>
					</div>
					<p class="infoCar"><strong>Thông tin xe:</strong> Mercedes GLS</p>
					<p class="infoCar"><strong>Dịch vụ:</strong> Chỉnh móp đầu xe, khôi phục vết xước sơn xe.</p>
				</div>
				<? } ?>
			</div>
		</div>
		<? } ?>
		<? if ($activeSubMenu=='event') { ?>
		<div class="tabContentItem active">
			<div class="centerContainer">
				<div class="small-24 medium-6 large-6 columns">
					<div class="subtab">
						<div class="subtabItem active">
							Album ảnh <i class="fa fa-angle-right" aria-hidden="true"></i>
						</div>
						<div class="subtabItem">
							Video <i class="fa fa-angle-right" aria-hidden="true"></i>
						</div>
					</div>
				</div>
				<div class="subtabContent small-24 medium-18 large-18 columns">
					<div class="subtabContentItem active">
						<? for ($i=1; $i<10; $i++) { ?>
						<div class="item small-24 medium-8 large-8 columns">
							<img src="<?=uploadUrl('images','gallery/event/'.$i.'.jpg');?>" />
							<p class="title">Vietnam Star Mercedes 2016</p>
							<a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Xem thêm</a>
						</div>
						<? } ?>
						<div class="imageGallery">
							<div class="imageGalleryClose"><i class="fa fa-times-circle-o" aria-hidden="true"></i></div>
							<div class="imageGalleryContent">
								<? for ($i=1; $i<10; $i++) { ?>
								<a href="<?=uploadUrl('images','gallery/event/'.$i.'.jpg');?>" data-ngthumb="<?=uploadUrl('images','gallery/event/'.$i.'.jpg');?>" data-ngdesc="title"></a>
								<? } ?>
							</div>
						</div>
					</div>
					<div class="subtabContentItem">
						video
					</div>
				</div>
			</div>
		</div>
		<? } ?>
	</div>
</div>