<?php
/**
 * @var $this RecoverPasswordController
 * @var $model RecoverPasswordForm
 * @var $form MActiveForm
 */
cs()->registerCssFile($this->module->getAssetsUrl() . '/css/user.css');
?>

<div class="z-depth-4 card-panel">
    <div class="outside-form outside-form--medium">
        <h4 class="center">Придумайте новый пароль</h4>

        <?php
        $form = $this->beginWidget('materialize.widgets.MActiveForm', array(
            'id' => 'login-form',
            'enableClientValidation' => true,
            'addSaveButton' => false,
            'clientOptions' => array(
                'validateOnSubmit' => true
            )
        ));
        ?>

        <div class="outside-form__fields">
            <?= $form->passwordFieldRow($model, 'password', array('column' => MHtml::MOBILE_COLUMN_12, 'prepend' => MHtml::icon('lock_outline'))); ?>
            <?= $form->passwordFieldRow($model, 'passwordConfirm', array('column' => MHtml::MOBILE_COLUMN_12, 'prepend' => MHtml::icon('lock_outline'))); ?>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <?= MHtml::submitButton('Сменить пароль', array(
                    'color' => MHtml::COLOR_PINK,
                    'color-shade' => MHtml::COLOR_SHADE_ACCENT_2,
                    'class' => 'col s12'
                )); ?>
            </div>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>

