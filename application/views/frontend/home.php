<div id="homePage" class="fullContainer">
<!-- banner -->
	<div class="banner fullContainer">
		<ul class="bxslider-1">
			<? foreach ($bannerPos1 as $banner) { ?>
				<li> 
					<? if ($banner['link'] != "") { ?>
					<a href="<?=$banner['link']?>"><img src="<?=$banner['url']?>" /></a>
					<? } else { ?>
					<img src="<?=$banner['url']?>" />
					<? } ?>
				</li>
			<? } ?>
		</ul>
	</div>
<!-- service -->
	<div class="service fullContainer">
		<div class="centerContainer">
			<p class="title"><?=$textHome['service']['title']?> <span></span></p>
			<div class="row">
				<? foreach ($service as $item) { ?>
					<div class="small-24 medium-8 large-4 columns">
						<img src="<?=$item['thumbnail']?>" />
						<p class="caption"><? if ($lang=="vn") { echo $item['title']; } else { echo $item['title_en']; } ?></p>
						<!-- <a class="linkFull" href="<? if ($lang=="vn") { echo $links['service']['service'].'/'.$item['url']; } else { echo $links['service']['service'].'/'.$item['url_en']; } ?>"></a> -->
						<a class="linkFull" href="<?=$links['service']['service']?>"></a>
					</div>
				<? } ?>
			<!--
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
			-->
			</div>
		</div>
		<div class="row">
			<a class="btnBlue btnTimhieuthem" href="<?=$links['service']['service']?>"><?=$textMore?></a>
		</div>
	</div>
<!-- banner 2 -->
	<div class="banner banner-2 fullContainer">
		<ul class="bxslider-2">
			<? foreach ($bannerPos2 as $banner) { ?>
				<li>
					<? if ($banner['link'] != "") { ?>
					<a href="<?=$banner['link']?>"><img src="<?=$banner['url']?>" /></a>
					<? } else { ?>
					<img src="<?=$banner['url']?>" />
					<? } ?>
				</li>
			<? } ?>
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
				<? foreach ($certification as $item) { ?>
				<div class="row" style="clear: both">
					<? if (isset($item[0])) { ?>
						<div class="small-24 medium-12 large-12 columns">
							<div class="iconWrapper">
								<img src="<?=$item[0]['thumbnail']?>" />
								<span class="itemTitle" style="left: 70px;"><? if ($lang=="vn") { echo $item[0]['title']; } else { echo $item[0]['title_en']; }?></span>
							</div>
							<p class="itemDesc"><? if ($lang=="vn") { echo $item[0]['desc']; } else { echo $item[0]['desc_en']; }?></p>
							<p class="itemMore">&#187;&nbsp;
								<!-- <a href="<? if ($lang=="vn") { echo $links['service']['certification'].'/'.$item[0]['url']; } else { echo $links['service']['certification'].'/'.$item[0]['url_en']; }?>"><?=$textMore?></a> -->
								<a href="<?=$links['service']['certification']?>"><?=$textMore?></a>
							</p>
						</div>
					<? } ?>
					<? if (isset($item[1])) { ?>
						<div class="small-24 medium-12 large-12 columns">
							<div class="iconWrapper">
								<img src="<?=$item[1]['thumbnail']?>" />
								<span class="itemTitle" style="left: 90px;"><? if ($lang=="vn") { echo $item[1]['title']; } else { echo $item[1]['title_en']; }?></span>
							</div>
							<p class="itemDesc"><? if ($lang=="vn") { echo $item[1]['desc']; } else { echo $item[1]['desc_en']; }?></p>
							<p class="itemMore">&#187;&nbsp;
								<!-- <a href="<? if ($lang=="vn") { echo $links['service']['certification'].'/'.$item[1]['url']; } else { echo $links['service']['certification'].'/'.$item[1]['url_en']; }?>"><?=$textMore?></a> -->
								<a href="<?=$links['service']['certification']?>"><?=$textMore?></a>
							</p>
						</div>
					<? } ?>
				</div>
				<? } ?>
				<!-- 
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
				</div> -->
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
					<? if (count($gallery)>=5) { ?>
						<? $arrChunk = array_chunk($gallery, 2);?>
						<? for ($i=0; $i<5; $i++) { ?>
							<li>
								<div class="row">
									<div class="small-24 medium-12 large-12 columns">
										<div class="imgWrapper small-12 medium-12 large-12 columns">
											<img src="<?=$arrChunk[$i][0]['detail'][0]['value']?>" />
											<div class="caption"><?=$textGallery['textBefore']?></div>
										</div>
										<div class="imgWrapper small-12 medium-12 large-12 columns">
											<img src="<?=$arrChunk[$i][0]['detail'][1]['value']?>" />
											<div class="caption"><?=$textGallery['textAfter']?></div>
										</div>
										<p class="infoCar"><strong><?=$textGallery['textInfo']?>:</strong> <?=$arrChunk[$i][0]['title']?></p>
										<p class="infoCar"><strong><?=$textGallery['textService']?>:</strong> <?=$arrChunk[$i][0]['desc']?></p>
									</div>
									<div class="small-24 medium-12 large-12 columns">
										<div class="imgWrapper small-12 medium-12 large-12 columns">
											<img src="<?=$arrChunk[$i][1]['detail'][0]['value']?>" />
											<div class="caption"><?=$textGallery['textBefore']?></div>
										</div>
										<div class="imgWrapper small-12 medium-12 large-12 columns">
											<img src="<?=$arrChunk[$i][1]['detail'][1]['value']?>" />
											<div class="caption"><?=$textGallery['textAfter']?></div>
										</div>
										<p class="infoCar"><strong><?=$textGallery['textInfo']?>:</strong> <?=$arrChunk[$i][1]['title']?></p>
										<p class="infoCar"><strong><?=$textGallery['textService']?>:</strong> <?=$arrChunk[$i][1]['desc']?></p>
									</div>
								</div>
							</li>
						<? } ?>
					<? } 
					else { ?>
							<? if (count($gallery)==1) { ?>
								<li>
									<div class="row">
										<div class="small-24 medium-12 large-12 columns">
											<div class="imgWrapper small-12 medium-12 large-12 columns">
												<img src="<?=$gallery[0]['detail'][0]['value']?>" />
												<div class="caption"><?=$textGallery['textBefore']?></div>
											</div>
											<div class="imgWrapper small-12 medium-12 large-12 columns">
												<img src="<?=$gallery[0]['detail'][1]['value']?>" />
												<div class="caption"><?=$textGallery['textAfter']?></div>
											</div>
											<p class="infoCar"><strong><strong><?=$textGallery['textInfo']?>:</strong> Mercedes GLS</p>
											<p class="infoCar"><strong><strong><?=$textGallery['textService']?>:</strong> Chỉnh móp đầu xe, khôi phục vết xước sơn xe.</p>
										</div>
									</div>
								</li>
							<? } else { ?>
								<? $arrChunk = array_chunk($gallery, 2);?>
								<? foreach ($arrChunk as $item) { ?>
									<li>
										<div class="row">
											<div class="small-24 medium-12 large-12 columns">
												<div class="imgWrapper small-12 medium-12 large-12 columns">
													<img src="<?=$item[0]['detail'][0]['value']?>" />
													<div class="caption"><?=$textGallery['textBefore']?></div>
												</div>
												<div class="imgWrapper small-12 medium-12 large-12 columns">
													<img src="<?=$item[0]['detail'][1]['value']?>" />
													<div class="caption"><?=$textGallery['textAfter']?></div>
												</div>
												<p class="infoCar"><strong><?=$textGallery['textInfo']?>:</strong> <?=$item[0]['title']?></p>
												<p class="infoCar"><strong><?=$textGallery['textService']?>:</strong> <?=$item[0]['desc']?></p>
											</div>
											<div class="small-24 medium-12 large-12 columns">
												<div class="imgWrapper small-12 medium-12 large-12 columns">
													<img src="<?=$item[1]['detail'][0]['value']?>" />
													<div class="caption"><?=$textGallery['textBefore']?></div>
												</div>
												<div class="imgWrapper small-12 medium-12 large-12 columns">
													<img src="<?=$item[1]['detail'][1]['value']?>" />
													<div class="caption"><?=$textGallery['textAfter']?></div>
												</div>
												<p class="infoCar"><strong><?=$textGallery['textInfo']?>:</strong> <?=$item[1]['title']?></p>
												<p class="infoCar"><strong><?=$textGallery['textService']?>:</strong> <?=$item[1]['desc']?></p>
											</div>
										</div>
									</li>
								<? } ?>
							<? } ?>
					<? } ?>
				</ul>
				<div class="outside">
				  	<div id="slider-prev"></div>
				  	<div id="slider-next"></div>
				</div>
				<div class="row">
					<a class="btnBlue btnXemthem" href="<?=$links['gallery']['beforeafter']?>"><?=$textViewMore?></a>
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