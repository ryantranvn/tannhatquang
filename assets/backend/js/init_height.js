// set height
    var otherHeight = $('#header').height() + $('#left-panel').height() + $('.mainContainer').height() + 50 + 34 + $('.page-footer').height();
    var height_scroll_div = function() {
        $('.wrap_left, .wrap_right, #wrap_form, .wrap_tab').css({
            'height' : ($(window).height()-otherHeight)+'px'
        });
    }

    height_scroll_div();
    $(window).resize( function() {
        height_scroll_div();
    });
// btn zoom
/*
	$('body').on('click', 'a.jarviswidget-fullscreen-btn', function() {
		var parent = $(this).closest('.jarviswidget');
		parent.find('.ui-jqgrid-view, .ui-jqgrid-hdiv, .ui-jqgrid-bdiv').css({'width':'100%'});
	});
	$('body').on('click', 'a.jarviswidget-fullscreen-btn i.fa.fa-compress', function() {

	});
*/
