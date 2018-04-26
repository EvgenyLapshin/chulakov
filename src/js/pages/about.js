var kupavnaAbout = function () {

    return {
        init: function () {
            $('.slick-slider').slick({
                slidesToShow: 4,
                slidesToScroll: 4,
                mobileFirst: true,
                dots: true,
                prevArrow: '<div class="slick-arrow slick-prev"><svg class="icon-arrow"><use xlink:href="#icon-arrow"></use></svg></div>',
                nextArrow: '<div class="slick-arrow slick-next"><svg class="icon-arrow"><use xlink:href="#icon-arrow"></use></svg></div>',
                responsive: [
                    {
                        breakpoint: 1300,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 5,
                        }
                    }
                ]
            });

            /* FIXME: найти причину неправильного позиционирования при первом показе. Когда-нибудь.. */
            var tooltip = $('span.i');

            tooltip.trigger('mouseenter');
            setTimeout(function () {
                tooltip.trigger('mouseleave');
            }, 250);

            var $modal = $('#about-popup');

            $('.slick-popup').on('click', 'img', function () {
                $modal.find('img').attr('src', $(this).data('large-img'));
                $modal.foundation('open');
            });
        }
    }
}();

$(document).ready(function () {
    kupavnaAbout.init();
});