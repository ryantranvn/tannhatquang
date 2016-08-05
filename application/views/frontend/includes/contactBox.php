<!-- <div id="arcText">Liên hệ tư vấn</div> -->
<div class="contactBox">
	<div class="titleWrapper hideBox row">
		<div class="small-24 medium-24 large-24 columns">
			<p>Liên hệ tư vấn </p>
			<i class="fa fa-caret-down" aria-hidden="true"></i>
		</div>
	</div>
	<div class="row">
		<div class="small-24 medium-24 large-24 columns">
			<?=$frmContact['open'] ?>
				<p>Vui lòng điền đầy đủ thông tin, những thông tin có đánh dấu * là bắt buộc nhập.</p>
				<div class="row">
					<div class="small-24 medium-24 large-24 columns">
						<label><span>*</span>HỌ VÀ TÊN</label>
						<input type="text" name="fullname" />
					</div>
				</div>
				<div class="row">
					<div class="small-24 medium-12 large-12 columns">
						<label><span>*</span>EMAIL</label>
						<input type="text" name="email" />
					</div>
					<div class="small-24 medium-12 large-12 columns">
						<label><span>*</span>SỐ ĐIỆN THOẠI</label>
						<input type="text" name="phone" class="positive-integer" />
					</div>
				</div>
				<div class="row">
					<div class="small-24 medium-24 large-24 columns">
						<label class="lblService"><span>*</span>DỊCH VỤ CẦN TƯ VẤN</label>
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
							<input type="text" name="service" class="valueGet hiddenInput" value="Sửa chữa, đồng sơn dòng xe sang" />
						</div>
						<input type="submit" class="btnBlue" value="Gửi yêu cầu" />
					</div>
				</div>
			<?=$frmContact['close'] ?>
		</div>
	</div>
</div>
<div class="contactBox_mini">
	<p>Liên hệ tư vấn<i class="fa fa-caret-up" aria-hidden="true"></i></p>
</div>