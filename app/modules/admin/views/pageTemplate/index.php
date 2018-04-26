<?php
/**
 * @var $this PageTemplateController
 * @var $model PageTemplate
 */

$this->pageTitle = 'Шаблоны страниц';

$this->breadcrumbs = array(
    $this->pageTitle
);

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => $this->pageTitle,
    'buttonVisible' => true
));

$this->widget('materialize.widgets.grid.MGridView', array(
    'id' => $model->gridId,
    'dataProvider' => $model->search(),
    'enableSorting' => false,
    'columns' => array(
        array(
            'name' => 'id',
            'htmlOptions' => array('width' => '10')
        ),
        array(
            'name' => 'title',
            'value' => 'CHtml::link($data->title, $this->grid->controller->createUrl("update", array("id" => $data->id)))',
            'type' => 'html'
        ),
        array(
            'name' => 'child_id',
            'class' => 'materialize.widgets.grid.MDropDownListColumn',
            'data' => CHtml::listData(PageTemplate::model()->findAll(), 'id', 'title'),
        ),
        array(
            'name' => 'to_display',
            'class' => 'materialize.widgets.grid.MCheckBoxColumn',
        ),
        array(
            'class' => 'materialize.widgets.grid.MButtonColumn',
            'template' => '{update} {delete}',
        )
    )
));

$this->endWidget();