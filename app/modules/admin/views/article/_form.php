<?php
/* @var ArticleController $this */
/* @var Article $model */

$form = $this->beginWidget('materialize.widgets.MActiveForm', array(
    'id' => $model->formId,
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true
    )
));

$tabs[] = array('label' => 'Основные', 'content' => $this->renderPartial('_tabGeneral', array('model' => $model, 'form' => $form), true), 'active' => true);
$tabs[] = array('label' => 'SEO', 'content' => $this->widget('admin.widgets.seoTab.SeoTabWidget', array('model' => $model, 'form' => $form), true));

$mTabs = $this->beginWidget('materialize.widgets.MTabs', array(
    'tabs' => $tabs,
    'return' => true,
    'headerHtmlOptions' => array(
        'class' => 'tab-header'
    )
));

$this->tabs = $mTabs->header;

$this->endWidget(); // MTabs
$this->endWidget(); // MActiveForm