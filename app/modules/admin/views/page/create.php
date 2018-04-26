<?php
/**
 * @var $this PageController
 * @var $model Page
 * @var $tabsEntities array
 */

$this->pageTitle = 'Добовить новую страницу';

$this->breadcrumbs = array(
    'Страницы' => array('index'),
    'Добавить',
);

$this->renderPartial('_form', array('model' => $model, 'tabsEntities' => $tabsEntities));