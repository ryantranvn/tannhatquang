<div id="wrap_hotline" class="container-fluid">
    <div class="container">
        <div class="row">
			<div class="wrap_title col col-md-3">
                <div class="media row">
                    <div class="media-left">
                        <img class="media-object normal" src="<?=ASSETS_URL?>frontend/images/phone.png" alt="<?=IMG_ALT?>">
                    </div>
                    <div class="media-body">
                        <p>Hotline<br /><span>1800 XX XX</span></p>
                    </div>
                </div>
			</div>
            <div class="wrap_slick col col-md-9">
                <div class="row">
                    <div id="slick_hotline" class="slick_container col-xs-12 col-sm-12 col-md-12">
                        <? for ($i=1; $i<=20; $i++) { ?>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object normal" src="<?=ASSETS_URL?>frontend/images/skype.png" alt="<?=IMG_ALT?>">
                                        <img class="media-object active" src="<?=ASSETS_URL?>frontend/images/skype-active.png" alt="<?=IMG_ALT?>">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <p>Nguyễn Văn A <?=$i?><br /><span>0909 XX XXXX</span></p>
                                </div>
                            </div>
                        </div>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
