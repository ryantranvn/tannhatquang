// list
if ($(idTableList).length>0 && $('.customer_list').length>0) {
    var statusStr = ":Tất cả;active:Hiện;inactive:Ẩn";
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
        colNames : ['Status', 'Họ tên', 'Điện thoại', 'Email', 'Địa chỉ', 'Quận', 'Tỉnh', 'Ngày', 'Action'],
        colModel : [
            { name : 'status', index : 'status', align : 'center', width : '80',
                stype: 'select', searchoptions:{ sopt:['eq'], value: statusStr }
            },
            { name : 'fullname', index : 'fullname', search : true, width : '200' },
            { name : 'phone', index : 'phone', search : true, align : 'center', width : '120' },
            { name : 'email', index : 'email', align : 'center', search : true, width : '200' },
            { name : 'address', index : 'address', align : 'center', search : true, width : '150' },
            { name : 'district', index : 'district', align : 'center', search : true, width : '100' },
            { name : 'province', index : 'province', align : 'center', search : true, width : '100' },
            { name : 'created_datetime', index : 'created_datetime', align : 'center', search : true, width : '200' },
            { name: "act", index: 'act', editable : false, search : false, width : '80', align : 'center' }
        ],
        rownumbers : true,
        rowNum : defaultNumRows,
        rowList : [10, 20, defaultNumRows],
        pager : idPager,
        sortname : 'id',
        sortorder : "asc",
        toolbarfilter : true,
        viewrecords : true,
        gridComplete : function() {
            var ids = jQuery(idTableList).jqGrid('getDataIDs');
            for (var i = 0; i < ids.length; i++) {
                var cl = ids[i];
                var rowData = jQuery(idTableList).jqGrid ('getRowData', cl);
                var fa = formatButton(cl, rowData.status, 'btnStatus', bUrl+currentModule['url']+'/ajax_status', 'modalStatus');
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

    // reload list on click tree item
    $('.tree').find('span').each( function() {
        $(this).click( function() {
            var path = $(this).attr('data-path');
            var filters = '{"groupOp":"AND", "rules":[{"field":"path","op":"cn","data": "'+path+'"}]}';
            jQuery(idTableList).jqGrid('setGridParam',{
                datatype: 'json',
                postData: {filters:filters},
                search: true
            }).trigger('reloadGrid');
        });
    });

    // fancy box
    $("a.groupFancyBox").fancybox();
}
// customer_form
    if ($('.customer_form').length>0) {
    // order table list
        if ($(idTableList).length>0) {
            var customer_id = $('#frmCustomer').find('input[name="customer_id"]').val();
            var statusStr = ":Tất cả;active:Hiện;inactive:Ẩn";
            caption = captionButton(false, true);
            // jqGrid
            jQuery(idTableList).jqGrid({
                url: bUrl + currentModule['url'] + '/ajax_order_list?q=2&customer_id='+customer_id,
                datatype: "json",
                height : 'auto',
                autowidth : true,
                shrinkToFit: false,
                gridResize: true,
                autoResizeAllColumns: true,
                iconSet: "fontAwesome",
                colNames : ['Status', 'Mã đơn hàng', 'Total', 'Ngày', 'Địa chỉ', 'Quận', 'Tỉnh', 'Action'],
                colModel : [
                    { name : 'status', index : 'status', align : 'center', width : '80',
                        stype: 'select', searchoptions:{ sopt:['eq'], value: statusStr }
                    },
                    { name : 'id', index : 'id', search : true, align : 'center', width : '150' },
                    { name : 'total', index : 'total', search : true, align : 'center', width : '120' },
                    { name : 'created_datetime', index : 'created_datetime', align : 'center', search : true, width : '200' },
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
                        var fa = formatButton(cl, rowData.status, 'btnStatus', bUrl+currentModule['url']+'/ajax_status', 'modalStatus');
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

        }
    }
