<?php
/* @var $this AssignmentController */
/* @var $model User */
/* @var $authItemDp AuthItemDataProvider */
/* @var $formModel AddAuthItemForm */
/* @var $form MActiveForm */
/* @var $assignmentOptions array */

$this->pageTitle = Yii::t('AuthModule.main', 'Assignments');

$this->breadcrumbs = array(
    $this->pageTitle => array('index'),
    'Пользователь'
);

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => 'Пользователь ' . CHtml::encode(CHtml::value($model, $this->module->userNameColumn)),
    'description' => Yii::t('AuthModule.main', 'Items assigned to this user')
));

    $this->widget('materialize.widgets.grid.MGridView', array(
        'dataProvider' => $authItemDp,
        'emptyText' => Yii::t('AuthModule.main', 'This user does not have any assignments.'),
        'hideHeader' => true,
        'columns' => array(
            array(
                'class' => 'AuthItemDescriptionColumn',
                'active' => true,
            ),
            array(
                'class' => 'AuthItemTypeColumn',
                'active' => true,
            ),
            array(
                'class' => 'AuthAssignmentRevokeColumn',
                'userId' => $model->{$this->module->userIdColumn},
            ),
        ),
    ));

$this->endWidget();


if (!empty($assignmentOptions)) {

    $this->beginWidget('materialize.widgets.MCard', array(
        'title' => 'Назначить права пользователю ' . CHtml::encode(CHtml::value($model, $this->module->userNameColumn)),
    ));

    $form = $this->beginWidget('materialize.widgets.MActiveForm');

    echo $form->dropDownListRow($formModel, 'items', $assignmentOptions, array('column' => MHtml::MOBILE_COLUMN_4));
    echo MHtml::submitButton(Yii::t('AuthModule.main', 'Assign'));

    $this->endWidget();

    $this->endWidget();

}