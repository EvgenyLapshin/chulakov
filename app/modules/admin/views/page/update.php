<?php
/**
 * @var $this PageController
 * @var $model Page
 * @var $tabsEntities array
 */

$this->pageTitle = 'Редактировать страницу';

$this->breadcrumbs = array(
    'Страницы' => array('index'),
    'Редактировать'
);

$this->renderPartial('_form', array('model' => $model, 'tabsEntities' => $tabsEntities));