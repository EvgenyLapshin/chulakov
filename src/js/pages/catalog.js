var kupavnaCatalog = function () {

    var select = function () {
        $('.show-count').on("select2:select", function () {
            window.location.href = $(this).val();
        }).select2({
            minimumResultsForSearch: Infinity,
            theme                  : 'classic'
        });
    };

    var ellipsisProductCard = function () {
        if ($('.catalog-view-card').length) {
            $('.product-card').find('.name, .size-wrap').dotdotdot({
                watch: "window"
            });
        }
    };

    var bindCart = function () {
        $('body').on('click', '.product-inline .add-to-cart, .product-card .add-to-cart', function (e) {
            e.preventDefault();
            e.stopPropagation();

            var $link = $(this).closest('a');
            var productModel = $link.data('product');

            var product = cart.getProduct(productModel);
            var productCount = product ? product.count : 0;
            var productInStock = productModel.in_stock;
            var preOrder = true; //поменять на false если хочешь отключить предзаказ


            if (productCount + 1 <= productInStock || preOrder) {
                if (!$link.hasClass('disabled')) {
                    if (productInStock - productCount === 0) {
                        kupavnaApp.appendNotice($link);
                    }
                    cart.add(productModel, 1);
                }
            }

            if (productCount + 1 >= productInStock && !preOrder) {
                $link.addClass('disabled');
            }

        });
    };

    var initPreOrderPopup = function () {

        var $cardsBtn = $('.add-product'),
            $popup = $('#pre-order');

        $cardsBtn.on('click', function (e) {

            var productModel = $(this).closest('.product-card').data('product') || $(this).closest('.product-inline').data('product');

            $popup.find('#PreOrderForm_pageUrl').val(productModel.url);
            $popup.find('#PreOrderForm_product').val(productModel.name);

        })
    };


    return {
        init: function () {
            select();

            var $filter = $('#catalog-filter');

            if ($filter.length) {

                $filter.on('click', '.reset-filter', function () {
                    kupavnaApp.resetFilter();
                });

                kupavnaApp.filter();

                kupavnaApp.markCheckboxOnGetParams($filter.find('.checkbox-tag-group'), '.checkbox-tag');
                kupavnaApp.markCheckboxOnGetParams($filter.find('.checkbox-group'), '.checkbox');
            }

            $.ajaxPostLoading();

            initPreOrderPopup();
        },

        ellipsisProductCard: function () {
            ellipsisProductCard();
        }
    }
}();

$(document).ready(function () {
    kupavnaCatalog.init();
    kupavnaCatalog.ellipsisProductCard();
});