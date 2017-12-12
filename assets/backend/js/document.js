var otherHeight = $('#header').height() + $('.page-footer').height();
var height_scroll_div = function() {
    $('.doc_content').css({
        'height' : ($(window).height()-otherHeight)+'px'
    });
}

$(document).ready( function() {

    height_scroll_div();
    $(window).resize( function() {
        height_scroll_div();
    });

    $('body').on('click', '#gotoTop', function() {
        $(".doc_content").animate({ scrollTop: 0 }, 600, function() {
        });
    });

});
