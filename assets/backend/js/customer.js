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
            var statusStr = ":Tất cả;1:Mới;2:Đã xem;3:Đã liên lạc;4:Đã xác nhận;5:Đang chuyển hàng;6:Đã nhận hàng;7:Đã thanh toán;8:Đã hủy";
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
    }
// frmCustomerAddress
    if ($('#frmCustomerAddress').length>0) {
        var customer_id = $('#frmCustomer').find('input[name="customer_id"]').val();
    // click edit customer address
        $('.btnEdit').click( function() {
            var address_id = $(this).find('.address_id').html();
            var address = $(this).find('.address').html();
            var province_id = $(this).find('.province_id').html();
            var district_id = $(this).find('.district_id').html();
            $('#frmCustomerAddress').find('input[name="current_address_id"]').val(address_id.trim());
            $('#frmCustomerAddress').find('input[name="current_address"]').val(address.trim());
            $('#frmCustomerAddress').find('input[name="current_province_id"]').val(province_id.trim());
            $('#frmCustomerAddress').find('input[name="current_district_id"]').val(district_id.trim());
        });
    // set default value of address modal
        $('#modal_address').on('show.bs.modal', function (e) {
            $('input[name="address"]').val($('#frmCustomerAddress').find('input[name="current_address"]').val());
            var province_id = $('#frmCustomerAddress').find('input[name="current_province_id"]').val();
            $('select[name="province_id"]').select2('val',province_id);
            var district_id = $('#frmCustomerAddress').find('input[name="current_district_id"]').val();
            if (province_id != "") {
                $.ajax({
                    url: fUrl + 'ajax_get_district',
                    type: 'POST',
                    cache: false,
                    dataType: 'json',
                    data: {
                        'province_id': province_id,
                        'csrf_hash': $.cookie('csrf_cookie_ci')
                    },
                    success: function (data) {
                        if (typeof data == 'object') {
                            var district_list = "";
                            $.each(data, function (index, item) {
                                district_list += "<option value='" + item['id'] + "'>" + item['text'] + "</option>"
                            });
                            $('select[name="district_id"]').html('').html(district_list).promise().done(function () {
                                $('select[name="district_id"]').select2('val', district_id);
                            });
                        }
                    },
                    error: function () {
                        showSmartAlert("Error", "Can send data. Please contact to admin.", '[YES]')
                    }
                });
            }
        });
    // bind district from province
        $('#frmCustomerAddress').find('select[name="province_id"]').change( function() {
            var province_id = $(this).val();
            $('select[name="district_id"]').select2('val','');
            $.ajax({
                url: fUrl + 'ajax_get_district',
                type: 'POST',
                cache: false,
                dataType: 'json',
                data: {
                    'province_id' : province_id,
                    'csrf_hash' : $.cookie('csrf_cookie_ci')
                },
                success: function(data) {
                    if(typeof data =='object') {
                        var district_list = "";
                        $.each(data, function(index, item) {
                            district_list += "<option value='"+item['id']+"'>"+item['text']+"</option>"
                        });
                        $('select[name="district_id"]').html('').html(district_list)
                    }
                },
                error: function() {
                    showSmartAlert("Error", "Can send data. Please contact to admin.", '[YES]')
                }
            });
        });
    // validation and submit
        var validator = $("#frmCustomerAddress").validate({
            rules: {
                address: {
                    required : true,
                    maxlength : 512
                },
                province_id: {
                    required : true
                },
                district_id: {
                    required: true
                }
            },
            messages: {
                address: {
                    required : "Địa chỉ bắt buộc nhập",
                    maxlength : "Tối đa 512 ký tự"
                },
                province_id: {
                    required : "Tỉnh/Thành phố bắt buộc chọn"
                },
                district_id: {
                    required : "Tỉnh/Thành phố bắt buộc chọn"
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
                var address_id = $('input[name="current_address_id"]').val();
                $.ajax({
                    url: bUrl + 'customer/update_customer_address',
                    type: 'POST',
                    cache: false,
                    dataType: 'json',
                    data: {'csrf_hash' : $.cookie('csrf_cookie_ci'),
                        'customer_id': customer_id,
                        'address_id': address_id,
                        'province_id': $('select[name="province_id"]').select2('val'),
                        'district_id': $('select[name="district_id"]').select2('val'),
                        'address': $('input[name="address"]').val()
                    },
                    success: function(data) {
                        if (data.err=="1") {
                            showSmartAlert("Error", data.msg, '[YES]');
                        }
                        else {
                            window.location.href = bUrl + currentModule['url'] + '/edit/' + customer_id;
                        }
                    },
                    error: function() {
                        showSmartAlert("Error", "Can send data. Please contact to admin.", '[YES]')
                    }
                });
                return false;
            }
        });
    // delete address
        $('.btnDelete').click( function() {
            var address_id = $(this).find('.address_id').html().trim();
            showSmartAlert("Xóa địa chỉ", "Bạn có chắc muốn xóa địa chỉ này ?", '[YES][NO]', function() {
                window.location.href = bUrl + currentModule['url'] + '/delete_address/' + address_id;
            });
        });
    }