// list
if ($(idTableList).length>0) {
    var customer_id = $('#frmCustomer').find('input[name="customer_id"]').val();
    caption = captionButton(false, true);
    // jqGrid
    jQuery(idTableList).jqGrid({
        url: bUrl + currentModule['url'] + '/ajax_list?q=2',
        datatype: "json",
        height : 'auto',
        autowidth : true,
        shrinkToFit: false,
        gridResize: true,
        autoResizeAllColumns: true,
        iconSet: "fontAwesome",
        colNames : ['ID', 'Tiêu đề', 'Mô tả', 'File', 'Thứ tự', 'Action'],
        colModel : [
            { name : 'id', index : 'id', search : true, align : 'center', width : '150' },
            { name : 'title', index : 'title', search : true, align : 'center', width : '120' },
            { name : 'desc', index : 'desc', align : 'center', search : true, width : '200' },
            { name : 'filename', index : 'filename', align : 'center', search : true, width : '150' },
            { name : 'order', index : 'order', align : 'center', search : true, width : '100' },
            { name: "act", index: 'act', editable : false, search : false, width : '80', align : 'center' }
        ],
        rownumbers : true,
        rowNum : defaultNumRows,
        rowList : [10, 20, defaultNumRows],
        pager : idPager,
        sortname : 'id',
        sortorder : "desc",
        toolbarfilter : true,
        viewrecords : true,
        gridComplete : function() {
            var ids = jQuery(idTableList).jqGrid('getDataIDs');
            for (var i = 0; i < ids.length; i++) {
                var cl = ids[i];
                var btnInline = btnEditInline(cl) + bntDeleteInline(cl);
                jQuery(idTableList).jqGrid('setRowData', ids[i], {
                    act : btnInline
                });
            }
        },
        ajaxRowOptions: { async: true },
        caption : caption,
        multiselect : true,
        loadBeforeSend: function () {
            $(this).closest("div.ui-jqgrid-view").find("table.ui-jqgrid-htable>thead>tr>th").css({"text-align":"center"});
        }
    });

    // common
    tableCommon();

    // delete inline
    $('body').on('click','.btnDelete', function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        showSmartAlert("Warning", "<p>Are you sure delete this data ?</p>", '[YES][NO]', function() {
            // click YES
            window.location.href = href
        }, function() {
            // click NO
        });
    });

    // multi-delete
    $('body').on('click', '#btnMultiDelete', function(e) {
        e.preventDefault();
        var href = $(this).attr('href');

        var selectedRows = jQuery(idTableList).jqGrid('getGridParam','selarrrow');
        if (selectedRows.length==0) {
            showSmartAlert("Error", "Please select data.", '[YES]');
        }
        else {
            showSmartAlert("Warning", "<p>Are you sure delete this data ?</p>", '[YES][NO]', function() {
                // click YES
                $('#ids').val(selectedRows);
                $('#frmTopButtons').submit();
            }, function() {
                // click NO
            });
        }
    });
}
// limit character
    $('input[name="title"]').limit('1024','#title_limit');
// file
    selectFile('.btnSelectThumbnail', 'docs', true, false);
// validator
    var validator = $("#frmModule").validate({
        rules: {
            title: {
                required: true
            }
        },
        messages: {
            name_module: {
                required : "Tiêu đề không được rỗng"
            }
        },
        highlight: function (element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });