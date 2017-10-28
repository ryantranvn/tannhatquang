<?=$this->load->view('backend/includes/breadcrumb','',TRUE)?>
<!-- widget grid -->
<section id="widget-grid" class="customer_form">
    <?=$this->load->view('backend/includes/reply','',TRUE)?>
    <!-- row -->
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget jarviswidget-color-blue" data-widget-editbutton="false" data-widget-deletebutton="false">
                <!-- header -->
                <header>
                    <h2>Thông tin đơn hàng</h2>
                </header>
                <!-- end header -->
                <div id="wrap_form" class="custom-scroll table-responsive" class="row" style="position: relative; overflow-x: hidden; overflow-y: scroll; padding-top: 20px;">
                    <?=$frmOrder['open']?>
                    
                    <?=$frmOrder['close']?>
                </div>
            </div>
        </article>
    </div>
    <!-- end row -->
</section>
<!-- end widget grid -->