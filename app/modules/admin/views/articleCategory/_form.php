<?php
/* @var ArticleCategoryController $this */
/* @var ArticleCategory $model */
/* @var Article $article */

$form = $this->beginWidget('materialize.widgets.MActiveForm', array(
    'id' => $model->formId,
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true
    )
));

$tabs = array();

if (!$model->isNewRecord) {
    $tabs[] = array(
        'label' => 'Статьи',
        'content' => $this->renderPartial('_tabArticles', array(
            'model' => $article,
            'category' => $model,
            'form' => $form
        ), true),
        'active' => true
    );
}

$tabs[] = array(
    'label' => 'Основные',
    'content' => $this->renderPartial('_tabGeneral', array(
        'model' => $model,
        'form' => $form
    ), true),
    'active' => (count($tabs) ? false : true)
);

$tabs[] = array(
    'label' => 'SEO',
    'content' => $this->widget('admin.widgets.seoTab.SeoTabWidget', array(
        'model' => $model,
        'form' => $form
    ), true)
);

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