<?php
/**
 * @var $this PageController
 * @var $model Page
 * @var $form MActiveForm
 * @var $attribute array
 */

$htmlOptions = array(
    'uncheckValue' => 0
);

if (!empty($attribute['settings']['htmlOptions'])) {
    $htmlOptions = SuperHelper::mergeHtmlOptions($htmlOptions, $attribute['settings']['htmlOptions']);
}

echo $form->checkBoxRow($model, $attribute['name'], $htmlOptions);