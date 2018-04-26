<?php
/* @var $this BackendController */
/* @var $model SActiveRecord */
/* @var $form MActiveForm */

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => 'SEO-поля'
));

echo $form->textFieldRow($model, 'alias');

echo $form->textFieldRow($model, 'meta_title');

echo $form->textAreaRow($model, 'meta_keywords');

echo $form->textAreaRow($model, 'meta_description');

$this->widget('UploaderWidget', array('model' => $model, 'attribute' => 'meta_image'));

$this->endWidget();