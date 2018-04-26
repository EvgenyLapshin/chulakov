var kupavnaLK = function () {
    var uploadNewFile = function () {
        var $uploadForm = $('#new-doc-lk');

        $('#new-doc-lk_file', $uploadForm).on('change', function () {
            $('#new-doc-lk_file-name', $uploadForm).val(this.files[0].name);
            $uploadForm.find('.check').removeClass('hide');
        });

        $uploadForm.find('#new-doc-lk_browse').on('click', function () {
            $('#new-doc-lk_file', $uploadForm).trigger('click');
        });

    };

    var requiredFields = function () {
        var $moreWriteBox = $('.more-write');
        var $elements = $moreWriteBox.find('.items span');

        $('#profile-update-form').on('change', 'input', function () {
            var $this = $(this);
            var $requireMessage = $moreWriteBox.find('.decor[href="#' + $this.attr('id') + '"]').closest('span');

            if ($this.val() == '') {
                $requireMessage.fadeIn(0);
            } else {
                $requireMessage.fadeOut(0);
            }

            var $visibleElements = $elements.filter(':visible');
            $elements.filter('.last').removeClass('last');

            if ($visibleElements.length) {
                $moreWriteBox.removeClass('hidden');
                $visibleElements.eq(-1).addClass('last');
            } else {
                $moreWriteBox.addClass('hidden');
            }
        });
    };

    var historyToggle = function () {
        $('.lk-history-item').on('click', '.toggle', function () {
            var $item = $(this).closest('.lk-history-item');

            if ($item.hasClass('is-open')) {
                $item.removeClass('is-open');
                $item.find('.wrap').css('height', 0);
                $(this).find('span').text('Развернуть');
            } else {
                $item.addClass('is-open');
                $item.find('.wrap').css('height', $item.find('.inner').height());
                $(this).find('span').text('Свернуть');
            }
        });
    };

    var switchTab = function () {
        var hash = window.location.hash;
        if (hash != "") {
            $('[href = "' + hash + '" ]').attr('aria-selected', true).closest('li').addClass('is-active');
            $(hash).addClass('is-active');
        } else {
            $('[href = "#panel1" ]').attr('aria-selected', true).closest('li').addClass('is-active');
            $('#panel1').addClass('is-active');
        }
    };

    var repeatOrder = function () {
        $('body').on('click', '.repeat-order', function () {

            Cookies.remove('cart', {path: '/'});
            cart.init();

            var items = $(this).closest('.lk-history-item').find('.item');
            var preOrder = true;

            items.each(function (index, element) {
                var productModel = $(element).data('product');

                if (productModel) {
                    var productInStock = productModel.in_stock ? productModel.in_stock : 1000000;
                    var productModelCount;
                    if (preOrder) {
                        productModelCount = productModel.count;
                    } else {
                        productModelCount = productModel.count > productInStock ? productInStock : productModel.count;
                    }
                    cart.add(productModel, productModelCount);
                }
            });

            window.location.href = '/lk/cart';
        })


    };

    var deleteFile = function () {

        $('body').on('click', '.lk-doc-item .close', function () {

            var file = $(this).closest('.lk-doc-item');
            var documentWrapper = $('.lk-doc-wrapper');
            documentWrapper.find('.callout').remove();


            $.ajax({
                url     : '/lk/profile/deleteFile?id=' + file.data('id'),
                data    : '',
                dataType: 'JSON',
                method  : 'POST'
            }).success(function (data) {

                if (data.error_code == 0) {
                    file.animate({opacity: 0}, 500, function () {
                        setTimeout(function () {
                            file.remove();
                        }, 200);
                    });
                }

            }).error(function () {
                /** FIXME: указать почту саппорта */
                documentWrapper.append('<div class="callout warning" style="margin-top: 18px"><h5>Произошла ошибка.</h5><p>Повторите попытку позднее. В случае повторения ошибки свяжитесь с <a href="mailto:info@reaktivy.ru">администрацией</a></p></div>');
            }).complete(function () {

            });
        })
    };

    var setUnitsMode = function () {
        var $unitsModeRadio = $('.js--unitsModeRadio');
        var activeMode = $('.header').data('units-mode');

        $unitsModeRadio.each(function () {
            var $this = $(this);

            if($this.attr('value') == activeMode) {
                $this.prop( "checked", true );
            }
        });
    };

    return {
        init: function () {
            uploadNewFile();
            historyToggle();
            requiredFields();
            switchTab();
            deleteFile();
            repeatOrder();
            setUnitsMode();
            kupavnaApp.anchorToBlock();
        }
    }
}();

$(document).ready(function () {
    kupavnaLK.init();
});