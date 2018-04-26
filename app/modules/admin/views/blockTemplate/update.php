<div class="row">

<?php
/**
 * @var $this BlockTemplateController
 * @var $model BlockTemplate
 * @var $mBlockField BlockField
 * @var $blockFieldController BlockFieldController
 */

$this->pageTitle = 'Редактировать шаблон блока';

if ($model->entity_template_name) {
    $this->breadcrumbs = array(
        'Шаблоны страниц' => array('/admin/pageTemplate/index'),
        '«' . $model->entityTemplate->title . '»' => array('/admin/pageTemplate/update', 'id' => $model->entity_template_id),
        $this->pageTitle
    );
} else {
    $this->breadcrumbs = array(
        '«' . $model->entity_name . '»' => array('/admin/' . lcfirst($model->entity_name) . '/index'),
        $this->pageTitle
    );
}

$this->renderPartial('_form', array('model' => $model));

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => 'Поля',
    'wrappedInRow' => false,
    'collWrapperCss' => array(MHtml::MOBILE_COLUMN_12, MHtml::DESKTOP_COLUMN_6),
    'buttonVisible' => true,
    'buttonHtmlOptions' => array(
        'url' => url('/admin/blockField/create', array('blockTemplate' => $model->id))
    )
));

$blockFieldController->widget('materialize.widgets.grid.MGridView', array(
    'id' => $mBlockField->gridId,
    'dataProvider' => $mBlockField->search(),
    'enableSorting' => false,
    'columns' => array(
        array(
            'name' => 'label',
            'value' => 'CHtml::link($data->label, url("/admin/blockField/update", array("id" => $data->id)))',
            'type' => 'html'
        ),
        array(
            'name' => 'name',
            'class' => 'materialize.widgets.grid.MTextColumn'
        ),
        'type',
        array(
            'class' => 'materialize.widgets.grid.MButtonColumn',
            'template' => '{update} {delete}',
            'deleteButtonUrl' => 'url("/admin/blockField/delete", array("id" => $data->id))',
            'updateButtonUrl' => 'url("/admin/blockField/update", array("id" => $data->id))',
        ),
        array(
            'class' => 'materialize.widgets.grid.MSortableColumn',
            'url' => url('/admin/blockField/sortable')
        ),
    )
));

$this->endWidget();
?>

</div>