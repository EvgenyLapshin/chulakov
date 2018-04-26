<?php
/* @var $this AssignmentController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle =  Yii::t('AuthModule.main', 'Assignments');

$this->breadcrumbs = array(
    $this->pageTitle
);

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => $this->pageTitle
));

$this->widget('materialize.widgets.grid.MGridView', array(
    'id' => $dataProvider->model->gridId,
    'dataProvider' => $dataProvider,
    'enableSorting' => false,
    'columns' => array(
        array(
            'header' => Yii::t('AuthModule.main', 'User'),
            'class' => 'AuthAssignmentNameColumn',
        ),
        array(
            'header' => Yii::t('AuthModule.main', 'Assigned items'),
            'class' => 'AuthAssignmentItemsColumn',
        ),
        array(
            'class' => 'AuthAssignmentViewColumn',
        )
    )
));

$this->endWidget();