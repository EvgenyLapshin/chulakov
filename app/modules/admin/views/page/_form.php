<?php
/**
 * @var $this PageController
 * @var $model Page
 * @var $form MActiveForm
 * @var $tabsEntities array
 */

$form = $this->beginWidget('materialize.widgets.MActiveForm', array(
    'id' => $model->formId,
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'openButtonUrl' => ($model->rTemplate && $model->rTemplate->to_display) ? $model->url : '',
    'openButtonVisible' => !$model->isNewRecord,
    'clientOptions' => array(
        'validateOnSubmit' => true
    )
));

$tabs = array();

if ($tabsEntities) {
    $tabs = $tabsEntities;
}

$tabs = array_merge($tabs, array(
    array(
        'label' => 'Основные',
        'content' => $this->renderPartial('_tabGeneral' . ucfirst($model->getScenario()), array('model' => $model, 'form' => $form), true),
        'active' => !$tabs
    )
));

if ($model->rTemplate) {
    $tabs = array_merge($tabs, $this->blockTabs($model, $model->rTemplate));
}

if (!empty($model->rTemplate) && $model->rTemplate->to_display && !$model->link) {
    $tabs[] = array(
        'label' => 'SEO',
        'content' => $this->widget('admin.widgets.seoTab.SeoTabWidget', array('model' => $model, 'form' => $form), true)
    );
}

$mTabs = $this->beginWidget('materialize.widgets.MTabs', array(
    'tabs' => $tabs,
    'return' => true,
    'headerHtmlOptions' => array(
        'class' => 'tab-header'
    )
));

$this->tabs = $mTabs->header;

$this->endWidget();
$this->endWidget();