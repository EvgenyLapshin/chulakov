<?php
/**
 * @var $this PageController
 * @var $model Page
 */

$this->pageTitle = 'Страницы';

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
            'htmlOptions' => array(
                'width' => '10'
            )
        ),
        array(
            'name' => 'page_title',
            'value' => 'CHtml::link($data->page_title, $this->grid->controller->createUrl("update", array("id" => $data->id)))',
            'type' => 'html'
        ),
        array(
            'name' => 'template_id',
            'value' => '$data->rTemplate->title',
            'type' => 'html'
        ),
        array(
            'name' => 'is_published',
            'class' => 'materialize.widgets.grid.MCheckBoxColumn'
        ),
        array(
            'class' => 'materialize.widgets.grid.MButtonColumn',
            'template' => '{open} {update} {delete}',
            'openButtonUrl' => 'url("/page/index", array("alias" => $data->alias))',
            'openButtonVisible' => '($data->rTemplate->to_display) ? 1 : 0'
        )
    )
));

$this->endWidget();