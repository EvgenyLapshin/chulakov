<?php
/* @var CatalogProductController $this */
/* @var CatalogProduct $model */
/* @var MActiveForm $form */

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => 'Основные поля'
));

echo $form->textFieldRow($model, 'name');

echo $form->textFieldRow($model, 'name_synonym');

$this->widget('UploaderWidget', array('model' => $model, 'attribute' => 'image'));

$this->widget('UploaderRedactorWidget', array('model' => $model, 'attribute' => 'content'));

$this->widget('UploaderRedactorWidget', array('model' => $model, 'attribute' => 'kit'));

echo $form->dropDownListRow($model, 'catalog_country_manufacturer_id', MHtml::listData(CatalogCountryManufacturer::model()->findAll(), 'id', 'name'), array('prompt' => ''));

echo $form->dropDownListRow($model, 'catalog_category_id', MHtml::listData(CatalogCategory::model()->findAll(), 'id', 'name'));

echo $form->checkBoxRow($model, 'is_published');

$this->endWidget();