<?php
/**
 * @var $this AController
 * @var $model Block
 * @var $attribute array
 * @var $name string
 */

$data = BlockField::processPossibleValues($attribute['settings'], $attribute['possible_values']);

$htmlOptions = array(
    'label' => $model->getAttributeLabel($attribute['name']),
    'data-type' => $attribute['type'],
    'data-model' => get_class($model),
    'data-attribute' => $attribute['name'],
    'data-template' => $model->block_template_id,
    'class' => 'block-field'
);

if (!empty($attribute['settings']['htmlOptions'])) {
    $htmlOptions = SuperHelper::mergeHtmlOptions($htmlOptions, $attribute['settings']['htmlOptions']);
}

echo MHtml::dropDownListRow($name, $model->{$attribute['name']}, $data, $htmlOptions);