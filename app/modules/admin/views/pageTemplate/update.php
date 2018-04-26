<?php
/**
 * @var $this PageTemplateController
 * @var $model PageTemplate
 * @var $mField PageField
 * @var $pageFieldController PageFieldController
 */

$this->breadcrumbs = array(
    'Шаблоны страниц' => array('index'),
    'Редактировать',
);
?>

<div class="row">
    <?php $this->renderPartial('_form', array('model' => $model)); ?>
</div>

<div class="row">

    <?php
    $this->beginWidget('materialize.widgets.MCard', array(
        'title' => 'Поля',
        'wrappedInRow' => false,
        'collWrapperCss' => array(MHtml::MOBILE_COLUMN_12, MHtml::DESKTOP_COLUMN_6),
        'buttonVisible' => true,
        'buttonHtmlOptions' => array(
            'url' => url('/admin/pageField/create', array('template' => $model->id))
        )
    ));

    $pageFieldController->widget('materialize.widgets.grid.MGridView', array(
        'id' => $mField->gridId,
        'dataProvider' => $mField->search(),
        'enableSorting' => false,
        'columns' => array(
            array(
                'name' => 'label',
                'value' => 'CHtml::link($data->label, url("/admin/pageField/update", array("id" => $data->id)))',
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
                'deleteButtonUrl' => 'url("/admin/pageField/delete", array("id" => $data->id))',
                'updateButtonUrl' => 'url("/admin/pageField/update", array("id" => $data->id))',
            ),
            array(
                'class' => 'materialize.widgets.grid.MSortableColumn',
                'url' => url('/admin/pageField/sortable')
            )
        )
    ));

    $this->endWidget();

    $this->widget('app.modules.admin.widgets.blockGrid.BlockGridWidget', array(
        'entity_name' => 'Page',
        'entity_template_name' => 'PageTemplate',
        'entity_template_id' => $model->id
    ));
    ?>

</div>