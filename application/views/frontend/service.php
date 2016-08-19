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
				<i class="fa fa-angle-right" aria-hidden="true"></i>
				<span><?=$breadcrumb[$page][$subCat]?></span>
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
					<? if ($subCat!='introduction') { ?>
						<div class="item">
							<img src="<?=$gioithieu['thumbnail']?>" />
							<p class="title"><? if ($lang=='vn') { echo $gioithieu['title']; } else { echo $gioithieu['title_en']; }?></p>
							<p class="date"><?=date('d-m-Y', strtotime($gioithieu['created_datetime']))?></p>
						</div>
					<? } ?>

					<? if ($subCat!='service') { ?>
						<div class="item">
							<img src="<?=$dichvu['thumbnail']?>" />
							<p class="title"><? if ($lang=='vn') { echo $dichvu['title']; } else { echo $dichvu['title_en']; }?></p>
							<p class="date"><?=date('d-m-Y', strtotime($dichvu['created_datetime']))?></p>
						</div>
					<? } ?>

					<? if ($subCat!='certification') { ?>
						<div class="item">
							<img src="<?=$chungnhan['thumbnail']?>" />
							<p class="title"><? if ($lang=='vn') { echo $chungnhan['title']; } else { echo $chungnhan['title_en']; }?></p>
							<p class="date"><?=date('d-m-Y', strtotime($chungnhan['created_datetime']))?></p>
						</div>
					<? } ?>
					
					
				<!--
					<? foreach ($dichvu as $item) { ?>
						<div class="item">
							<img src="<?=$item['thumbnail']?>" />
							<p class="title"><? if ($lang=='vn') { echo $item['title']; } else { echo $item['title_en']; }?></p>
							<p class="date"><?=date('d-m-Y', strtotime($item['created_datetime']))?></p>
						</div>
					<? }?>
				-->
				<!--
					<? foreach ($chungnhan as $item) { ?>
						<div class="item">
							<img src="<?=$item['thumbnail']?>" />
							<p class="title"><? if ($lang=='vn') { echo $item['title']; } else { echo $item['title_en']; }?></p>
							<p class="date"><?=date('d-m-Y', strtotime($item['created_datetime']))?></p>
						</div>
					<? }?>
				-->
				<!-- <a class="btnBlue btnXemthem" href="<?=F_URL?>"><?=$textViewMore?></a> -->
				</div>
			</div>
		</div>
	</div>
</div>