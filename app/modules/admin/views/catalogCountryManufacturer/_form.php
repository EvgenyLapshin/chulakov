<?php 
/* @var CatalogCountryManufacturerController $this */
/* @var CatalogCountryManufacturer $model */
/* @var MActiveForm $form */

$form = $this->beginWidget('materialize.widgets.MActiveForm', array(
    'id' => $model->formId,
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true
    )
));

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => 'Основные поля'
));

echo $form->textFieldRow($model, 'name');

echo $form->checkBoxRow($model, 'is_published');

$this->endWidget();

$this->endWidget();