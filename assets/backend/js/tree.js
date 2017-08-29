// tree view
    var selected_category_id = $('input[name="selected_category_id"]').val();
    treeView();
// default_category_id
$('.tree').find('span[data-id='+selected_category_id+']').addClass('label-success');
// show icons on tree
if (permissionsMember[currentModule['control_name']][3] == 1 && $('#is_post').length==0) { // has permission and not post page
        if ($('#frmCategory').length==0) { // only edit in category or sub-category page
            $('.tree').find('span').each( function() {
                $(this).click( function() {
                    if ($(this).attr('data-id')>2) { // not default category
                        $('.tree').find('a').remove();
                        htmlStr = '<a class="iconEdit_inTree" href="' + bUrl + currentModule['url'] + '/edit/' + $(this).attr('data-id') + '"><i class="fa fa-lg fa-edit"></i></a>';
                        htmlStr += '<a class="iconDelete_inTree" href="' + bUrl + currentModule['url'] + '/delete/' + $(this).attr('data-id') + '"><i class="fa fa-lg fa-trash-o txt-color-red"></i></a>';
                        $(this).append(htmlStr);
                    }
                });
            })

        }
    }


// disabled root on sub category page
    if ($('#is_sub_category').length>0 && $('#is_sub_category').val()!=0) {
        $('#root').addClass('btn bg-color-blueDark txt-color-white disabled');
    }
// disabled category can move to
    if ($('input[name=id_category]').length>0 && $('input[name=id_category]').val() != "") {
        // disabled itself
        currentItem = $('.tree').find('li > span[data-id=' + $('input[name=selected_category_id]').val() + ']');
        // disable children
        currentItem.parent('li').children('ul').find('span').addClass('btn btn-danger disabled');
        // disabled parent
        parentItem = $('.tree').find('li > span[data-id=' + $('input[name=parent_id]').val() + ']')
        parentItem.addClass('btn btn-danger disabled');
    }
