var Validator = function () {

    this.filesToUpload;

    var uploadFile = function () {
        $('input[type=file]').change(function () {
            Validator.filesToUpload = this.files;
        });
    };

    var convertErrors = function (errors) {
        var result = {};

        $.each(errors, function (index, error_list) {
            result[index] = error_list.join(' ');
        });

        return result;

    };

    var bindAddEffect = function () {
        $.tools.validator.addEffect("labelMate", function (errors, event) {

            $.each(errors, function (index, error) {
                var $parentInputGroup = error.input.first().closest('.input-group');
                var $parentLabel = error.input.first().closest('label');
                var $errorField = error.input.first().siblings('.form-error');

                if (!$errorField.length) {
                    $errorField = $parentInputGroup.siblings('.form-error');
                }

                if ($parentInputGroup.length) {
                    $parentInputGroup.addClass('is-invalid-input');
                } else {
                    $parentLabel.addClass('is-invalid-label')
                }

                $errorField.text(error.messages[0]).addClass('is-visible');
            });

        }, function (inputs) {
            inputs.each(function () {
                var $input = $(this);
                var $parentInputGroup = $input.closest('.input-group');
                var $parentLabel = $input.closest('label');
                var $errorField = $input.siblings('.form-error');

                if (!$errorField.length) {
                    $errorField = $parentInputGroup.siblings('.form-error');
                }

                if ($parentInputGroup.length) {
                    $parentInputGroup.removeClass('is-invalid-input');
                } else {
                    $parentLabel.removeClass('is-invalid-label')
                }

                $errorField.removeClass('is-visible');
            });

        });
    };

    var getButtonOnForm = function ($form) {
        var $result = $form.find('button[type="submit"]');

        if (!$result.length) {
            $result = $('body').find('button[form="' + $form.attr('id') + '"]');
        }

        return $result;
    };

    var toggleLockForm = function ($form) {
        if ($form.hasClass('lock')) {
            $form.removeClass('lock');
            getButtonOnForm($form).removeClass('disabled');
        } else {
            $form.addClass('lock');
            getButtonOnForm($form).addClass('disabled');
        }
    };

    var removeErrorMessage = function ($form) {
        $form.find('.callout').remove();
    };

    return {
        /**
         * Функция для привязки серверной валидации к форме
         * @param elem - селектор
         * @param {Object=}options - параметры
         * @param {Number}options.delay - продолжительность показа сообщения об отправке
         * @param {String}options.success_message - текст об успехе. Приоритет -> в вёрстке -> ответ от сервера -> через этот параметр
         */
        bind: function (elem, options) {
            $(elem).each(function () {
                    var $form = $(this);

                    options = $.extend({
                        delay: 10000
                    }, options, $form.data());

                    $form.validator({effect: 'labelMate'}).submit(function (e) {
                        toggleLockForm($form);
                        removeErrorMessage($form);

                        if ($(this).find('button').hasClass('load-file')) {

                            var data = new FormData($form.get(0));

                            $.each(Validator.filesToUpload, function (key, value) {
                                data.append('file', value);
                            });


                            $.ajax({
                                url        : $form.attr('action') + '?uploadFileName=file',
                                data       : data,
                                processData: false,
                                contentType: false,
                                dataType   : 'JSON',
                                method     : 'POST'
                            }).success(function (data) {
                                var resultMessage = data.result[0] || options.success_message;

                                if (data.error_code == 0) {

                                    $form.append('<div class="callout success">' + resultMessage + "</div>");

                                    if (!$form.find('.ajax-form__elements').hasClass('hide-forever')) {
                                        setTimeout(function () {
                                            removeErrorMessage($form);
                                        }, options.delay);
                                    }

                                    $('.lk-doc-wrapper').append(data.result.file);
                                }

                            }).error(function () {
                                /** FIXME: указать почту саппорта */
                                $form.prepend('<div class="callout warning"><h5>Произошла ошибка.</h5><p>Повторите попытку позднее. В случае повторения ошибки свяжитесь с <a href="mailto:info@reaktivy.ru">администрацией</a></p></div>');
                            }).complete(function () {
                                toggleLockForm($form);
                            });

                        } else {

                            $form.find('input[name$="RequestDetailsForm[pageUrl]"]').val(window.location.href);
                            $form.find('input[name$="RequestDetailsForm[pageTitle]"]').val(document.title);

                            $.ajax({
                                url     : $form.attr('action'),
                                data    : $form.serialize(),
                                dataType: 'JSON',
                                method  : 'POST'
                            }).success(function (data) {
                                var resultMessage = data.result[0] || options.success_message;

                                if (data.error_code == 0) {


                                    if (!$form.hasClass('notify-form') && !$form.hasClass('login-form')) {
                                        $form.css('height', $form.height());
                                        $form.find('.ajax-form__elements').fadeOut(150);
                                        $form.find('.ajax-form__message').html(resultMessage);

                                        $form.find('.ajax-form__message').fadeIn(150);

                                        setTimeout(function () {
                                            $form.get(0).reset();
                                            $form.find('.ajax-form__elements').fadeIn(150);
                                            $form.find('.ajax-form__message').fadeOut(150);
                                        }, options.delay)
                                    } else if (!$form.hasClass('login-form')) {

                                        if ($form.hasClass('hide-success-form')) {
                                            $form.css('height', $form.height());
                                            $form.find('.ajax-form__elements').fadeOut(150);

                                            setTimeout(function () {
                                                $form.append('<div class="callout success">' + resultMessage + "</div>");
                                            }, 200);

                                            if (!$form.find('.ajax-form__elements').hasClass('hide-forever')) {
                                                setTimeout(function () {
                                                    $form.get(0).reset();
                                                    $form.css('height', 'auto');
                                                    $form.find('.ajax-form__elements').fadeIn(150);
                                                }, options.delay);
                                            }

                                        } else {
                                            $form.append('<div class="callout success">' + resultMessage + "</div>");
                                        }

                                        if (!$form.find('.ajax-form__elements').hasClass('hide-forever')) {
                                            setTimeout(function () {
                                                removeErrorMessage($form);
                                            }, options.delay);
                                        }



                                    } else {
                                        location.reload();
                                    }

                                    if($form.data('success') !== undefined) {
                                        eval($form.data('success'));

                                    }
                                }
                                else {
                                    reload.invalidate(convertErrors(data.error_messages));
                                }
                            }).error(function () {
                                /** FIXME: указать почту саппорта */
                                $form.prepend('<div class="callout warning"><h5>Произошла ошибка.</h5><p>Повторите попытку позднее. В случае повторения ошибки свяжитесь с <a href="mailto:info@reaktivy.ru">администрацией</a></p></div>');
                            }).complete(function () {
                                toggleLockForm($form);
                            });
                        }
                        return false;
                    });


                    var reload = $form.data('validator');
                }
            );
        },
        init: function () {
            bindAddEffect();
            uploadFile();
        }
    }
}();

jQuery(document).ready(function ($) {
    Validator.init();
    Validator.bind('.ajax-form');
});
