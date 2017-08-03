// list
    // var activeStr = ":All;1:Active;0:Lock";
    caption = captionButton(true, false)

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

    // add
        $('body').on('click', '#btnAdd', function(e) {
            e.preventDefault();
            location.reload();
        });

    // edit
        $('body').on('click', '.btnEdit', function(e) {
            e.preventDefault();

            oper = 'edit'
            id = $(this).attr('data-id')
            $.ajax({
                url: bUrl + module + '/ajax_getModule',
                type: 'POST',
                cache: false,
                dataType: 'json',
                data: { 'id': id, 'csrf_hash' : $.cookie('csrf_cookie_ci') },
                success: function(data) {
                    if (data.error==0) {
                        $('input[name="csrf_hash"]').val($.cookie('csrf_cookie_ci'));
                        var module = data.module
                        $('#frmModule input[name="name"]').val(module.name).attr('disabled','disabled')
                        $('#frmModule input[name="url"]').val(module.url).attr('disabled','disabled')
                        $('#frmModule input[name="icon"]').val(module.icon)
                        $('#frmModule textarea[name="desc"]').val(module.desc)
                        $('#frmModule input[name="order"]').val(module.order)

                        $('#frmModule input[name="name"]').focus();
                        $('#frmModule input[name="oper"]').val('edit');
                        $('#frmModule input[name="id"]').val(id);

                        $('#frmModule button[type="submit"]').html('').html('<i class="fa fa-lg fa-save"></i> Save')
                    }
                    else {
                        showSmartAlert("Error", "Can get data. Please contact to admin.", '[YES]')
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
        gen_url($('input[name="name"]'), $('#frmModule input[name="url"]'));

    // limit character
        $('input[name="name"]').limit('255','#nameLimit');
        $('textarea[name="desc"]').limit('1000','#descLimit');

    // validation
        var $validator = $("#frmModule").validate({
            rules: {
                name: {
                    required: true,
                    lettersonly: true,
                    remote: {
                        url: bUrl + module + '/ajax_existed',
                        type: 'post',
                        data: {
                            csrf_hash : function(){ return $.cookie('csrf_cookie_ci') },
                            oper : function(){ return oper },
                            name : function(){ return $('input[name=name]').val(); }
                        }
                    }
                },
                url: { required: true },
            },
            messages: {
                name: {
                    required : "Name is required",
                    lettersonly : "Name only contains letters",
                    remote: jQuery.validator.format("Name \"{0}\" is already taken")
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
                // check exist in category
                $.ajax({
                    url: bUrl + module + '/ajax_existed',
                    type: 'POST',
                    cache: false,
                    dataType: 'text',
                    data: { 'oper': oper,
                            'name':$('input[name=name]').val(),
                            'csrf_hash' : $.cookie('csrf_cookie_ci')
                          },
                    success: function(data) {
                        if (data=="false") {
                            errorContent = '<span for="name" class="help-block">Name "'+$('input[name=name]').val()+'" is already taken</span>';
                            $('input[name=name]').closest('.form-group').removeClass('has-success').addClass('has-error');
                            $('input[name=name]').after(errorContent)
                        }
                        else {
                            $('input[name="csrf_hash"]').val($.cookie('csrf_cookie_ci'));
                            form.submit();
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
