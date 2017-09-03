<div id="sanphamPage" class="fullContainer subPage">
    <div class="centerContainer">
        <div class="small-12 medium-3 large-3 columns noPaddingRight">
            <!-- productList -->
            <?=$this->load->view('frontend/includes/danhmuc_sanpham','',TRUE)?>
            <!-- hotProduct -->
            <?=$this->load->view('frontend/includes/sanpham_noibat','',TRUE)?>
        </div>
        <div id="sanphamContent" class="small-12 medium-9 large-9 columns">
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
