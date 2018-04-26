<?php
/* @var CatalogCategoryController $this */
/* @var CatalogCategory $model */

$this->breadcrumbs = array(
    'Каталог' => array('/admin/page/update', 'id' => $model->page->id),
    'Добавить категорию',
);

$this->renderPartial('_form', array('model' => $model));