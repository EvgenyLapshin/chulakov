<?php
/* @var CatalogCountryManufacturerController $this */
/* @var CatalogCountryManufacturer $model */

$this->breadcrumbs = array(
    'Страны производители' => array('/admin/catalogCountryManufacturer'),
    'Редактировать'
);

$this->renderPartial('_form', array('model' => $model));