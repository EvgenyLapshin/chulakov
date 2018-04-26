<?php
/**
 * @var $this PageController
 * @var $model Page
 * @var $form MActiveForm
 * @var $attribute array
 */

$data = PageField::processPossibleValues($attribute['settings'], $attribute['possible_values']);

$htmlOptions = array(
    'uncheckValue' => 0
);

if (!empty($attribute['settings']['htmlOptions'])) {
    $htmlOptions = SuperHelper::mergeHtmlOptions($htmlOptions, $attribute['settings']['htmlOptions']);
}

echo $form->checkBoxList($model, $attribute['name'], $data, $htmlOptions);