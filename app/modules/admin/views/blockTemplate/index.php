<?php
/**
 * @var $this BlockTemplateController
 * @var $model BlockTemplate
 */

$this->pageTitle = 'Шаблоны блоков';

if ($model->entity_template_id) {
    $this->breadcrumbs = array(
        $this->pageTitle => array('index'),
        '«' . $model->entityTemplate->title . '»' => array('/admin/pageTemplate/update', 'id' => $model->entity_template_id),
    );
} else {
    $this->breadcrumbs = array(
        $this->pageTitle
    );
}

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => $this->pageTitle,
    'buttonVisible' => true
));

$this->widget('materialize.widgets.grid.MGridView', array(
    'id' => $model->gridId,
    'dataProvider' => $model->search(),
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
            'name' => 'entity_name',
            'class' => 'materialize.widgets.grid.MTextColumn',
            'header' => 'Модель сущности',
            'description' => true
        ),
        array(
            'name' => 'limit_blocks',
            'class' => 'materialize.widgets.grid.MTextColumn',
            'header' => 'Кол-во блоков',
            'description' => true
        ),
        array(
            'name' => 'entity_template_name',
            'class' => 'materialize.widgets.grid.MTextColumn',
            'header' => 'Модель шаблона сущности',
            'description' => true
        ),
        array(
            'name' => 'entity_template_id',
            'value' => '(!empty($data->entityTemplate->title)) ? $data->entityTemplate->title : ""'
        ),
        array(
            'name' => 'type',
            'class' => 'materialize.widgets.grid.MDropDownListColumn',
            'data' => BlockTemplate::getTypeList()
        ),
        array(
            'class' => 'materialize.widgets.grid.MButtonColumn',
            'template' => '{update} {delete}',
        ),
        array(
            'class' => 'materialize.widgets.grid.MSortableColumn'
        )
    )
));

$this->endWidget();