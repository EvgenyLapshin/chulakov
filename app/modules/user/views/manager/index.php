<?php
/**
 * @var $this ManagerController
 * @var $model User
 */

$this->pageTitle = 'Пользователи';

$this->breadcrumbs = array(
    $this->pageTitle
);

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => $this->pageTitle,
    'buttonVisible' => true,
    'buttonHtmlOptions' => array(
        'icon' => MHtml::icon('person_add')
    )
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
            'name' => 'username',
            'value' => 'CHtml::link($data->username, $this->grid->controller->createUrl("update", array("id" => $data->id)))',
            'type' => 'html'
        ),
        array(
            'name' => 'email',
            'class' => 'materialize.widgets.grid.MTextColumn'
        ),
        array(
            'name' => 'status',
            'class' => 'materialize.widgets.grid.MDropDownListColumn',
            'data' => $model->getStatusList()
        ),
        array(
            'class' => 'materialize.widgets.grid.MButtonColumn',
            'template' => '{update} {delete}'
        )
    )
));

$this->endWidget();