<?php
/* @var NewsController $this */
/* @var News $model */
/* @var MActiveForm $form */

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => 'Основные поля'
));

echo $form->textFieldRow($model, 'title');

echo $form->textAreaRow($model, 'description');

$this->widget('UploaderRedactorWidget', array('model' => $model, 'attribute' => 'content'));

$this->widget('UploaderWidget', array('model' => $model, 'attribute' => 'image'));

echo $form->dateTimePickerRow($model, 'pub_date');

echo $form->textFieldRow($model, 'view_count');

echo $form->checkBoxRow($model, 'is_important');

echo $form->dropDownListRow($model, 'status', $model->getStatusList());

$this->endWidget();