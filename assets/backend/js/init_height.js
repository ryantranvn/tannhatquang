// set height
    var otherHeight = $('#header').height() + $('#left-panel').height() + $('.mainContainer').height() + 50 + 34 + $('.page-footer').height();
    $('.wrap_left, .wrap_right, #wrap_form').css({
        'height' : ($(window).height()-otherHeight)+'px'
    });

    $(window).resize( function() {
        $('.wrap_left, .wrap_right, #wrap_form').css({
            'height' : ($(window).height()-otherHeight)+'px'
        });
    });
