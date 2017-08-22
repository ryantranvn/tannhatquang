<?=$this->load->view('backend/includes/breadcrumb','',TRUE)?>
<!-- widget grid -->
    <section id="widget-grid">
        <!-- reply -->
            <?=$this->load->view('backend/includes/reply','',TRUE)?>
        <!-- row -->
			<div class="row">
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="jarviswidget jarviswidget-color-blue" data-widget-editbutton="false" data-widget-deletebutton="false">
                    <!-- header -->
                        <header>
                            <ul class="nav nav-tabs pull-left in">
                                <li class="active">
                                    <a data-toggle="tab" href="#hr1">Meta</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#hr2">Skype Accounts</a>
                                </li>
                            </ul>
                        </header>
                    <!-- end header -->
                        <div class="wrap_tab" style="position: relative; overflow-x: hidden; overflow-y: scroll">
                            <div class="tab-content">
                                <div class="tab-pane active" id="hr1">
                                    <?=$this->load->view('backend/setting/form_meta','',TRUE)?>
                                </div>
                                <div class="tab-pane" id="hr2">
                                    tab 2
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
		<!-- end row -->
	</section>
<!-- end widget grid -->
