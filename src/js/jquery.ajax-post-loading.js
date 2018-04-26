(function ($) {
    $.ajaxPostLoading = function (options) {
        // Создаём настройки по-умолчанию, расширяя их с помощью параметров, которые были переданы
        var settings = $.extend({
            container: '#ajax-load-container',
            loop: '.loop',
            moreLoopKeyInResponse: 'items',
            button: '.ajax-pagination-button',
            replaceButton: true,
            replaceSelector: '.ajax-pager-wrap',
            buttonKeyInResponse: 'pager',
            success: $.noop
        }, options);

        /** Тут сложные вычисление попадания в область видимости */
        function mostlyVisible(element) {
            var scroll_pos = $(window).scrollTop();
            var window_height = $(window).height();
            var el_top = $(element).offset().top;
            var el_height = $(element).height();
            var el_bottom = el_top + el_height;
            return ((el_bottom - el_height * 0.25 > scroll_pos) &&
            (el_top < (scroll_pos + 0.5 * window_height)));
        }

        function initPagination() {
            $(window).scroll(function () {
                var scroll_pos = $(window).scrollTop();
                var last_scroll = 0;
                var $loops = $(settings.loop);

                if (Math.abs(scroll_pos - last_scroll) > $(window).height() * 0.1) {
                    last_scroll = scroll_pos;

                    $loops.each(function (index) {
                        if (mostlyVisible(this)) {
                            history.replaceState(null, null, $(this).attr("data-url"));
                            return (false);
                        }
                    });
                }
            });

        }

        function getUrlScroll() {
            function getUrlVars() {
                var vars = [], hash;
                var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
                for (var i = 0; i < hashes.length; i++) {
                    hash = hashes[i].split('=');
                    vars.push(hash[0]);
                    vars[hash[0]] = hash[1];
                }

                return vars;
            }

            var first = getUrlVars()["page"];
            var $window = $(window);
            var $loops = $(settings.loop);

            $loops.each(function () {
                if (first == undefined) {
                    return false;
                }

                else {
                    if (first <= 0)
                        first = 1;

                    if ($loops.eq(first - 1).length) {
                        var i = $loops.eq(first - 1).offset().top;
                        $window.scrollTop(i - 150)
                    }

                }

            });

        }

        return function () {

            var $container = $(settings.container);

            $(document.body).on('click', settings.button, function (e) {
                e.preventDefault();
                e.stopPropagation();

                var $link = $(this);

                if ($link.hasClass('loading')) {
                    return;
                }

                $.ajax({
                    url: $link.attr('href'),
                    dataType: 'JSON',
                    method: 'POST',
                    cache: false,
                    beforeSend: function () {
                        $link.addClass('loading');
                    },
                    success: function (data) {
                        $container.append(data[settings.moreLoopKeyInResponse]);
                        if (settings.replaceButton) {
                            $(settings.replaceSelector).replaceWith(data[settings.buttonKeyInResponse]);
                        }
                        settings.success();
                    },
                    complete: function () {
                        $link.removeClass('loading');
                    }
                });
            });

            initPagination();
            getUrlScroll();
        }();
    };
})(jQuery);