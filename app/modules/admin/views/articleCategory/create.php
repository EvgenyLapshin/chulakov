<?php
/* @var ArticleCategoryController $this */
/* @var ArticleCategory $model */

$this->breadcrumbs = array(
    'Категории' => array('/admin/page/update', 'id' => $model->page->id),
    'Добавить',
);

$this->renderPartial('_form', array('model' => $model));