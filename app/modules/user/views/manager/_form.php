<?php
/**
 * @var $this ManagerController
 * @var $user User
 * @var $userProfile UserProfile
 * @var $form MActiveForm
 */

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => 'Основные поля'
));

$form = $this->beginWidget('materialize.widgets.MActiveForm', array(
    'id' => $user->formId,
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true
    )
)); 

echo $form->textFieldRow($user, 'username', array('prepend' => MHtml::icon('person')));

echo $form->textFieldRow($user, 'email', array('prepend' => MHtml::icon('email')));

$this->widget('UploaderWidget', array(
    'model' => $userProfile,
    'attribute' => 'avatar'
));

echo $form->dropDownListRow($user, 'status', $user->statusList);

if ($user->isNewRecord) {
    echo $form->passwordFieldRow($user, 'password');
} else {
    echo $form->passwordFieldRow($user, 'newPassword');
}

echo $form->passwordFieldRow($user, 'passwordConfirm');

$this->endWidget();
$this->endWidget();