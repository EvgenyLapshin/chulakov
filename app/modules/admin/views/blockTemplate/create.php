<?php
/**
 * @var $this BlockTemplateController
 * @var $model BlockTemplate
 */

$this->pageTitle = 'Добавить шаблон блока';

if ($model->entity_template_name) {
    $this->breadcrumbs = array(
        'Шаблоны страниц' => array('/admin/pageTemplate/index'),
        '«' . $model->entityTemplate->title . '»' => array('/admin/pageTemplate/update', 'id' => $model->entity_template_id),
        $this->pageTitle
    );
} else {
    $this->breadcrumbs = array(
        'Шаблоны блоков' => array('/admin/blockTemplate/index'),
        $this->pageTitle
    );
}

$this->renderPartial('_form', array('model' => $model));