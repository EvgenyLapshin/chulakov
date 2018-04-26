<?php
/**
 * @var $this PageController
 * @var $model Page
 * @var $form MActiveForm
 * @var $attribute array
 */

$pluginOptions = array();

if (!empty($attribute['settings']['pluginOptions'])) {
    $pluginOptions = SuperHelper::mergeHtmlOptions($pluginOptions, $attribute['settings']['pluginOptions']);
}

$htmlOptions = array();

if (!empty($attribute['settings']['htmlOptions'])) {
    $htmlOptions = SuperHelper::mergeHtmlOptions($htmlOptions, $attribute['settings']['htmlOptions']);
}

echo $form->dateTimePickerRow($model, $attribute['name'], $htmlOptions);