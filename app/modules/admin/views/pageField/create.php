<?php
/**
 * @var $this PageFieldController
 * @var $model PageField
 * @var $form TbActiveForm
 */

$this->breadcrumbs = array(
    'Шаблоны страниц' => array('/admin/pageTemplate/index'),
    '«' . $model->rTemplate->title . '»' => array('/admin/pageTemplate/update', 'id' => $model->template_id),
    'Добавить'
);

$this->renderPartial('_form', array('model' => $model));