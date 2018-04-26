var kupavnaProduct = function () {
    var relatedFunctionInit = function () {
        var $slider = $('#related-slider');

        $slider.slick({
            slidesToShow  : 3,
            slidesToScroll: 3,
            variableWidth : true,
            infinite      : false,
            appendArrows  : $('#related-slider-control'),
            prevArrow     : '<svg class="icon-arrow slick-prev"><use xlink:href="#icon-arrow"></use></svg>',
            nextArrow     : '<svg class="icon-arrow slick-next transform-180"><use xlink:href="#icon-arrow"></use></svg>',
            mobileFirst   : false
        });

        $slider.find('.name').dotdotdot();
    };

    return {
        init: function () {
            relatedFunctionInit();

            var $form = $('#buy-form-packages');
            var $totalElement = $('#buy-form-total').find('span').eq(0);

            var deletePackage = function ($package) {
                $package.remove();
                calcPrices();
            };

            var updatePackage = function ($package, newCount) {
                $package.trigger('package.change', {
                    $package: $package,
                    newCount: newCount
                });
            };

            var calcPrices = function () {
                var total = 0;

                $form.find('.pre-packing-product').each(function () {
                    var $package = $(this);
                    var count = Number($package.find('.count input').val());
                    var dataProduct = $package.data('product');
                    $package.find('.total span').html(window.cart.formatPrice(dataProduct.price * dataProduct.count));
                    $package.data('product', dataProduct);

                    total += dataProduct.price * count;
                });

                $totalElement.html(cart.formatPrice(total));
            };

            $form
                .on('package.change', function (e, params) {
                    e.stopPropagation();
                    e.preventDefault();
                    var $package = params.$package;
                    var $input = $package.find('.count input');
                    var dataProduct = $package.data('product');

                    dataProduct.count = params.newCount;
                    $input.val(dataProduct.count);
                    calcPrices();
                })
                .on('change keyup', '.count input', function () {
                    var $package = $(this).closest('.pre-packing-product');
                    var value = Number($(this).val());
                    value = Math.min(value, 999);

                    updatePackage($package, value);
                })
                .on('click', '.count .up', function (e) {
                    e.stopPropagation();
                    var $package = $(this).closest('.pre-packing-product');

                    var $input = $package.find('.count input');
                    var value = Number($input.val());
                    value++;
                    value = Math.min(value, 999);
                    $input.val(value);
                    updatePackage($package, value);
                })
                .on('click', '.count .down', function (e) {
                    e.stopPropagation();
                    var $package = $(this).closest('.pre-packing-product');

                    var $input = $package.find('.count input');
                    var value = Number($input.val());

                    if (value > 0) {
                        value--;
                        $input.val(value);
                        updatePackage($package, value);
                    } else {
                        deletePackage($package);
                    }
                })
                .on('click', '.remove', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    deletePackage($(this).closest('.pre-packing-product'));
                })
                .closest('.reveal')
                .on('click', '.buy-form-actions button', function (e) {
                    e.preventDefault();
                    $form.find('.pre-packing-product').each(function () {
                        var $this = $(this);
                        var count = Number($this.find('.count input').val());

                        if (count > 0) {
                            cart.add($this.data('product'), count);
                        }
                    });

                    $form.closest('.reveal').foundation('close');
                })
        }
    }
}();

$(document).ready(function () {
    kupavnaProduct.init();
});