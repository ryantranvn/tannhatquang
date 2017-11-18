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
            { name : 'id', index : 'id', search : true, align : 'center', width : '50' },
            { name : 'title', index : 'title', search : true, align : 'left', width : '120' },
            { name : 'desc', index : 'desc', align : 'left', search : true, width : '200' },
            { name : 'filename', index : 'filename', align : 'center', search : true, width : '80' },
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
                var rowData = jQuery(idTableList).jqGrid ('getRowData', cl);
                var btnInline = btnEditInline(cl) + bntDeleteInline(cl);
                var file = '<a href="'+rowData.filename+'" target="_blank" class="link_in_table"><i class="fa fa-cloud-download"></i></i></a>'
                jQuery(idTableList).jqGrid('setRowData', ids[i], {
                    act : btnInline,
                    filename : file
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

    // edit
    $('body').on('click', '.btnEdit', function(e) {
        e.preventDefault();
        id = $(this).attr('data-id')
        $.ajax({
            url: bUrl + 'price_list/ajax_get_edit',
            type: 'POST',
            cache: false,
            dataType: 'json',
            data: {
                'id': id,
                'csrf_hash': $.cookie('csrf_cookie_ci')
            },
            success: function (data) {
                if (data.err==1) {
                    showSmartAlert("Error", data.msg, '[YES]');
                }
                else {
                    $('input[name="csrf_hash"]').val($.cookie('csrf_cookie_ci'));
                    var price_list = data.price_list;
                    $('#frmPriceList input[name="title"]').val(price_list.title);
                    $('#frmPriceList input[name="filename"]').val(price_list.filename);
                    $('#frmPriceList textarea[name="desc"]').val(price_list.desc);
                    $('#frmPriceList input[name="order"]').val(price_list.order);

                    $('#frmPriceList input[name="id"]').val(id);
                }
            }
        });
    });
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
// file uploads
    selectFile('.btnSelectThumbnail', 'docs', false, false);
// validator
    var validator = $("#frmPriceList").validate({
        rules: {
            title: {
                required: true
            }
        },
        messages: {
            title: {
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