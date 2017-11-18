<div id="wrap_banggia" class="container-fluid">
    <div class="container">
        <div class="row">
            <div id="wrap_left" class="col col-sm-3">
                <?=$this->load->view('frontend/includes/wrap_product_category','',TRUE)?>
                <?=$this->load->view('frontend/includes/wrap_hot_product','',TRUE)?>
            </div>
            <div id="wrap_right" class="col col-sm-9">
                <h3 class="text_left red" style="line-height: 40px">Bảng giá thiết bị điện dân dụng - điện công nghiệp</h3>
                <p>Bảng giá thiết bị điện dân dụng và điện công nghiệp tập trung các bảng giá thiết bị thông dụng nhất hiện nay bao gồm như là Selec, Mikro, Emic, LS, Mitsubishi, Schneider, Siemens, ABB, Hyundai, Shihlin, Teco, Chint, Omron, Autonics...</p>
                <p>Hiện nay, bảng giá thiết bị điện trên thị trường biến động thường xuyên, không ổn định. Chính vì thế, quý khách hàng có nhu cầu nên kiểm chứng hiệu lực của các bảng giá trước khi sử dụng để đặt hàng, điều này nhằm hạn chế tối đa những sự cố không đáng có phát sinh. Nếu quý khách cần bảng giá thiết bị điện dân dụng khác, hoặc muốn cập nhật bảng giá thiết bị điện công nghiệp mới nhất, xin hãy vui lòng liên lạc trực tiếp với chúng tôi thông qua hotline 0973.893.001. Công ty Điện Thành Vinh chúng tôi sẽ hỗ trợ quý khách tối đa trong khả năng của mình.</p>
                <h5 class="text_center red" style="line-height: 30px">Mọi nhu cầu về bảng báo giá thiết bị điện dân dụng - điện công nghiệp xin liên hệ</h5>
                <p class="text_center" style="margin-bottom: 20px">
                    12 Hoàng Diệu, Phường 2, Tp Cà Mau, Việt Nam<br/>
                    Phone : +84 7803 515 555 | +84 7806 515 555<br/>
                    Fax : +84 7806 251 022<br/>
                    Email : dntntannhatquang@gmail.com
                </p>
                <?php
                    foreach ($price_list as $item) { ?>
                        <p>
                            <a class="red" href="<?php echo F_URL . $item['filename']?>" target="_blank"><?php echo $item['title']?></a>
                            <?php echo $item['desc']?>
                        </p>
                    <?php
                    }
                ?>
<!--                <p><a class="red" href="#">Bảng giá thiết bị đóng cắt C&S (INDIA) (0 bảng giá)</a> Bảng giá thiết bị đóng cắt, cầu dao tự đông, giao chống giật, khởi động từ... và các thiết bị điện công nghiệp khác từ C&S Ấn Độ (INDIA)</p>-->
<!--                <p><a class="red" href="#">Bảng giá relay Mikro (0 bảng giá)</a> Bảng báo giá thiết bị relay tự động công nghiệp chính hãng của Mikro</p>-->
<!--                <p><a class="red" href="#">Bảng giá thiết bị điện Shneider (1 bảng giá)</a> Bảng báo giá các sản phẩm thiết bị điện công nghiệp chính hãng đến từ thương hiệu nổi tiếng Shneider</p>-->
<!--                <p><a class="red" href="#">Bảng giá thiết bị điện Panasonic (1 bảng giá)</a> Bảng báo giá các thiết bị và sản phẩm điện công nghiệp chính hãng đến từ thương hiệu Panasonic nổi tiếng</p>-->
<!--                <p><a class="red" href="#">Bảng giá đèn led Libastar (1 bảng giá)</a> Bảng báo giá các thiết bị đèn led chiếu sáng dân dụng và công nghiệp của thương hiệu Libastar</p>-->
<!--                <p><a class="red" href="#">Bảng giá thiết bị điện Mitsubishi (0 bảng giá)</a> Bảng báo giá những sản phẩm, thiết bị điện công nghiệp chính hãng của Mitsubishi - Thương hiệu thiết bị điện nổi tiếng hàng đầu</p>-->
<!--                <p><a class="red" href="#">Bảng giá thiết bị điện Sino Vanlock (0 bảng giá)</a> Bảng báo giá các thiết bị và sản phẩm điện dân dung của thương hiệu giá rẻ Sino - Vanlock</p>-->
<!--                <p><a class="red" href="#">Bảng giá thiết bị điện LS (1 bảng giá)</a> Bảng báo giá các thiết bị và sản phẩm điện công nghiệp tự động hóa chính hãng đến từ thương hiệu nổi tiếng LS</p>-->
<!--                <p><a class="red" href="#">Bảng giá thiết bị Duhal (0 bảng giá)</a> Bảng báo giá các thiết bị cùng sản phẩm của hãng thiết bị điện dân dụng Duhal. Liện hệ hotline 0973.893.001 để được giá tốt nhất</p>-->
<!--                <p><a class="red" href="#">Bảng giá thiêt bị paragon (1 bảng giá)</a> Bảng báo giá các sản phẩm thiết bị đèn chiếu sáng chất lượng đến từ thương hiệu thiết bị điện dân dụng Paragon hàng đâu tại Việt Nam</p>-->
<!--                <p><a class="red" href="#">Bảng giá Meikosha (1 bảng giá)</a> Bảng báo giá thiết bị điện công nghiệp chính hãng của Meikosha - Thương hiệu thiết bị điện chất lượng và uy tín</p>-->
            </div>
        </div>
    </div>
</div>
