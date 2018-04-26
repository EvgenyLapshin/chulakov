<?php
/**
 * @var $this BackendController
 * @var $model SActiveRecord
 * @var $form MActiveForm
 */

$this->beginWidget('materialize.widgets.MCard', array(
    'button' => false,
    'wrappedInRow' => false
));

echo $form->textFieldRow($model, 'alias');

echo PHP_EOL;

$tabs = array();
$active = true;
foreach (param('languagesAdminList') as $lang => $langName) {
    $tabContent = $form->textFieldRow($model, 'meta_title_' . $lang)
        . $form->textAreaRow($model, 'meta_keywords_' . $lang)
        . $form->textAreaRow($model, 'meta_description_' . $lang)
        . $this->widget('UploaderWidget', array('model' => $model, 'attribute' => 'meta_image_' . $lang), true);

    $tabs[] = array(
        'label' => $langName,
        'content' => $tabContent,
        'active' => $active,
        'id' => 'seo_' . $lang

    );
    $active = false;
}

$this->widget('bootstrap.widgets.TbTabs', array(
    'tabs' => $tabs,
));

$this->endWidget();