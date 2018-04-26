<?php
/** @var FrontendController $this */

$title = (get_class($model) == CatalogProduct::class) ? $model->name : $model->title;
$form = new PreOrderForm();
$form->product = $title;
$form->pageTitle = $title;
$form->pageUrl = $model->absoluteUrl;
$contacts = $this->getPage(16);
?>

<div class="reveal" id="pre-order" data-animation-in="slide-in-down" data-animation-out="slide-out-up" data-reveal>
    <div class="heading">
        Оформление заказа
        <button class="close-button" data-close aria-label="Close modal" type="button">
            <svg class="icon-close">
                <use xlink:href="#icon-close"></use>
            </svg>
        </button>
    </div>

    <form class="ajax-form" action="/site/preOrder" novalidate method="post">
        <?= CHtml::activeHiddenField($form, 'pageUrl'); ?>
        <?= CHtml::activeHiddenField($form, 'pageTitle'); ?>
        <?= CHtml::activeHiddenField($form, 'firstName'); ?>
        <?= CHtml::activeHiddenField($form, 'product'); ?>

        <div class="ajax-form__elements">
            <div class="row">
                <div class="small-12 columns">
                    <?= CHtml::activeLabel($form, 'name', array('class' => 'input-medium')); ?>
                    <div class="input-group margin-small">
                        <?= CHtml::activeTextField($form, 'name', array(
                            'placeholder' => 'Введите Ваше имя',
                            'class' => 'input-group-field'
                        )); ?>
                        <div class="input-group-label">
                            <svg class="icon-people">
                                <use xlink:href="#icon-people"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="form-error"></div>
                </div>

                <div class="small-12 columns">
                    <?= CHtml::activeLabel($form, 'phone', array('class' => 'input-medium')); ?>
                    <div class="input-group margin-small">
                        <?= CHtml::activeTextField($form, 'phone', array(
                            'placeholder' => '+7 (906) 627-01-34',
                            'class' => 'input-group-field phone-mask'
                        )); ?>
                        <div class="input-group-label">
                            <svg class="icon-phone">
                                <use xlink:href="#icon-phone"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="form-error"></div>
                </div>

                <div class="small-12 columns">
                    <?= CHtml::activeLabel($form, 'email', array('class' => 'input-medium')); ?>
                    <div class="input-group margin-small">
                        <?= CHtml::activeTextField($form, 'email', array(
                            'placeholder' => 'Введите Ваш email',
                            'class' => 'input-group-field'
                        )); ?>
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
                    <button class="button large alert float-right no-bot-margin mt-15" type="submit">Оформить</button>
                </div>
            </div>
        </div>
        <div class="ajax-form__message">
            <div class="extend_h4">Ваше заявка принята</div>
        </div>
    </form>

</div>