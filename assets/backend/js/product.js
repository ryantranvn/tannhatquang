// list
    if ($(idTableList).length>0) {
        var statusStr = ":Tất cả;active:Hiện;inactive:Ẩn";
        var hotStr = ":Tất cả;1:Nổi bật;0:Thường";
        caption = captionButton(true, true);
        caption += captionImport(currentModule['module']);
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
            colNames : ['Status', 'Nổi bật', 'Chuyên mục', 'Mã SP', 'Tên SP', 'Đơn vị', 'Số lượng', 'Tồn kho', 'Giá', 'Giá KM', 'Thứ tự', 'Hình', 'Action'],
            colModel : [{ name : 'status', index : 'status', align : 'center', width : '80',
                            stype: 'select', searchoptions:{ sopt:['eq'], value: statusStr }
                        },
                        { name : 'hot_flg', index : 'hot_flg', align : 'center', width : '80',
                            stype: 'select', searchoptions:{ sopt:['eq'], value: hotStr }
                        },
                        { name : 'category', index : 'category', search : true, width : '100' },
                        { name : 'code', index : 'code', search : true, align : 'center', width : '60' },
                        { name : 'name', index : 'name', align : 'left', search : true, width : '150' },
                        { name : 'unit', index : 'unit', align : 'center', search : true, width : '60' },
                        { name : 'quantity', index : 'quantity', align : 'right', search : true, width : '60' },
                        { name : 'stock_in_trade', index : 'stock_in_trade', align : 'right', search : true, width : '60' },
                        { name : 'price', index : 'price', align : 'right', search : true, width : '60' },
                        { name : 'price_sale', index : 'price_sale', align : 'right', search : true, width : '60' },
                        { name : 'order', index : 'order', align : 'center', search : true, width : '60',
                            editable : true,
                            editoptions: { dataInit: function (elem) {
                                    setTimeout( function() {
                                        $(elem).numeric();
                                    }, 100);
                                }
                            }
                        },
                        { name : 'pictures', index : 'pictures', align : 'center', search : false, width : '100' },
                        { name: "act", index: 'act', editable : false, search : false, width : '80', align : 'center' }
            ],
            rownumbers : true,
            rowNum : defaultNumRows,
            rowList : [10, 20, defaultNumRows],
            pager : idPager,
            sortname : 'code',
            sortorder : "asc",
            toolbarfilter : true,
            viewrecords : true,
            gridComplete : function() {
                var ids = jQuery(idTableList).jqGrid('getDataIDs');
                for (var i = 0; i < ids.length; i++) {
                    var cl = ids[i];
                    var rowData = jQuery(idTableList).jqGrid ('getRowData', cl);
                    var fa = formatButton(cl, rowData.status, 'btnStatus', bUrl+currentModule['url']+'/ajax_status', 'modalStatus');
                    var ht = formatButton(cl, rowData.hot_flg, 'btnHot', bUrl+currentModule['url']+'/ajax_hot', 'modalStatus');
                    var th = "";
                    var arr = rowData.pictures.split(',');
                    if (arr != undefined && arr.length>0) {
                        $.each(arr, function( index, url ) {
                            th += '<a class="groupFancyBox" href="' + url + '" rel="image-'+i+'"><img src="' + url + '" class="smalThumbInTable" /></a>'
                        });
                    }
                    var btnInline = btnEditInline(cl) + bntDeleteInline(cl);
                    jQuery(idTableList).jqGrid('setRowData', ids[i], {
                        status : fa,
                        hot_flg : ht,
                        pictures : th,
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
            }
            // onSelectRow: function(id) {
            // },
            //editurl: "server.php"
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

// frmProduct
    if ($('#frmProduct').length>0) {
            // justAlphaNum($('input[name=code_product]'));
        // generate URL
            gen_url($('input[name="name_product"]'), $('input[name="url_product"]'));
        // preventBeginWith
            preventBeginWith('input[name=price_product]', 48);
            preventBeginWith('input[name=price_product_sale]', 48);
            preventBeginWith('input[name=price_product_sale_percent]', 48);
            preventBeginWith('input[name=quantity_product]', 48);
        // limit character
            $('input[name="code_product"]').limit('20','#code_product_limit');
            $('input[name="manufacturer_product"]').limit('200','#manufacturer_product_limit');
            $('input[name="name_product"]').limit('200','#name_product_limit');
            $('input[name="url_product"]').limit('200','#url_product_limit');
            $('textarea[name="desc_product"]').limit('1000','#desc_product_limit');
        // have_sale
            if ($('#have_sale').is(":checked")) {
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
            selectFile('.btnSelectThumbnail', 'images', true, false);
            // delele file
            $('body').on('click', '.thumbnailDel', function(e) {
                e.preventDefault();

                var thumbnailItem = $(this).parent('.thumbnailItem');
                var thumbnailWrapper = thumbnailItem.parent('.thumbnailWrapper');
                var inputThumbnail = thumbnailWrapper.prev().children('.inputThumbnail');
                //
                var obj = JSON.parse(inputThumbnail.val());

                if (obj.length == 1) {
                    inputThumbnail.val('')
                }
                else {
                    var imgSrc = thumbnailItem.find('img').attr('src');
                    var index = obj.indexOf(imgSrc);
                    obj.splice(index, 1);
                    if (obj.length>0) {
                        inputThumbnail.val(JSON.stringify(obj))
                    }
                }
                thumbnailItem.remove();
                if ($('.thumbnailItem').length==0) {
                    thumbnailWrapper.html('').html(defaultIMG)
                }
            });
        // editor
			var editor = CKEDITOR.replace( 'content_product', {
	            entities_latin: false,
	            entities_greek: false,
	            toolbar: 'Full'
	        })
        // validation
            var $validator = $("#frmProduct").validate({
                rules: {
                    code_product: {
                        required : true,
                        maxlength : 20
                    },
                    name_product: {
                        required : true,
                        maxlength : 200
                    },
                    url_product: {
                        required: true,
                        maxlength : 200
                    },
                    desc_product: {
                        maxlength : 1000,
                    }
                },
                messages: {
                    code_product: {
                        required : "Mã sản phẩm bắt buộc nhập",
                        maxlength : "Tối đa 20 ký tự"
                    },
                    name_product: {
                        required : "Name bắt buộc nhập",
                        maxlength : "Tối đa 200 ký tự"
                    },
                    url_product: {
                        required : "URL bắt buộc nhập",
                        maxlength : "Tối đa 200 ký tự"
                    },
                    desc_product: {
                        maxlength : "Tối đa 1000 ký tự"
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
                    $.ajax({
                        url: bUrl + 'product/update',
                        type: 'POST',
                        cache: false,
                        dataType: 'json',
                        data: {'csrf_hash' : $.cookie('csrf_cookie_ci'),
                            'post_id': $('input[name="post_id"]').val(),
                            'code': $('input[name="code_product"]').val(),
                            'manufacturer': $('input[name="manufacturer_product"]').val(),
                            'name': $('input[name="name_product"]').val(),
                            'url' : $('input[name="url_product"]').val(),
                            'desc': $('textarea[name="desc_product"]').val(),
                            'price' : $('input[name="price_product"]').val(),
                            'price_sale' : $('input[name="price_product_sale"]').val(),
                            'price_sale_percent' : $('input[name="price_product_sale_percent"]').val(),
                            'quantity' : $('input[name="quantity_product"]').val(),
                            'unit' : $('input[name="unit_product"]').val(),
                            'thumbnail': $('input[name="thumbnail"]').val(),
                            'order': $('input[name="order"]').val(),
                            'status': $('input[name="status"]:checked').val(),
                            'category_id': $('input[name="selected_category_id"]').val(),
                            'category_name': $('input[name="selected_category_name"]').val(),
                            'detail': editor.getData()
                            },
                        success: function(data) {
                            if (data.err=="1") {
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
