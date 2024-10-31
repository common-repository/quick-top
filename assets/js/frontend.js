jQuery(document).ready(function($) {
    var quickTop = $('#quick-top');

    $(window).scroll(function() {
        if ($(this).scrollTop() > quickTop.data('scroll-distance')) {
            quickTop.addClass('show');
        } else {
            quickTop.removeClass('show');
        }
    });

    quickTop.click(function() {
        $('html, body').animate({ scrollTop: 0 }, 600);
        return false;
    });
});
