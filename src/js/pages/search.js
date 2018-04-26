/**
 * Created by htmlmak on 11.06.2016.
 */

var kupavnaSearch = function () {
    var searchMark = function () {
        var searchText = $('#search-text').val();

        if (searchText !== '') {
            $('.search-mark .card-content').mark(searchText);
        }
    };

    return {
        init: function () {
            searchMark();
        }
    }
}();

$(document).ready(function () {
    kupavnaSearch.init();
});