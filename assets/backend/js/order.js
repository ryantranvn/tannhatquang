// list
if ($(idTableList).length>0) {
    var customer_id = $('#frmCustomer').find('input[name="customer_id"]').val();
    var statusStr = ":Tất cả;1:Mới;2:Đã xem;3:Đã liên lạc;4:Đã xác nhận;5:Đang chuyển hàng;6:Đã nhận hàng;7:Đã thanh toán;8:Đã hủy";
    caption = captionButton(false, true);
    // jqGrid
    jQuery(idTableList).jqGrid({
        url: bUrl + currentModule['url'] + '/ajax_list?q=2&customer_id='+customer_id,
        datatype: "json",
        height : 'auto',
        autowidth : true,
        shrinkToFit: false,
        gridResize: true,
        autoResizeAllColumns: true,
        iconSet: "fontAwesome",
        colNames : ['Status', 'Mã đơn hàng', 'Total', 'Ngày', 'Địa chỉ', 'Quận', 'Tỉnh', 'Action'],
        colModel : [
            { name : 'status', index : 'status', align : 'center', width : '140',
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

}