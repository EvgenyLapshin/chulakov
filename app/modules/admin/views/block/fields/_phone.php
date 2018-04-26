<?php
/**
 * @var $this AController
 * @var $model Block
 * @var $attribute array
 * @var $name string
 */

$htmlOptions = array(
    'class' => 'block-field',
    'name' => $name
);

if (!empty($attribute['settings']['htmlOptions'])) {
    $htmlOptions = SuperHelper::mergeHtmlOptions($htmlOptions, $attribute['settings']['htmlOptions']);
}

$this->widget('vendor.laco.widgets.phone.PhoneWidget', array(
    'model' => $model,
    'attribute' => $attribute['name'],
    'template' => $model->block_template_id,
    'mask' => $attribute['settings']['mask'],
    'htmlOptions' => $htmlOptions
));