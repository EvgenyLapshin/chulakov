<?php
/* @var PageController $this */
/* @var Page $model */

$form = new ServiceForm();
$form->subject = $model->page_title;
$form->pageTitle = $model->page_title;
$form->pageUrl = $model->absoluteUrl;
?>

<div class="service-form">
    <div class="service-form-inner">
        <div class="row service-form-wrap">
            <div class="small-12 columns">
                <h2>Обратиться за услугой упаковки</h2>

                <form class="ajax-form" action="/site/service" novalidate>
                    <div class="ajax-form__elements">
                        <?= CHtml::activeHiddenField($form, 'pageUrl'); ?>
                        <?= CHtml::activeHiddenField($form, 'pageTitle'); ?>
                        <?= CHtml::activeHiddenField($form, 'firstName'); ?>
                        <?= CHtml::activeHiddenField($form, 'subject'); ?>
                        <div class="row">
                            <div class="small-4 columns">
                                <label for="field-1" class="input-medium">
                                    Имя
                                </label>
                                <div class="input-group">
                                    <?= CHtml::activeTelField($form, 'name', array('class' => 'input-group-field', 'placeholder' => 'Введите Ваше имя')); ?>
                                    <span class="input-group-label">
                                        <svg class="icon-people">
                                            <use xlink:href="#icon-people"></use>
                                        </svg>
                                    </span>
                                </div>
                                <div class="form-error"></div>
                            </div>

                            <div class="small-4 columns">
                                <label for="field-2" class="input-medium">
                                    Телефон
                                </label>
                                <div class="input-group">
                                    <?= CHtml::activeTelField($form, 'phone', array('class' => 'input-group-field phone-mask', 'placeholder' => '+7 (906) 627-01-34')); ?>
                                    <span class="input-group-label">
                                        <svg class="icon-phone">
                                            <use xlink:href="#icon-phone"></use>
                                        </svg>
                                    </span>
                                </div>
                                <div class="form-error"></div>
                            </div>

                            <div class="small-4 columns">
                                <label for="field-3" class="input-medium">
                                    Почта
                                </label>
                                <div class="input-group">
                                    <?= CHtml::activeTelField($form, 'email', array('class' => 'input-group-field', 'placeholder' => 'Введите Ваш email')); ?>
                                    <span class="input-group-label">
                                        <svg class="icon-mail">
                                            <use xlink:href="#icon-mail"></use>
                                        </svg>
                                    </span>
                                </div>
                                <div class="form-error"></div>
                            </div>

                            <div class="small-8 columns">
                                <label for="field-4" class="input-medium">
                                    Комментарий
                                    <?= CHtml::activeTextArea($form, 'message', array('class' => 'md-0', 'placeholder' => 'Введите Ваш комментарий')); ?>
                                    <span class="form-error"></span>
                                </label>
                            </div>

                            <div class="small-3 small-offset-1 columns">
                                <button class="button large red float-right" type="submit">Отправить заявку</button>
                            </div>
                        </div>
                    </div>
                    <div class="ajax-form__message">
                        <div class="extend_h4">
                            Сообщение отправлено! <br>
                            Мы свяжемся в Вами в ближайшее время.
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
