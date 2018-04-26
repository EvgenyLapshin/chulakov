/**
 * Block
 *
 * @author Lapshin Evgeny
 * @copyright 2012-2015 Laco
 */

jQuery(document).ready(function ($) {

    Block.displayedPossibleValues();
    Block.displayedDefaultValue();
    $(document).on('change', '#BlockField_type', function () {
        Block.setSettingsDefault($(this));
        Block.displayedPossibleValues($(this));
        Block.displayedDefaultValue($(this));
    });

});

Block = {

    /**
     * Установить настройки поумолчанию, для выбранного типа поля.
     */
    setSettingsDefault: function ($select) {
        var type = $select.children(':selected').val();

        if (type != undefined) {
            if ($.inArray(type, ['file', 'redactor', 'image', 'slide', 'phone', 'dropDownList', 'checkboxList']) !== -1) {
                codeMirrorBlockField_settings.setValue($('#settings-default-' + type).val());
            } else {
                codeMirrorBlockField_settings.setValue($('#settings-default-other').val());
            }
        }
    },

    /**
     * Установить настройки поумолчанию, для выбранного типа поля.
     */
    displayedDefaultValue: function ($select) {
        $select = $select || $('#BlockField_type');
        var type = $select.children(':selected').val(),
            $defaultValueInput = $('#BlockField_default_value'),
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
        $select = $select || $('#BlockField_type');
        var type = $select.children(':selected').val(),
            $possibleValuesInput = $('#BlockField_possible_values'),
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