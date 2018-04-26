<?php
/* @var ArticleCategoryController $this */
/* @var ArticleCategory $model */

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => 'Категории',
    'buttonVisible' => true
));

$this->widget('materialize.widgets.grid.MGridView', array(
    'id' => $model->gridId,
    'dataProvider' => $model->search(),
    'enableSorting' => false,
    'columns' => array(
        array(
            'name' => 'name',
            'value' => 'CHtml::link($data->name, $this->grid->controller->createUrl("update", array("id" => $data->id)))',
            'type' => 'html'
        ),
        array(
            'class' => 'materialize.widgets.grid.MCheckBoxColumn',
            'name' => 'is_published',
            'type' => 'html',
        ),
        array(
            'class' => 'materialize.widgets.grid.MButtonColumn',
            'template' => '{open} {update} {delete}'
        ),
        array(
            'class' => 'materialize.widgets.grid.MSortableColumn'
        )
    )
));

$this->endWidget();