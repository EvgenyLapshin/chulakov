<?php
/**
 * @var $this EmailController
 * @var $model Email
 */

$this->pageTitle = 'Письма';

$this->breadcrumbs = array(
    $this->pageTitle
);

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => $this->pageTitle,
    'description' => 'Здесь находятся тексты писем, рассылаемые сайтом',
    'buttonVisible' => user()->isAdmin
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
            'name' => 'name',
            'value' => 'CHtml::link($data->name, $this->grid->controller->createUrl("update", array("id" => $data->id)))',
            'type' => 'html'
        ),
        array(
            'name' => 'email',
            'class' => 'materialize.widgets.grid.MTextColumn'
        ),
        array(
            'name' => 'subject',
            'class' => 'materialize.widgets.grid.MTextColumn'
        ),
        array(
            'class' => 'materialize.widgets.grid.MButtonColumn',
            'template' => '{update} {delete}',
        )
    ),
));

$this->endWidget();