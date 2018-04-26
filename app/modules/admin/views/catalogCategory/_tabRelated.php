<?php
/* @var CatalogCategoryController $this */
/* @var CatalogProduct $model */
/* @var CatalogCategory $category */
/* @var MActiveForm $form */

$controller = app()->createController('/admin/catalogProduct');
/** @var CatalogProductController $controller */
$controller = $controller[0];

$controller->beginWidget('materialize.widgets.MCard', array(
    'title' => 'Товары',
    'buttonVisible' => true,
    'buttonHtmlOptions' => array(
        'url' => $controller->createUrl('create', array('catalog_category_id' => $category->id))
    )
));

$controller->widget('materialize.widgets.grid.MGridView', array(
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
            'name' => 'catalog_country_manufacturer_id',
            'class' => 'materialize.widgets.grid.MDataColumn',
            'value' => '$data->getRelated("rCatalogCountryManufacturer") ? $data->rCatalogCountryManufacturer->name : ""',
            'description' => true,
            'header' => 'Производитель'
        ),
        array(
            'name' => 'catalog_category_id',
            'class' => 'materialize.widgets.grid.MDropDownListColumn',
            'data' => CHtml::listData(CatalogCategory::model()->sPublished()->findAll(), 'id', 'name'),
            'htmlOptions' => array('width' => '350')
        ),
        array(
            'class' => 'materialize.widgets.grid.MCheckBoxColumn',
            'name' => 'is_published',
            'header' => MHtml::icon('remove_red_eye'),
            'description' => true,
            'type' => 'html'
        ),
        array(
            'class' => 'materialize.widgets.grid.MButtonColumn',
            'template' => '{open} {update} {delete}'
        )
    )
));

$controller->endWidget();