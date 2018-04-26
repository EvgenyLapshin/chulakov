<?php
/* @var CatalogCategoryController $this */
/* @var CatalogCategory $model */
/* @var CatalogProduct $catalogProduct */

$this->breadcrumbs = array(
    '«' . $model->page->page_title . '»' => array('/admin/page/update', 'id' => $model->page->id),
    '«' . $model->name . '»',
    'Редактировать'
);

$this->renderPartial('_form', array('model' => $model, 'catalogProduct' => $catalogProduct));