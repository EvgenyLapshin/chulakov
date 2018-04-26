<?php
/**
 * @var $this RegisterController
 * @var $model RegisterForm
 * @var $form MActiveForm
 */
cs()->registerCssFile($this->module->getAssetsUrl() . '/css/user.css');
?>

<div class="z-depth-4 card-panel">
    <div class="outside-form">
        <h4 class="center">Регистрация:</h4>

        <?php
        $form = $this->beginWidget('materialize.widgets.MActiveForm', array(
            'id' => 'register-form',
            'enableClientValidation' => true,
            'addSaveButton' => false,
            'clientOptions' => array(
                'validateOnSubmit' => true
            )
        ));
        ?>

        <div class="outside-form__fields">
            <?php
            echo $form->textFieldRow($model, 'username', array('column' => MHtml::MOBILE_COLUMN_12, 'prepend' => MHtml::icon('person_outline')));
            echo $form->textFieldRow($model, 'email', array('column' => MHtml::MOBILE_COLUMN_12, 'prepend' => MHtml::icon('email')));
            echo $form->passwordFieldRow($model, 'password', array('column' => MHtml::MOBILE_COLUMN_12, 'prepend' => MHtml::icon('lock_outline')));
            echo $form->passwordFieldRow($model, 'passwordConfirm', array('column' => MHtml::MOBILE_COLUMN_12, 'prepend' => MHtml::icon('lock_outline')));
            ?>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <?= MHtml::submitButton('Регистрация', array(
                    'color' => MHtml::COLOR_PINK,
                    'color-shade' => MHtml::COLOR_SHADE_ACCENT_2,
                    'class' => 'col s12'
                )); ?>
            </div>
        </div>

        <?php $this->endWidget(); ?>

        <!-- Восстановить пароль [link]-->
        <div class="row">
            <div class="col s12">
                <p class="right-align">
                    <?= MHtml::link('Войти', url('/user/login')); ?>
                </p>
            </div>
        </div>

    </div>
</div>
