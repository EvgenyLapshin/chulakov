var kupavnaHome = function () {

    $.fn.accordion = function () {
        return this.each(function () {
            var $accordion = $(this);

            var setActive = function (index) {
                $accordion.css('opacity', 1);
                $accordion.find('li').removeClass('active').eq(index).addClass('active')
                    .find('.title').dotdotdot();
                updateDirectionArrow();
                setTimeout(function () {
                    $accordion.trigger('change', $accordion.find('li').eq(index), index);
                }, 200);
            };

            var updateDirectionArrow = function () {
                $accordion.find('li').removeClass('rotate-arrow');

                $accordion.find('li').each(function () {
                    if (!$(this).hasClass('active')) {
                        $(this).addClass('rotate-arrow')
                    } else {
                        return false;
                    }
                });
            };

            $accordion.on('click', 'li', function () {
                var $item = $(this);

                if (!$item.hasClass('active')) {
                    setActive($item.index());
                }
            });

            setActive(0);
            $accordion.trigger('create');
            $accordion.addClass('init');
        });
    };

    function getScrollBarWidth() {
        var inner = document.createElement('p');
        inner.style.width = "100%";
        inner.style.height = "200px";

        var outer = document.createElement('div');
        outer.style.position = "absolute";
        outer.style.top = "0px";
        outer.style.left = "0px";
        outer.style.visibility = "hidden";
        outer.style.width = "200px";
        outer.style.height = "150px";
        outer.style.overflow = "hidden";
        outer.appendChild(inner);

        document.body.appendChild(outer);
        var w1 = inner.offsetWidth;
        outer.style.overflow = 'scroll';
        var w2 = inner.offsetWidth;
        if (w1 == w2) w2 = outer.clientWidth;

        document.body.removeChild(outer);

        return (w1 - w2);
    };

    var maxWidthSlider = function () {
        $('#home-slider-content').css('width', $(window).width());
    };

    return {
        init: function () {
            $('#home-accordion .accordion')
                .on('change', function (e, item) {
                    var $content = $(item).find('.content');

                    if (!$content.triggerHandler("isTruncated")) {
                        $content.dotdotdot();
                    }
                })
                .accordion();

            var $sliderWrap = $('#home-slider-wrap ');
            var progressBar = null;

            var setCurrentSlide = function (count) {
                $sliderWrap.find('.home-slider-pages span').html(count + 1);
            };

            var indexAnimate = 0;
            var setAnimateCircle = function () {
                progressBar.animate(indexAnimate, {
                    duration: 200
                }, function () {
                    /* Или статично заебенить индексы чтобы круг в исходную точку возвращался */
                    indexAnimate++;
                    progressBar.animate(indexAnimate, {
                        duration: 5800
                    });
                });

            };

            $('#home-slider-content')
                .on('init', function (e, slider) {
                    $sliderWrap.find('.controls').append('<div class="home-slider-pages"><div><span></span>/' + slider.slideCount + '</div><div id="home-progress" class="home-progress"></div></div>');
                    setCurrentSlide(slider.currentSlide);
                    progressBar = new ProgressBar.Circle('#home-progress', {
                        strokeWidth: 5,
                        color: '#f92534',
                        trailColor: '#e4e6e6',
                        svgStyle: {
                            width: '109px',
                            height: '109px',
                        }
                    });
                    setAnimateCircle();
                })
                .on('beforeChange', function (e, slider, currentSlide, nextSlide) {
                    setCurrentSlide(nextSlide);
                    setAnimateCircle();
                })
                .slick({
                    infinite: false,
                    speed: 600,
                    prevArrow: '' +
                    '<span class="slick-arrow slick-prev"><svg class="icon-arrow-list transform-180"><use xlink:href="#icon-arrow-list"></use></svg></span>' +
                    '<span class="slick-arrow slick-prev alt-arrow"><svg class="icon-arrow"><use xlink:href="#icon-arrow"></use></svg></span>',
                    nextArrow: '' +
                    '<span class="slick-arrow slick-next"><svg class="icon-arrow-list"><use xlink:href="#icon-arrow-list"></use></svg></span>' +
                    '<span class="slick-arrow slick-next alt-arrow"><svg class="icon-arrow transform-180"><use xlink:href="#icon-arrow"></use></svg></span>',
                    appendArrows: $sliderWrap.find('.controls'),
                    autoplay: true,
                    autoplaySpeed: 6000
                });

            $(window).on('resize', maxWidthSlider);
            maxWidthSlider();
        }
    }
}();

$(document).ready(function () {
    kupavnaHome.init();
});