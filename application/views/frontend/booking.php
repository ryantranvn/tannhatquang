<div id="bookingPage" class="fullContainer">
<!-- banner -->
	<div class="banner fullContainer">
		<? if ($lang=='vn') { ?>
			<img src="<?=$banner['url']?>" />
		<? } else { ?>
			<img src="<?=$banner['url_en']?>" />
		<? } ?>
	</div>

<!-- booking -->
	<div class="fullContainer">
		<div class="centerContainer">
			<div class="left small-24 medium-10 large-10 columns">
				<p class="title"><?=$textBooking['title']?></p>
				<p class="desc"><?=$textBooking['desc']?></p>
			</div>
			<div class="right small-24 medium-14 large-14 columns">
				<p class="title"><?=$textBooking['form']['title']?></p>
				<p class="desc"><span>*</span> <?=$textBooking['form']['textRequied']?></p>
				<?=$frmBooking['open'] ?>
					<div class="row noPadding">
						<div class="small-24 medium-24 large-24 columns noPadding">
							<label><span>*</span><?=$textBooking['form']['lblFullname']?></label>
							<input type="text" name="fullname" />
						</div>
					</div>
					<div class="row">
						<div class="small-24 medium-12 large-12 columns noPaddingLeft">
							<label><span>*</span><?=$textBooking['form']['lblEmail']?></label>
							<input type="text" name="email" />
						</div>
						<div class="small-24 medium-12 large-12 columns noPaddingRight">
							<label><span>*</span><?=$textBooking['form']['lblPhone']?></label>
								<input type="text" name="phone" class="positive-integer" />
						</div>
					</div>
					<div class="row">
						<div class="small-24 medium-24 large-24 columns noPadding">
							<label><span>*</span><?=$textBooking['form']['lblAddress']?></label>
							<input type="text" name="address" />
						</div>
					</div>
					<div class="row line">
						<div class="small-24 medium-24 large-24 columns noPadding"></div>
					</div>
					<div class="row">
						<div class="small-24 medium-24 large-24 columns noPadding">
							<label><span>*</span><?=$textBooking['form']['lblCar']?></label>
							<div id="carWrapper" class="selectWrapper">
								<p class="valueShow">Mercedes-Benz</p>
								<ul>
									<? foreach ($car as $item) { ?>
										<li class="pointer" data-val="<?=$item?>"><?=$item?></li>
									<? } ?>
								</ul>
								<input type="text" name="car" class="valueGet hiddenInput" value="Mercedes-Benz" />
							</div>
							<div id="modelWrapper" class="selectWrapper">
								<p class="valueShow">DÒNG XE</p>
								<ul>
									<? foreach ($mercedes as $item) { ?>
										<li class="pointer" data-val="<?=$item?>"><?=$item?></li>
									<? } ?>
								</ul>
								<input type="text" name="model" class="valueGet hiddenInput" />
							</div>
							<div id="loaixeWrapper">
								<label>LOẠI XE</label>
								<input type="text" name="modelOther" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="small-24 medium-24 large-24 columns noPadding">
							<label for="service"><span>*</span><?=$textBooking['form']['lblService']?></label>
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
						</div>
					</div>
					<div class="row">
						<div class="small-24 medium-24 large-24 columns noPadding">
							<label for="pictures"><span>*</span><?=$textBooking['form']['lblUpload']?></label>
							<a href="#" class="btnUpload btnBlue"><i class="fa fa-plus" aria-hidden="true"></i><?=$textBooking['form']['btnUpload']?></a>
						</div>
						<div id="imgContainer" class="small-24 medium-24 large-24 columns noPadding"></div>
					</div>
					<div class="row">
						<div class="small-24 medium-24 large-24 columns noPadding">
							<label for="date"><span>*</span><?=$textBooking['form']['lblBooking']?></label>
							<input type="text" name="date" value="<?=$textBooking['form']['placeholderDate']?>" readonly />
						</div>
					</div>
					<div class="row noPadding">
						<div class="small-24 medium-24 large-24 columns noPadding">
							<label><span>*</span><?=$textBooking['form']['lblTitle']?> (<span class="charLimit" id="titleLimit"></span>)</label>
							<input type="text" name="title" placeholder="<?=$textBooking['form']['placeholder250']?>" />
							
						</div>
					</div>
					<div class="row noPadding" style="height: 150px;">
						<div class="small-24 medium-24 large-24 columns noPadding">
							<label><span>*</span><?=$textBooking['form']['lblContent']?> (<span class="charLimit" id="bookingContentLimit"></span>)</label>
							<textarea name="bookingContent" placeholder="<?=$textBooking['form']['placeholder2000']?>"></textarea>
						</div>
					</div>
					<div class="row" style="height: 50px;">
						<div class="small-24 medium-24 large-24 columns noPadding">
							<input type="submit" class="btnBlue" value="<?=$textBooking['form']['btnSend']?>" />
						</div>
					</div>
				<?=$frmBooking['close'] ?>
				<?=$frmUpload['open'] ?>
					<input type="file" name="ajax_files[]" id="ajax_files" multiple />
				<?=$frmUpload['close'] ?>
			</div>
		</div>
	</div>
</div>


