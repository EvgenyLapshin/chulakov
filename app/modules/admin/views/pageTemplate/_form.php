<?php
/**
 * @var $this PageTemplateController
 * @var $model PageTemplate
 * @var $form MActiveForm
 */

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => 'Шаблон страницы',
    'wrappedInRow' => false
));

$form = $this->beginWidget('materialize.widgets.MActiveForm', array(
    'id' => $model->formId,
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true
    )
));

echo $form->textFieldRow($model, 'title');

echo $form->dropDownListRow($model, 'child_id',
    CHtml::listData(PageTemplate::model()->findAll(), 'id', 'title'),
    array('empty' => '')
);

echo $form->checkBoxRow($model, 'to_display');

$this->endWidget();
$this->endWidget();