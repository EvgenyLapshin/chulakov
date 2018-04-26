<?php
/* @var ArticleCategoryController $this */
/* @var Article $model */
/* @var ArticleCategory $category */
/* @var MActiveForm $form */

$controller = app()->createController('/admin/article');
/** @var ArticleController $controller */
$controller = $controller[0];

$controller->beginWidget('materialize.widgets.MCard', array(
    'title' => 'Статьи',
    'buttonVisible' => true,
    'buttonHtmlOptions' => array(
        'url' => $controller->createUrl('create', array('category_id' => $category->id))
    )
));

$controller->widget('materialize.widgets.grid.MGridView', array(
    'id' => $model->gridId,
    'dataProvider' => $model->search(),
    'enableSorting' => false,
    'columns' => array(
        array(
            'name' => 'title',
            'value' => 'CHtml::link($data->title, $this->grid->controller->createUrl("update", array("id" => $data->id)))',
            'type' => 'html'
        ),
        array(
            'name' => 'status',
            'class' => 'materialize.widgets.grid.MDropDownListColumn',
            'data' => $model->getStatusList(),
        ),
        array(
            'class' => 'materialize.widgets.grid.CDataColumn',
            'name' => 'pub_date',
            'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->pub_date)'
        ),
        array(
            'class' => 'materialize.widgets.grid.MTextColumn',
            'name' => 'view_count',
            'header' => MHtml::icon('visibility'),
            'description' => true,
            'htmlOptions' => array('style' => 'text-align:center;'),
            'headerHtmlOptions' => array('style' => 'text-align:center;')
        ),
        array(
            'class' => 'materialize.widgets.grid.MButtonColumn',
            'template' => '{open} {update} {restore} {softDelete} {hardDelete}'
        ),
    )
));

$controller->endWidget();