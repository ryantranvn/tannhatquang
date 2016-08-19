<div id="servicePage" class="fullContainer">
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
			<div class="left small-24 medium-16 large-16 columns">
				<i class="fa fa-home" aria-hidden="true"></i>
				<i class="fa fa-angle-right" aria-hidden="true"></i>
				<span><?=$breadcrumb[$page]['root']?></span>
				<!-- <i class="fa fa-angle-right" aria-hidden="true"></i> -->
				<!-- <span><?=$breadcrumb[$page][$subCat]?></span> -->
			</div>
			<div class="right small-0 medium-8 large-8 columns">&nbsp;</div>
		</div>
	</div>
<!-- content -->
	<div class="contentContainer fullContainer">
		<div class="centerContainer">
		<!-- left -->
			<div class="left small-24 medium-16 large-16 columns">
				<p class="title"><? if ($lang=='vn') { echo $detail['title']; } else { echo $detail['title_en']; }?></p>
				<p class="date"><?=date('d-m-Y', strtotime($detail['created_datetime']))?></p>
				<p>--</p>
				<div class="contentPost">
					<? if ($lang=='vn') { echo $detail['content']; } else { echo $detail['content_en']; }?>
				</div>
			</div>
		<!-- right -->
			<div class="right small-24 medium-8 large-8 columns">
				<div class="box">
					<p class="titleBox"><?=$textNews['related']?><span>--</span></p>
					
					<div class="item">
						<img src="<?=uploadUrl('images','temp/1.jpg');?>" />
						<p class="title">Tin tức liên quan 01</p>
						<p class="date">13/05/2016</p>
					</div>
					<div class="item">
						<img src="<?=uploadUrl('images','temp/2.jpg');?>" />
						<p class="title">Tin tức liên quan 1</p>
						<p class="date">13/05/2016</p>
					</div>
					<div class="item">
						<img src="<?=uploadUrl('images','temp/3.jpg');?>" />
						<p class="title">Tin tức liên quan 01</p>
						<p class="date">13/05/2016</p>
					</div>
					<div class="item">
						<img src="<?=uploadUrl('images','temp/4.jpg');?>" />
						<p class="title">Tin tức liên quan 01</p>
						<p class="date">13/05/2016</p>
					</div>
					<a class="btnBlue btnXemthem" href="<?=F_URL?>"><?=$textViewMore?></a>
				</div>
			</div>
		</div>
	</div>
</div>