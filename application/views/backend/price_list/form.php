<?=$this->load->view('backend/includes/breadcrumb','',TRUE)?>
<!-- widget grid -->
<section id="widget-grid">
    <?=$this->load->view('backend/includes/reply','',TRUE)?>
    <!-- row -->
    <div class="row">
        <!-- ADD -->
        <?php if ($permissionsMember['Module']['2'] == 1 || $permissionsMember['Module']['3'] == 1) { ?>
        <article class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="jarviswidget jarviswidget-color-blue" data-widget-editbutton="false" data-widget-deletebutton="false">
                <!-- header -->
                <header>
                </header>
                <!-- end header -->
                <!-- widget content -->
                <div class="wrap_left" style="position: relative; overflow-x: hidden; overflow-y: scroll">
                    <?=$frmPriceList['open']?>
                    <?//=$frmPriceList['close']?>
                </div>
                <!-- end widget content -->
            </div>
        </article>
        <?php } ?>
    </div>
    <!-- end row -->
</section>
<!-- end widget grid -->