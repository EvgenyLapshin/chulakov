<?php
/**
 * @var $this AController
 * @var $model Block
 * @var $attribute array
 * @var $name string
 */

$htmlOptions = array(
    'label' => $model->getAttributeLabel($attribute),
    'data-model' => get_class($model),
    'data-attribute' => $attribute,
    'data-template' => $model->block_template_id,
    'class' => 'block-field'
);

if (!empty($attribute['settings']['htmlOptions'])) {
    $htmlOptions = SuperHelper::mergeHtmlOptions($htmlOptions, $attribute['settings']['htmlOptions']);
}

echo MHtml::hiddenField($name, $model->$attribute, $htmlOptions);