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
            { name : 'total', index : 'total', search : true, align : 'center', width : '120' },
            { name : 'created_datetime', index : 'created_datetime', align : 'center', search : true, width : '200' },
            { name : 'fullname', index : 'fullname', align : 'center', search : true, width : '150' },
            { name : 'phone', index : 'phone', align : 'center', search : true, width : '150' },
            { name : 'address', index : 'address', align : 'center', search : true, width : '150' },
            { name : 'district', index : 'district', align : 'center', search : true, width : '100' },
            { name : 'province', index : 'province', align : 'center', search : true, width : '100' },
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
                var fa = formatOrderStatusButton(cl, rowData.status, 'btnOrderStatus', bUrl+currentModule['url']+'/ajax_status', 'modalStatus');
                var btnInline = btnEditInline(cl) + bntDeleteInline(cl);
                jQuery(idTableList).jqGrid('setRowData', ids[i], {
                    status : fa,
                    act : btnInline
                });
            }
            // btnStatus
            click_btnInGrid('modalStatus', function() {
                location.reload();
            });
        },
        ajaxRowOptions: { async: true },
        caption : caption,
        multiselect : true,
        loadBeforeSend: function () {
            $(this).closest("div.ui-jqgrid-view").find("table.ui-jqgrid-htable>thead>tr>th").css({"text-align":"center"});
        },
        // onSelectRow: function(id) {
        // },
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
    selectFile('.btnSelectThumbnail', 'file', true, false);