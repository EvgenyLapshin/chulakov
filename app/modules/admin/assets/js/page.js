/**
 * Project Mandarin.
 * @author Lapshin Evgeny
 * @copyright 2012-2015 Laco
 *
 * Created by PhpStorm (02.04.2015).
 */

jQuery(document).ready(function ($) {

    Page.visibilityLink();

    $(document).on("change", "#Page_type", function () {
        Page.visibilityLink($(this));
    });

    Page.displayedPossibleValues();
    Page.displayedDefaultValue();
    $(document).on('change', '#PageField_type', function () {
        Page.setSettingsDefault($(this));
        Page.displayedPossibleValues($(this));
        Page.displayedDefaultValue($(this));
    });
});

Page = {
    /**
     * Если в поле "Тип" выбрано значение "Ссылка", то показать поле "Ссылка", иначе скрыть.
     */
    visibilityLink: function (select) {
        select = select || $("#Page_type");
        var object = $("#Page_link").closest(".control-group");
        if (select.children(":selected").val() === "link")
            object.css("display", "block");
        else
            object.css("display", "none");
    },

    /**
     * Установить настройки поумолчанию, для выбранного типа поля.
     */
    setSettingsDefault: function ($select) {
        var type = $select.children(':selected').val();

        if (type != undefined) {
            if ($.inArray(type, ['file', 'redactor', 'image', 'slide', 'phone', 'dropDownList', 'checkboxList', 'video', 'link']) !== -1) {
                codeMirrorPageField_settings.setValue($('#settings-default-' + type).val());
            } else {
                codeMirrorPageField_settings.setValue($('#settings-default-other').val());
            }
        }
    },

    /**
     * Установить настройки поумолчанию, для выбранного типа поля.
     */
    displayedDefaultValue: function ($select) {
        $select = $select || $('#PageField_type');
        var type = $select.children(':selected').val(),
            $defaultValueInput = $('#PageField_default_value'),
            $defaultValueBlock = $defaultValueInput.closest('div.control-group');

        if (type != undefined) {
            if ($.inArray(type, ['file', 'image']) !== -1) {
                $defaultValueBlock.hide();
                $defaultValueInput.val('');
            } else {
                $defaultValueBlock.show();
            }
        }
    },

    /**
     * Установить настройки поумолчанию, для выбранного типа поля.
     */
    displayedPossibleValues: function ($select) {
        $select = $select || $('#PageField_type');
        var type = $select.children(':selected').val(),
            $possibleValuesInput = $('#PageField_possible_values'),
            $possibleValuesBlock = $possibleValuesInput.closest('div.control-group');

        if (type != undefined) {
            if ($.inArray(type, ['dropDownList', 'checkboxList']) !== -1) {
                $possibleValuesBlock.show();
            } else {
                $possibleValuesBlock.hide();
                $possibleValuesInput.val('');
            }
        }
    }
};