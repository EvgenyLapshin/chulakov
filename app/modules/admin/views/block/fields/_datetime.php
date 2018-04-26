<?php
/**
 * @var $this AController
 * @var $model Block
 * @var $attribute array
 * @var $name string
 */

$pluginOptions = array();

if (!empty($attribute['settings']['pluginOptions'])) {
    $pluginOptions = SuperHelper::mergeHtmlOptions($pluginOptions, $attribute['settings']['pluginOptions']);
}

$htmlOptions = array(
    'label' => $model->getAttributeLabel($attribute['name']),
    'data-type' => $attribute['type'],
    'data-model' => get_class($model),
    'data-attribute' => $attribute['name'],
    'data-template' => $model->block_template_id,
    'data-plugin-options' => json_encode($pluginOptions),
    'class' => 'block-field',
);

if (!empty($attribute['settings']['htmlOptions'])) {
    $htmlOptions = SuperHelper::mergeHtmlOptions($htmlOptions, $attribute['settings']['htmlOptions']);
}

echo MHtml::dateTimePickerRow($name, $model->$attribute['name'], $pluginOptions, $htmlOptions);