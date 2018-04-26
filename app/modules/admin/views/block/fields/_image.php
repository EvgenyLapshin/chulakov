<?php
/**
 * @var $this AController
 * @var $model Block
 * @var $attribute array
 * @var $name string
 */

$htmlOptions = array(
    'class' => 'block-field',
    'name' => $name,
    'data-entity_id' => $model->entity_id
);

if (!empty($attribute['settings']['htmlOptions'])) {
    $htmlOptions = SuperHelper::mergeHtmlOptions($htmlOptions, $attribute['settings']['htmlOptions']);
}

$this->widget('UploaderWidget', array(
    'model' => $model,
    'attribute' => $attribute['name'],
    'template' => $model->block_template_id,
    'htmlOptions' => $htmlOptions
));