var kupavnaApp = function () {
    var checkTouchSupport = function () {
        function is_touch_device() {
            try {
                document.createEvent("TouchEvent");
                return true;
            } catch (e) {
                return false;
            }
        }

        is_touch_device() ? $('body').addClass('touch') : $('body').removeClass('touch');
    };

    var toTopHandler = function () {
        var $toTop = $('#to-top');
        var isShow = false;

        $(window).on('scroll', function (e) {
            if ((window.pageYOffset || document.scrollTop) - (document.clientTop || 0) > 300) {
                if (!isShow) {
                    $toTop.addClass('is-show');
                    isShow = true;
                }
            } else {
                if (isShow) {
                    $toTop.removeClass('is-show');
                    isShow = false;
                }
            }
        });
        $toTop.on('click', function () {
            scrollTo(0, 300);
        });
    };

    var catalogNavHeader = function () {
        var $button = $('#catalog-nav-header');
        var unhoverBtn = function () {
            $button.children('.btn').removeClass('hover');
        };

        $button.on('mouseenter', '.catalog-nav-menu > li', function () {
            $button.find('.catalog-nav-menu > li').removeClass('current');
            $button.find('.catalog-nav-show').html($(this).children('ul').clone());
            $(this).addClass('current');
        });

        $button.on('mouseenter', '.btn', function () {
            $(this).addClass('hover');
            $button.find('.catalog-nav-menu > li').eq(0).trigger('mouseenter');
        });

        $button.on('mouseleave', '.btn', function () {
            if (!$button.find('.catalog-nav-wrap').filter(':hover').length) {
                unhoverBtn();
            }
        });

        $button.on('mouseleave', '.catalog-nav-wrap', unhoverBtn);

        $button.find('.catalog-nav-show').css('height', $button.find('.catalog-nav-menu').innerHeight());
    };

    var headerNav = function () {
        $('#header-nav').children('li').each(function () {
            if ($(this).find('ul').length) {
                $(this).addClass('hover');
            }
        });
    };

    var filterInit = function () {
        $('.filter .name').on('click', function (e) {
            var $filter = $(this).closest('.filter');

            if ($filter.hasClass('open')) {
                /* if (!$(e.target).closest('.icon', $filter).length) {
                 return;
                 }*/

                $filter
                    .find('.wrap').animate({
                    height: 0
                }, 100);

                $filter.removeClass('open');
            } else {
                $filter
                    .addClass('open')
                    .find('.wrap').animate({
                    height: $filter.find('.items').innerHeight()
                }, 100, function () {
                    $(this).removeAttr('style');
                });
            }
        }).eq(0).closest('form').on('submit', function () {
            var $form = $(this);
            var search = window.location.search.substring(1);
            var setParam = function (name, value) {
                var $field = $form.find('input[name=' + name + ']');
                if (!$field.length) {
                    $field = $('<input />', {
                        type: 'hidden',
                        name: name,
                        value: value
                    });
                    $form.append($field);
                } else {
                    $field.val(value);
                }
            };

            try {
                search = JSON.parse('{"' + decodeURI(search).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g, '":"') + '"}');

                $.each(search, function (name, value) {
                    setParam(name, value);
                });
            } catch (error) {
            }
        });
    };

    var toggleFilter = function () {
        function getGroupHeight(array) {
            var result = 0;

            array.each(function () {
                result += $(this).height();
            });

            return result;
        }

        $('.filter').each(function () {
            var $filter = $(this);
            var elements = null;

            if ($filter.find('.checkbox').length > 5) {
                elements = $filter.find('.checkbox');

                $filter.find('.checkbox-group').data('height', $filter.find('.checkbox-group').height());

                $filter.find('.checkbox-group').height(getGroupHeight(elements.slice(0, 5)));

                $filter.find('.toggle-checkbox-group').addClass('show');

                $filter.on('click', '.toggle-checkbox-group', function () {
                    var $this = $(this),
                        $target = $this.closest('.filter').find('.checkbox-group');

                    if (!$this.hasClass('checkbox-group--state-open')) {
                        $target.animate({height: $target.data('height')}, 100);
                        $this.addClass('checkbox-group--state-open').text('Свернуть список');
                    }
                    else {
                        var newHeight = 0;
                        var checkedInputs = $target.find('input[type="checkbox"]:checked');

                        if (checkedInputs.length) {
                            newHeight = getGroupHeight($target.find('.checkbox').slice(0, Math.max(5, checkedInputs.eq(-1).closest('.checkbox').index() + 1)));
                        }

                        $target.animate({height: newHeight}, 100);
                        $this.removeClass('checkbox-group--state-open').text('Показать ещё');
                    }
                });

                return;
            }

            if ($filter.find('.checkbox-tag-group').height() > 78) {

                $filter.find('.checkbox-tag-group').data('height', $filter.find('.checkbox-tag-group').height());

                $filter.find('.checkbox-tag-group').height(78);

                $filter.find('.toggle-checkbox-group').addClass('show');

                $filter.on('click', '.toggle-checkbox-group', function () {
                    var $this = $(this),
                        $target = $this.closest('.filter').find('.checkbox-tag-group');

                    if (!$this.hasClass('checkbox-group--state-open')) {
                        $target.animate({height: $target.data('height')}, 100);
                        $this.addClass('checkbox-group--state-open').text('Свернуть список');
                    }
                    else {
                        $target.animate({height: 78}, 100);
                        $this.removeClass('checkbox-group--state-open').text('Показать ещё');
                    }
                });
            }
        });
    };

    var markCheckboxOnGetParams = function (container, className, sortDisables) {
        function getJsonFromUrl() {
            var query = location.search.substr(1);
            var result = [];

            query.split("&").forEach(function (part) {
                var item = part.split("=");
                var itemPush = {};
                itemPush[item[0]] = decodeURIComponent(item[1]);
                result.push(itemPush);
            });

            return result;
        }

        container.each(function () {
            var groupItem = $(this);

            groupItem.find(className).each(function () {
                var $this = $(this);
                var $input = $this.find('input[type="checkbox"]');

                $.each(getJsonFromUrl(), function (key, value) {
                    if (encodeURI($input.attr('name')) == Object.keys(value)[0] && $input.attr('value') == value[Object.keys(value)[0]]) {
                        $input.prop('checked', true);

                        if (!sortDisables) {
                            groupItem.prepend($this);
                        }
                    }
                });
            })
        });
    };

    var scrollTo = function (position, speed) {
        position = position || Number(0);
        speed = Number(speed) || 1000;

        $('html,body').animate({
            scrollTop: position
        }, speed);
    };

    var setToggleHtml = function ($item, height) {
        var $content = $item.find('.content');

        if ($content.height() > height) {
            $item.data('is-toggle', true);
            $content.data('originHeight', $content.height()).css('height', height);
            $item.find('.show-btn').addClass('show');
        }
    };

    var initNotice = function () {

        $('body').on('click', '.notice', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).closest('.notice').fadeOut(function () {
                $(this).remove();
            });
        });

    };


    return {

        init: function () {
            $(document).foundation();
            checkTouchSupport();
            toTopHandler();
            catalogNavHeader();
            headerNav();
            initNotice();
        },

        filter: function () {
            toggleFilter();
            filterInit();
        },

        resetFilter: function () {
            window.location.href = window.location.href.replace(/\?.*/, '');
            return false;
        },

        anchorToBlock: function () {
            $('body').on('click', '.anchor-to-block', function (e) {
                e.preventDefault();
                e.stopPropagation();

                var target = $(this.hash);
                var topOffset = Number($(this).data('offset')) || Number(0);
                var speed = $(this).data('speed');
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    scrollTo(target.offset().top + topOffset, speed);
                    return false;
                }
            });
        },

        anchorToTab: function () {
            $('body').on('click', '.anchor-to-tab', function (e) {
                e.preventDefault();
                e.stopPropagation();

                $($(this).data('tab-href')).trigger('click')
            });

        },

        /**
         * Активация чекбоксов если они переданы в гет параметре
         * @param container
         * @param className
         * @param sortDisables
         */
        markCheckboxOnGetParams: function (container, className, sortDisables) {
            markCheckboxOnGetParams(container, className, sortDisables);
        },

        dotText: function () {
            $('.dot-text').each(function () {
                var $this = $(this);

                $this.find('.text').dotdotdot({
                    height: $this.data('height'),
                    callback: function (isTruncated) {
                        if (isTruncated) {
                            if ($this.find('.text').html().slice(-4) === '... ') {
                                var $temp = $this.find('.text').children();
                                $this.find('.text')
                                    .empty()
                                    .append($temp);
                            }
                            $this.find('.show')
                                .addClass('visible')
                                .on('click', function () {
                                    var $showBtn = $this.find('.show');
                                    var altTextBtn = $showBtn.data('alt-text');
                                    $showBtn.data('alt-text', $showBtn.find('span').text());
                                    $showBtn.toggleClass('is-open').find('span').text(altTextBtn);

                                    if ($this.find('.text').data('dotdotdot')) {
                                        $this.find('.text').trigger('isTruncated', function (isTruncated) {
                                            if (isTruncated) {
                                                $this.find('.text').trigger('destroy');
                                            }
                                        });
                                    } else {
                                        $this.find('.text').dotdotdot({
                                            height: $this.data('height'),
                                            callback: function (isTruncated) {
                                                if (isTruncated) {
                                                    if ($this.find('.text').html().slice(-4) === '... ') {
                                                        var $temp = $this.find('.text').children();
                                                        $this.find('.text')
                                                            .empty()
                                                            .append($temp);
                                                    }
                                                }
                                            }
                                        });
                                    }

                                });
                        }
                    }
                })
            });
        },

        gallery: function () {
            $('.gallery-widget').each(function () {
                var $gallery = $(this);

                $gallery.find('.slider-content').on('init', function () {
                    $gallery.find('.thumbs')
                        .append($gallery.find('.slick-dots').addClass('clearfix'))
                        .customScrollbar({
                            updateOnWindowResize: true
                        });
                }).slick({
                    prevArrow: '<div class="slick-arrow slick-prev"><div class="button radial"><svg class="icon-arrow"><use xlink:href="#icon-arrow"></use></svg></div></div>',
                    nextArrow: '<div class="slick-arrow slick-next"><div class="button radial"><svg class="icon-arrow slick-next transform-180"><use xlink:href="#icon-arrow"></use></svg></div></div>',
                    dots: true,
                    customPaging: function (slick, slide) {
                        return '<img src="' + $(slick.$slides[slide]).data('thumb') + '">'
                    }
                });
            });
        },

        tabsLink: function () {
            $('.tabs-link').on('click', 'a', function () {
                if ($(this).attr('href') == '#') {
                    return false;
                }
                window.location.href = this.href;
            });
        },

        initPhoneMask: function () {
            $('.phone-mask').each(function () {
                var $input = $(this);
                $input.mask($input.data('mask') || '+7 (999) 999-99-99');
            })
        },

        showToggle: function (selector, height, update) {
            /* FIXME: отрефакторить эту функцию */
            var $selector = $(selector);

            if (update) {
                $selector.each(function () {
                    var $item = $(this);
                    if (!$item.data('is-toggle')) {
                        $item.find('.show-btn').removeClass('show');
                        $item.find('.content').css('height', 'auto');
                        setToggleHtml($item, height);
                    }
                });

                return false;
            }

            $selector.each(function () {
                setToggleHtml($(this), height);
            }).on('click', '.show-btn', function () {
                var $this = $(this);
                var $item = $this.closest(selector);
                var dataText = $this.data('text');

                if ($item.hasClass('open')) {
                    $item
                        .removeClass('open')
                        .find('.content')
                        .animate({
                            height: height
                        });
                } else {
                    $item
                        .addClass('open')
                        .find('.content')
                        .animate({
                            height: $item.find('.content').data('originHeight')
                        });
                }

                $this.data('text', $this.find('span').text()).find('span').text(dataText);
            });
        },

        /**
         * текст при предзаказе
         */

        noticeText : 'Данного товара больше нет в наличии, но он доступен под заказ!',

        appendNotice: function ($element) {

            $element.append('<div class="notice"><div class="notice__text">' +  kupavnaApp.noticeText + '</div> <div class="notice__confirm">Хорошо</div> </div> ');

        }



    }
}();

$(document).ready(function () {
    kupavnaApp.init();
    kupavnaApp.initPhoneMask();

    $(document.body).on('click', 'a[href="#"]', function (e) {
        e.preventDefault();
        e.stopPropagation();
        return false;
    });
});