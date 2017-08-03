<div class="btn-group" data-toggle="buttons">
    <label class="btn btn-default">
        <?php if (!isset($frmData['status'])) { ?>
            <input type="radio" name="status" value="active" checked="checked" />
        <?php } else {?>
            <input type="radio" name="status" value="active" <?php if ($frmData['status'] == "active") { ?> checked="checked"<?php } ?>/>
        <?php }?>
        Active <i class="fa fa-eye"></i></label>
    <label class="btn btn-default">
        <?php if (!isset($frmData['status'])) { ?>
            <input type="radio" name="status" value="inactive" />
        <?php } else {?>
            <input type="radio" name="status" value="inactive" <?php if ($frmData['status'] == "inactive") { ?> checked="checked"<?php } ?>/>
        <?php }?>
        Inactive <i class="fa fa-eye-slash"></i></label>
</div>
