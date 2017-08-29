// list
    if ($(idTableList).length>0) {
        var activeStr = ":All;active:Active;inactive:Inactive;block:Block";
        if (authMember['username'] == 'admin') {
            caption = captionButton(true, false)
        }
        else {
            caption = captionButton(false, false)
        }
        //caption += captionExport();

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
                colNames : ['Status', 'ID', 'Username', 'Avatar', 'Created Datetime', 'Action'],
                colModel : [{ name : 'status', index : 'status', align : 'center', width : '100',
                                stype: 'select', searchoptions:{ sopt:['eq'], value: activeStr }
                            },
                            { name : 'id', index : 'id', search : true, align : 'center', width : '60', hidden : true },
                            { name : 'username', index : 'username', align : 'left', search : true, width : '200' },
                            { name : 'thumbnail', index : 'thumbnail', align : 'center', search : false, width : '100' },
                            { name : 'created_datetime', index : 'created_datetime', align : 'center', search : false, width : '150' },
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
                /*
                rowattr: function (rd) {
                    if (rd.username=='admin') {
                        return {
                            "class": "ui-state-disabled ui-jqgrid-disablePointerEvents"
                        };
                    }
                },
                */
                loadBeforeSend: function () {
                    $(this).closest("div.ui-jqgrid-view").find("table.ui-jqgrid-htable>thead>tr>th").css({"text-align":"center"});
                },
                gridComplete : function() {
                    var ids = jQuery("#jqgrid").jqGrid('getDataIDs');
                    for (var i = 0; i < ids.length; i++) {
                        var cl = ids[i];
                        var rowData = jQuery(idTableList).jqGrid ('getRowData', cl);
                        if (rowData.id  == 1) {
                            var btnInline = btnEditInline(cl);
                            fa = "";
                        }
                        else {
                            if (rowData.id == authMember['id']) {
                                var btnInline = btnEditInline(cl);
                                fa = "";
                            }
                            else {
                                $('tr#'+rowData.id).children('td:eq(1)').html('');
                                var btnInline = btnEditInline(cl) + bntDeleteInline(cl);
                                var fa = formatButton(cl, rowData.status, 'btnStatus_', 'btnStatus', 'modalStatus');
                            }
                        }
                        // var btnInline = btnEditInline(cl) + bntDeleteInline(cl)
                        var th = '<img src="' + uploadDir + '.thumbs/images/member/avatar.png" class="thumbInTable" />';
                        if (rowData.thumbnail != "") {
                            th = '<img src="' + rowData.thumbnail + '" class="thumbInTable" />';
                        }
                        jQuery("#jqgrid").jqGrid('setRowData', ids[i], {
                            status : fa,
                            thumbnail : th,
                            act : btnInline
                        });
                    }
                // btnStatus
                    click_btnInGrid('btnStatus', 'modalStatus', bUrl+'member/ajax_status', function() {
                        location.reload();
                    });

                },
                ajaxRowOptions: { async: true },
                caption : caption,
                multiselect : true,
                // editurl : bUrl + module + '/edit_inline',
            });

        // common
            tableCommon();

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

    }

// frmMember
    if ($('#frmMember').length>0) {

    // change password
        if ($('#change_password').length>0) {
            $('.password_contain').children('fieldset').hide();
        }
        $('body').on('click', '#change_password', function(e) {
            e.preventDefault();
            $('.password_contain').children('.row:first').hide();
            $('.password_contain').children('fieldset').show();
        });
    // password
        $('body').on('focus','input[name="password"]', function() {
            $(this).prop('type','password').val('')
            $('input[name="confirm_password"]').prop('type','password').val('');
        });
        $('body').on('click','#randomPass', function() {
            ranPass = randString(6, 'alpha');
            $('input[name="password"]').prop('type','text').val(ranPass)
            $('input[name="confirm_password"]').prop('type','text').val(ranPass)
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

    // permission
        // Full Permission
            $('body').on('click','.permissionFull', function() {
                group = $(this).parent('label').parent('.checkbox').parent('.form-group');
                permissionFull = group.find('.checkbox .permissionFull');
                permissionRead = group.find('.checkbox .permissionRead');
                permissionAdd = group.find('.checkbox .permissionAdd');
                permissionEdit = group.find('.checkbox .permissionEdit');
                permissionDelete = group.find('.checkbox .permissionDelete');
                if ($(this).is(':checked')) {
                    permissionRead.prop('checked', 'checked');
                    permissionAdd.prop('checked', 'checked');
                    permissionEdit.prop('checked', 'checked');
                    permissionDelete.prop('checked', 'checked');
                }
                else {
                    permissionRead.prop('checked', '');
                    permissionAdd.prop('checked', '');
                    permissionEdit.prop('checked', '');
                    permissionDelete.prop('checked', '');
                }
            });
        // Read Permission
            $('body').on('click','.permissionRead', function() {
                group = $(this).parent('label').parent('.checkbox').parent('.form-group');
                permissionFull = group.find('.checkbox .permissionFull');
                permissionRead = group.find('.checkbox .permissionRead');
                permissionAdd = group.find('.checkbox .permissionAdd');
                permissionEdit = group.find('.checkbox .permissionEdit');
                permissionDelete = group.find('.checkbox .permissionDelete');

                if (permissionFull.is(':checked')) {
                    permissionFull.prop('checked', '')
                    permissionRead.prop('checked', 'checked')
                    permissionAdd.prop('checked', '')
                    permissionEdit.prop('checked', '')
                    permissionDelete.prop('checked', '')
                }
                else {
                    if (permissionRead.is(':checked') && permissionAdd.is(':checked') && permissionEdit.is(':checked') && permissionDelete.is(':checked')) {
                        permissionFull.prop('checked', 'checked')
                    }
                    else {
                        if (!permissionRead.is(':checked')) {
                            permissionAdd.prop('checked', '')
                            permissionEdit.prop('checked', '')
                            permissionDelete.prop('checked', '')
                        }
                    }
                }
            });
        // Add Permission
            $('body').on('click','.permissionAdd', function() {
                group = $(this).parent('label').parent('.checkbox').parent('.form-group');
                permissionFull = group.find('.checkbox .permissionFull');
                permissionRead = group.find('.checkbox .permissionRead');
                permissionAdd = group.find('.checkbox .permissionAdd');
                permissionEdit = group.find('.checkbox .permissionEdit');
                permissionDelete = group.find('.checkbox .permissionDelete');

                if (permissionFull.is(':checked')) {
                    permissionFull.prop('checked', '');
                    permissionRead.prop('checked', 'checked');
                    permissionAdd.prop('checked', 'checked');
                    permissionEdit.prop('checked', '');
                    permissionDelete.prop('checked', '');
                }
                else {
                    if (permissionRead.is(':checked') && permissionAdd.is(':checked') && permissionEdit.is(':checked') && permissionDelete.is(':checked')) {
                        permissionFull.prop('checked', 'checked');
                    }
                    else {
                        if (!permissionAdd.is(':checked')) {
                            permissionEdit.prop('checked', '');
                        }
                        else {
                            if (!permissionRead.is(':checked')) {
                                permissionRead.prop('checked', 'checked');
                            }
                        }
                    }
                }
            });
        // Edit Permission
            $('body').on('click','.permissionEdit', function() {
                group = $(this).parent('label').parent('.checkbox').parent('.form-group');
                permissionFull = group.find('.checkbox .permissionFull');
                permissionRead = group.find('.checkbox .permissionRead');
                permissionAdd = group.find('.checkbox .permissionAdd');
                permissionEdit = group.find('.checkbox .permissionEdit');
                permissionDelete = group.find('.checkbox .permissionDelete');

                if (permissionFull.is(':checked')) {
                    permissionFull.prop('checked', '');
                    permissionRead.prop('checked', 'checked');
                    permissionAdd.prop('checked', 'checked');
                    permissionEdit.prop('checked', 'checked');
                    permissionDelete.prop('checked', '');
                }
                else {
                    if (permissionRead.is(':checked') && permissionAdd.is(':checked') && permissionEdit.is(':checked') && permissionDelete.is(':checked')) {
                        permissionFull.prop('checked', 'checked');
                    }
                    else {
                        if (permissionEdit.is(':checked')) {
                            permissionRead.prop('checked', 'checked');
                            permissionAdd.prop('checked', 'checked');
                        }
                    }
                }
            });
        // Delete Permission
            $('body').on('click','.permissionDelete', function() {
                group = $(this).parent('label').parent('.checkbox').parent('.form-group');
                permissionFull = group.find('.checkbox .permissionFull');
                permissionRead = group.find('.checkbox .permissionRead');
                permissionAdd = group.find('.checkbox .permissionAdd');
                permissionEdit = group.find('.checkbox .permissionEdit');
                permissionDelete = group.find('.checkbox .permissionDelete');

                if (permissionFull.is(':checked')) {
                    permissionFull.prop('checked', '');
                    permissionRead.prop('checked', 'checked');
                    permissionAdd.prop('checked', '');
                    permissionEdit.prop('checked', '');
                    permissionDelete.prop('checked', 'checked');
                }
                else {
                    if (permissionRead.is(':checked') && permissionAdd.is(':checked') && permissionEdit.is(':checked') && permissionDelete.is(':checked')) {
                        permissionFull.prop('checked', 'checked');
                    }
                }
            });

    // validation
        var $validator = $("#frmMember").validate({
                rules: {
                    username: {
                        required: true,
                        maxlength : 255
                    },
                    old_password: {
                        minlength : 3,
                        maxlength : 20
                    },
                    password: {
                        required: true,
                        minlength : 3,
                        maxlength : 20
                    },
                    confirm_password: {
                        required : true,
                        minlength : 3,
                        maxlength : 20,
                        equalTo : '#appendbutton' // password field
                    }
                },
                messages: {
                    username: {
                        required : "Username is required",
                        maxlength : "Maximum is 255 characters"
                    },
                    old_password: {
                        minlength : "Minimum is 3 characters",
                        maxlength : "Maximum is 20 characters"
                    },
                    password: {
                        required : "Password is required",
                        minlength : "Minimum is 3 characters",
                        maxlength : "Maximum is 20 characters"
                    },
                    confirm_password: {
                        required : "Confirm Password is required",
                        minlength : "Minimum is 3 characters",
                        maxlength : "Maximum is 20 characters",
                        equalTo : "Must match with Password field"
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
                    var permissions = [];
                    $('#permissions').find('.permission').each( function() {
                        group = $(this)
                        var module_name = group.attr('id');
                        permissions[module_name] = [];
                        group.find('input[type="checkbox"]').each( function() {
                            if ($(this).is(':checked')) {
                                permissions[module_name].push(1);
                            }
                            else {
                                permissions[module_name].push(0);
                            }
                        })
                    });
                    permissions_json = Object.assign({}, permissions);
                    $.ajax({
                        url: bUrl + 'member/update',
                        type: 'POST',
                        cache: false,
                        dataType: 'json',
                        data: { 'id': $('input[name="id"]').val(),
                                'username' : $('input[name="username"]').val(),
                                'old_password' : $('input[name="old_password"]').val(),
                                'password' : $('input[name="password"]').val(),
                                'confirm_password' : $('input[name="confirm_password"]').val(),
                                'thumbnail': $('input[name=thumbnail]').val(),
                                'status': $('input[name=status]:checked').val(),
                                'permissions': permissions_json,
                                'csrf_hash' : $.cookie('csrf_cookie_ci')
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
