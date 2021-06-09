$(function () {
    $('.box').on('mouseenter', function () {
        $(this).find('img').animate({ top: '-40px' }, { duration: 160 });
        $(this).find('.caption').animate({ top: '170px' }, { duration: 160 });
    });

    $('.box').on('mouseleave', function () {
        $(this).find('img').animate({ top: '0' }, { duration: 160 });
        $(this).find('.caption').animate({ top: '220px' }, { duration: 160 });
    });

    $('.box').on('click', function () {
        $(this).find('img').animate({ top: '-40px' }, { duration: 160 });
        $(this).find('.caption').animate({ top: '170px' }, { duration: 160 });
    });

    $('.box').on('dblclick', function () {
        $(this).find('img').animate({ top: '0' }, { duration: 160 });
        $(this).find('.caption').animate({ top: '220px' }, { duration: 160 });
    });
});
