<div id="<?=$page?>Page" class="fullContainer">
<!-- banner -->
	<div class="banner fullContainer">
		<? if ($lang=='vn') { ?>
			<img src="<?=$banner['url']?>" />
		<? } else { ?>
			<img src="<?=$banner['url_en']?>" />
		<? } ?>
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
					<a href="<?=$links['gallery']['beforeafter']?>"><?=$textGallery['tabBeforeAfter']?></a>
				</div>
				<div class="tabItem<? if ($activeSubMenu=='event') { ?> active<? } ?>">
					<a href="<?=$links['gallery']['event']?>"><?=$textGallery['tabEvent']?></a>
				</div>
			</div>
		</div>
	</div>

<!-- tab content -->
	<div class="tabContent fullContainer">
		<? if ($activeSubMenu=='beforeafter') { ?> 
		<div class="tabContentItem active">
			<div class="centerContainer">
				<? foreach ($gallery as $item) { ?>
					<div class="item small-24 medium-12 large-12 columns">
						<div class="imgWrapper small-12 medium-12 large-12 columns noPadding">
							<a href="<?=$item['detail'][0]['value']?>" data-lightbox="left-<?=$item['id']?>" data-title="<?=$item['title']?>">
								<img src="<?=$item['detail'][0]['value']?>" />
							</a>
							<div class="caption"><?=$textGallery['textBefore']?></div>
						</div>
						<div class="imgWrapper small-12 medium-12 large-12 columns noPadding">
							<a href="<?=$item['detail'][1]['value']?>" data-lightbox="left-<?=$item['id']?>" data-title="<?=$item['title']?>">
								<img src="<?=$item['detail'][1]['value']?>" />
							</a>
							<div class="caption"><?=$textGallery['textAfter']?></div>
						</div>
						<p class="infoCar"><strong><?=$textGallery['textInfo']?>:</strong> <?=$item['title']?></p>
						<p class="infoCar"><strong><?=$textGallery['textService']?>:</strong> <?=$item['desc']?></p>
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
							Album <i class="fa fa-angle-right" aria-hidden="true"></i>
						</div>
						<div class="subtabItem">
							Video <i class="fa fa-angle-right" aria-hidden="true"></i>
						</div>
					</div>
				</div>
				<div class="subtabContent small-24 medium-18 large-18 columns">
					<div class="subtabContentItem active">
						<? if (count($gallery['album'])>0) {
							foreach ($gallery['album'] as $item) { ?>
								<div class="item small-24 medium-8 large-8 columns">
									<img src="<?=$item['detail'][0]['value']?>" />
									<p class="title"><?=$item['title']?></p>
									<a data-id="<?=$item['id']?>" href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <?=$textViewMore?></a>
								</div>
							<? }
						} ?>
						<div class="imageGallery">
							<div class="imageGalleryClose"><i class="fa fa-times-circle-o" aria-hidden="true"></i></div>
							<div class="imageGalleryContent"></div>
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