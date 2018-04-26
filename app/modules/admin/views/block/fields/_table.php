<?php
/**
 * @var $this AController
 * @var $model Block
 * @var $attribute array
 * @var $name string
 */

$htmlOptions = array(
    'name' => $name,
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

$this->widget('vendor.laco.widgets.table.TableWidget', array(
    'model' => $model,
    'attribute' => $attribute['name'],
    'generatedJS' => false,
    'template' => $model->block_template_id,
    'htmlOptions' => $htmlOptions
));