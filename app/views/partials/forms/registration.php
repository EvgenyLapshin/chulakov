<?php
/* @var FrontendController $this */

$form = new RegisterForm();
?>

<div class="registration">
    <div class="title">
        <svg class="icon-user">
            <use xlink:href="#icon-user"></use>
        </svg>
        <span>Регистрация</span>
    </div>
    <div class="description">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
    </div>
    <form class="ajax-form" action="/lk/register" novalidate method="post" autocomplete="off">
        <?= CHtml::activeHiddenField($form, 'pageUrl'); ?>
        <?= CHtml::activeHiddenField($form, 'pageTitle'); ?>
        <?= CHtml::activeHiddenField($form, 'name'); ?>

        <div class="ajax-form__elements">
            <div class="row">
                <div class="small-12 mb-15">
                    <div class="input-group margin-small">
                        <input class="input-group-field" type="text" placeholder="ФИО" name="name" autocomplete="off">
                    </div>
                    <div class="form-error"></div>
                </div>

                <div class="small-12 mb-15">
                    <div class="input-group margin-small">
                        <?= CHtml::activeEmailField($form, 'email', array('class' => 'input-group-field', 'placeholder' => 'Email', 'autocomplete' => 'off')); ?>
                    </div>
                    <div class="form-error"></div>
                </div>

                <div class="small-12 mb-45">
                    <div class="input-group margin-small">
                        <?= CHtml::activePasswordField($form, 'password', array('class' => 'input-group-field', 'placeholder' => 'Пароль', 'autocomplete' => 'off')); ?>
                    </div>
                    <div class="form-error"></div>
                </div>

                <div class="small-12">
                    <button class="button large white no-bot-margin expanded" type="submit">Зарегистрироваться</button>
                </div>
            </div>
        </div>
        <div class="ajax-form__message">
            <div class="extend_h4">Ваше заявка принята</div>
        </div>
    </form>
</div>