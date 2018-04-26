<?php
/* @var NewsController $this */
/* @var News $model */

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => 'Новости',
    'buttonVisible' => true,
    'buttonHtmlOptions' => array(
        'url' => $this->createUrl('create')
    )
));

$this->widget('materialize.widgets.grid.MGridView', array(
    'id' => $model->gridId,
    'dataProvider' => $model->search(),
    'enableSorting' => false,
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'title',
            'value' => 'CHtml::link($data->title, $this->grid->controller->createUrl("update", array("id" => $data->id)))',
            'type' => 'html'
        ),
        array(
            'name' => 'status',
            'class' => 'materialize.widgets.grid.MDropDownListColumn',
            'data' => $model->getStatusList()
        ),
        array(
            'class' => 'materialize.widgets.grid.CDataColumn',
            'name' => 'pub_date',
            'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->pub_date)'
        ),
        array(
            'class' => 'materialize.widgets.grid.MCheckBoxColumn',
            'name' => 'is_important',
            'type' => 'html',
            'htmlOptions' => array('style' => 'text-align:center;'),
            'headerHtmlOptions' => array('style' => 'text-align:center;')
        ),
        array(
            'class' => 'materialize.widgets.grid.MTextColumn',
            'name' => 'view_count',
            'header' => MHtml::icon('visibility'),
            'description' => true,
            /*'htmlOptions' => array('style' => 'text-align:center;'),*/
            'headerHtmlOptions' => array('style' => 'text-align:center;')
        ),
        array(
            'class' => 'materialize.widgets.grid.MButtonColumn',
            'template' => '{open} {update} {restore} {softDelete} {hardDelete}'
        ),
    )
));

$this->endWidget();