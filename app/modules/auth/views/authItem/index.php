<?php
/* @var $this OperationController|TaskController|RoleController */
/* @var $dataProvider AuthItemDataProvider */

$this->breadcrumbs = array(
    $this->capitalize($this->getTypeText(true)),
);

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => $this->capitalize($this->getTypeText(true)),
    'buttonVisible' => true,
    'buttonHtmlOptions' => array(
        'label' => Yii::t('AuthModule.main', 'Add {type}', array('{type}' => $this->getTypeText()))
    )
));

$this->widget('materialize.widgets.grid.MGridView', array(
    'dataProvider' => $dataProvider,
    'enableSorting' => false,
    'emptyText' => Yii::t('AuthModule.main', 'No {type} found.', array('{type}' => $this->getTypeText(true))),
    'columns' => array(
        array(
            'name' => 'name',
            'type' => 'raw',
            'header' => Yii::t('AuthModule.main', 'System name'),
            'htmlOptions' => array('class' => 'item-name-column'),
            'value' => "CHtml::link(\$data->name, array('view', 'name'=>\$data->name))",
        ),
        array(
            'name' => 'description',
            'header' => Yii::t('AuthModule.main', 'Description'),
            'htmlOptions' => array('class' => 'item-description-column'),
        ),
        array(
            'class' => 'materialize.widgets.grid.MButtonColumn',
            'viewButtonLabel' => Yii::t('AuthModule.main', 'View'),
            'viewButtonUrl' => "Yii::app()->controller->createUrl('view', array('name'=>\$data->name))",
            'updateButtonLabel' => Yii::t('AuthModule.main', 'Edit'),
            'updateButtonUrl' => "Yii::app()->controller->createUrl('update', array('name'=>\$data->name))",
            'deleteButtonLabel' => Yii::t('AuthModule.main', 'Delete'),
            'deleteButtonUrl' => "Yii::app()->controller->createUrl('delete', array('name'=>\$data->name))",
            'deleteConfirmation' => Yii::t('AuthModule.main', 'Are you sure you want to delete this item?'),
        )
    )
));

$this->endWidget();