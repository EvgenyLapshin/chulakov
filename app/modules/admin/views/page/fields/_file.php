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

$this->widget('UploaderWidget', array(
    'model' => $model,
    'attribute' => $attribute['name'],
    'template' => $model->template_id,
    'htmlOptions' => $htmlOptions
));