// config
	var idTableList = '#jqgrid'
	var idPager = "#pjqgrid"
	var defaultNumRows = 50
	var defaultIMG = '<img class="thumbnail" src="'+fUrl+'assets/common/images/default.jpg" />'

/*
	$(document).on({
	    ajaxStart: function() {
	        processing_on();
	    },
	    ajaxStop: function() {
	       processing_off();
	    }
	});
*/

/* alert */
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
	function captionButton(btnAdd, btnDelete)
	{
		caption = "";

		if (btnAdd == true && permissionsMember[currentModule['control_name']][2] == 1) {
			caption += '<a id="btnAdd" href="'+bUrl+currentModule['url']+'/add" class="btnTop btn btn-success"><i class="fa fa-plus"></i> Add</a>';
		}
		if (btnDelete == true && permissionsMember[currentModule['control_name']][4] == 1) {
			caption += '<a id="btnMultiDelete" href="#" class="btnTop btn btn-danger"><i class="fa fa-trash-o"></i> Delete</a>';
		}

		return caption;
	}
	function captionExport(module)
	{
		return '<a id="btnExport" href="'+bUrl+module+'/export_db" class="btnTop btn btn-primary"><i class="fa fa-cloud-download"></i> Export</a>';
	}
	function captionImport(module)
	{
		return '<a id="btnImport" href="#" class="btnTop btn btn-default"><i class="fa fa-cloud-upload"></i> Import</a>'
	}

// action buttons inline
	function btnEditInline(id)
	{
		buttons = '';
		if (permissionsMember[currentModule['control_name']][3] == 1) {
			buttons += '<a href="' + bUrl + currentModule['url'] + '/edit/' + id + '" data-id="' + id + '" class="btn btn-primary btn-xs btnEdit"><i class="fa fa-edit"></i></a>'
		}

		return buttons;
	}
	function bntDeleteInline(id)
	{
		buttons = '';
		if (permissionsMember[currentModule['control_name']][4] == 1) {
			buttons += '<a href="' + bUrl + currentModule['url'] + '/delete/' + id + '" data-id="' + id + '" class="btn btn-danger btn-xs btnDelete"><i class="fa fa-trash-o"></i></a>'
		}
		return buttons;
	}

// status
	var clsTextColor_Status = 'txt-color-white'
	var clsBgColor_ActiveStatus = 'bg-color-green'
	var clsBgColor_InactiveStatus = 'bg-color-blueDark'
	var clsBgColor_BlockStatus = 'bg-color-red'
	var arrStatus = new Array()
	arrStatus['active'] 	= ['bg-color-green', 	'txt-color-white']
	arrStatus['inactive'] 	= ['bg-color-blueDark', 'txt-color-white']
	arrStatus['block'] 		= ['bg-color-red', 		'txt-color-white']
	// init both add or edit form has status element
	function init_Radio() {
		if ($('.radioWrapper').length>0) {
			$('body').find('.radioWrapper').each( function() {
				var radioId = $(this).attr('id')
				var radioWrapper = $('#'+radioId)
				var checkedStatus = radioWrapper.find('input[name=status]:checked')

				if (checkedStatus != undefined) {
					checkedStatus.parent('label').addClass('active')
					checkedStatus.parent('label').addClass(arrStatus[checkedStatus.val()][0])
					checkedStatus.parent('label').addClass(arrStatus[checkedStatus.val()][1])
				}

				// on click
				radioWrapper.on('click', 'label.btn', function() {
					var thisLabel = $(this)
					var input = thisLabel.children('input')
					var btn_group = thisLabel.parent('.btn-group')
					var is_checked = input.is(':checked')
					if (!is_checked) {
						// reset
						btn_group.find('input:checked').removeAttr('checked')
						btn_group.find('label').attr('class','btn btn-default')
						// new
						thisLabel.addClass(arrStatus[input.val()][0]).addClass(arrStatus[input.val()][1])
						input.attr('checked','checked');
					}
				})
			})
		}
	}

	function formatButton(idRow, statusVal, preID_Btn, class_Btn, id_Modal) // button in grid list
	{
		activeClass = arrStatus[statusVal][0] + " " + arrStatus[statusVal][1]

		fa = '<button id="'+preID_Btn+idRow+'" class="btn '+class_Btn+' '+activeClass+'" data-id="'+idRow+'" data-toggle="modal" data-target="#'+id_Modal+'">'
			fa += statusVal
		fa += '</button>'

		return fa;
	}
	function click_btnInGrid(class_Btn, id_Modal, url_Ajax, fnCallback)
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
							/*
								removeClass = arrStatus[oldValue][0] + " " + arrStatus[oldValue][1]
								activeClass = arrStatus[newValue][0] + " " + arrStatus[newValue][1]
							// remove oldClass
								$('#'+idBtn).removeClass(removeClass)
							// add newClass
								$('#'+idBtn).addClass(activeClass)
							// set value
								$('#'+idBtn).html(newValue)
							*/
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
// tree view
	function treeView()
	{
		if ($('.tree').length>0) {
			$('.tree').find('li').addClass('parent_li').attr('role', 'treeitem').children('span').on('click', function() {
			// set color
				$('.tree').find('li').children('span').removeClass('label-success');

				$(this).addClass('label-success');
			// set data
				$(this).closest('.wrap_tree').find('input[name=selected_category_id]').val($(this).attr('data-id'))
				$(this).closest('.wrap_tree').find('input[name=parent_id]').val($(this).closest('ul').prev('span').attr('data-id'));
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
		else if (type == "media") {
			window.open(libsUrl + 'kcfinder/browse.php?type=media&dir=media/public', 'kcfinder_textbox',
		        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
		        'resizable=1, scrollbars=0, width=800, height=600'
		    );
		}
	}
	function openKCFinderMulti(field, type, hasLink, fnCallback) {
	    window.KCFinder = {
	        callBackMultiple: function(files) {
	            window.KCFinder = null;
				var arr = new Array();
				if (field.val()!="") {
					arr = JSON.parse(field.val())
				}
	            for (var i = 0; i < files.length; i++) {
	                arr.push(files[i])
	            }
				field.val(JSON.stringify(arr))
	            if(typeof fnCallback == "function"){
		            fnCallback();
		        }
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
	function selectFile(buttonClass, typeFile, multiFile, hasLink)
	{
		$('body').on('click', buttonClass, function() {
			if (typeFile == 'images' || typeFile == 'media') {
				thumbnailWrapper = $(this).parent().parent().next('.thumbnailWrapper')
			}
			if (multiFile==undefined || multiFile=="") {
				inputField = $(this).parent().prev('.inputThumbnail')
				openKCFinder(inputField, typeFile, function() {
					filename = inputField.val();
					if (typeFile == 'images') {
						typeDir = 'images/'
						htmlImg = '<img src="' + filename + '" class="thumbnail" />';
		                htmlDel = '<a class="thumbnailDel"><i class="fa fa-trash-o"></i></a>'
	                	nameLinkInput = inputField.attr('name')
	                	if (hasLink==undefined || hasLink=="") {
	                		htmlLink = ''
	                	}
	                	else if (hasLink==true) {
		                	htmlLink = '<div class="row">'
			                	htmlLink += '<label style="float: left; clear: both;">Link</label>'
			                	htmlLink += '<input type="text" name="'+nameLinkInput+'_link" class="inputThumbnail form-control" style="float: left; clear: both" />'
			                htmlLink += '</div>'
			            }
		                thumbnailWrapper.html('').html('<div class="thumbnailItem">' + htmlImg+htmlDel+htmlLink + '</div>')
		            }
		            else if (typeFile == 'media') {
		            	htmlStr = '<video id="video" width="320" controls="true">'
					        htmlStr += '<source src="'+filename+'">'
					        htmlStr += 'Your browser does not support HTML5 video tag. Please download FireFox 3.5 or higher.'
					    htmlStr += '</video><br/>'
					    // htmlStr += '<button onclick="shoot()" style="width: 64px;border: solid 2px #ccc;">Capture</button><br/>'
					    // htmlStr += '<div id="output" style="display: inline-block; top: 4px; position: relative ;border: dotted 1px #ccc; padding: 2px;"></div>'
		            	thumbnailWrapper.html('').html(htmlStr)
		            }
				})
			}
			else {
				inputField = $(this).parent().prev('.inputThumbnail')
				openKCFinderMulti(inputField, typeFile, hasLink, function() {
					if (typeFile == 'images') {
						typeDir = 'images/'
						var obj = JSON.parse(inputField.val());
						htmlImgList = "";
						$.each(obj, function(index, value) {
							htmlImg = '<img src="' + value + '" class="thumbnail" />';
			                htmlDel = '<a class="thumbnailDel"><i class="fa fa-trash-o"></i></a>';
							if (hasLink==undefined || hasLink=="") {
		                		htmlLink = ''
		                	}
							else {
								htmlLink = '<div class="">'
				                	htmlLink += '<label style="float: left; clear: both;">Link</label>'
				                	htmlLink += '<input type="text" name="thumbnail_links[]" class="form-control" style="float: left; clear: both" />'
				                htmlLink += '</div>'
							}
							htmlImgList += '<div class="thumbnailItem">' + htmlImg + htmlDel + htmlLink + '</div>';
						});
						thumbnailWrapper.html('').html(htmlImgList);
						// if (thumbnailWrapper.find('.thumbnailItem').length==0) {
						// 	thumbnailWrapper.html('').html(htmlImgList);
						// }
						// else {
						// 	thumbnailWrapper.append(htmlImgList);
						// }
					}
				});
			}
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

// select category
	function selectCategory(itemClass, fnCallback)
	{
		$('body').on('click', itemClass, function() {

			inputField = $(itemClass).parent().next('input')
			index = $(this).index();
			value = $(this).attr('data-save')

			$(itemClass).removeClass('btn-success')
			$(this).addClass('btn-success')
			inputField.val(value)

			if(typeof fnCallback == "function"){
	            fnCallback(index, value);
	        }
		});
	}

// capture video
	var videoId = 'video';
	var scaleFactor = 0.25;
	var snapshots = [];

	/**
	 * Captures a image frame from the provided video element.
	 *
	 * @param {Video} video HTML5 video element from where the image frame will be captured.
	 * @param {Number} scaleFactor Factor to scale the canvas element that will be return. This is an optional parameter.
	 *
	 * @return {Canvas}
	 */
	function capture(video, scaleFactor) {
	    if(scaleFactor == null){
	        scaleFactor = 1;
	    }
	    var w = video.videoWidth * scaleFactor;
	    var h = video.videoHeight * scaleFactor;
	    var canvas = document.createElement('canvas');
	        canvas.width  = w;
	        canvas.height = h;
	    var ctx = canvas.getContext('2d');
	        ctx.drawImage(video, 0, 0, w, h);
	    return canvas;
	}

	/**
	 * Invokes the <code>capture</code> function and attaches the canvas element to the DOM.
	 */
	function shoot(){
	    var video  = document.getElementById(videoId);
	    var output = document.getElementById('output');
	    var canvas = capture(video, scaleFactor);
	        canvas.onclick = function(){
	            window.open(this.toDataURL());
	        };
	    snapshots.unshift(canvas);
	    output.innerHTML = '';
	    for(var i=0; i<4; i++){
	        output.appendChild(snapshots[i]);
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
	        submitHandler: function(form) {
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

// MEMBER
	function memberPage()
	{
		if ($('#memberPage').length>0) {
			module = 'member'

		// list
			if ($(idTableList).length>0) {
				var activeStr = ":All;active:Active;inactive:Inactive;block:Block";
				if (authMember['username'] == 'admin') {
					caption = captionButton(module, true, false)
				}
				else {
					caption = captionButton(module, false, false)
				}
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
								if (rowData.id == authMember['id']) {
									var btnInline = btnEditInline(module, cl, true) //+ bntDeleteInline(module, false, cl, true)
									fa = ""
								}
								else {
									$('tr#'+rowData.id).children('td:eq(1)').html('');
									var btnInline = btnEditInline(module, cl, true) + bntDeleteInline(module, false, cl, true)
									var fa = formatButton(cl, rowData.status, 'btnStatus_', 'btnStatus', 'modalStatus')
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
							click_btnInGrid('btnStatus', 'modalStatus', bUrl+module+'/ajax_status', function() {
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
			if ($('#frmAdd').length>0 || $('#frmEditInfo').length>0) {

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

		// check box permission
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

// SETTING
	function settingPage()
	{
		if ($('#frmEditMeta').length>0) {
			var $validator = $("#frmEditMeta").validate({
					rules: {
						pageTitle: {
							required: true,
							maxlength : 255
						},
						metaKey: {
							required: true
						},
						metaDesc: {
							required : true,
							maxlength : 255
						}
					},
					messages: {
						pageTitle: {
							required : "Page Title is required",
							maxlength : "Maximum is 255 characters"
						},
						metaKey: {
							required : "Meta Keyword is required"
						},
						metaDesc: {
							required : "Meta Description is required",
							maxlength : "Maximum is 255 characters",
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

			$('input[name="pageTitle"]').limit('255','#pageTitleLimit');
			$('input[name="metaDesc"]').limit('255','#metaDescLimit');
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
				// caption += captionImport(module);
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
					colNames : ['Status', /*'ID',*/ 'Email', 'Max Score', 'Time', 'Regist Datetime'],
					colModel : [{ name : 'status', index : 'status', align : 'center', width : '80',
									stype: 'select', searchoptions:{ sopt:['eq'], value: statusStr }
								},
								// { name : 'id', index : 'id', search : true, align : 'center', width : '60' },
								{ name : 'email', index : 'email', align : 'left', search : true, width : '400' },
								{ name : 'score', index : 'score', align : 'center', search : true, width : '100' },
								{ name : 'time', index : 'time', align : 'center', search : true, width : '100' },
								{ name : 'created_datetime', index : 'created_datetime', align : 'center', search : true, width : '200' }
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
							var aiDi = rowData.id - 3
							var fa = ""
							var fa = formatButton(cl, rowData.status, 'btnStatus_', 'btnStatus', 'modalStatus')
							var th = ""
							if (rowData.thumbnail != "") {
								th = '<img src="' + rowData.thumbnail + '" class="thumbInTable" />'
							}
							var	btnInline = btnEditInline(module, cl, true) + bntDeleteInline(module, false, cl, true)
							jQuery(idTableList).jqGrid('setRowData', ids[i], {
								id : aiDi,
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
					subGrid : true,
					subGridBeforeExpand: function(subgrid_id, row_id) {
						// $('#'+row_id).addClass('expandRow');
					},
					subGridRowExpanded: function(subgrid_id, row_id) {
						var subgrid_table_id, pager_id;
						subgrid_table_id = subgrid_id+"_t";
						pager_id = "p_"+subgrid_table_id;
						$("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' class='scroll subTable'></table><div id='"+pager_id+"' class='scroll'></div>");
						jQuery("#"+subgrid_table_id).jqGrid({
							url:  bUrl + module + '/ajax_sublist?q=2&id='+row_id,
							datatype: "json",
							colNames: ['Score','Time','Datetime'],
							colModel: [
								{ name : "total_score", index : "total_score", width : "200", align : "center" },
								{ name : "client_time", index : "client_time", width : "200", align : "center" },
								{ name : "created_datetime", index : "created_datetime", width : "200", align : "center" }
							],
							rownumbers : true,
						   	rowNum : 20,
						   	// pager: pager_id,
						   	sortname: 'id',
						    sortorder: "asc",
						    height: '100%',
						    gridComplete : function() {
						    	var subIds = jQuery("#"+subgrid_table_id).jqGrid('getDataIDs');
								for (var i = 0; i < subIds.length; i++) {
									var cl = subIds[i];
									var rowData = jQuery("#"+subgrid_table_id).jqGrid ('getRowData', cl);
									if (rowData.total_score == "") {
										ts = 0
									}
									else {
										ts = rowData.total_score
									}
									if (rowData.right == 1) {
										right = '<span class="label label-primary">TRUE</span>'
									}
									else {
										right = '<span class="label label-danger">FALSE</span>'
									}

									jQuery("#"+subgrid_table_id).jqGrid('setRowData', subIds[i], {
										right : right,
										total_score : ts
									});
								}
						    }
						});
					},
					subGridRowColapsed: function(subgrid_id, row_id) {
						//$('#'+row_id).removeClass('expandRow');
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
					selectedRows = jQuery(idTableList).jqGrid('getGridParam','selarrrow');
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
		}
	}

	$(document).ready( function() {
		$('body').on('click', 'a.jarviswidget-fullscreen-btn', function() {
			var parent = $(this).closest('.jarviswidget');
			parent.find('.ui-jqgrid-view, .ui-jqgrid-hdiv, .ui-jqgrid-bdiv').css({'width':'100%'});
		});
	// btnCancel
		if ($('.btnCancel').length>0) {
			$('.btnCancel').click( function() {
				window.history.back();
			});
		}
	// status
		init_Radio()
	// replyError
		if ($('#login_form').length==0) {
			if (typeof replyErrorContent !== 'undefined') {
				if (replyErrorContent !== null && replyErrorContent !== "") {
					showSmartAlert("Error", replyErrorContent, '[YES]')
				}
			}
		}
	// import & export
		if ($('#frmImport').length>0) {
			$('body').on('click', 'a#btnImport', function(e) {
				e.preventDefault()
				$('input[name="importFile"]').click();
			});
			$('body').on('change', 'input[name="importFile"]', function(e) {
				processing_on();
				$('#frmImport').submit();
			});
		}

	// some init
		pageSetUp(); // init smartadmin
		positiveInteger();
	    setOrder();
	// auth
		if ($('#login_form').length>0) {
			valid_login();
    		refresh_captcha();
    	}

   	// pages
		dashboardPage();
		// modulePage();
		memberPage();
		settingPage();

		userPage();
	});
