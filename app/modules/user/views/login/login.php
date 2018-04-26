<?php
/**
 * @var $this LoginController
 * @var $model LoginForm
 * @var $form MActiveForm
 */
cs()->registerCssFile($this->module->getAssetsUrl() . '/css/user.css');
?>
<div class="z-depth-4 card-panel">
    <div class="outside-form">
        <h4 class="center">Вход</h4>

        <?php
        $form = $this->beginWidget('materialize.widgets.MActiveForm', array(
            'id' => 'login-form',
            'enableClientValidation' => true,
            'addSaveButton' => false,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            )
        ));
        ?>

        <div class="outside-form__fields">
            <?= $form->textFieldRow($model, 'username', array('placeholder' => 'Имя пользователя или E-mail', 'label' => 'Логин', 'column' => MHtml::MOBILE_COLUMN_12, 'prepend' => MHtml::icon('person_outline'))); ?>

            <?= $form->passwordFieldRow($model, 'password', array('placeholder' => 'Не менее 6 символов', 'column' => MHtml::MOBILE_COLUMN_12, 'prepend' => MHtml::icon('lock_outline'))); ?>

            <div class="outside-form__remember row">
                <?= $form->checkMark($model, 'rememberMe', array('column' => MHtml::MOBILE_COLUMN_12)); ?>
            </div>

        </div>

        <div class="row">
            <div class="input-field col s12">
                <?= MHtml::submitButton('Войти', array(
                    'color' => MHtml::COLOR_PINK,
                    'color-shade' => MHtml::COLOR_SHADE_ACCENT_2,
                    'class' => 'col s12'
                )); ?>
            </div>
        </div>

        <!-- Восстановить пароль [link]-->
        <div class="row">
            <div class="col s12">
                <p class="right-align">
                    <?= MHtml::link('Забыли пароль?', url('/user/recoverPassword')); ?>
                </p>
            </div>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>

