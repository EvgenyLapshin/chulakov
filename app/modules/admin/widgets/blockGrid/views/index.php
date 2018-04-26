<?php
/**
 * @var $this BlockGridWidget
 * @var $model SActiveRecord
 * @var $mBlockTemplate BlockTemplate
 */

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => 'Шаблоны блоков',
    'wrappedInRow' => false,
    'collWrapperCss' => array(MHtml::MOBILE_COLUMN_12, MHtml::DESKTOP_COLUMN_6),
    'buttonVisible' => true,
    'buttonHtmlOptions' => array(
        'url' => url('/admin/blockTemplate/create', array(
            'entity_name' => $mBlockTemplate->entity_name,
            'entity_template_name' => $mBlockTemplate->entity_template_name,
            'entity_template_id' => $mBlockTemplate->entity_template_id
        ))
    )
));

$this->widget('materialize.widgets.grid.MGridView', array(
    'id' => $mBlockTemplate->gridId,
    'dataProvider' => $mBlockTemplate->search(),
    'enableSorting' => false,
    'columns' => array(
        array(
            'name' => 'id',
            'htmlOptions' => array('width' => '10')
        ),
        array(
            'name' => 'name',
            'value' => 'CHtml::link($data->name, url("/admin/blockTemplate/update", array("id" => $data->id)))',
            'type' => 'html'
        ),
        array(
            'name' => 'type',
            'value' => '$data->type',
            'class' => 'materialize.widgets.grid.MDropDownListColumn',
            'data' => $mBlockTemplate->getTypeList()
        ),
        array(
            'class' => 'materialize.widgets.grid.MButtonColumn',
            'template' => '{update} {delete}',
            'deleteButtonUrl' => 'url("/admin/blockTemplate/delete", array("id" => $data->id))',
            'updateButtonUrl' => 'url("/admin/blockTemplate/update", array("id" => $data->id))',
        ),
        array(
            'class' => 'materialize.widgets.grid.MSortableColumn',
            'url' => url('/admin/blockTemplate/sortable')
        )
    )
));

$this->endWidget();