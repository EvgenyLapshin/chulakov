<?php
/** @var FrontendController $this */

$contacts = Page::model()->findByPk(16);
$form = new SubscribeForm();
?>

<div class="reveal" id="subscribe-form" data-animation-in="slide-in-down" data-animation-out="slide-out-up" data-reveal>
    <div class="heading">
        Подписаться на рассылку
        <button class="close-button" data-close aria-label="Close modal" type="button">
            <svg class="icon-close">
                <use xlink:href="#icon-close"></use>
            </svg>
        </button>
    </div>

    <form class="ajax-form" action="/site/subscribe" novalidate method="post">
        <?= CHtml::activeHiddenField($form, 'pageUrl'); ?>
        <?= CHtml::activeHiddenField($form, 'pageTitle'); ?>
        <?= CHtml::activeHiddenField($form, 'firstName'); ?>
        <input type="hidden" name="subject" value="Подписка на рассылку">

        <div class="ajax-form__elements">
            <div class="row">
                <div class="small-12 columns">
                    <label class="input-medium">Почта</label>
                    <div class="input-group margin-small">
                        <?= CHtml::activeTelField($form, 'email', array('class' => 'input-group-field', 'placeholder' => 'Введите Ваше email')); ?>
                        <div class="input-group-label">
                            <svg class="icon-mail">
                                <use xlink:href="#icon-mail"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="form-error"></div>
                </div>

                <div class="small-12 columns">
                    <div class="button-label-text float-left mt-15 large"><?= $contacts->phoneManager; ?></div>
                    <button class="button large alert float-right no-bot-margin mt-15" type="submit">Отправить</button>
                </div>
            </div>
        </div>
        <div class="ajax-form__message">
            <div class="extend_h4">Ваше заявка принята</div>
        </div>
    </form>

</div>