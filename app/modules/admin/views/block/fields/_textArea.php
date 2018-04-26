<?php
/**
 * @var $this AController
 * @var $model Block
 * @var $attribute array
 * @var $name string
 */

$htmlOptions = array(
    'label' => MHtml::label($model->getAttributeLabel($attribute['name']), MHtml::getIdByName($name)),
    'data-model' => get_class($model),
    'data-attribute' => $attribute['name'],
    'data-template' => $model->block_template_id,
    'class' => 'block-field',
);

if (!empty($attribute['settings']['htmlOptions'])) {
    $htmlOptions = SuperHelper::mergeHtmlOptions($htmlOptions, $attribute['settings']['htmlOptions']);
}

echo MHtml::textAreaRow($name, $model->{$attribute['name']}, $htmlOptions);