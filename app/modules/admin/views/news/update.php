<?php
/* @var NewsController $this */
/* @var News $model */

$this->breadcrumbs = array(
    '«' . $model->page->page_title . '»' => array('/admin/page/update', 'id' => $model->page->id),
    'Редактировать'
);

$this->renderPartial('_form', array('model' => $model));