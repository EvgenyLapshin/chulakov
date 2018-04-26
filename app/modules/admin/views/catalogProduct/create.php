<?php
/* @var CatalogProductController $this */
/* @var CatalogProduct $model */

$this->breadcrumbs = array(
    '«' . $model->rCatalogCategory->page->page_title . '»' => array('/admin/page/update', 'id' => $model->rCatalogCategory->page->id),
    '«' . $model->rCatalogCategory->name . '»' => array('/admin/catalogCategory/update', 'id' => $model->rCatalogCategory->id),
    'Добавить товар'
);

$this->renderPartial('_form', array('model' => $model));