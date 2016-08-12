<div id="homePage" class="fullContainer">
<!-- banner -->
	<div class="banner fullContainer">
		<ul class="bxslider-1">
			<? if ($lang=='vn') {
				foreach ($bannerPos1_VN as $banner) { ?>
					<li><img src="<?=$banner?>" /></li>
				<? }
			} else { 
				foreach ($bannerPos1_EN as $banner) { ?>
					<li><img src="<?=$banner?>" /></li>
				<? }
			} ?>
		  	<!-- <li><img src="<?=uploadUrl('images','banner/position-1/1.jpg');?>" /></li>
		  	<li><img src="<?=uploadUrl('images','banner/position-1/2.jpg');?>" /></li>
		  	<li><img src="<?=uploadUrl('images','banner/position-1/3.jpg');?>" /></li>
		  	<li><img src="<?=uploadUrl('images','banner/position-1/4.jpg');?>" /></li>
		  	<li><img src="<?=uploadUrl('images','banner/position-1/5.jpg');?>" /></li> -->
		</ul>
	</div>
<!-- service -->
	<div class="service fullContainer">
		<div class="centerContainer">
			<p class="title"><?=$textHome['service']['title']?> <span></span></p>

			<div class="row">
				<div class="small-24 medium-8 large-4 columns">
					<img src="<?=assetsUrl('frontend','images','service/service-1.jpg');?>" />
					<p class="caption"><?=$textHome['service'][0]?></p>
				</div>
				<div class="small-24 medium-8 large-4 columns">
					<img src="<?=assetsUrl('frontend','images','service/service-2.jpg');?>" />
					<p class="caption"><?=$textHome['service'][1]?></p>

				</div>
				<div class="small-24 medium-8 large-4 columns">
					<img src="<?=assetsUrl('frontend','images','service/service-3.jpg');?>" />
					<p class="caption"><?=$textHome['service'][2]?></p>
				</div>
				<div class="small-24 medium-8 large-4 columns">
					<img src="<?=assetsUrl('frontend','images','service/service-4.jpg');?>" />
					<p class="caption"><?=$textHome['service'][3]?></p>
				</div>
				<div class="small-24 medium-8 large-4 columns">
					<img src="<?=assetsUrl('frontend','images','service/service-5.jpg');?>" />
					<p class="caption"><?=$textHome['service'][4]?></p>
				</div>
				<div class="small-24 medium-8 large-4 columns">
					<img src="<?=assetsUrl('frontend','images','service/service-6.jpg');?>" />
					<p class="caption"><?=$textHome['service'][5]?></p>
				</div>
			</div>
		</div>
		<div class="row">
			<a class="btnBlue btnTimhieuthem" href="<?=F_URL?>"><?=$textMore?></a>
		</div>
	</div>
<!-- banner 2 -->
	<div class="banner banner-2 fullContainer">
		<ul class="bxslider-2">
			<? if ($lang=='vn') {
				foreach ($bannerPos2_VN as $banner) { ?>
					<li><img src="<?=$banner?>" /></li>
				<? }
			} else { 
				foreach ($bannerPos2_EN as $banner) { ?>
					<li><img src="<?=$banner?>" /></li>
				<? }
			} ?>
		  	<!-- <li><img src="<?=uploadUrl('images','banner/position-2/1.jpg');?>" /></li>
		  	<li><img src="<?=uploadUrl('images','banner/position-2/2.jpg');?>" /></li>
		  	<li><img src="<?=uploadUrl('images','banner/position-2/3.jpg');?>" /></li>
		  	<li><img src="<?=uploadUrl('images','banner/position-2/4.jpg');?>" /></li> -->
		</ul>
	</div>
<!-- certification -->
	<div class="certification fullContainer">
		<div class="left small-0 medium-12 large-10 columns">
			<img src="<?=assetsUrl('frontend','images','certification/1.jpg');?>" />
		</div>
		<div class="right small-24 medium-12 large-14 columns">
			<div class="wrapper">
				<p class="title"><?=$textHome['certification']['title']?></p>
				<div class="row">
					<div class="small-24 medium-12 large-12 columns">
						<div class="iconWrapper">
							<img src="<?=assetsUrl('frontend','images','certification/icon-1.png');?>" />
							<span class="itemTitle" style="left: 70px;"><?=$textHome['certification'][0]['title']?></span>
						</div>
						<p class="itemDesc"><?=$textHome['certification'][0]['desc']?></p>
						<p class="itemMore">&#187;&nbsp;<a href="<?=F_URL?>"><?=$textMore?></a></p>
					</div>
					<div class="small-24 medium-12 large-12 columns">
						<div class="iconWrapper">
							<img src="<?=assetsUrl('frontend','images','certification/icon-2.png');?>" />
							<span class="itemTitle" style="left: 90px;"><?=$textHome['certification'][1]['title']?></span>
						</div>
						<p class="itemDesc"><?=$textHome['certification'][1]['desc']?></p>
						<p class="itemMore">&#187;&nbsp;<a href="<?=F_URL?>"><?=$textMore?></a></p>
					</div>
				</div>
				<div class="row">
					<div class="small-24 medium-12 large-12 columns">
						<div class="iconWrapper">
							<img src="<?=assetsUrl('frontend','images','certification/icon-3.png');?>" />
							<span class="itemTitle" style="left: 70px;"><?=$textHome['certification'][2]['title']?></span>
						</div>
						<p class="itemDesc"><?=$textHome['certification'][2]['desc']?></p>
						<p class="itemMore">&#187;&nbsp;<a href="<?=F_URL?>"><?=$textMore?></a></p>
					</div>
					<div class="small-24 medium-12 large-12 columns">
						<div class="iconWrapper">
							<img src="<?=assetsUrl('frontend','images','certification/icon-4.png');?>" />
							<span class="itemTitle" style="left: 80px;"><?=$textHome['certification'][3]['title']?></span>
						</div>
						<p class="itemDesc"><?=$textHome['certification'][3]['desc']?></p>
						<p class="itemMore">&#187;&nbsp;<a href="<?=F_URL?>"><?=$textMore?></a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- gallery -->
	<div class="gallery fullContainer">
		<div class="centerContainer">
			<p class="title"><?=$textHome['gallery']['title']?><span></span></p>
			<p calss="desc"><?=$textHome['gallery']['desc']?></p>
			<div class="gallerySlide">
				<ul class="bxslider-3">
					<li>
						<div class="row">
							<div class="small-24 medium-12 large-12 columns">
								<div class="imgWrapper small-12 medium-12 large-12 columns">
									<img src="<?=uploadUrl('images','gallery/before/1.jpg');?>" />
									<div class="caption">BAN ĐẦU</div>
								</div>
								<div class="imgWrapper small-12 medium-12 large-12 columns">
									<img src="<?=uploadUrl('images','gallery/after/1.jpg');?>" />
									<div class="caption">LÚC SAU</div>
								</div>
								<p class="infoCar"><strong>Thông tin xe:</strong> Mercedes GLS</p>
								<p class="infoCar"><strong>Dịch vụ:</strong> Chỉnh móp đầu xe, khôi phục vết xước sơn xe.</p>
							</div>
							<div class="small-24 medium-12 large-12 columns">
								<div class="imgWrapper small-12 medium-12 large-12 columns">
									<img src="<?=uploadUrl('images','gallery/before/2.jpg');?>" />
									<div class="caption">BAN ĐẦU</div>
								</div>
								<div class="imgWrapper small-12 medium-12 large-12 columns">
									<img src="<?=uploadUrl('images','gallery/after/2.jpg');?>" />
									<div class="caption">LÚC SAU</div>
								</div>
								<p class="infoCar"><strong>Thông tin xe:</strong> Mercedes GLS</p>
								<p class="infoCar"><strong>Dịch vụ:</strong> Chỉnh móp đầu xe, khôi phục vết xước sơn xe.</p>
							</div>
						</div>
					</li>
					<li>
						<div class="row">
							<div class="small-24 medium-12 large-12 columns">
								<div class="imgWrapper small-12 medium-12 large-12 columns">
									<img src="<?=uploadUrl('images','gallery/before/1.jpg');?>" />
									<div class="caption">BAN ĐẦU</div>
								</div>
								<div class="imgWrapper small-12 medium-12 large-12 columns">
									<img src="<?=uploadUrl('images','gallery/after/1.jpg');?>" />
									<div class="caption">LÚC SAU</div>
								</div>
								<p class="infoCar"><strong>Thông tin xe:</strong> Mercedes GLS</p>
								<p class="infoCar"><strong>Dịch vụ:</strong> Chỉnh móp đầu xe, khôi phục vết xước sơn xe.</p>
							</div>
							<div class="small-24 medium-12 large-12 columns">
								<div class="imgWrapper small-12 medium-12 large-12 columns">
									<img src="<?=uploadUrl('images','gallery/before/2.jpg');?>" />
									<div class="caption">BAN ĐẦU</div>
								</div>
								<div class="imgWrapper small-12 medium-12 large-12 columns">
									<img src="<?=uploadUrl('images','gallery/after/2.jpg');?>" />
									<div class="caption">LÚC SAU</div>
								</div>
								<p class="infoCar"><strong>Thông tin xe:</strong> Mercedes GLS</p>
								<p class="infoCar"><strong>Dịch vụ:</strong> Chỉnh móp đầu xe, khôi phục vết xước sơn xe.</p>
							</div>
						</div>
					</li>
				</ul>
				<div class="outside">
				  	<div id="slider-prev"></div>
				  	<div id="slider-next"></div>
				</div>
				<div class="row">
					<a class="btnBlue btnXemthem" href="<?=F_URL?>"><?=$textMore?></a>
				</div>
			</div>
		</div>
	</div>
<!-- contact -->
	<div class="contact fullContainer">
		<div class="centerContainer">
			<div class="row">
				<div class="left small-24 medium-12 large-12 columns">
					<img src="<?=assetsUrl('frontend','images','icon-contact.png');?>" />
					<p class="title"><?=$textHome['contact']['title']?></p>
					<p><?=$textHome['contact']['name']?></p>
					<p>-</p>
					<p><?=$textHome['contact']['address']?></p>
					<p>Tel: (84 8) 3770 8030 – Fax: (84 8) 3770 8031</p>
					<p><strong>Hotline: 0903 001 365</strong></p>
					<div class="row">
						<a class="btnBlue btnLienhe" href="<?=$links['contact']?>"><?=$textHome['contact']['button']?></a>
					</div>
				</div>
				<div class="right small-24 medium-12 large-12 columns">
					<div class="mapWrapper">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3747.0835764407784!2d106.73372612012926!3d10.752391559639582!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317525851fd7fb97%3A0x8cfcad0c4836a621!2sVietnam+Star+Body+%26+Paint!5e0!3m2!1sen!2s!4v1469592378812" width="100%" height="100%" frameborder="0" style="border: 0;" allowfullscreen></iframe>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>