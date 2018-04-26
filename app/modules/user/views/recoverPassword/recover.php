<?php
/**
 * @var $this RecoverPasswordController
 * @var $model RecoverPasswordForm
 * @var $form MActiveForm
 */
cs()->registerCssFile($this->module->getAssetsUrl() . '/css/user.css');
?>

<div class="z-depth-4 card-panel">
    <div class="outside-form outside-form--large">
        <h4 class="center">Восстановление пароля</h4>

        <?php
        $form = $this->beginWidget('materialize.widgets.MActiveForm', array(
            'id' => 'RecoverPasswordForm',
            'enableClientValidation' => true,
            'addSaveButton' => false,
            'clientOptions' => array(
                'validateOnSubmit' => true
            )
        ));
        ?>

        <div class="outside-form__fields">

            <?= $form->textFieldRow($model, 'email', array('column' => MHtml::MOBILE_COLUMN_12, 'prepend' => MHtml::icon('person_outline'))); ?>

        </div>

        <div class="row">
            <div class="input-field col s12">
                <?= MHtml::submitButton('Восстановить', array(
                    'color' => MHtml::COLOR_PINK,
                    'color-shade' => MHtml::COLOR_SHADE_ACCENT_2,
                    'class' => 'col s12'
                )); ?>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <p class="right-align">
                    <?= MHtml::link('Войти', url('/user/login')); ?>
                </p>
            </div>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>


