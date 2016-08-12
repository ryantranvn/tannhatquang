<!-- <div id="arcText">Liên hệ tư vấn</div> -->
<div class="contactBox">
	<div class="titleWrapper hideBox row">
		<div class="small-24 medium-24 large-24 columns">
			<p><?=$textContactBox['title']?></p>
			<i class="fa fa-caret-down" aria-hidden="true"></i>
		</div>
	</div>
	<div class="row">
		<div class="small-24 medium-24 large-24 columns">
			<?=$frmContact['open'] ?>
				<p><?=$textContactBox['form']['title']?></p>
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
						<label class="lblService"><span>*</span><?=$textBooking['form']['lblService']?></label>
						<div id="serviceWrapper" class="selectWrapper">
							<p class="valueShow"><?=$textBooking['service'][0]?></p>
							<ul>
								<li class="pointer" data-val="<?=$textBooking['service'][0]?>"><?=$textBooking['service'][0]?></li>
									<li class="pointer" data-val="<?=$textBooking['service'][1]?>"><?=$textBooking['service'][1]?></li>
									<li class="pointer" data-val="<?=$textBooking['service'][2]?>"><?=$textBooking['service'][2]?></li>
									<li class="pointer" data-val="<?=$textBooking['service'][3]?>"><?=$textBooking['service'][3]?></li>
									<li class="pointer" data-val="<?=$textBooking['service'][4]?>"><?=$textBooking['service'][4]?></li>
									<li class="pointer" data-val="<?=$textBooking['service'][5]?>"><?=$textBooking['service'][5]?></li>
							</ul>
							<input type="text" name="service" class="valueGet hiddenInput" value="<?=$textBooking['service'][0]?>" />
						</div>
						<input type="submit" class="btnBlue" value="<?=$textBooking['form']['btnSend']?>" />
					</div>
				</div>
			<?=$frmContact['close'] ?>
		</div>
	</div>
</div>
<div class="contactBox_mini">
	<p><?=$textContactBox['title']?><i class="fa fa-caret-up" aria-hidden="true"></i></p>
</div>