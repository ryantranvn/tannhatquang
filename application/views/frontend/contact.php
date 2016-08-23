<div id="contactPage" class="fullContainer">
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
			</div>
			<div class="right small-0 medium-8 large-8 columns">&nbsp;</div>
		</div>
	</div>

<!-- contact -->
	<div class="contact fullContainer">
		<div class="centerContainer">
			<div class="left small-24 medium-12 large-12 columns">
				<img src="<?=assetsUrl('frontend','images','icon-contact.png');?>" />
				<p class="title"><?=$textHome['contact']['title']?></p>
				<p class="name"><?=$textHome['contact']['name']?></p>
				<p>-</p>
				<p><?=$textHome['contact']['address']?></p>
				<p>Tel: (84 8) 3770 8030 – Fax: (84 8) 3770 8031</p>
				<p><strong>Hotline: 0903 001 365</strong></p>
			</div>
			<div class="right small-24 medium-12 large-12 columns">
				<div class="mapWrapper">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3747.0835764407784!2d106.73372612012926!3d10.752391559639582!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317525851fd7fb97%3A0x8cfcad0c4836a621!2sVietnam+Star+Body+%26+Paint!5e0!3m2!1sen!2s!4v1469592378812" width="100%" height="100%" frameborder="0" style="border: 0;" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>

<!-- form -->
	<div class="frmWrapper fullContainer">
		<div class="centerContainer">
			<?=$frmContact['open'] ?>
				<p class="title"><?=$textBooking['form']['title']?></p>
				<div class="small-24 medium-12 large-12 columns">
					<div class="row">
						<div class="small-24 medium-24 large-24 columns">
							<label><span>*</span><?=$textBooking['form']['lblFullname']?></label>
							<input type="text" name="fullname" />
						</div>
					</div>
					<div class="row">
						<div class="small-24 medium-12 large-12 columns">
							<label><span>*</span><?=$textBooking['form']['lblEmail']?></label>
							<input type="text" name="email" />
						</div>
						<div class="small-24 medium-12 large-12 columns">
							<label><span>*</span><?=$textBooking['form']['lblPhone']?></label>
								<input type="text" name="phone" class="positive-integer" />
						</div>
					</div>
					<div class="row">
						<div class="small-24 medium-24 large-24 columns">
							<label><span>*</span><?=$textBooking['form']['lblAddress']?></label>
							<input type="text" name="address" />
						</div>
					</div>
				</div>
				<div class="small-24 medium-12 large-12 columns">
					<div class="row">
						<div class="small-24 medium-24 large-24 columns">
							<label><span>*</span><?=$textBooking['form']['lblTitle']?></label>
							<input type="text" name="title" />
						</div>
					</div>
					<div class="row" style="height: 150px;">
						<div class="small-24 medium-24 large-24 columns">
							<label><span>*</span><?=$textBooking['form']['lblContent']?></label>
							<textarea name="content"></textarea>
						</div>
					</div>
					<div class="row" style="height: 50px;">
						<div class="small-24 medium-24 large-24 columns">
							<input type="submit" class="btnBlue" value="Gửi" />
						</div>
					</div>
				</div>

			<?=$frmContact['close'] ?>
		</div>
	</div>

</div>