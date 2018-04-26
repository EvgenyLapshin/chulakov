<?php
/* @var $this LogController */
/* @var $model Log */

$this->breadcrumbs = array(
    'Logs' => array('index'),
    'Добавить',
);

$this->renderPartial('_form', array('model' => $model));