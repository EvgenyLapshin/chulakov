/**
 * Created by htmlm on 11.07.2016.
 */

var kupavnaCart = function () {

    var cartOptions = {
        productId: 'id'
    };

    var getCartState = function (products) {
        var result = {
            count           : 0,
            price           : 0,
            totalSale       : 0,
            totalPackaging  : 0,
            totalPackagingPc: 0
        };

        var preOrder = true;

        $.each(products, function (i, product) {
            var productInStock = product.in_stock ? product.in_stock : 1000000;
            var productCount;
            if (preOrder) {
                productCount = product.count
            } else {
                productCount = product.count > productInStock ? productInStock : product.count;
            }
            result.count += productCount;
            result.price += (productCount * product.price);
            result.totalSale += product.old_price ? (productCount * (product.old_price - product.price)) : 0;
            result.totalPackaging += productCount * product.packaging;

            if (product.packaging == 0) {
                result.totalPackagingPc += product.count;
            }
        });

        return result;
    };

    var $widget = $('.cart-widget'),
        $header = $('.header'),
        unitsMode = $header.data('units-mode'),
        priceIsOn = $header.data('show-prices');

    if (priceIsOn) {
        $widget.find('.in-cart span.total').addClass('is--visible');
    }

    $(window).on('cart.update', function (e, data) {
        var state = getCartState(data.cart);

        if (state.count) {
            if (unitsMode == 'pc') {
                $widget.find('.in-cart span:first').html(state.count + ' шт');
            } else if (unitsMode == 'kg') {
                $widget.find('.in-cart span:first').html(state.totalPackaging + ' кг');
                if (state.totalPackagingPc > 0) {
                    $widget.find('.in-cart .total-pc').html(' + ' + state.totalPackagingPc + ' шт');
                } else {
                    $widget.find('.in-cart .total-pc').html('');
                }
            }
            $widget.find('.in-cart span.total').html(cart.formatPrice(state.price) + ' Р');
            $widget.removeClass('empty');
        } else {
            $widget.addClass('empty');
        }
    });

    window.cart = new Cart({
        queryParams : [cartOptions.productId],
        productModel: {
            id: 'number'
        },
        coreMethods : {
            getTotalPrice: function (products) {
                var result = 0;
                products = products || cart.state.products;
                $.each(products, function (key, product) {
                    result += product[cart.options.keys.price];
                });

                return result;
            }
        }
    });

    cart.init();

    return {
        init: function () {

        },

        getCartCount: getCartState
    }
}();