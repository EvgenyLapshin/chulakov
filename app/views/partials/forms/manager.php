<?php
/**
 * @var FrontendController $this
 */

$contacts = $this->getPage(16);
?>

<div class="manager-widget">
    <div class="title">
        <img src="/dist/img/manager-icon.png" alt="">
        <div class="text">
            <div class="phone"><?= $contacts->phoneManager; ?></div>
            <button class="anchor" data-toggle="call-manager">Связаться с менеджером</button>
        </div>
    </div>

    <div class="message">
        Позвоните или напишите менеджеру,
        если вам что-то не понятно.
    </div>
</div>

<div class="reveal" id="call-manager" data-animation-in="slide-in-down" data-animation-out="slide-out-up" data-reveal>
    <div class="heading">
        Связаться с менеджером
        <button class="close-button" data-close aria-label="Close modal" type="button">
            <svg class="icon-close">
                <use xlink:href="#icon-close"></use>
            </svg>
        </button>
    </div>

    <form class="ajax-form" action="/site/manager" novalidate method="post">
        <input type="hidden" name="firstName">
        <input type="hidden" name="subject" value="Вопрос">

        <div class="ajax-form__elements">
            <div class="row">
                <div class="small-12 columns">
                    <label class="input-medium">Имя</label>
                    <div class="input-group margin-small">
                        <input class="input-group-field" type="text"
                               placeholder="Введите Ваше имя" name="name">
                        <div class="input-group-label">
                            <svg class="icon-people">
                                <use xlink:href="#icon-people"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="form-error"></div>
                </div>

                <div class="small-12 columns">
                    <label class="input-medium">Телефон</label>
                    <div class="input-group margin-small">
                        <input class="input-group-field phone-mask" type="text"
                               placeholder="+7 (906) 627-01-34" name="phone">
                        <div class="input-group-label">
                            <svg class="icon-phone">
                                <use xlink:href="#icon-phone"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="form-error"></div>
                </div>

                <div class="small-12 columns">
                    <label class="input-medium">Почта</label>
                    <div class="input-group margin-small">
                        <input class="input-group-field" type="text"
                               placeholder="Введите Ваш email" name="email">
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