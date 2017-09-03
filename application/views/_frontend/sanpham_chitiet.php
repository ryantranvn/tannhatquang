<div id="sanpham_chitietPage" class="fullContainer subPage">
    <div class="centerContainer">
        <div class="small-12 medium-3 large-3 columns noPaddingRight">
            <!-- productList -->
            <?=$this->load->view('frontend/includes/danhmuc_sanpham','',TRUE)?>
            <!-- hotProduct -->
            <?=$this->load->view('frontend/includes/sanpham_noibat','',TRUE)?>
        </div>
        <div id="sanpham_chitietContent" class="small-12 medium-9 large-9 columns">
            <div class="row">
                <div class="product_image small-12 medium-6 large-6 columns">
                    <img class="large_image" src="<?=F_URL?>assets/frontend/images/light.png" alt="<?=$imgAlt?>" />
                    <div class="small_image">
                        <img src="<?=F_URL?>assets/frontend/images/light.png" alt="<?=$imgAlt?>" />
                        <img src="<?=F_URL?>assets/frontend/images/light.png" alt="<?=$imgAlt?>" />
                        <img src="<?=F_URL?>assets/frontend/images/light.png" alt="<?=$imgAlt?>" />
                        <img src="<?=F_URL?>assets/frontend/images/light.png" alt="<?=$imgAlt?>" />
                    </div>
                </div>
                <div class="product_info small-12 medium-6 large-6 columns">
                    <div class="product_name">
                        Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...
                    </div>
                    <p class="attr_name">Khuyến mãi:</p>
                    <p class="attr_info color_blue">Đang được cập nhật</p>
                    <p class="attr_name">Loại sản phẩm:</p>
                    <p class="attr_info color_blue">Đèn Led Âm trần - Libastar - Việt Nam</p>
                    <p class="attr_name">Nhà cung cấp:</p>
                    <p class="attr_info color_blue">Công Ty TNHH TM Nhật Quang</p>
                    <p class="attr_name">Thông tin chi tiết:</p>
                    <p class="attr_info color_blue">Đèn Led âm trần tròn, kính mờ, trắng ngọc trai 12W - Libastar - Việt Nam</p>
                    <div class="attr_info">
                        - Ánh Sáng: Trắng - Vàng<br/>
                        - Chip led nhập khẩu Taiwan<br/>
                        - Chấn lưu có IC<br/>
                        - Phi: 110mm<br/>
                        - Bảo hành 24 tháng
                    </div>
                </div>
            </div>
            <div class="row prize_box">
                <span class="new_prize">VND 120.000</span>
                <span class="old_prize"><span>VND 240.000</span>  50%</span>
                <button class="add_cart">THÊM VÀO GIỎ HÀNG</button>
            </div>
            <div class="row product_related">
                <p class="title redCenter">Sản phẩm liên quan</p>
                <ul id="sanphamList">
                <? for ($i=1; $i<90; $i++) { ?>
                    <li class="small-3 medium-4 large-4 columns">
                    <!-- <div class="product_item small-12 medium-4 large-4 columns"> -->
                        <div class="product_box">
                            <img src="<?=F_URL?>assets/frontend/images/light.png" alt="<?=$imgAlt?>" />
                            <p class="product_desc">It is a long established fact that a reader will be distracted fact.</p>
                            <p class="product_prize">VND 120.000</p>
                            <p class="product_prize_old"><span>VND 240.000 </span> 50%</p>
                            <a href="<?=F_URL?>san-pham/chi-tiet" class="linkFull"></a>
                        </div>
                    <!-- </div> -->
                    </li>
                <? } ?>
                </ul>
                <div class="holder_sanphamList"></div>
                <div class="customBtns">
                    <span class="arrowPrev_sanpham">&lt;</span>
                    <span class="arrowNext_sanpham">&gt;</span>
                </div>
            </div>
        </div>
    </div>
</div>
