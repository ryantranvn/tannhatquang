<?=$frmEditMeta['open']?>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<fieldset>
				<!-- Page Title -->
					<div class="form-group">
						<div class="row">
							<div class="col-sm-12 col-md-12 col-lg-12">
								<label class="control-label">Page Title <sup>*</sup></label>
								<input type="text" class="form-control" name="page_title" value="<?=$page_title?>" />
								<span class="charLimit" id="page_title_limit"></span>
							</div>
						</div>
					</div>
				<!-- Meta Keywords -->
					<div class="form-group">
                        <div class="row">
							<div class="col-sm-12 col-md-12 col-lg-12">
								<label class="control-label">Meta Keywords </label>
                                <input class="form-control tagsinput" name="meta_key" value="<?=$meta_key?>" data-role="tagsinput">
                                <p>Press "Enter" to complete or add more keyword</p>
							</div>
						</div>
					</div>
				<!-- Meta Description -->
					<div class="form-group">
                        <div class="row">
							<div class="col-sm-12 col-md-12 col-lg-12">
								<label class="control-label">Meta Description </label>
								<input type="text" class="form-control" name="meta_desc" value="<?=$meta_desc?>" />
								<span class="charLimit" id="meta_desc_limit"></span>
							</div>
						</div>
					</div>
			</fieldset>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 actions">
			<button class="btn btn-sm btn-success pull-right" type="submit">
				<i class="fa fa-lg fa-save"></i> Save
			</button>
		</div>
	</div>
<?=$frmEditMeta['close']?>
