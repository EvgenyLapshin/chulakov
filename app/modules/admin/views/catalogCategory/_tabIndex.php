<?php
/* @var CatalogCategoryController $this */
/* @var CatalogCategory $model */

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => 'Категории',
    'description' => 'Сортировка категорий производится в левом меню, где отображено дерево категорий каталога.',
    'buttonVisible' => true,
    'buttonHtmlOptions' => array(
        'url' => url('/admin/catalogCategory/create')
    )
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
            'template' => '{open} {update}'
        ),
    )
));

$this->endWidget();