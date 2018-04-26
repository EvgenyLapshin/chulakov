<?php
/* @var CatalogProductController $this */
/* @var CatalogProduct $model */

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => 'Товары',
    'filterButtonVisible' => true
));

$this->widget('materialize.widgets.grid.MGridView', array(
    'id' => $model->gridId,
    'dataProvider' => $model->search(),
    'enableSorting' => false,
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'name',
            'value' => 'CHtml::link($data->name, $this->grid->controller->createUrl("update", array("id" => $data->id)))',
            'type' => 'html'
        ),
        array(
            'name' => 'catalog_country_manufacturer_id',
            'value' => '$data->getRelated("rCatalogCountryManufacturer") ? $data->rCatalogCountryManufacturer->name : ""',
            'description' => true,
            'header' => 'Производитель',
            'filter' => false
        ),
        array(
            'name' => 'is_published',
            'value' => '($data->is_published) ? MHtml::icon("done") : MHtml::icon("check_box_outline_blank")',
            'header' => MHtml::icon('remove_red_eye'),
            'description' => true,
            'type' => 'html',
            'filter' => array('Нет', 'Да'),
            'htmlOptions' => array('style' => 'text-align:center;'),
            'headerHtmlOptions' => array('style' => 'text-align:center;'),
        ),
        array(
            'name' => 'content',
            'value' => '($data->content) ? MHtml::icon("done") : MHtml::icon("check_box_outline_blank")',
            'type' => 'html',
            'header' => MHtml::icon('receipt'),
            'description' => true,
            'filter' => array('Нет', 'Да'),
            'htmlOptions' => array('style' => 'text-align:center;'),
            'headerHtmlOptions' => array('style' => 'text-align:center;'),
        ),
        array(
            'name' => 'image',
            'value' => '($data->image) ? MHtml::icon("done") : MHtml::icon("check_box_outline_blank")',
            'type' => 'html',
            'header' => MHtml::icon('image'),
            'description' => true,
            'filter' => array('Нет', 'Да'),
            'htmlOptions' => array('style' => 'text-align:center;'),
            'headerHtmlOptions' => array('style' => 'text-align:center;'),
        ),
        array(
            'class' => 'materialize.widgets.grid.MButtonColumn',
            'template' => '{open} {update}'
        )
    )
));

$this->endWidget();