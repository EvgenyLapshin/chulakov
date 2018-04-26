var kupavnaPackaging = function () {

    return {
        init: function () {
            kupavnaApp.gallery();
            kupavnaApp.anchorToBlock();
            kupavnaApp.anchorToTab();

            $('#example').on('change.zf.tabs', function (e, tab) {
                $('#example-tabs').find('.tabs-panel').eq(tab.index()).find('.slick-slider').slick('setPosition');
                $(window).trigger('resize');
                $(window).trigger('resize');
            });
        }
    }
}();

$(document).ready(function () {
    kupavnaPackaging.init();
});