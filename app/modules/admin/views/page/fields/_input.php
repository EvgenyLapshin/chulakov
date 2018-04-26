<?php
/**
 * @var $this PageController
 * @var $model Page
 * @var $form MActiveForm
 * @var $attribute array
 */

$htmlOptions = array();

if (!empty($attribute['settings']['htmlOptions'])) {
    $htmlOptions = MHtml::mergeHtmlOptions($htmlOptions, $attribute['settings']['htmlOptions']);
}

echo $form->textFieldRow($model, $attribute['name'], $htmlOptions);