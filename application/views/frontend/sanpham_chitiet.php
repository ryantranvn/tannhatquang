<div id="wrap_sanpham" class="container-fluid">
    <div class="container">
        <div class="row">
            <div id="wrap_left" class="col col-sm-3">
                <?=$this->load->view('frontend/includes/wrap_product_category','',TRUE)?>
                <?=$this->load->view('frontend/includes/wrap_hot_product','',TRUE)?>
            </div>
            <div id="wrap_right" class="col col-sm-9">
                <div class="row">
                    <div class="wrap_sanpham_detail container-fluid">
                        <?=$this->load->view('frontend/includes/wrap_product_image','',TRUE)?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>