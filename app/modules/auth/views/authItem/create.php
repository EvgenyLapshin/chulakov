<?php
/* @var $this OperationController|TaskController|RoleController */
/* @var $model AuthItemForm */
/* @var $form MActiveForm */

$this->breadcrumbs = array(
	$this->capitalize($this->getTypeText(true)) => array('index'),
	Yii::t('AuthModule.main', 'New {type}', array('{type}' => $this->getTypeText())),
);

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => Yii::t('AuthModule.main', 'New {type}', array('{type}' => $this->getTypeText()))
));

$form = $this->beginWidget('materialize.widgets.MActiveForm', array(
    'id' => 'auth-item-form',
));

echo $form->hiddenField($model, 'type');
echo $form->textFieldRow($model, 'name');
echo $form->textFieldRow($model, 'description');

$this->endWidget();
$this->endWidget();