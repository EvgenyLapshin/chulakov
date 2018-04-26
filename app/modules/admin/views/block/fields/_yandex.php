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

$this->widget('materialize.widgets.MMapWidget', array(
    'model' => $model,
    'attribute' => $attribute['name'],
    'htmlOptions' => $htmlOptions
));