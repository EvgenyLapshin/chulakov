var kupavnaVacancies = function () {

    var setVacancyTitleHandler = function () {
        var title = $(this).closest('.vacancies-item').find('.card-title').text();
        $('#feedback-vacancy-title').val(title);
    };

    return {
        init: function () {
            kupavnaApp.showToggle('.vacancies-item', 300);
        },

        responseOnVacancy: function () {
            $('.vacancies-item').on('click', '.button', setVacancyTitleHandler);
        }
    }
}();

$(document).ready(function () {
    kupavnaVacancies.init();
    kupavnaVacancies.responseOnVacancy();
});