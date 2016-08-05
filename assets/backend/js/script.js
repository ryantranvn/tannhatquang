// config

	var idTableList = '#jqgrid'
	var idPager = "#pjqgrid"
	var defaultNumRows = 50

	var classTextColor_Status = classTextColor_Position = 'txt-color-white'
	var arrClassValue_Status = new Array();
		arrClassValue_Status['active'] = 'bg-color-green'
		arrClassValue_Status['inactive'] = 'bg-color-blueDark'
		arrClassValue_Status['block'] = 'bg-color-red'

// alert
	function showSmartAlert(title, content, buttons, fnCallbackYES, fnCallbackNO, fnCallbackCANCEL)
	{
		$('body').css({ 'overflow' : 'hidden' })
		$.SmartMessageBox({
			title : title,
			content : content,
			buttons : buttons
		}, function(ButtonPressed) {
			if (ButtonPressed === "YES") {
				if(typeof fnCallbackYES == "function"){
					fnCallbackYES();
				}
			}
			else if (ButtonPressed === "NO") {
				if(typeof fnCallbackNO == "function"){
					fnCallbackNO();
				}
			}
			else if (ButtonPressed === "CANCEL") {
				if(typeof fnCallbackCANCEL == "function"){
					fnCallbackCANCEL();
				}
			}
			$('body').css({ 'overflow' : 'auto' })
		});
	}

// html reply
	function replySuccess(content)
	{
		htmlStr = '<div class="row reply">';
			htmlStr += '<div class="alert alert-success alert-block">';
				htmlStr += '<a class="close" data-dismiss="alert" href="#">×</a>'
				htmlStr += '<h4 class="alert-heading">Success!</h4>'
				htmlStr += content
			htmlStr += '</div>'
		htmlStr += '</div>'

		return htmlStr;
	}
	function replyError(content)
	{
		htmlStr = '<div class="row reply">';
			htmlStr += '<div class="alert alert-danger alert-block">';
				htmlStr += '<a class="close" data-dismiss="alert" href="#">×</a>'
				htmlStr += '<h4 class="alert-heading">Error!</h4>'
				htmlStr += content
			htmlStr += '</div>'
		htmlStr += '</div>'

		return htmlStr;
	}

// table common
	function tableCommon() 
	{
		/*
			jQuery("#jqgrid").jqGrid('inlineNav', idPager, {
				edit : false,
				add : false
			});
		*/

		/* add filter */
			jQuery(idTableList).jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false, defaultSearch: "cn" });
		/* Add tooltips */
			// $('.navtable .ui-pg-button').tooltip({
			// 	container : 'body'
			// });

			// jQuery("#m1").click(function() {
			// 	var s;
			// 	s = jQuery("#jqgrid").jqGrid('getGridParam', 'selarrrow');
			// 	alert(s);
			// });
			// jQuery("#m1s").click(function() {
			// 	jQuery("#jqgrid").jqGrid('setSelection', "13");
			// });
		
		// remove classes
			$(".ui-jqgrid").removeClass("ui-widget ui-widget-content");
			$(".ui-jqgrid-view").children().removeClass("ui-widget-header ui-state-default");
			$(".ui-jqgrid-labels, .ui-search-toolbar").children().removeClass("ui-state-default ui-th-column ui-th-ltr");
			$(".ui-jqgrid-pager").removeClass("ui-state-default");
			$(".ui-jqgrid").removeClass("ui-widget-content");

		// add classes
			$(".ui-jqgrid-htable").addClass("table table-bordered table-hover");
			$(".ui-jqgrid-btable").addClass("table table-bordered table-striped");

			$(".ui-pg-div").removeClass().addClass("btn btn-sm btn-primary");
			$(".ui-icon.ui-icon-plus").removeClass().addClass("fa fa-plus");
			$(".ui-icon.ui-icon-pencil").removeClass().addClass("fa fa-pencil");
			$(".ui-icon.ui-icon-trash").removeClass().addClass("fa fa-trash-o");
			$(".ui-icon.ui-icon-search").removeClass().addClass("fa fa-search");
			$(".ui-icon.ui-icon-refresh").removeClass().addClass("fa fa-refresh");
			$(".ui-icon.ui-icon-disk").removeClass().addClass("fa fa-save").parent(".btn-primary").removeClass("btn-primary").addClass("btn-success");
			$(".ui-icon.ui-icon-cancel").removeClass().addClass("fa fa-times").parent(".btn-primary").removeClass("btn-primary").addClass("btn-danger");

			$(".ui-icon.ui-icon-seek-prev").wrap("<div class='btn btn-sm btn-default'></div>");
			$(".ui-icon.ui-icon-seek-prev").removeClass().addClass("fa fa-backward");

			$(".ui-icon.ui-icon-seek-first").wrap("<div class='btn btn-sm btn-default'></div>");
			$(".ui-icon.ui-icon-seek-first").removeClass().addClass("fa fa-fast-backward");

			$(".ui-icon.ui-icon-seek-next").wrap("<div class='btn btn-sm btn-default'></div>");
			$(".ui-icon.ui-icon-seek-next").removeClass().addClass("fa fa-forward");

			$(".ui-icon.ui-icon-seek-end").wrap("<div class='btn btn-sm btn-default'></div>");
			$(".ui-icon.ui-icon-seek-end").removeClass().addClass("fa fa-fast-forward");

		// resize
			$(window).on('resize.jqGrid', function() {
				$(idTableList).jqGrid('setGridWidth', $("#content").width());
			});
	}

// saveRow
	function actionSaveRow(rowid) 
	{
		jQuery(idTableList).jqGrid('saveRow',rowid, 
		{ 
		    aftersavefunc: function ( rowid, response ) {
		    	responseText = $.parseJSON(response.responseText)
		    	if(responseText.text == "OK") {
		    		if ($('.reply').length>0) $('.reply').remove();
		    		$('#widget-grid').prepend(replySuccess("Edit data successful."))
		    	}
		        else {
		        	if ($('.reply').length>0) $('.reply').remove();
		        	$('#widget-grid').prepend(replyError("Error edit data."));
		        }
		    }
		});
	}

// action buttons on top
	function captionButton(module, btnAdd, btnDelete)
	{
		caption = "";

		if (btnAdd == true && permissionsMember[module][2] == 1) {
			caption += '<a id="btnAdd" href="'+bUrl+module+'/add" class="btnTop btn btn-success"><i class="fa fa-plus"></i> Add</a>';	
		}
		if (btnDelete == true && permissionsMember[module][4] == 1) {
			caption += '<a id="btnMultiDelete" href="#" class="btnTop btn btn-danger"><i class="fa fa-trash-o"></i> Delete</a>';
		}

		return caption;
	}

	function captionExport(module)
	{
		return '<a id="btnExport" href="'+bUrl+module+'/export_db" class="btnTop pull-right btn btn-primary"><i class="fa fa-cloud-download"></i> Export</a>';
	}
	function captionImport(module)
	{
		return '<a id="btnImport" href="#" class="btnTop pull-right btn btn-default"><i class="fa fa-cloud-upload"></i> Import</a>'
	}

// action buttons inline
	function btnEditInline(module, id, btnEdit)
	{
		buttons = '';
		if (btnEdit == true && permissionsMember[module][3] == 1) {
			buttons += '<a href="' + bUrl + module + '/edit/' + id + '" data-id="' + id + '" class="btn btn-primary btn-xs btnEdit"><i class="fa fa-edit"></i></a>'
		}
		return buttons;
	}
	function bntDeleteInline(module, extendModule, id, btnDelete)
	{
		buttons = '';
		if (btnDelete == true && permissionsMember[module][4] == 1) {
			if (extendModule == false) {
				buttons += '<a href="' + bUrl + module + '/delete/' + id + '" data-id="' + id + '" class="btn btn-danger btn-xs btnDelete"><i class="fa fa-trash-o"></i></a>'
			}
			else {
				buttons += '<a href="' + bUrl + extendModule + '/delete/' + id + '" data-id="' + id + '" class="btn btn-danger btn-xs btnDelete"><i class="fa fa-trash-o"></i></a>'
			}
		}
		return buttons;
	}

// status
	function set_NewRadio(classWrapper, statusVal, arrClassValue, classTextColor)
	{
		activeClass = ""
		for (value in arrClassValue) {
			if (statusVal == value) {
				activeClass = arrClassValue[value]
				activeClass += " "+classTextColor
			}
		}
		$('.'+classWrapper+' label:has(input[value="'+statusVal+'"])').addClass('active').addClass(activeClass)
		$('.'+classWrapper+' label:has(input[value="'+statusVal+'"])').children('input').attr('checked','checked')
	}
	function click_NewRadio(classWrapper, arrClassValue, classTextColor)
	{	
		// on click
		$('.'+classWrapper).on('click', '.btn', function() {
			for (value in arrClassValue) {
				$('.'+classWrapper).find("."+arrClassValue[value]).removeClass(arrClassValue[value]).removeClass(classTextColor).removeClass('active')
			}
			set_NewRadio(classWrapper, $(this).children('input').val(), arrClassValue, classTextColor)
		})
	}
	function formatButton(idRow, statusVal, preID_Btn, class_Btn, id_Modal, arrClassValue, classTextColor) // button in grid list
	{
		activeClass = ""
		for (value in arrClassValue) {
			if (statusVal == value) {
				activeClass = arrClassValue[value]
				activeClass += " "+classTextColor
			}
		}
		
		fa = '<button id="'+preID_Btn+idRow+'" class="btn '+class_Btn+' '+activeClass+'" data-id="'+idRow+'" data-toggle="modal" data-target="#'+id_Modal+'">'
			fa += statusVal
		fa += '</button>'

		return fa;
	}
	function click_btnInGrid(class_Btn, id_Modal, url_Ajax, arrClassValue, fnCallback)
	{
		// on show
			var idBtn
			$('.'+class_Btn).click( function() {
				idBtn = $(this).attr('id')
				$('#'+id_Modal+' .modal-content').position({
				  my: "left top",
				  at: "left top",
				  of: $(this)
				});
			});
			$('#'+id_Modal).parent().on('webkitTransitionEnd oTransitionEnd transitionend msTransitionEnd', function() {
			    if ($('#'+id_Modal).attr('class').indexOf('in') == -1) {
			    	$('#'+id_Modal+' .modal-content').css({
						'left' : '0px',
						'top' : '0px'
					});
			    }
			});
		// in hide
			$('#'+id_Modal+' .btn').click( function() {
				var oldValue = $('#'+idBtn).html()
				var newValue = $(this).attr('data-value');
				$('#'+id_Modal).modal('hide');

				if (oldValue != newValue) {
					// id = idBtn.substring(7)
					id = $('#'+idBtn).attr('data-id')
					$.ajax({
			    		url: url_Ajax,
			            type: 'POST',
		                cache: false,
		                dataType: 'text',
		                data: { 'id': id,
		                		'value' : newValue,
		                		'csrf_hash' : $.cookie('csrf_cookie_ci')
		                	  },
		                success: function(data) {
		                	if (data=="true") {
		                		for (value in arrClassValue) {
		                			if (oldValue == value) {
		                				removeClass = arrClassValue[value]
		                			}
		                			if (newValue == value) {
										activeClass = arrClassValue[value]
									}
								}
							// remove oldClass
								$('#'+idBtn).removeClass(removeClass)
							// add newClass
								$('#'+idBtn).addClass(activeClass)
							// set value
								$('#'+idBtn).html(newValue)
							// callback
								if(typeof fnCallback == "function"){
									fnCallback();
								}
		                	}
		                	else {
		                		if (data=="false") {
		                			showSmartAlert("Error", "Can send data. Please contact to admin.", '[YES]')
		                		}
		                		else {
		                			showSmartAlert("Error", "You does not have permission to edit data. Please contact to admin.", '[YES]')
		                		}
			                }
		                },
		                error: function() {
		                    showSmartAlert("Error", "Can send data. Please contact to admin.", '[YES]')
		                }
			    	});
				}
			});
	}
	function statusAdd()
	{
		if ($('#statusAdd').length>0) {
			set_NewRadio('statusWrapper', 'active', arrClassValue_Status, classTextColor_Status)
			click_NewRadio('statusWrapper', arrClassValue_Status, classTextColor_Status);
		}
	}
	function statusEdit()
	{
		if ($('#statusEdit').length>0) {
			set_NewRadio('statusWrapper', $('.statusWrapper label.active input[name="status"]').val(), arrClassValue_Status, classTextColor_Status)
			click_NewRadio('statusWrapper', arrClassValue_Status, classTextColor_Status);
		}
	}

// tree view
	function treeView()
	{
		if ($('.tree').length>0) {
			$('.tree').find('li').addClass('parent_li').attr('role', 'treeitem').children('span').on('click', function() {
			// set color
				$('.tree').find('li').children('span').removeClass('label-success');
			
				$(this).addClass('label-success');
			// set data
				$('input[name=parent_id]').val($(this).attr('data-id'))
			});
			
			// collapse all
				/*
				$('.tree ul li span').filter(function() {
				  	return $(this).attr("data-indent") > 1;
				}).next('ul').css('display','none');
				*/
			
			// expantion + collapse
				$('body').on('click', '.tree ul li span i', function() {

					sub = $(this).parent('span').parent('li').children('ul');					

					if ($(this).attr('class').indexOf('fa-minus-circle') != -1) {
						if (sub != 'undefined') {
							sub.hide('fast')
						}
						$(this).removeClass().addClass('fa fa-sm fa-plus-circle')
					}
					else {
						if (sub != 'undefined') {
							sub.show('fast')
						}
						$(this).removeClass().addClass('fa fa-sm fa-minus-circle')
					}
				});
			// set minus icon for item expended
				$('.tree').find('li:has(ul)').each( function() {
					$(this).children('span').children('i').removeClass('fa-plus-circle').addClass('fa-minus-circle');
				});
		}
	}

// positive-integer
	function positiveInteger()
	{
		if ($(".positive-integer").length>0) {
        	$(".positive-integer").numeric({ decimal: false, negative: false }, function() { 
	            this.value = ""; this.focus(); 
	        });
	    }
	}

// KCFinder
	function openKCFinder(field, type, fnCallback) 
	{
	    window.KCFinder = {
	        callBack: function(url) {
	        	// var pathname = url.split("/");
				// var filename = pathname[pathname.length-1];
	            field.val(url);
	            window.KCFinder = null;
	            if(typeof fnCallback == "function"){
		            fnCallback();
		        }
	        }
	    };
	    if (type == "images") {
		    window.open(libsUrl + 'kcfinder/browse.php?type=images&dir=images/public', 'kcfinder_textbox',
		        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
		        'resizable=1, scrollbars=0, width=800, height=600'
		    );
		}
		else if (type == "docs") {
		    window.open(libsUrl + 'kcfinder/browse.php?type=docs&dir=docs/public', 'kcfinder_textbox',
		        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
		        'resizable=1, scrollbars=0, width=800, height=600'
		    );
		}
	}
	function openKCFinderMulti(textarea, type) {
	    window.KCFinder = {
	        callBackMultiple: function(files) {
	            window.KCFinder = null;
	            textarea.value = "";
	            elementWrapper = textarea.parentElement.nextElementSibling // galleryWrapper thumbnail
	            inputMulti = textarea.nextElementSibling.nextElementSibling	// galleryFiles
	            deletedImages = elementWrapper.nextElementSibling	// deletedImages

	            arr = new Array();

	            if(deletedImages != null) { // edit
	            	action = 'edit'
	            }
	            else {
	            	action = 'add'
	            	elementWrapper.innerHTML = "";
	            }

	            for (var i = 0; i < files.length; i++) {
	            	arr.push(files[i])

	            // create wrapper
	            	elemItem = document.createElement("div");
	            	elemItem.setAttribute("class", "imageItem");
	            // create image
	            	elemImg = document.createElement("img");
	            	elemImg.setAttribute("src", files[i]);
	            // create delete button
	            	elemDel = document.createElement("i");
	            	if (action == 'edit') {
	            		elemDel.setAttribute("class", "fa fa-trash-o iEdit");
	            	}
	            	else {
	            		elemDel.setAttribute("class", "fa fa-trash-o");
	            	}

	            // add html
	            	elementWrapper.appendChild(elemItem)
	            	elemItem.appendChild(elemImg)
	            	elemItem.appendChild(elemDel)
	            }
	            if (inputMulti.value != "") {
	            	arrOld = $.parseJSON(inputMulti.value);
	            	for (var i = 0; i < arrOld.length; i++) {
	            		arr.push(arrOld[i])
	            	}
	            }
	            inputMulti.value = JSON.stringify(arr);
	        }
	    };
	    if (type == "images") {
		    window.open(libsUrl + 'kcfinder/browse.php?type=images&dir=images/public', 'kcfinder_multiple',
		        'status=0, toolbar=0, location=0, menubar=1, directories=0, ' +
		        'resizable=1, scrollbars=0, width=800, height=600'
		    );
		}
		else if (type == "docs") {
		    window.open(libsUrl + 'kcfinder/browse.php?type=docs&dir=docs/public', 'kcfinder_multiple',
		        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
		        'resizable=1, scrollbars=0, width=800, height=600'
		    );
		}
	}
	
// select File
	function selectFile(buttonClass, typeFile)
	{
		$('body').on('click', buttonClass, function() {

			inputField = $(this).parent().prev('.inputThumbnail')
			if (typeFile == 'images') {
				thumbnailWrapper = $(this).parent().parent().next('.thumbnailWrapper')
			}
			
			openKCFinder(inputField, typeFile, function() {
				filename = inputField.val();
				if (typeFile == 'images') {
					typeDir = 'images/'
					htmlImg = '<img src="' + filename + '" />';
	                htmlDel = '<a class="thumbnailDel"><i class="fa fa-trash-o"></i></a>'
	                thumbnailWrapper.html('').html(htmlImg+htmlDel)
	            }
			});
		});
	}

// order
	function setOrder()
	{
		if ($(".orderSpinner").length>0) {
			$(".orderSpinner").spinner({
			    min: 0,
			    max: 99,
			    step: 1,
			    start: 1000,
			    numberFormat: "C"
			});
			$('body').on('change', 'input[name="order"]', function() {
				if ($(this).val() == "") {
					$(this).val(0)
				}
				else if ($(this).val()>100) {
					$(this).val(99);
				}
			});
		}
	}

// positive-integer
	function positiveInteger()
	{
		if ($(".positive-integer").length>0) {
        	$(".positive-integer").numeric({ decimal: false, negative: false }, function() { 
	            this.value = ""; this.focus(); 
	        });
	    }
	}


//================================================== PAGEs
// AUTH
	function valid_login()
	{
	    $("#login_form").validate({
	        rules: {
	            username: {
	                required: true,
	                maxlength: 255
	            },
	            captcha: {
	                required: true
	            },
	            password: {
	                required: true,
	                maxlength: 255
	            }
	        },
	        messages: {
	            username: {
	                required: "not empty",
	                maxlength: "must less 255 characters"
	            },
	            password: {
	                required: "not empty",
	                maxlength: "must less 255 characters"
	            },
	            captcha: {
	                required: "not empty"
	            }
	        },
	        submitHandle: function(form) {
	            form.submit();
	        }
	    });
	}

	function refresh_captcha()
	{
	    $('#captcha_refesh').click( function() {
	        btnRefesh = $(this);
	        sc = btnRefesh.prev('img').attr("id");
	        
	        $.ajax({
	            url: bUrl + "auth/ajax_captcha",
	            type: 'POST',
	            cache: false,
	            dataType: 'json',
	            data: { 'sc' : sc, 'csrf_hash' : $.cookie('csrf_cookie_ci') },
	            success: function(data) {
	                btnRefesh.prev('img').remove();
	                btnRefesh.before(data);
	                $('input[name="csrf_hash"]').val($.cookie('csrf_cookie_ci'));
	            },
	            error: function() {
	                alert('Error ! Can not load data.');
	            }
	        });
	    });
	}

// DASHBOARD
	function dashboardPage()
	{
		if ($('#dashboardPage').length>0) {
			module = 'dashboard'
		}
	}

// CATEGORY
	function categoryPage()
	{
		if ($('#categoryPage').length>0) {
			module = 'category'

		// list
			if ($(idTableList).length>0) {
				var statusStr = ":All;active:Active;inactive:Inactive;block:Block";
				caption = captionButton(module, true, true)

			// jqGrid
				jQuery(idTableList).jqGrid({
					url: bUrl + module + '/ajax_list?q=2',
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
					sortname : 'parent',
					sortorder : "asc",
					toolbarfilter : true,
					viewrecords : true,
					rowattr: function (rd) {
		                if (rd.name=='default') {
		                    return {
		                        "class": "ui-state-disabled ui-jqgrid-disablePointerEvents"
		                    };
		                }
		            },
					gridComplete : function() {
						var ids = jQuery(idTableList).jqGrid('getDataIDs');
						for (var i = 0; i < ids.length; i++) {
							var cl = ids[i];
							var rowData = jQuery(idTableList).jqGrid ('getRowData', cl);
							var fa = ""
							if (cl > 1) {
								var fa = formatButton(cl, rowData.status, 'btnStatus_', 'btnStatus', 'modalStatus', arrClassValue_Status, classTextColor_Status)
							}
							var th = ""
							if (rowData.thumbnail != "") {
								th = '<img src="' + rowData.thumbnail + '" class="thumbInTable" />'
							}
							var btnInline = ""
							if (cl > 1) {
								btnInline = btnEditInline(module, cl, true) + bntDeleteInline(module, false, cl, true)
							}
							jQuery(idTableList).jqGrid('setRowData', ids[i], {
								status : fa,
								thumbnail : th,
								act : btnInline
							});

						}
					// btnStatus
						click_btnInGrid('btnStatus', 'modalStatus', bUrl+module+'/ajax_status', arrClassValue_Status, function() {
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
					showSmartAlert("Warning", "<p>Delete a category maybe effect to another data.</p><p>[YES] : Delete all children.<br/>[NO] : Just delete this category.<br/>[CANCEL] : Cancel delete action.</p><p>Are you sure delete this data ?</p>", '[YES][NO][CANCEL]', function() {
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
			if ($('#addContainer').length>0 || $('#editContainer').length>0) {
				// tree view
					treeView()

				// generate URL
					gen_url($('input[name="name"]'), $('input[name="url"]'));
					gen_url($('input[name="nameEN"]'), $('input[name="urlEN"]'));

				// limit character
					$('input[name="name"]').limit('200','#nameLimit');
					$('input[name="url"]').limit('200','#urlLimit');
					$('textarea[name="desc"]').limit('1000','#descLimit');

					$('input[name="nameEN"]').limit('200','#nameENLimit');
					$('input[name="urlEN"]').limit('200','#urlENLimit');
					$('textarea[name="descEN"]').limit('1000','#descENLimit');

				// file
					selectFile('.btnSelectThumbnail', 'images')
					// delele file
					$('body').on('click', '.thumbnailDel', function(e) {
						e.preventDefault();
						thumbnailWrapper = $(this).parent('.thumbnailWrapper')
						inputThumbnail = thumbnailWrapper.prev().children('.inputThumbnail')

						inputThumbnail.val('')
						thumbnailWrapper.html('').html(defaultIMG)
					});
			}

		// add
			if ($('#addContainer').length>0) {
				var oper = 'add';
			// validation
				var $validator = $("#frmAdd").validate({
				    rules: {
				    	name: { 
							required : true,
							maxlength : 200
						},
						url: { 
							required: true,
							maxlength : 200,
							remote: {
								url: bUrl + module + '/ajax_existed_inCategory',
				                type: 'post',
				                data: {
				                	csrf_hash : function(){ return $.cookie('csrf_cookie_ci') },
				                	oper : function(){ return oper },
									url : function(){ return $('input[name=url]').val(); },
									parent_id : function(){ return $('input[name=parent_id]').val(); },
									lang : function(){ return "vn" }
				                }
							}
						},
						desc: {
							maxlength : 1000,
						},
						nameEN: { 
							required : true,
							maxlength : 200
						},
						urlEN: { 
							required: true,
							maxlength : 200,
							remote: {
								url: bUrl + module + '/ajax_existed_inCategory',
				                type: 'post',
				                data: {
				                	csrf_hash : function(){ return $.cookie('csrf_cookie_ci') },
				                	oper : function(){ return oper },
									url : function(){ return $('input[name=urlEN]').val(); },
									parent_id : function(){ return $('input[name=parent_id]').val(); },
									lang : function(){ return "en" }
				                }
							}
						},
						descEN: {
							maxlength : 1000,
						}
				    },
				    messages: {
				    	name: {
				    		required : "Name is required",
				    		maxlength : "Maximum is 200 characters"
				    	},
				      	url: {
				      		required : "URL is required",
				      		maxlength : "Maximum is 200 characters",
				      		remote: jQuery.validator.format("URL \"{0}\" is already taken")
				      	},
				        desc: { 
				        	maxlength : "Maximum is 1000 characters"
				        },
				        nameEN: {
				    		required : "Name is required",
				    		maxlength : "Maximum is 200 characters"
				    	},
				      	urlEN: {
				      		required : "URL is required",
				      		maxlength : "Maximum is 200 characters",
				      		remote: jQuery.validator.format("URL \"{0}\" is already taken")
				      	},
				        descEN: { 
				        	maxlength : "Maximum is 1000 characters"
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
				    	// check exist in category
				    	$.ajax({
				    		url: bUrl + module + '/ajax_multi_existed_inCategory',
				            type: 'POST',
			                cache: false,
			                dataType: 'json',
			                data: { 'csrf_hash' : $.cookie('csrf_cookie_ci'),
			                		'oper': oper,
			                		'id': $('input[name=id]').val(),
			                		'url' : $('input[name=url]').val(),
			                		'urlEN' : $('input[name=urlEN]').val(),
			                		'parent_id': $('input[name=parent_id]').val()
			                	  },
			                success: function(data) {
			                	if (data.error=="1") {
			                		showSmartAlert("Error", "URL VN is already taken", '[YES]')
			                	}
			                	else if (data.error=="2") {
			                		showSmartAlert("Error", "URL EN is already taken", '[YES]')
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
			}

		// edit
			if ($('#editContainer').length>0) {
				var oper = 'edit';
				var id = $('input[name=id]').val();
				
			// tree view
				// invisible all children
				selectedItem = $('.tree').find('li > span[data-id='+id+']');
				selectedItem.parent('li').children('span').addClass('btn btn-danger disabled')
				selectedItem.parent('li').find('ul').children('li').children('span').addClass('btn btn-danger disabled')
			
			// validation
				var $validator = $("#frmEdit").validate({
				    rules: {
				    	name: { 
							required : true,
							maxlength : 200
						},
						url: { 
							required: true,
							maxlength : 200,
							remote: {
								url: bUrl + module + '/ajax_existed_inCategory',
				                type: 'post',
				                data: {
				                	csrf_hash : function(){ return $.cookie('csrf_cookie_ci') },
				                	oper : function(){ return oper },
				                	id : id,
									url : function(){ return $('input[name=url]').val(); },
									parent_id : function(){ return $('input[name=parent_id]').val(); }
				                }
							}
						},
						desc: {
							maxlength : 1000,
						},
						nameEN: { 
							required : true,
							maxlength : 200
						},
						urlEN: { 
							required: true,
							maxlength : 200,
							remote: {
								url: bUrl + module + '/ajax_existed_inCategory',
				                type: 'post',
				                data: {
				                	csrf_hash : function(){ return $.cookie('csrf_cookie_ci') },
				                	oper : function(){ return oper },
				                	id : id,
									url : function(){ return $('input[name=urlEN]').val(); },
									parent_id : function(){ return $('input[name=parent_id]').val(); },
									lang : function(){ return "en" }
				                }
							}
						},
						descEN: {
							maxlength : 1000,
						}
				    },
				    messages: {
				    	name: {
				    		required : "Name is required",
				    		maxlength : "Maximum is 200 characters"
				    	},
				      	url: {
				      		required : "URL is required",
				      		maxlength : "Maximum is 200 characters",
				      		remote: jQuery.validator.format("URL VN \"{0}\" is already taken")
				      	},
				        desc: { 
				        	required : "Description is required",
				        	maxlength : "Maximum is 1000 characters"
				        },
				        nameEN: {
				    		required : "Name is required",
				    		maxlength : "Maximum is 200 characters"
				    	},
				      	urlEN: {
				      		required : "URL is required",
				      		maxlength : "Maximum is 200 characters",
				      		remote: jQuery.validator.format("URL EN \"{0}\" is already taken")
				      	},
				        descEN: { 
				        	maxlength : "Maximum is 1000 characters"
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
				    	// check exist in category
				    	$.ajax({
				    		url: bUrl + module + '/ajax_multi_existed_inCategory',
				            type: 'POST',
			                cache: false,
			                dataType: 'json',
			                data: { 'csrf_hash' : $.cookie('csrf_cookie_ci'),
			                		'oper': oper,
			                		'id': id,
			                		'url' : $('input[name=url]').val(),
			                		'urlEN' : $('input[name=urlEN]').val(),
			                		'parent_id': $('input[name=parent_id]').val()
			                	  },
			                success: function(data) {
			                	if (data.error=="1") {
			                		showSmartAlert("Error", "URL is already taken", '[YES]')
			                	}
			                	else {
				                	form.submit();
				                }
			                },
			                error: function() {
			                    showSmartAlert("Error", "Can send data. Please contact to admin.", '[YES]')
			                }
				    	});
				    }
				});
			}

		}
	}

// MODULE
	function modulePage()
	{
		if ($('#modulePage').length>0) {
			module = 'module'

		// list
			// var activeStr = ":All;1:Active;0:Lock";
			caption = captionButton(module, true, false)
		 	
		 	// set column
				jQuery("#jqgrid").jqGrid({
					url: bUrl + module + '/ajax_list?q=2',
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
							
							var btnInline = btnEditInline(module, cl, true) + bntDeleteInline(module, false, cl, true)
							
							ico = '<i class="'+rowData.icon+'" />'	
							
							jQuery("#jqgrid").jqGrid('setRowData', ids[i], {
								act : btnInline,
								icon : ico
							});
						}
					},
					ajaxRowOptions: { async: true },
					caption : caption,
					multiselect : true,
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
		}
	}

// MEMBER
	function memberPage()
	{
		if ($('#memberPage').length>0) {
			module = 'member'

		// list
			if ($(idTableList).length>0) {
				var activeStr = ":All;active:Active;inactive:Inactive;block:Block";
				
				caption = captionButton(module, true, true)
				//caption += captionExport();

			 	// set column
					jQuery("#jqgrid").jqGrid({
						url: bUrl + module + '/ajax_list?q=2',
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
									{ name : 'id', index : 'id', search : true, align : 'center', width : '60' }, 
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
						rowattr: function (rd) {
			                if (rd.username=='admin') {
			                    return {
			                        "class": "ui-state-disabled ui-jqgrid-disablePointerEvents"
			                    };
			                }
			            },
						loadBeforeSend: function () {
							$(this).closest("div.ui-jqgrid-view").find("table.ui-jqgrid-htable>thead>tr>th").css({"text-align":"center"});
						},
						gridComplete : function() {
							var ids = jQuery("#jqgrid").jqGrid('getDataIDs');
							for (var i = 0; i < ids.length; i++) {
								var cl = ids[i];
								var rowData = jQuery(idTableList).jqGrid ('getRowData', cl);
								if (rowData.id != authMember['id']) {
									var btnInline = btnEditInline(module, cl, true) + bntDeleteInline(module, false, cl, true)
									var fa = formatButton(cl, rowData.status, 'btnStatus_', 'btnStatus', 'modalStatus', arrClassValue_Status, classTextColor_Status)
								}
								else {
									$('tr#'+rowData.id).children('td:eq(1)').html('');
									btnInline = ""
									fa = ""
								}
								var th = '<img src="' + uploadDir + '.thumbs/images/member/avatar.png" class="thumbInTable" />'
								if (rowData.thumbnail != "") {
									th = '<img src="' + rowData.thumbnail + '" class="thumbInTable" />'
								}
								jQuery("#jqgrid").jqGrid('setRowData', ids[i], {
									status : fa,
									thumbnail : th,
									act : btnInline
								});
							}
						// btnStatus
							click_btnInGrid('btnStatus', 'modalStatus', bUrl+module+'/ajax_status', arrClassValue_Status)
							
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
			
			// multi-delete
				$('body').on('click', '#btnMultiDelete', function(e) {
					e.preventDefault();
					href = $(this).attr('href');

					selectedRows = jQuery(idTableList).jqGrid('getGridParam','selarrrow');
					if (selectedRows.length==0) {
						showSmartAlert("Error", "Please select data.", '[YES]');
					}
					else {
						showSmartAlert("Warning", "<p>Are you sure delete data ?</p>", '[NO][YES]', function() {
							// click YES
							$('#ids').val(selectedRows)
							$('#frmTopButtons').submit();
						}, function() {
							// click NO
						});
					}
				});
			}

		// common for add & edit
			if ($('#frmAdd').length>0 || $('#frmEditPermission').length>0) {
				
			// Full Permission	
				$('body').on('click','.permissionFull', function() {
					group = $(this).parent('label').parent('.checkbox').parent('.form-group')
					permissionFull = group.find('.checkbox .permissionFull');
					permissionRead = group.find('.checkbox .permissionRead');
					permissionAdd = group.find('.checkbox .permissionAdd');
					permissionEdit = group.find('.checkbox .permissionEdit');
					permissionDelete = group.find('.checkbox .permissionDelete');
					if ($(this).is(':checked')) {
						permissionRead.prop('checked', 'checked')
						permissionAdd.prop('checked', 'checked')
						permissionEdit.prop('checked', 'checked')
						permissionDelete.prop('checked', 'checked')
					}
					else {
						permissionRead.prop('checked', '')
						permissionAdd.prop('checked', '')
						permissionEdit.prop('checked', '')
						permissionDelete.prop('checked', '')
					}
				});
			// Read Permission
				$('body').on('click','.permissionRead', function() {
					group = $(this).parent('label').parent('.checkbox').parent('.form-group')
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
					group = $(this).parent('label').parent('.checkbox').parent('.form-group')
					permissionFull = group.find('.checkbox .permissionFull');
					permissionRead = group.find('.checkbox .permissionRead');
					permissionAdd = group.find('.checkbox .permissionAdd');
					permissionEdit = group.find('.checkbox .permissionEdit');
					permissionDelete = group.find('.checkbox .permissionDelete');

					if (permissionFull.is(':checked')) {
						permissionFull.prop('checked', '')
						permissionRead.prop('checked', 'checked')
						permissionAdd.prop('checked', 'checked')
						permissionEdit.prop('checked', '')
						permissionDelete.prop('checked', '')
					}
					else {
						if (permissionRead.is(':checked') && permissionAdd.is(':checked') && permissionEdit.is(':checked') && permissionDelete.is(':checked')) {
							permissionFull.prop('checked', 'checked')
						}
						else {
							if (!permissionAdd.is(':checked')) {
								permissionEdit.prop('checked', '')
							}
							else {
								if (!permissionRead.is(':checked')) {
									permissionRead.prop('checked', 'checked')
								}
							}
						}
					}
				});
			// Edit Permission
				$('body').on('click','.permissionEdit', function() {
					group = $(this).parent('label').parent('.checkbox').parent('.form-group')
					permissionFull = group.find('.checkbox .permissionFull');
					permissionRead = group.find('.checkbox .permissionRead');
					permissionAdd = group.find('.checkbox .permissionAdd');
					permissionEdit = group.find('.checkbox .permissionEdit');
					permissionDelete = group.find('.checkbox .permissionDelete');

					if (permissionFull.is(':checked')) {
						permissionFull.prop('checked', '')
						permissionRead.prop('checked', 'checked')
						permissionAdd.prop('checked', 'checked')
						permissionEdit.prop('checked', 'checked')
						permissionDelete.prop('checked', '')
					}
					else {
						if (permissionRead.is(':checked') && permissionAdd.is(':checked') && permissionEdit.is(':checked') && permissionDelete.is(':checked')) {
							permissionFull.prop('checked', 'checked')
						}
						else {
							if (permissionEdit.is(':checked')) {
								permissionRead.prop('checked', 'checked')
								permissionAdd.prop('checked', 'checked')
							}
						}
					}
				});
			// Delete Permission
				$('body').on('click','.permissionDelete', function() {
					group = $(this).parent('label').parent('.checkbox').parent('.form-group')
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
						permissionDelete.prop('checked', 'checked')
					}
					else {
						if (permissionRead.is(':checked') && permissionAdd.is(':checked') && permissionEdit.is(':checked') && permissionDelete.is(':checked')) {
							permissionFull.prop('checked', 'checked')
						}
					}
				});
			
			// file
				selectFile('.btnSelectThumbnail', 'images')
				// delele file
				$('body').on('click', '.thumbnailDel', function(e) {
					e.preventDefault();
					thumbnailWrapper = $(this).parent('.thumbnailWrapper')
					inputThumbnail = thumbnailWrapper.prev().children('.inputThumbnail')

					inputThumbnail.val('')
					thumbnailWrapper.html('').html(defaultIMG)
				});
			}

		// add
			if ($('#frmAdd').length>0) {
			
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

			// validation
				var $validator = $("#frmAdd").validate({
					    rules: {
							username: { 
								required: true,
								maxlength : 255,
								remote: {
									url: bUrl + module + '/ajax_existed_username',
					                type: 'post',
					                data: {
					                	csrf_hash : function(){ return $.cookie('csrf_cookie_ci') },
					                	oper : function(){ return 'add' },
										username : function(){ return $('input[name=username]').val(); }
					                }
								}
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
					      		maxlength : "Maximum is 255 characters",
					      		remote: jQuery.validator.format("Username \"{0}\" is already taken")
					      	},
					        password: {
					        	required : "Password is required",
					        	minlength : "Minimum is 255 characters",
					        	maxlength : "Maximum is 255 characters"
					        },
					        confirm_password: {
					        	required : "Confirm Password is required",
					        	minlength : "Minimum is 255 characters",
					        	maxlength : "Maximum is 255 characters",
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
					    	// check exist in category
					    	$.ajax({
					    		url: bUrl + module + '/ajax_existed_username',
					            type: 'POST',
				                cache: false,
				                dataType: 'text',
				                data: { 'oper':'add',
				                		'username':$('input[name="username"]').val(), 
				                		'csrf_hash' : $.cookie('csrf_cookie_ci')
				                	  },
				                success: function(data) {
				                	if (data=="false") {
				                		errorContent = '<span for="title" class="help-block">Username "'+$('input[name=username]').val()+'" is already taken</span>';
				                		$('input[name=username]').closest('.form-group').removeClass('has-success').addClass('has-error');
				                		$('input[name=username]').after(errorContent)
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
			}
		
		// edit info
			if ($('#frmEditInfo').length>0) {
			
			// validation
				var $validator = $("#frmEditInfo").validate({
					    rules: {
							username: { 
								required: true,
								maxlength : 255,
								remote: {
									url: bUrl + module + '/ajax_existed_username',
					                type: 'post',
					                data: {
					                	csrf_hash : function(){ return $.cookie('csrf_cookie_ci') },
					                	oper : function(){ return 'edit' },
										username : function(){ return $('input[name=username]').val(); },
										id : function(){ return $('input[name=id]').val(); }
					                }
								}
							}
					    },
					    messages: {
					      	username: {
					      		required : "Username is required",
					      		maxlength : "Maximum is 255 characters",
					      		remote: jQuery.validator.format("Username \"{0}\" is already taken")
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
					    	// check exist in category
					    	$.ajax({
					    		url: bUrl + module + '/ajax_existed_username',
					            type: 'POST',
				                cache: false,
				                dataType: 'text',
				                data: { 'oper':'edit',
				                		'username':$('input[name="username"]').val(), 
				                		'id' : $('input[name="id"]').val(),
				                		'csrf_hash' : $.cookie('csrf_cookie_ci')
				                	  },
				                success: function(data) {
				                	if (data=="false") {
				                		errorContent = '<span for="title" class="help-block">Username "'+$('input[name=username]').val()+'" is already taken</span>';
				                		$('input[name=username]').closest('.form-group').removeClass('has-success').addClass('has-error');
				                		$('input[name=username]').after(errorContent)
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
			}

		// edit password
			if ($('#frmEditPassword').length>0) {
			// password
				$('body').on('focus','input[name="password"]', function() {
					$(this).prop('type','password').val('')
					$('input[name="confirm_password"]').prop('type','password').val('');
				});
				$('body').on('click','#randomPass', function() {
					ranPass = randString(6);
					$('input[name="password"]').prop('type','text').val(ranPass)
					$('input[name="confirm_password"]').prop('type','text').val(ranPass)
				});

			// validation
				var $validator = $("#frmEditPassword").validate({
					    rules: {
							old_password: { 
								required: true,
								maxlength : 255
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
					      	old_password: {
					      		required : "Old Password is required",
					      		maxlength : "Maximum is 255 characters"
					      	},
					      	password: {
					        	required : "New Password is required",
					        	minlength : "Minimum is 255 characters",
					        	maxlength : "Maximum is 255 characters"
					        },
					        confirm_password: {
					        	required : "Confirm Password is required",
					        	minlength : "Minimum is 255 characters",
					        	maxlength : "Maximum is 255 characters",
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
					    }
					});
			}

		}
	}

// SERVICE
	function servicePage()
	{
		if ($('#servicePage').length>0) {
			module = 'service'

		// list
			if ($(idTableList).length>0) {
				var statusStr = ":All;active:Active;inactive:Inactive;block:Block";
				caption = captionButton(module, true, true)

			// jqGrid
				jQuery(idTableList).jqGrid({
					url: bUrl + module + '/ajax_list?q=2',
					datatype: "json",
					height : 'auto',
					autowidth : true,
					shrinkToFit: false,
					gridResize: true,
					autoResizeAllColumns: true,
					iconSet: "fontAwesome",
					colNames : ['Status', 'ID', 'Title', 'Category','Order', 'Thumbnail', 'Action'],
					colModel : [{ name : 'status', index : 'status', align : 'center', width : '80',
									stype: 'select', searchoptions:{ sopt:['eq'], value: statusStr }
								},
								{ name : 'id', index : 'id', search : true, align : 'center', width : '60' }, 
								{ name : 'title', index : 'title', align : 'left', search : true, width : '150' }, 
								{ name : 'categoryName', index : 'categoryName', search : true, width : '150' },
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
							var fa = formatButton(cl, rowData.status, 'btnStatus_', 'btnStatus', 'modalStatus', arrClassValue_Status, classTextColor_Status)
							var th = ""
							if (rowData.thumbnail != "") {
								th = '<img src="' + rowData.thumbnail + '" class="thumbInTable" />'
							}
							var	btnInline = btnEditInline(module, cl, true) + bntDeleteInline(module, false, cl, true)
							jQuery(idTableList).jqGrid('setRowData', ids[i], {
								status : fa,
								thumbnail : th,
								act : btnInline
							});

						}
					// btnStatus
						click_btnInGrid('btnStatus', 'modalStatus', bUrl+module+'/ajax_status', arrClassValue_Status, function() {
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
					showSmartAlert("Warning", "<p>Are you sure delete data ?</p>", '[NO][YES]', function() {
						// click YES
						$('#ids').val(selectedRows)
						$('#frmTopButtons').submit();
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
						showSmartAlert("Warning", "<p>Are you sure delete data ?</p>", '[NO][YES]', function() {
							// click YES
							$('#ids').val(selectedRows)
							$('#frmTopButtons').submit();
						}, function() {
							// click NO
						});
					}
				});

			}
		
		// common add & edit
			if ($('#addContainer').length>0 || $('#editContainer').length>0) {
			// select category
				$('body').on('click', '.category', function() {
					$('.category').removeClass('btn-success')
					$(this).addClass('btn-success')
					$('input[name="category"]').val($(this).attr('data-save'))

					index = $(this).index();
					$('.chooseDate').removeClass('showChooseDate');
					$('#inputDateWrapper').find('.chooseDate:eq('+index+')').addClass('showChooseDate')
				});
				$('input[name="title"]').mouseenter( function() {

				})

			// generate URL
				gen_url($('input[name="title"]'), $('input[name="url"]'));
				gen_url($('input[name="titleEN"]'), $('input[name="urlEN"]'));

			// limit character
				$('input[name="title"]').limit('200','#titleLimit');
				$('input[name="url"]').limit('200','#urlLimit');
				$('textarea[name="desc"]').limit('1000','#descLimit');

				$('input[name="titleEN"]').limit('200','#titleENLimit');
				$('input[name="urlEN"]').limit('200','#urlENLimit');
				$('textarea[name="descEN"]').limit('1000','#descENLimit');

			// file
				selectFile('.btnSelectThumbnail', 'images')
				// delele file
				$('body').on('click', '.thumbnailDel', function(e) {
					e.preventDefault();
					thumbnailWrapper = $(this).parent('.thumbnailWrapper')
					inputThumbnail = thumbnailWrapper.prev().children('.inputThumbnail')

					inputThumbnail.val('')
					thumbnailWrapper.html('').html(defaultIMG)
				});

			// editor
				CKEDITOR.replace( 'contentService', {
		            entities_latin: false,
		            entities_greek: false,
		            toolbar: 'Full'
		        })
		        CKEDITOR.replace( 'contentServiceEN', {
		            entities_latin: false,
		            entities_greek: false,
		            toolbar: 'Full'
		        })
			}

		// add
			if ($('#addContainer').length>0) {
				var oper = 'add';

			// validation
				var $validator = $("#frmAdd").validate({
				    rules: {
				    	title: { 
							required : true,
							maxlength : 200
						},
						url: { 
							required: true,
							maxlength : 200,
							remote: {
								url: bUrl + module + '/ajax_existed_inCategory',
				                type: 'post',
				                data: {
				                	csrf_hash : function(){ return $.cookie('csrf_cookie_ci') },
				                	oper : function(){ return oper },
									url : function(){ return $('input[name=url]').val(); },
									parent_id : function(){ return $('input[name=parent_id]').val(); },
									lang : function(){ return "vn" }
				                }
							}
						},
						desc: {
							maxlength : 1000,
						},
						titleEN: { 
							required : true,
							maxlength : 200
						},
						urlEN: { 
							required: true,
							maxlength : 200,
							remote: {
								url: bUrl + module + '/ajax_existed_inCategory',
				                type: 'post',
				                data: {
				                	csrf_hash : function(){ return $.cookie('csrf_cookie_ci') },
				                	oper : function(){ return oper },
									url : function(){ return $('input[name=urlEN]').val(); },
									parent_id : function(){ return $('input[name=parent_id]').val(); },
									lang : function(){ return "en" }
				                }
							}
						},
						descEN: {
							maxlength : 1000,
						}
				    },
				    messages: {
				    	title: {
				    		required : "Name is required",
				    		maxlength : "Maximum is 200 characters"
				    	},
				      	url: {
				      		required : "URL is required",
				      		maxlength : "Maximum is 200 characters",
				      		remote: jQuery.validator.format("URL \"{0}\" is already taken")
				      	},
				        desc: { 
				        	maxlength : "Maximum is 1000 characters"
				        },
				        titleEN: {
				    		required : "Name is required",
				    		maxlength : "Maximum is 200 characters"
				    	},
				      	urlEN: {
				      		required : "URL is required",
				      		maxlength : "Maximum is 200 characters",
				      		remote: jQuery.validator.format("URL \"{0}\" is already taken")
				      	},
				        descEN: { 
				        	maxlength : "Maximum is 1000 characters"
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
				    	// check exist in category
				    	$.ajax({
				    		url: bUrl + module + '/ajax_multi_existed_inCategory',
				            type: 'POST',
			                cache: false,
			                dataType: 'json',
			                data: { 'csrf_hash' : $.cookie('csrf_cookie_ci'),
			                		'oper': oper,
			                		'id': $('input[name=id]').val(),
			                		'url' : $('input[name=url]').val(),
			                		'urlEN' : $('input[name=urlEN]').val(),
			                		'parent_id': $('input[name=parent_id]').val()
			                	  },
			                success: function(data) {
			                	if (data.error=="1") {
			                		showSmartAlert("Error", "URL VN is already taken", '[YES]')
			                	}
			                	else if (data.error=="2") {
			                		showSmartAlert("Error", "URL EN is already taken", '[YES]')
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
			}

		// edit
			if ($('#editContainer').length>0) {
				var oper = 'edit';
				var id = $('input[name=id]').val();

			// validation
				var $validator = $("#frmEdit").validate({
				    rules: {
				    	title: { 
							required : true,
							maxlength : 200
						},
						url: { 
							required: true,
							maxlength : 200,
							remote: {
								url: bUrl + module + '/ajax_existed_inCategory',
				                type: 'post',
				                data: {
				                	csrf_hash : function(){ return $.cookie('csrf_cookie_ci') },
				                	oper : function(){ return oper },
				                	id : id,
									url : function(){ return $('input[name=url]').val(); },
									parent_id : function(){ return $('input[name=parent_id]').val(); },
									lang : function(){ return "vn" }
				                }
							}
						},
						desc: {
							maxlength : 1000,
						},
						titleEN: { 
							required : true,
							maxlength : 200
						},
						urlEN: { 
							required: true,
							maxlength : 200,
							remote: {
								url: bUrl + module + '/ajax_existed_inCategory',
				                type: 'post',
				                data: {
				                	csrf_hash : function(){ return $.cookie('csrf_cookie_ci') },
				                	oper : function(){ return oper },
				                	id : id,
									url : function(){ return $('input[name=urlEN]').val(); },
									parent_id : function(){ return $('input[name=parent_id]').val(); },
									lang : function(){ return "en" }
				                }
							}
						},
						descEN: {
							maxlength : 1000,
						}
				    },
				    messages: {
				    	title: {
				    		required : "Name is required",
				    		maxlength : "Maximum is 200 characters"
				    	},
				      	url: {
				      		required : "URL is required",
				      		maxlength : "Maximum is 200 characters",
				      		remote: jQuery.validator.format("URL \"{0}\" is already taken")
				      	},
				        desc: { 
				        	maxlength : "Maximum is 1000 characters"
				        },
				        titleEN: {
				    		required : "Name is required",
				    		maxlength : "Maximum is 200 characters"
				    	},
				      	urlEN: {
				      		required : "URL is required",
				      		maxlength : "Maximum is 200 characters",
				      		remote: jQuery.validator.format("URL \"{0}\" is already taken")
				      	},
				        descEN: { 
				        	maxlength : "Maximum is 1000 characters"
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
				    	// check exist in category
				    	$.ajax({
				    		url: bUrl + module + '/ajax_multi_existed_inCategory',
				            type: 'POST',
			                cache: false,
			                dataType: 'json',
			                data: { 'csrf_hash' : $.cookie('csrf_cookie_ci'),
			                		'oper': oper,
			                		id : id,
			                		'url' : $('input[name=url]').val(),
			                		'urlEN' : $('input[name=urlEN]').val(),
			                		'parent_id': $('input[name=parent_id]').val()
			                	  },
			                success: function(data) {
			                	if (data.error=="1") {
			                		showSmartAlert("Error", "URL VN is already taken", '[YES]')
			                	}
			                	else if (data.error=="2") {
			                		showSmartAlert("Error", "URL EN is already taken", '[YES]')
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
			}
		}
	}

// USER
	function userPage()
	{
		if ($('#userPage').length>0) {
			module = 'user'

		// list
			if ($(idTableList).length>0) {
				var statusStr = ":All;active:Active;inactive:Inactive";
				caption = captionButton(module, false, false)
				caption += captionExport(module);

			// jqGrid
				jQuery(idTableList).jqGrid({
					url: bUrl + module + '/ajax_list?q=2',
					datatype: "json",
					height : 'auto',
					autowidth : true,
					shrinkToFit: false,
					gridResize: true,
					autoResizeAllColumns: true,
					iconSet: "fontAwesome",
					colNames : ['Status', 'ID', 'Title', 'Service', 'Fullname', 'Phone'/*, 'Action'*/],
					colModel : [{ name : 'status', index : 'status', align : 'center', width : '80',
									stype: 'select', searchoptions:{ sopt:['eq'], value: statusStr }
								},
								{ name : 'id', index : 'id', search : true, align : 'center', width : '60' }, 
								{ name : 'title', index : 'title', align : 'left', search : true, width : '150' }, 
								{ name : 'service', index : 'service', search : true, width : '150' },
								{ name : 'fullname', index : 'fullname', search : true, width : '150' },
								{ name : 'phone', index : 'phone', search : true, width : '150' },
								// { name: "act", index: 'act', editable : false, search : false, width : '80', align : 'center' }
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
							var fa = formatButton(cl, rowData.status, 'btnStatus_', 'btnStatus', 'modalStatus', arrClassValue_Status, classTextColor_Status)
							var th = ""
							if (rowData.thumbnail != "") {
								th = '<img src="' + rowData.thumbnail + '" class="thumbInTable" />'
							}
							var	btnInline = btnEditInline(module, cl, true) + bntDeleteInline(module, false, cl, true)
							jQuery(idTableList).jqGrid('setRowData', ids[i], {
								status : fa,
								thumbnail : th,
								act : btnInline
							});

						}
					// btnStatus
						click_btnInGrid('btnStatus', 'modalStatus', bUrl+module+'/ajax_status', arrClassValue_Status, function() {
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
			/*
			// delete inline
				$('body').on('click','.btnDelete', function(e) {
					e.preventDefault();

					href = $(this).attr('href');
					showSmartAlert("Warning", "<p>Are you sure delete data ?</p>", '[NO][YES]', function() {
						// click YES
						$('#ids').val(selectedRows)
						$('#frmTopButtons').submit();
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
						showSmartAlert("Warning", "<p>Are you sure delete data ?</p>", '[NO][YES]', function() {
							// click YES
							$('#ids').val(selectedRows)
							$('#frmTopButtons').submit();
						}, function() {
							// click NO
						});
					}
				});
			*/
			}
		}
	}

// DOCUMENT ready
	$(document).ready( function() {

	// btnCancel
		if ($('.btnCancel').length>0) {
			$('.btnCancel').click( function() {
				window.history.back();
			});
		}
	// replyError
		if ($('#login_form').length==0) {
			if (replyErrorContent != null && replyErrorContent != undefined && replyErrorContent != "") {
				showSmartAlert("Error", replyErrorContent, '[YES]')
			}
		}
	// import & export
		if ($('#frmImport').length>0) {

			$('body').on('click', 'a#btnImport', function(e) {
				e.preventDefault()
				$('input[name="importFile"]').click();
			});
			$('body').on('change', 'input[name="importFile"]', function(e) {
				$('#frmImport').submit();
			});
		}

		pageSetUp()
		positiveInteger();
	    setOrder();
	    statusAdd()
	    statusEdit()
	// auth
		if ($('#login_form').length>0) {
			valid_login();
    		refresh_captcha();
    	}

   	// pages
		dashboardPage()
		categoryPage()
		modulePage()
		memberPage()

		servicePage()
		userPage()
	});

