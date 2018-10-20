// list
    if ($(idTableList).length>0) {
        var statusStr = ":All;active:Active;inactive:Inactive";
        // if (permissionsMember[]
        caption = captionButton(true, true)

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
            colNames : ['Status', 'ID', 'Name', 'Parent','Order', 'Thumbnail', 'Action'],
            colModel : [{ name : 'status', index : 'status', align : 'center', width : '80',
                            stype: 'select', searchoptions:{ sopt:['eq'], value: statusStr }
                        },
                        { name : 'id', index : 'id', search : true, align : 'center', width : '60' },
                        { name : 'name', index : 'name', align : 'left', search : true, width : '150' },
                        { name : 'parent', index : 'parent', search : true, width : '150' },
                        { name : 'order', index : 'order', align : 'center', search : true, width : '60',
                            editable : true,
                            editoptions: { dataInit: function (elem) {
                                    setTimeout( function() {
                                        $(elem).numeric();
                                    }, 100);
                                }
                            }
                        },
                        { name : 'thumbnail', index : 'thumbnail', align : 'center', search : false, width : '100' },
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
            rowattr: function (rd) {
                if (rd.name=='Product' || rd.name=='News') {
                    return {
                        "class": "ui-state-disabled ui-jqgrid-disablePointerEvents"
                    };
                }
            },
            gridComplete : function() {
                jQuery(idTableList).find('tr.ui-state-disabled').each( function() {
                    $(this).find('td[aria-describedby="jqgrid_cb"]').children('.cbox').remove();
                });
                var ids = jQuery(idTableList).jqGrid('getDataIDs');
                for (var i = 0; i < ids.length; i++) {
                    var cl = ids[i];
                    var rowData = jQuery(idTableList).jqGrid ('getRowData', cl);
                    var fa = ""
                    if (cl > 2) {
                        var fa = formatButton(cl, rowData.status, 'btnStatus_', 'btnStatus', 'modalStatus')
                    }
                    var th = ""
                    if (rowData.thumbnail != "") {
                        th = '<img src="' + rowData.thumbnail + '" class="thumbInTable" />'
                    }
                    var btnInline = ""
                    if (cl > 2) {
                        btnInline = btnEditInline(cl) + bntDeleteInline(cl)
                    }
                    jQuery(idTableList).jqGrid('setRowData', ids[i], {
                        status : fa,
                        thumbnail : th,
                        act : btnInline
                    });

                }
            // btnStatus
                click_btnInGrid('btnStatus', 'modalStatus', bUrl+'category/ajax_status', function() {
                    location.reload();
                });
            },
            ajaxRowOptions: { async: true },
            caption : caption,
            multiselect : true,
            loadBeforeSend: function () {
                $(this).closest("div.ui-jqgrid-view").find("table.ui-jqgrid-htable>thead>tr>th").css({"text-align":"center"});
            },
            onSelectRow: function(id) {
            }
        });

    // common
        tableCommon();

    // delete inline
        $('body').on('click','.btnDelete', function(e) {
            e.preventDefault();

            href = $(this).attr('href');
            showSmartAlert("Warning", "<p>Delete a category may be effect to another data.</p><p>Are you sure delete this data ?</p>", '[YES][NO]', function() {
                // click YES
                window.location.href = href
            }, function() {// click CANCEL
            });
        });

    // multi-delete
        $('body').on('click', '#btnMultiDelete', function(e) {
            e.preventDefault();
            href = $(this).attr('href');

            selectedRows = jQuery(idTableList).jqGrid('getGridParam','selarrrow');
            if (selectedRows.length==0) {
                showSmartAlert("Error", "Please select data.", '[YES]');
            }
            else {
                showSmartAlert("Warning", "<p>Delete a category may be effect to another data.</p><p>Are you sure delete this data ?</p>", '[YES][NO]', function() {
                    // click YES
                    $('#ids').val(selectedRows);
                    $('#frmTopButtons').submit();
                }, function() {// click CANCEL
                });
            }
        });

    // reload list on click tree item
        $('.tree').find('span').each( function() {
            $(this).click( function() {
                if ($(this).attr('data-id')>2) {
                    var path = $(this).attr('data-path');
                    var filters = '{"groupOp":"AND", "rules":[{"field":"path","op":"cn","data": "'+path+'"}]}';
                    jQuery(idTableList).jqGrid('setGridParam',{
                        datatype: 'json',
                        postData: {filters:filters},
                        search: true
                    }).trigger('reloadGrid');
                }
            });
        });
    }

// frmCategory
    if ($('#frmCategory').length>0) {
    // generate URL
        gen_url($('input[name="name_category"]'), $('input[name="url_category"]'));

    // limit character
        $('input[name="name_category"]').limit('200','#name_category_limit');
        $('input[name="url_category"]').limit('200','#url_category_limit');
        $('textarea[name="desc_category"]').limit('1000','#desc_category_limit');

    // file
        selectFile('.btnSelectThumbnail', 'images')
        // delele single file
        $('body').on('click', '.thumbnailDel', function(e) {
            e.preventDefault();
            thumbnailWrapper = $(this).parent('.thumbnailItem').parent('.thumbnailWrapper');
            inputThumbnail = thumbnailWrapper.prev().children('.inputThumbnail');
            inputThumbnail.val('');
            thumbnailWrapper.html('').html(defaultIMG);
        });
    // validation
    //    $('textarea[name="desc_category"]').mouseleave( function () {
    //        console.log($(this).val())
    //    })
        var validator = $("#frmCategory").validate({
                        rules: {
                            name_category: {
                                required : true,
                                maxlength : 200
                            },
                            url_category: {
                                required: true,
                                maxlength : 200
                            },
                            desc_category: {
                                maxlength : 1000,
                            },
                        },
                        messages: {
                            name_category: {
                                required : "Name bắt buộc nhập",
                                maxlength : "Tối đa 200 ký tự"
                            },
                            url_category: {
                                required : "URL bắt buộc nhập",
                                maxlength : "Tối đa 200 ký tự"
                            },
                            desc_category: {
                                maxlength : "Tối đa 1000 ký tự"
                            },
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
                            $.ajax({
                                url: bUrl + 'category/update',
                                type: 'POST',
                                cache: false,
                                dataType: 'json',
                                data: { 'csrf_hash' : $.cookie('csrf_cookie_ci'),
                                        'id': $('input[name="id_category"]').val(),
                                        'name': $('input[name="name_category"]').val(),
                                        'url' : $('input[name="url_category"]').val(),
                                        'desc': $('textarea[name="desc_category"]').val(),
                                        'thumbnail': $('input[name="thumbnail"]').val(),
                                        'order': $('input[name="order"]').val(),
                                        'status': $('input[name="status"]:checked').val(),
                                        //'selected_category_id': $('input[name="selected_category_id"]').val()
                                        //'selected_category_name': $('input[name="selected_category_name"]').val(),
                                        'parent_id': $('select[name="parent_id"]').val()
                                      },
                                success: function(data) {
                                    if (data.err==1) {
                                        showSmartAlert("Error", data.msg, '[YES]')
                                    }
                                    else {
                                        window.location.href = bUrl + currentModule['url'];
                                    }
                                },
                                error: function() {
                                    showSmartAlert("Error", "Can send data. Please contact to admin.", '[YES]')
                                }
                            });
                            return false;
                        }
                    });
    }
