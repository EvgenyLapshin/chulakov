<?php
/* @var $this LogController */
/* @var $model Log */
/* @var $form MActiveForm */

$this->beginWidget('materialize.widgets.MCard', array(
    'button' => false,
    'wrappedInRow' => false
));

$form = $this->beginWidget('materialize.widgets.MActiveForm', array(
    'id' => $model->formId,
    'enableAjaxValidation' => false
));

echo $form->textFieldRow($model, 'level');

echo $form->textFieldRow($model, 'category');

echo $form->textFieldRow($model, 'logtime');

echo $form->textAreaRow($model, 'message');

$this->tabs = MHtml::submitButtonFixed($model->isNewRecord ? 'Добавить' : 'Сохранить', array('form' => $model->formId));

$this->endWidget();
$this->endWidget();