function covidWidget() {
    $('.covid19-widget__btn').on('click', function () {
        $('.covid19-widget').toggleClass('opened');
        $(this).toggleClass('opened');
        $('body').toggleClass('covid19-body');
    });
}

$(function () {
    $('.covid19-widget').prependTo('body');
    covidWidget();
    $('body').addClass('covid19-body');
});