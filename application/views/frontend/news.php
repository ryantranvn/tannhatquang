<div id="newsPage" class="fullContainer">
<!-- banner -->
	<div class="banner fullContainer">
		<img src="<?=uploadUrl('images','banner/news.jpg');?>" />
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
					<? for ($i=1; $i<20; $i++) { ?>
					<li>
						<div class="item row">
							<p class="title">Tin tức 1</p>
							<p class="date">13/05/2016</p>
							<p>--</p>
							<div class="small-24 medium-9 large-9 columns noPaddingLeft">
								<img src="<?=uploadUrl('images','news/news1.jpg');?>" />
							</div>
							<div class="small-24 medium-15 large-15 columns noPaddingRight">
								<div class="desc">Ngày 12/5/2016, Vietnam Star Automobile chính thức khai trương Trung tâm đồng sơn quy mô và hiện đại nhất Việt Nam chuyên thực hiện các dịch vụ đồng sơn cho xe sang. Toạ lạc ở vị trí vô cùng thuận lợi, số 2&3, đường số 7, khu chế xuất Tân Thuận, phường Tân Thuận Đông, quận 7, TP. HCM,...</div>
								<a class="linkXemthem" href="<?=$links['newsDetail']?>">
									<i class="fa fa-angle-double-right" aria-hidden="true"></i>Xem thêm
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
					<p class="titleBox">TIN TỨC LIÊN QUAN<span>--</span></p>
					
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
					<a class="btnBlue btnXemthem" href="<?=F_URL?>">Xem thêm</a>
				</div>
			</div>
		</div>
	</div>
</div>

<link rel="stylesheet" type="text/css" href="<?=libsUrl('jPages','css','jPages.css') ?>" />
<script language="javascript" type="text/javascript" src="<?=libsUrl('jPages','js','jPages.min.js')?>"></script>

