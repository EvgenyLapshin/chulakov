/**
 * Created by htmlmak on 09.11.2016.
 */

var kupavnaBasket = function () {
    var setView = function ($view, model) {
        var state = kupavnaCart.getCartCount(cart.state.products);
        var unitsMode = $('.header').data('units-mode');

        if (model) {
            $view.find('.count input').val(model.count);
        } else {
            $view.fadeOut(300, function () {
                $view.remove();
            });
        }

        if(unitsMode == 'kg') {
            $('#cart__total-count').html(cart.formatPrice(state.totalPackagingPc) + ' шт');
        } else {
            $('#cart__total-count').html(cart.formatPrice(state.count) + ' шт');
        }

        $('#cart__total-packaging').html(cart.formatPrice(state.totalPackaging) + ' кг');
        $('#cart__total-sale').html(cart.formatPrice(state.totalSale) + ' руб');
        $('#cart__total-price').html(cart.formatPrice(state.price) + ' руб');
        if (model) {
            $view.find('.total').html(cart.formatPrice(model.count * model.price) + ' руб');

            if (unitsMode == 'kg') {
                if ((model.count * model.packaging) == 0) {
                    $view.find('.total-desc').html("за " + cart.formatPrice(model.count) + ' шт');
                } else {
                    $view.find('.total-desc').html("за " + cart.formatPrice(model.count * model.packaging) + ' кг');
                }
            }
        }
    };

    var bindUp = function () {
        $('body').on('click', '.cart-product .up', function () {
            var $item = $(this).closest('.cart-product');
            var model = cart.getProduct($item.data('product'));
            var productInStock = model.in_stock ? model.in_stock : 1000000;
            var preOrder = true;

            if (model.count + 1 <= productInStock || preOrder) {

                if (productInStock - model.count <= 0 && !$item.hasClass('notice-none')) {
                    if (!$item.hasClass('notice-none')) {
                        $item.addClass('notice-none');
                    }
                    kupavnaApp.appendNotice($item);
                }

                cart.add(model, 1, function (e) {
                    setView($item, model);
                });
            }

        });
    };

    var bindDelete = function () {
        $('body').on('click', '.cart-product .remove', function () {
            var $item = $(this).closest('.cart-product');
            var model = cart.getProduct($item.data('product'));

            $item.find('.remove-verification').css('left', '1007px').addClass('arrow-right').fadeIn('fast');

        });
    };

    var bindDown = function () {
        $('body').on('click', '.cart-product .down', function () {
            var $item = $(this).closest('.cart-product');
            var model = cart.getProduct($item.data('product'));
            var $verification = $item.find('.remove-verification');


            if (model.count <= 1) {
                $verification.removeClass('arrow-right');
                $verification.css('left', '175px').fadeIn('fast');
            } else {
                cart.delete(model, 1, function (result) {
                    setView($item, result);
                });
            }
        });
    };

    var bindChange = function () {
        $('body').on('change keyup', '.cart-product .count input', function () {
            var $item = $(this).closest('.cart-product');
            var model = cart.getProduct($item.data('product'));
            var $verification = $item.find('.remove-verification');

            var thisValue = Number(this.value);
            var productInStock = model.in_stock;
            var preOrder = true;

            if (thisValue <= 0) {
                $verification.removeClass('arrow-right');
                $verification.css('left', '175px').fadeIn('fast');
            } else {

                if (thisValue > productInStock && !preOrder) {

                    cart.set(model, productInStock, function (e) {
                        setView($item, model);
                    });
                } else {

                    if (productInStock - model.count <= 0 && !$item.hasClass('notice-none')) {
                        if (!$item.hasClass('notice-none')) {
                            $item.addClass('notice-none');
                        }
                        kupavnaApp.appendNotice($item);
                    }

                    cart.set(model, thisValue, function (e) {
                        setView($item, model);
                    });
                }
            }


        });
    };

    var hideVerification = function () {

        $(document).mouseup(function (e) {
            var container = $('.remove-verification');
            if (container.has(e.target).length === 0) {
                container.fadeOut('fast');
            }
        });

        $('body').on('click', '.remove-verification .refuse', function () {
            var $item = $(this).closest('.cart-product');
            var model = cart.getProduct($item.data('product'));

            cart.set(model, model.count, function (e) {
                setView($item, model);
                $('.remove-verification').fadeOut('fast');
            });
        })

    };

    var deleteProduct = function () {

        $('body').on('click', '.remove-verification .confirm', function () {
            var $item = $(this).closest('.cart-product');
            var model = cart.getProduct($item.data('product'));

            cart.delete(model, model.count, function (result) {
                setView($item, result);
                $('.remove-verification').fadeOut('fast');
            });
            checkCart();
        });
    };

    var checkCart = function () {

        var cartState = cart.state.products.length;
        var $button = $('.order .button');
        if (cartState > 0 && $button.hasClass('disabled')) {
            $button.removeClass('disabled');
        }

        if (cartState == 0 && !$button.hasClass('disabled')) {
            $button.addClass('disabled');
        }

        if (cartState == 0) {
            setTimeout(function () {
                $('.cart-empty').show()
            }, 500);
        } else {
            $('.cart-empty').hide()
        }

    };


    return {
        init: function () {
            checkCart();
            bindUp();
            bindDown();
            bindDelete();
            bindChange();
            hideVerification();
            deleteProduct();

            $('#createOrder').on('click', function (e) {
                e.preventDefault();

                var cartState = cart.state.products.length;

                if (cartState > 0) {
                    $.ajax({
                        url     : this.href,
                        data    : "",
                        async   : false,
                        dataType: 'JSON',
                        method  : 'POST'
                    }).success(function (data) {
                        if (data.error_code == 0) {

                            $('body').css('overflow', 'hiden').append('<div style="width: 100vw; height: 100vh; background-color: rgba(0,0,0,0.5);position: absolute; top: 0; left: 0; z-index: 1000;">    </div>>')

                            Cookies.remove('cart', {path: '/'});

                            window.location.href = '/lk/profile#panel2';
                        }
                        else {
                            $('body').prepend('<div class="callout warning" style="position: fixed; top: 0; right: 0; z-index: 1000;"><h5>' + data.error_messages.system_errors + '</h5></div>');
                        }
                    }).error(function () {
                        /** FIXME: указать почту саппорта */
                        $('body').prepend('<div class="callout warning" style="position: fixed; top: 0; right: 0; z-index: 1000;"><h5>Произошла ошибка.</h5><p>Повторите попытку позднее. В случае повторения ошибки свяжитесь с <a href="mailto:info@reaktivy.ru">администрацией</a></p></div>');
                    }).complete(function () {

                    });
                }


            });
        }
    }
}();

$(document).ready(function () {
    kupavnaBasket.init();
});