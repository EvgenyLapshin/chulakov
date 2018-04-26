<?php
/* @var ArticleCategoryController $this */
/* @var ArticleCategory $model */
/* @var Article $article */

$this->breadcrumbs = array(
    '«' . $model->page->page_title . '»' => array('/admin/page/update', 'id' => $model->page->id),
    'Редактировать'
);

$this->renderPartial('_form', array('model' => $model, 'article' => $article));