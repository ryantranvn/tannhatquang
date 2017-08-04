
// list
    if ($(idTableList).length>0) {
        var statusStr = ":All;active:Active;inactive:Inactive";
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
            colNames : ['Status', 'ID', 'Name', 'Category','Order', 'Thumbnail', 'Action'],
            colModel : [{ name : 'status', index : 'status', align : 'center', width : '80',
                            stype: 'select', searchoptions:{ sopt:['eq'], value: statusStr }
                        },
                        { name : 'id', index : 'id', search : true, align : 'center', width : '60' },
                        { name : 'name', index : 'name', align : 'left', search : true, width : '150' },
                        { name : 'category', index : 'category', search : true, width : '150' },
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
            gridComplete : function() {
                var ids = jQuery(idTableList).jqGrid('getDataIDs');
                for (var i = 0; i < ids.length; i++) {
                    var cl = ids[i];
                    var rowData = jQuery(idTableList).jqGrid ('getRowData', cl);
                    var fa = ""
                    if (cl > 3) {
                        var fa = formatButton(cl, rowData.status, 'btnStatus_', 'btnStatus', 'modalStatus')
                    }
                    var th = ""
                    if (rowData.thumbnail != "") {
                        th = '<img src="' + rowData.thumbnail + '" class="thumbInTable" />'
                    }
                    var btnInline = ""
                    if (cl > 3) {
                        btnInline = btnEditInline(cl) + bntDeleteInline(cl)
                    }
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
            // editurl : bUrl + module + '/edit_inline',
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
            showSmartAlert("Warning", "<p>Delete a category may be effect to another data.</p><p>[YES] : Delete all children.<br/>[NO] : Just delete this category.<br/>[CANCEL] : Cancel delete action.</p><p>Are you sure delete this data ?</p>", '[YES][NO][CANCEL]', function() {
                // click YES
                window.location.href = href + '?dc=1'
            }, function() {
                // click NO
                window.location.href = href + '?dc=0'
            }, function() {
                // click CANCEL
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
                showSmartAlert("Warning", "<p>Delete categories maybe effect to another data.</p><p>[YES] : Delete all children.<br/>[NO] : Just delete selected categories.<br/>[CANCEL] : Cancel delete action.</p><p>Are you sure delete data ?</p>", '[CANCEL][NO][YES]', function() {
                    // click YES
                    $('#ids').val(selectedRows)
                }, function() {
                    // click NO
                    $('#ids').val(selectedRows);
                    $('#frmTopButtons').submit();
                }, function() {
                    // click CANCEL
                });
            }
        });

    }
// common of add & edit
    if ($('#add').length>0 || $('#edit').length>0) {
        // tree view
            treeView();

        // generate URL
            gen_url($('input[name="name_product"]'), $('input[name="url_product"]'));

            preventBeginWith('input[name=price_product]', 48);
            preventBeginWith('input[name=price_product_sale]', 48);
            preventBeginWith('input[name=price_product_sale_percent]', 48);
        // limit character
            $('input[name="code_product"]').limit('20','#code_product_limit');
            $('input[name="manufacturer_product"]').limit('200','#manufacturer_product_limit');
            $('input[name="name_product"]').limit('200','#name_product_limit');
            $('input[name="url_product"]').limit('200','#url_product_limit');
            $('textarea[name="desc_product"]').limit('1000','#desc_product_limit');

        // have_sale
            $('label[for=have_sale]').click( function() {
                if (!$('#have_sale').is(":checked")) {
                    $('#sale_wrap').show();
                    $('input[name="have_sale"]').val(1);
                    $('input[name=price_product]').addClass('strikethrough');
                }
                else {
                    $('#sale_wrap').hide();
                    $('input[name="have_sale"]').val(0);
                    $('input[name=price_product]').removeClass('strikethrough');
                    $('input[name=price_product_sale]').val('');
                    $('input[name=price_product_sale_percent]').val('');
                }
            });
            preventLongMore_Number('input[name=price_product_sale_percent]', 2);
        // file
            selectFile('.btnSelectThumbnail', 'images', true)
            // delele file
            $('body').on('click', '.thumbnailDel', function(e) {
                e.preventDefault();
                thumbnailWrapper = $(this).parent('.thumbnailWrapper')
                inputThumbnail = thumbnailWrapper.prev().children('.inputThumbnail')

                inputThumbnail.val('')
                thumbnailWrapper.html('').html(defaultIMG)
            });
        // editor
			CKEDITOR.replace( 'content_product', {
	            entities_latin: false,
	            entities_greek: false,
	            toolbar: 'Full'
	        })
            // validation
            // var $validator = $("#frmProduct").validate({
            //     rules: {
            //         name_product: {
            //             required : true,
            //             maxlength : 200
            //         },
            //         url_product: {
            //             required: true,
            //             maxlength : 200
            //         },
            //         desc_product: {
            //             maxlength : 1000,
            //         }
            //     },
            //     messages: {
            //         name_product: {
            //             required : "Name is required",
            //             maxlength : "Maximum is 200 characters"
            //         },
            //         url_product: {
            //             required : "URL is required",
            //             maxlength : "Maximum is 200 characters"
            //         },
            //         desc_product: {
            //             maxlength : "Maximum is 1000 characters"
            //         }
            //     },
            //     highlight: function (element) {
            //         $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            //     },
            //     unhighlight: function (element) {
            //         $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            //     },
            //     errorElement: 'span',
            //     errorClass: 'help-block',
            //     errorPlacement: function (error, element) {
            //         if (element.parent('.input-group').length) {
            //             error.insertAfter(element.parent());
            //         } else {
            //             error.insertAfter(element);
            //         }
            //     },
            //     submitHandler: function(form) {
            //         /*
            //         $.ajax({
            //             // url: apiUrl + 'API_category/post_category',
            //             url: bUrl + 'category/update',
            //             type: 'POST',
            //             cache: false,
            //             dataType: 'json',
            //             data: { 'csrf_hash' : $.cookie('csrf_cookie_ci'),
            //                     'action': $('input[name=action]').val(),
            //                     // 'id': $('input[name=id]').val(),
            //                     // 'name': $('input[name=name]').val(),
            //                     // 'url' : $('input[name=url]').val(),
            //                     // 'desc': $('textarea[name=desc]').val(),
            //                     // 'thumbnail': $('input[name=thumbnail]').val(),
            //                     // 'order': $('input[name=order]').val(),
            //                     // 'status': $('input[name=status]:checked').val(),
            //                     // 'parent_id': $('input[name=parent_id]').val()
            //                   },
            //             success: function(data) {
            //                 if (data.err=="1") {
            //                     showSmartAlert("Error", data.msg, '[YES]')
            //                 }
            //                 else {
            //                     window.location.href = bUrl + currentModule['url'];
            //                 }
            //             },
            //             error: function() {
            //                 showSmartAlert("Error", "Can send data. Please contact to admin.", '[YES]')
            //             }
            //         });
            //         */
            //         return false;
            //     }
            // });
    }
