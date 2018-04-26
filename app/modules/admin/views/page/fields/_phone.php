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

$this->widget('vendor.laco.widgets.phone.PhoneWidget', array(
    'model' => $model,
    'attribute' => $attribute['name'],
    'mask' => $attribute['settings']['mask'],
    'htmlOptions' => $htmlOptions
));