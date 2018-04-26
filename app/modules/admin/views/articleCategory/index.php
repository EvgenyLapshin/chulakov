<?php
/* @var ArticleCategoryController $this */
/* @var ArticleCategory $model */

$this->breadcrumbs = array(
    '«' . $model->page->page_title . '»'
);

$tab = array(
    array('label' => 'Категории', 'content' => $this->renderPartial('_tabIndex', array('model' => $model), true), 'active' => true)
);

$this->widget('app.modules.admin.widgets.pageUpdate.PageUpdateWidget', array('id' => $model->page->id, 'tabsEntities' => $tab));