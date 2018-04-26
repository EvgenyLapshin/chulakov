<?php
/**
 * @var $this PageController
 * @var $model Page
 * @var $form MActiveForm
 * @var $attribute array
 */

$htmlOptions = array();

if (!empty($attribute['settings']['htmlOptions'])) {
    $htmlOptions = SuperHelper::mergeHtmlOptions($htmlOptions, $attribute['settings']['htmlOptions']);
}

$this->widget('materialize.widgets.MMapWidget', array(
    'model' => $model,
    'attribute' => $attribute['name'],
    'htmlOptions' => $htmlOptions
));