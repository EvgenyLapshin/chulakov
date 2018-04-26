<?php
/* @var CatalogCategoryController $this */
/* @var CatalogCategory $model */

$this->breadcrumbs = array(
    '«Страны производители»'
);

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => 'Страны производители',
    'buttonVisible' => true,
    'buttonHtmlOptions' => array(
        'url' => url('/admin/catalogCountryManufacturer/create')
    )
));

$this->widget('materialize.widgets.grid.MGridView', array(
    'id' => $model->gridId,
    'dataProvider' => $model->search(),
    'enableSorting' => false,
    'columns' => array(
        'name',
        array(
            'class' => 'materialize.widgets.grid.MCheckBoxColumn',
            'name' => 'is_published',
            'type' => 'html',
            'htmlOptions' => array('style' => 'text-align:center;'),
            'headerHtmlOptions' => array('style' => 'text-align:center;')
        ),
        array(
            'class' => 'materialize.widgets.grid.MButtonColumn',
            'template' => '{open} {update} {delete}'
        ),
    )
));

$this->endWidget();