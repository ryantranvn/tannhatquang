<div class="row">
    <fieldset>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <label class="control-label">Chuyên mục cha<sup>*</sup></label>
                    <select name="parent_id" class="form-control" placeholder="Select chuyên mục cha">
                        <?php if (isset($frmData)) { ?>
                            <? if (!isset($frmProduct)) { ?>
                                <option value="1" <?php if ($frmData['parent_id'] == 1) { ?> selected<?php } ?>>Sản phẩm</option>
                            <?php } ?>
                            <?php if (isset($categories) && count($categories)>0) { ?>
                                <?php foreach ($categories as $category) { ?>
                                    <option value="<?=$category['id'] ?>" <?php if ($frmData['parent_id'] == $category['id']) { ?> selected<?php } ?>><?=$category['name'] ?></option>
                                <?php } ?>
                            <?php } ?>
                        <?php } else { ?>
                            <? if (!isset($frmProduct)) { ?>
                                <option value="1">Sản phẩm</option>
                            <?php } ?>
                            <?php if (isset($categories) && count($categories)>0) { ?>
                                <?php foreach ($categories as $category) { ?>
                                    <option value="<?=$category['id'] ?>"><?=$category['name'] ?></option>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
    </fieldset>
</div>
