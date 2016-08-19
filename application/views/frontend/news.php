<div id="newsPage" class="fullContainer">
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
				<!-- <i class="fa fa-angle-right" aria-hidden="true"></i>
				<span>Khuyến mãi</span> -->
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
				<ul id="itemContainer">
					<? foreach ($tintuc as $item) { ?>
					<li>
						<div class="item row">
							<p class="title"><? if ($lang=='vn') { echo $item['title']; } else { echo $item['title_en']; }?></p>
							<p class="date"><?=date('d-m-Y', strtotime($item['created_datetime']))?></p>
							<p>--</p>
							<div class="small-24 medium-9 large-9 columns noPaddingLeft">
								<img src="<?=$item['thumbnail']?>" />
							</div>
							<div class="small-24 medium-15 large-15 columns noPaddingRight">
								<div class="desc"><? if ($lang=='vn') { echo $item['desc']; } else { echo $item['desc_en']; }?></div>
								<a class="linkXemthem" href="<?=$links['news']?>/<? if ($lang=='vn') { echo $item['url']; } else { echo $item['url_en']; }?>">
									<i class="fa fa-angle-double-right" aria-hidden="true"></i><?=$textViewMore?>
								</a>
							</div>
						</div>
					</li>
					<? } ?>
				</ul>
				<div class="holderWrapper row">
					<div class="holder"></div>
					<div class="customBtns">
				      <span class="arrowPrev"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
				      <span class="arrowNext"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
				    </div>
				</div>
			</div>
		<!-- right -->
			<div class="right small-24 medium-8 large-8 columns">
				<div class="box">
					<p class="titleBox"><?=$textNews['related']?><span>--</span></p>
					
					<? for ($i=count($tintuc)-1; $i>=0; $i--) { ?>
						<div class="item">
							<img src="<?=$tintuc[$i]['thumbnail']?>" />
							<p class="title"><? if ($lang=='vn') { echo $tintuc[$i]['title']; } else { echo $tintuc[$i]['title_en']; }?></p>
							<p class="date"><?=date('d-m-Y', strtotime($tintuc[$i]['created_datetime']))?></p>
						</div>
					<? } ?>
				<!-- 
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
				-->
				</div>
			</div>
		</div>
	</div>
</div>

<link rel="stylesheet" type="text/css" href="<?=libsUrl('jPages','css','jPages.css') ?>" />
<script language="javascript" type="text/javascript" src="<?=libsUrl('jPages','js','jPages.min.js')?>"></script>

