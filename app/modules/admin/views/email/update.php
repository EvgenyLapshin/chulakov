<?php
/**
 * @var $this EmailController
 * @var $model Email
 */

$this->breadcrumbs = array(
    'Письма' => array('index'),
    'Редактировать',
);

$this->renderPartial('_form', array('model' => $model));