<?php
/* @var $this OperationController|TaskController|RoleController */
/* @var $model AuthItemForm */
/* @var $item CAuthItem */
/* @var $form MActiveForm */

$this->breadcrumbs = array(
    $this->capitalize($this->getTypeText(true)) => array('index'),
    $item->description => array('view', 'name' => $item->name),
    Yii::t('AuthModule.main', 'Edit'),
);

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => CHtml::encode($item->description),
    'description' => $this->getTypeText()
));

$form = $this->beginWidget('materialize.widgets.MActiveForm', array(
    'id' => 'auth-item-form',
));

echo $form->hiddenField($model, 'type');
echo $form->textFieldRow($model, 'name', array(
    'disabled' => true,
    'title' => Yii::t('AuthModule.main', 'System name cannot be changed after creation.'),
));

echo $form->textFieldRow($model, 'description');

$this->endWidget();
$this->endWidget();