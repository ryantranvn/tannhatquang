<div class="wrap_tree widget-body">
    <div class="tree smart-form">
        <ul>
            <li>
                <span id="root" data-id="0" data-path="0-"><i class="fa fa-sm fa-minus-circle"></i> ROOT</span>
                <?php if (count($categories)>=1) { ?>
                <ul>
                    <li>
                        <span data-id="<?=$categories[0]['id']?>" data-path="<?=$categories[0]['path']?>" data-indent="<?=$categories[0]['indent']?>">
                            <i class="fa fa-lg fa-plus-circle"></i> <?=$categories[0]['name']?>
                        </span>
                        <?php for($i=1; $i<=count($categories)-1; $i++) { ?>
                            <?php if ($categories[$i]['indent'] == $categories[$i-1]['indent']) { ?>
                            </li><li>
                            <?php } else if ($categories[$i]['indent'] > $categories[$i-1]['indent']) { ?>
                            <ul><li>
                            <?php } else { ?>
                                <?php for ($j=0; $j<($categories[$i-1]['indent']-$categories[$i]['indent']); $j++) { ?>
                                </li></ul>
                                <?php } ?>
                            <li>
                            <?php } ?>
                            <span data-id="<?=$categories[$i]['id']?>" data-path="<?=$categories[$i]['path']?>" data-indent="<?=$categories[$i]['indent']?>">
                                <i class="fa fa-lg fa-plus-circle"></i> <?=$categories[$i]['name']?>
                            </span>
                        <?php } ?>
                    </li>
                </ul>
                <?php } ?>
            </li>
        </ul>
    </div>
    <input type="text" name="selected_category_id" class="hiddenInput" value="<?=$selected_category_id?>" />
    <input type="text" name="parent_id" class="hiddenInput" value="<?=$parent_id?>" />
    <input type="text" id="is_sub_category" class="hiddenInput" value="<?=$is_sub_category?>" />
    <? if (isset($is_post)) { ?>
    <input type="text" id="is_post" class="hiddenInput" value="<?=$is_post?>" />
    <? } ?>
</div>
