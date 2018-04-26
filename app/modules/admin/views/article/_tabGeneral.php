<?php
/* @var ArticleController $this */
/* @var Article $model */
/* @var MActiveForm $form */

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => 'Основные поля'
));

echo $form->textFieldRow($model, 'title');

echo $form->textAreaRow($model, 'description');

$this->widget('UploaderRedactorWidget', array('model' => $model, 'attribute' => 'content'));

$this->widget('UploaderWidget', array('model' => $model, 'attribute' => 'image'));

echo $form->dateTimePickerRow($model, 'pub_date');

echo $form->dropDownListRow($model, 'status', $model->getStatusList());

echo $form->textFieldRow($model, 'view_count');

$this->endWidget();