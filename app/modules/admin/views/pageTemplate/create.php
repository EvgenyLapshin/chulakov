<?php
/**
 * @var $this PageTemplateController
 * @var $model PageTemplate
 */

$this->breadcrumbs = array(
    'Шаблоны страниц' => array('index'),
    'Добавить',
);

$this->renderPartial('_form', array('model' => $model));