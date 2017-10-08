<?=$this->load->view('backend/includes/breadcrumb','',TRUE)?>
<!-- widget grid -->
    <section id="widget-grid">
        <!-- reply -->
            <?=$this->load->view('backend/includes/reply','',TRUE)?>
        <!-- row -->
			<div class="row">
                <article class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="jarviswidget jarviswidget-color-blue" data-widget-editbutton="false" data-widget-deletebutton="false">
                        <!-- header -->
                            <header>
                                <h2></h2>
                            </header>
                        <!-- end header -->
                        <div class="wrap_left" style="position: relative; overflow-x: hidden; overflow-y: scroll">
                            <?=$this->load->view('backend/includes/tree','',TRUE)?>
                        </div>
                    </div>
                </article>
                <article class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <div class="jarviswidget jarviswidget-color-blue" data-widget-editbutton="false" data-widget-deletebutton="false">
                        <!-- header -->
                            <header>
                                <h2></h2>
                            </header>
                        <!-- end header -->
                        <div class="wrap_right" style="position: relative; overflow-x: hidden; overflow-y: scroll">
							<div class="wrap_content">
								<?=$this->load->view('backend/includes/table_list','',TRUE)?>
							</div>
                        </div>
                    </div>
				</article>
            </div>
		<!-- end row -->
	</section>
<!-- end widget grid -->
