<?php
/**
 * @var $this BlockFieldController
 * @var $model BlockField
 * @var $form TbActiveForm
 */

if ($model->rBlockTemplate->entity_template_name) {
    $this->breadcrumbs = array(
        'Шаблоны страниц' => array('pageTemplate/index'),
        '«' . $model->rBlockTemplate->entityTemplate->title . '»' => array('pageTemplate/update', 'id' => $model->rBlockTemplate->entityTemplate->id),
        '«' . $model->rBlockTemplate->name . '»' => array('blockTemplate/update', 'id' => $model->rBlockTemplate->id),
        'Редактировать'
    );
} else {
    $this->breadcrumbs = array(
        '«' . $model->rBlockTemplate->entity_name . '»' => array(lcfirst($model->rBlockTemplate->entity_name) . '/index'),
        '«' . $model->rBlockTemplate->name . '»' => array('blockTemplate/update', 'id' => $model->rBlockTemplate->id),
        'Редактировать',
    );
}

$this->renderPartial('_form', array('model' => $model));