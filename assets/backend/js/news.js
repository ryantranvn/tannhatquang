// list
    if ($(idTableList).length>0) {
        var statusStr = ":All;active:Active;inactive:Inactive";
        caption = captionButton(true, true);
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
            colNames : ['Status', /*'Chuyên mục',*/ 'Tiêu đề', 'Thứ tự', 'Hình', 'Action'],
            colModel : [{ name : 'status', index : 'status', align : 'center', width : '80',
                            stype: 'select', searchoptions:{ sopt:['eq'], value: statusStr }
                        },
                        // { name : 'category', index : 'category', search : true, width : '100' },
                        { name : 'title', index : 'title', align : 'left', search : true, width : '450' },
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
            sortorder : "desc",
            toolbarfilter : true,
            viewrecords : true,
            gridComplete : function() {
                var ids = jQuery(idTableList).jqGrid('getDataIDs');
                for (var i = 0; i < ids.length; i++) {
                    var cl = ids[i];
                    var rowData = jQuery(idTableList).jqGrid ('getRowData', cl);
                    var fa = ""
                    var fa = formatButton(cl, rowData.status, 'btnStatus_', 'btnStatus', 'modalStatus')
                    var th = ""
                    if (rowData.thumbnail != "") {
                        th = '<img src="' + rowData.thumbnail + '" class="thumbInTable" />'
                    }
                    var btnInline = btnEditInline(cl) + bntDeleteInline(cl)
                    jQuery(idTableList).jqGrid('setRowData', ids[i], {
                        status : fa,
                        thumbnail : th,
                        act : btnInline
                    });

                }
            // btnStatus
                click_btnInGrid('btnStatus', 'modalStatus', bUrl+currentModule['url']+'/ajax_status', function() {
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
            href = $(this).attr('href');

            selectedRows = jQuery(idTableList).jqGrid('getGridParam','selarrrow');
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

// frmNews
    if ($('#frmNews').length>0) {
    // generate URL
        gen_url($('input[name="title"]'), $('input[name="url"]'));
    // limit character
        $('input[name="title"]').limit('200','#title_limit');
        $('input[name="url"]').limit('200','#url_limit');
        $('textarea[name="desc"]').limit('1000','#desc_limit');
    // editor
        var editor = CKEDITOR.replace( 'detail', {
            entities_latin: false,
            entities_greek: false,
            toolbar: 'Full'
        });
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
        var validator = $("#frmNews").validate({
                        rules: {
                            title: {
                                required : true,
                                maxlength : 200
                            },
                            url: {
                                required: true,
                                maxlength : 200
                            },
                            desc: {
                                maxlength : 1000,
                            },
                        },
                        messages: {
                            title: {
                                required : "Tiêu đề bắt buộc nhập",
                                maxlength : "Tối đa 200 ký tự"
                            },
                            url: {
                                required : "URL bắt buộc nhập",
                                maxlength : "Tối đa 200 ký tự"
                            },
                            desc: {
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
                                url: bUrl + 'news/update',
                                type: 'POST',
                                cache: false,
                                dataType: 'json',
                                data: { 'csrf_hash' : $.cookie('csrf_cookie_ci'),
                                        'id': $('input[name="id"]').val(),
                                        'title': $('input[name="title"]').val(),
                                        'url' : $('input[name="url"]').val(),
                                        'desc': $('textarea[name="desc"]').html(),
                                        'thumbnail': $('input[name="thumbnail"]').val(),
                                        'order': $('input[name="order"]').val(),
                                        'status': $('input[name="status"]:checked').val(),
                                        // 'category_id': $('input[name="selected_category_id"]').val(),
                                        // 'category_name': $('input[name="selected_category_name"]').val(),
                                        'detail': editor.getData()
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
