<div class="reveal" id="closed-section" data-animation-in="slide-in-down"
     data-animation-out="slide-out-up" data-reveal>
    <div class="heading">
        Раздел закрыт
        <button class="close-button" data-close aria-label="Close modal" type="button">
            <svg class="icon-close">
                <use xlink:href="#icon-close"></use>
            </svg>
        </button>
    </div>
    <div class="row">
        <div class="columns">
            <div class="content">
                <p>
                    Данный раздел сайта ещё не запущен, но мы активно работаем над этим.
                    <br>
                    Подпишитесь на обновления, чтобы узнать об открытии одними из первых!
                </p>
            </div>
        </div>
    </div>

    <form class="ajax-form" action="/site/subscribe" novalidate method="post">
        <input type="hidden" name="firstName">
        <input type="hidden" name="subject" value="Подписка на рассылку">

        <div class="ajax-form__elements">
            <div class="row">
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
                    <div class="button-label-text float-left mt-15 large">+7 923 795-45-78</div>
                    <button class="button large alert float-right no-bot-margin mt-15"
                            type="submit">Отправить
                    </button>
                </div>
            </div>
        </div>
        <div class="ajax-form__message">
            <div class="extend_h4">Ваше заявка принята</div>
        </div>
    </form>

</div>