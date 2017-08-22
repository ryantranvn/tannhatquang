// list
    // var activeStr = ":All;1:Active;0:Lock";
    caption = captionButton(false, false)

    // set column
        jQuery("#jqgrid").jqGrid({
            url: bUrl + currentModule['url'] + '/ajax_list?q=2',
            datatype: "json",
            height : 'auto',
            autowidth : true,
            shrinkToFit: false,
            gridResize: true,
            autoResizeAllColumns: true,
            iconSet: "fontAwesome",
            colNames : ['Name', 'URL', 'Icon', 'Desc', 'Order', 'Action'],
            colModel : [{ name : 'name', index : 'name', align : 'left', search : true, width : '150' },
                        { name : 'url', index : 'url', align : 'left', search : true, width : '150' },
                        { name : 'icon', index : 'icon', align : 'center', search : false, width : '50' },
                        { name : 'desc', index : 'desc', align : 'left', search : true, width : '200' },
                        { name : 'order', index : 'order', align : 'center', search : true, width : '50' },
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
                var ids = jQuery("#jqgrid").jqGrid('getDataIDs');
                for (var i = 0; i < ids.length; i++) {
                    var cl = ids[i];
                    var rowData = jQuery(idTableList).jqGrid ('getRowData', cl);

                    if (cl > 6) {
                        var btnInline = btnEditInline(cl) + bntDeleteInline(cl)
                    }
                    else {
                        var btnInline = "";
                    }
                    ico = '<i class="'+rowData.icon+'" />'

                    jQuery("#jqgrid").jqGrid('setRowData', ids[i], {
                        act : btnInline,
                        icon : ico
                    });
                }
            },
            ajaxRowOptions: { async: true },
            caption : caption,
            multiselect : false,
            // editurl : bUrl + module + '/edit_inline',
            loadBeforeSend: function () {
                $(this).closest("div.ui-jqgrid-view").find("table.ui-jqgrid-htable>thead>tr>th").css({"text-align":"center"});
            }
        });

    // common
        tableCommon();

    // clear
        $('body').on('click', '.btnClear', function(e) {
            e.preventDefault();
            $('input[name="name_module"], input[name="url"], input[name="icon"], input[name="id"]').val('');
            $('textarea[name="desc"]').val('');
            $('input[name="order"]').val(0);
            $('#frmModule').find('input[name="name_module"]').focus();
        });

    // edit
        $('body').on('click', '.btnEdit', function(e) {
            e.preventDefault();

            oper = 'edit'
            id = $(this).attr('data-id')
            $.ajax({
                url: bUrl + 'module/ajax_get_module',
                type: 'POST',
                cache: false,
                dataType: 'json',
                data: {
                    'id': id,
                    'csrf_hash' : $.cookie('csrf_cookie_ci')
                },
                success: function(data) {
                    if (data.err==1) {
                        showSmartAlert("Error", data.msg, '[YES]');
                    }
                    else {
                        $('input[name="csrf_hash"]').val($.cookie('csrf_cookie_ci'));
                        var module = data.module;
                        $('#frmModule input[name="name_module"]').val(module.name).attr('disabled','disabled');
                        $('#frmModule input[name="url"]').val(module.url).attr('disabled','disabled');
                        $('#frmModule input[name="icon"]').val(module.icon);
                        $('#frmModule textarea[name="desc"]').val(module.desc);
                        $('#frmModule input[name="order"]').val(module.order);

                        $('#frmModule input[name="id"]').val(id);
                    }
                },
                error: function() {
                    showSmartAlert("Error", "Can send data. Please contact to admin.", '[YES]')
                }
            });
        });

    // delete inline
        $('body').on('click','.btnDelete', function(e) {
            e.preventDefault();

            href = $(this).attr('href');
            showSmartAlert("Warning", "<p>Are you sure delete this data ?</p>", '[NO][YES]', function() {
                // click YES
                window.location.href = href
            }, function() {
                // click NO
            });
        });

    // generate URL
        gen_url($('input[name="name_module"]'), $('#frmModule input[name="url"]'));

    // limit character
        $('input[name="name_module"]').limit('255','#name_module_limit');
        $('textarea[name="desc"]').limit('1000','#desc_limit');

// validation
    var validator = $("#frmModule").validate({
        rules: {
            name_module: {
                required: true,
                lettersonly: true
            },
            url: { required: true }
        },
        messages: {
            name_module: {
                required : "Name is required",
                lettersonly : "Name only contains letters"
            },
            url: "Url is required"
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
                url: bUrl + 'module/submit',
                type: 'POST',
                cache: false,
                dataType: 'json',
                data: {
                        'csrf_hash' : $.cookie('csrf_cookie_ci'),
                        'id' : $('input[name="id"]').val(),
                        'name' : $('input[name="name_module"]').val(),
                        'url' : $('input[name="url"]').val(),
                        'icon' : $('input[name="icon"]').val(),
                        'desc': $('textarea[name="desc"]').val(),
                        'order' : $('input[name="order"]').val()
                      },
                success: function(data) {
                    if (data.err=="1") {
                        showSmartAlert("Error", data.msg, '[YES]');
                    }
                    else {
                        window.location.href = bUrl + currentModule['url'];
                    }
                },
                error: function() {
                    showSmartAlert("Error", "Can send data. Please contact to admin.", '[YES]')
                }
            });
        }
    });
// show icon wrapper
    $('input[name="icon"]').click( function() {

        selectedIcon = ''
        showSmartAlert("Choose icon for module <span class='selectedIcon'>your choose</span>", $(this).next('.iconWrapper').html(), '[NO][YES]', function() {
            $('input[name="icon"]').val(selectedIcon)
        });
        $('.MessageBoxContainer').css({
            'max-height' : '100%',
            'height' : '100%',
            'top' : '0'
        })
        $('.MessageBoxMiddle').css({
            'width' : '80%',
            'height' : '100%',
            'left' : '10%'
        })
        $('.MessageBoxMiddle .pText').next('.row').css({
            'max-height' : '80%',
            'height' : '80%',
            'padding-right' : '5%',
            'overflow-y' : 'scroll'
        });
        $('.MessageBoxContainer').find('.demo-icon-font').each( function() {
            $(this).click( function() {
                $('.MsgTitle .selectedIcon').html('').html($(this).html())
                selectedIcon = $(this).children('i').attr("class");
            });
        });
    });
