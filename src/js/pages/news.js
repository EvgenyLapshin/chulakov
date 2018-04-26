var kupavnaNews = function () {

    var ellipsisPreview = function () {
        $('.news-widget-text').dotdotdot();
    };

    return {
        init: function () {
            ellipsisPreview();

            var $filter = $('#news-filter');

            $filter.on('click', '.reset-filter', function () {
                kupavnaApp.resetFilter();
            });

            kupavnaApp.filter();

            kupavnaApp.markCheckboxOnGetParams($filter.find('.checkbox-group'), '.checkbox');

            $.ajaxPostLoading({
                loop: '.loop'
            });
        }
    }
}();

$(document).ready(function () {
    kupavnaNews.init();
    kupavnaApp.tabsLink();
});