<div id="homePage" class="fullContainer">

    <!-- hotProduct -->
	<div id="hotProduct" class="centerContainer">
		<div class="title_col small-12 medium-3 large-3 columns">
			<p>Sản phẩm<br />nổi bật</p>
            <a href="#">Xem thêm &#62;</a>
		</div>
		<div class="content_col small-12 medium-9 large-9 columns noPadding">
            <div class="wrap">
                <div class="frame" id="hotProductFrame">
                    <ul class="clearfix">
                        <? for ($i=1; $i<10; $i++) { ?>
                            <li>
								<div class="product_box">
	                                <img src="<?=F_URL?>assets/frontend/images/light.png" alt="<?=$imgAlt?>" />
	                                <p class="product_desc">It is a long established fact that a reader will be distracted fact.</p>
	                                <p class="product_prize">VND 120.000</p>
	                                <p class="product_prize_old"><span>VND 240.000 </span>  50%</p>
	                                <a href="#" class="linkFull"></a>
								</div>
                            </li>
                        <? } ?>
                    </ul>
                </div>
                <div class="scrollbar">
                    <div class="handle">
                        <div class="mousearea"></div>
                    </div>
                </div>
                <div class="controls center">
                    <button class="btn prev"></button>
                    <button class="btn next"></button>
                </div>
            </div>
		</div>
	</div>

    <!-- hotProduct -->
	<div id="saleProduct" class="centerContainer">
		<div class="content_col small-12 medium-9 large-9 columns noPadding">
            <div class="wrap">

                <div class="frame" id="saleProductFrame">
                    <ul class="clearfix">
                        <? for ($i=1; $i<10; $i++) { ?>
                            <li>
								<div class="product_box">
	                                <img src="<?=F_URL?>assets/frontend/images/light.png" alt="<?=$imgAlt?>" />
	                                <p class="product_desc">It is a long established fact that a reader will be distracted fact.</p>
	                                <p class="product_prize">VND 120.000</p>
	                                <p class="product_prize_old"><span>VND 240.000 </span>  50%</p>
	                                <a href="#" class="linkFull"></a>
								</div>
                            </li>
                        <? } ?>
                    </ul>
                </div>

                <div class="scrollbar">
                    <div class="handle">
                        <div class="mousearea"></div>
                    </div>
                </div>

                <div class="controls center">
                    <button class="btn prev"></button>
                    <button class="btn next"></button>
                </div>
            </div>
		</div>
        <div class="title_col small-12 medium-3 large-3 columns">
            <p>Sản phẩm<br />khuyến mãi</p>
            <a href="#">Xem thêm &#62;</a>
        </div>
    </div>
</div>
