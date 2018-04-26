<?php
/* @var $this LogController */
/* @var $model Log */


$this->pageTitle = 'Логи';

$this->breadcrumbs = array(
    $this->pageTitle
);

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => $this->pageTitle,
    'buttonVisible' => true,
    'buttonHtmlOptions' => array(
        'url' => $this->createUrl('delete'),
        'icon' => MHtml::icon('delete'),
        'title' => 'Очистить корзину'
    )
));

$this->widget('materialize.widgets.grid.MGridView', array(
    'id' => $model->gridId,
    'dataProvider' => $model->search(),
    'enableSorting' => false,
    'columns' => array(
        array(
            'name' => 'level',
            'htmlOptions' => array('style' => 'width: 10px')
        ),
        'category',
        array(
            'name' => 'logtime',
            'value' => 'date("Y-m-d H:i:s", $data->logtime)',
            'filter' => MHtml::datePicker('logtime')
        ),
        array(
            'name' => 'message',
            'value' => 'highlight_string("<?php " . $data->message . "?>", true)',
            'type' => 'html'
        )
    )
));

$this->endWidget();