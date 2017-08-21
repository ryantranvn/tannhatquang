<!-- widget div-->
<div id="wrap_table_list">

    <!-- widget content -->
        <div class="widget-body">
            <table id="jqgrid"></table>
            <div id="pjqgrid"></div>
        <!-- for multi delete -->
        <?php if (isset($frmTopButtons)) { ?>
            <?=$frmTopButtons['open']?>
                <input type="text" name="ids[]" id="ids" class="hiddenInput" />
            <?=$frmTopButtons['close']?>
        <? } ?>
        <!-- Import -->
        <?php if (isset($frmImport)) { ?>
            <?=$frmImport['open']?>
                <input type="file" name="importFile" class="hiddenInput" />
            <?=$frmImport['close']?>
        <? } ?>
        </div>
    <!-- end widget content -->
    <!-- Modal -->
        <div class="modal fade" id="modalStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <? foreach ($statusArr as $status) {
                            echo $status;
                        } ?>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    <!-- /.modal -->
</div>
<!-- end widget div -->
