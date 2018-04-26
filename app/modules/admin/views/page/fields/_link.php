<?php
/**
 * @var $this PageController
 * @var $model Page
 * @var $form MActiveForm
 * @var $attribute array
 */

$htmlOptions = array(
    'name' => CHtml::activeName($model, $attribute['name']),
    'data-type' => $attribute['type'],
    'data-model' => get_class($model),
    'data-attribute' => $attribute['name'],
    'data-template' => $model->template_id
);

if (!empty($attribute['settings']['htmlOptions'])) {
    $htmlOptions = SuperHelper::mergeHtmlOptions($htmlOptions, $attribute['settings']['htmlOptions']);
}

$this->widget('vendor.laco.widgets.link.LinkWidget', array(
    'model' => $model,
    'attribute' => $attribute['name'],
    'template' => $model->template_id,
    'htmlOptions' => $htmlOptions
));