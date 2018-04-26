<?php
/* @var ArticleController $this */
/* @var Article $model */

$this->breadcrumbs = array(
    '«' . $model->rCategory->page->page_title . '»' => array('/admin/articleCategory/index'),
    '«' . $model->rCategory->name . '»' => array('/admin/articleCategory/update', 'id' => $model->rCategory->id),
    'Добавить'
);

$this->renderPartial('_form', array('model' => $model));