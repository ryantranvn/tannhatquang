<div id="bookingPage" class="fullContainer">
<!-- banner -->
	<div class="banner fullContainer">
		<img src="<?=uploadUrl('images','banner/booking.jpg');?>" />
	</div>

<!-- booking -->
	<div class="fullContainer">
		<div class="centerContainer">
			<div class="left small-24 medium-10 large-10 columns">
				<p class="title">Chiếc xe yêu quý của bạn<br/>cần sự chăm sóc đặc biệt?</p>
				<p class="desc">Bạn lo lắng về Vết móp trên thân xe trong 1 cú va chạm nặng hay Vết trầy sơn trong 1 cú quẹt nhẹ? <br/>Bạn bối rối không biết xử lý thế nào khi xe gặp sự cố hoặc tai nạn?<br/>Bạn lăn tăn về vẻ bề ngoài của xe cần được chăm sóc hoàn hảo, đúng cách?<br/>Hãy đặt hẹn Trung tâm đồng sơn Vietnam Star để được tư vấn giải pháp cho chiếc xe yêu quý của bạn ngay hôm nay!</p>
			</div>
			<div class="right small-24 medium-14 large-14 columns">
				<p class="title">Vui lòng điền đầy đủ thông tin</p>
				<p class="desc">Những thông tin có đánh dấu <span>*</span> là bắt buộc nhập.</p>
				<?=$frmBooking['open'] ?>
					<div class="row noPadding">
						<div class="small-24 medium-24 large-24 columns noPadding">
							<label><span>*</span>HỌ VÀ TÊN</label>
							<input type="text" name="fullname" />
						</div>
					</div>
					<div class="row">
						<div class="small-24 medium-12 large-12 columns noPaddingLeft">
							<label><span>*</span>EMAIL</label>
							<input type="text" name="email" />
						</div>
						<div class="small-24 medium-12 large-12 columns noPaddingRight">
							<label><span>*</span>SỐ ĐIỆN THOẠI</label>
								<input type="text" name="phone" class="positive-integer" />
						</div>
					</div>
					<div class="row">
						<div class="small-24 medium-24 large-24 columns noPadding">
							<label><span>*</span>ĐỊA CHỈ</label>
							<input type="text" name="address" />
						</div>
					</div>
					<div class="row line">
						<div class="small-24 medium-24 large-24 columns noPadding"></div>
					</div>
					<div class="row">
						<div class="small-24 medium-24 large-24 columns noPadding">
							<label><span>*</span>THÔNG TIN XE</label>
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
							<label for="service"><span>*</span>DỊCH VỤ</label>
							<div id="serviceWrapper" class="selectWrapper">
								<p class="valueShow">Sửa chữa, đồng sơn dòng xe sang</p>
								<ul>
									<li class="pointer" data-val="Sửa chữa, đồng sơn dòng xe sang">Sửa chữa, đồng sơn dòng xe sang</li>
									<li class="pointer" data-val="Sơn xe: từng phần, phủ màu, đổi màu xe">Sơn xe: từng phần, phủ màu, đổi màu xe</li>
									<li class="pointer" data-val="Tư vấn màu sắc">Tư vấn màu sắc</li>
									<li class="pointer" data-val="Chăm sóc, làm đẹp nội, ngoại thất xe">Chăm sóc, làm đẹp nội, ngoại thất xe</li>
									<li class="pointer" data-val="Cứu hộ 24/7">Cứu hộ 24/7</li>
									<li class="pointer" data-val="Bảo dưỡng xe Mercedes Benz">Bảo dưỡng xe Mercedes Benz</li>
								</ul>
								<input type="text" name="service" class="valueGet hiddenInput" value="ĐỒNG SƠN" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="small-24 medium-24 large-24 columns noPadding">
							<label for="pictures"><span>*</span>ĐĂNG TẢI HÌNH ẢNH TÌNH TRẠNG HIỆN TẠI CỦA XE<br/>(tối đa 5 hình)</label>
							<a href="#" class="btnUpload btnBlue"><i class="fa fa-plus" aria-hidden="true"></i>Đăng tải hình ảnh</a>
						</div>
						<div id="imgContainer" class="small-24 medium-24 large-24 columns noPadding"></div>
					</div>
					<div class="row">
						<div class="small-24 medium-24 large-24 columns noPadding">
							<label for="date"><span>*</span>ĐẶT LỊCH HẸN</label>
							<input type="text" name="date" value="Ngày/Tháng/Năm" readonly />
						</div>
					</div>
					<div class="row noPadding">
						<div class="small-24 medium-24 large-24 columns noPadding">
							<label><span>*</span>TIÊU ĐỀ (<span class="charLimit" id="titleLimit"></span>)</label>
							<input type="text" name="title" placeholder="(Giới hạn 250 kí tự)" />
							
						</div>
					</div>
					<div class="row noPadding" style="height: 150px;">
						<div class="small-24 medium-24 large-24 columns noPadding">
							<label><span>*</span>NỘI DUNG (<span class="charLimit" id="bookingContentLimit"></span>)</label>
							<textarea name="bookingContent" placeholder="(Giới hạn 2000 kí tự)"></textarea>
						</div>
					</div>
					<div class="row" style="height: 50px;">
						<div class="small-24 medium-24 large-24 columns noPadding">
							<input type="submit" class="btnBlue" value="Hoàn thành" />
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


