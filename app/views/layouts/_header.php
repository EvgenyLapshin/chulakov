<?php
/** @var FrontendController $this */

$main = Page::model()->findByPk(1);
$this->renderPartial('/partials/yandexMetrika');
$this->renderPartial('/partials/googleAnalytics');
?>

<header class="header">
    <div class="toolbar">
        <div class="row">
            <div class="small-12 columns">
                <div class="logo"><a href="/"></a></div>
                <div class="logo-description"><?= $main->textHeader; ?></div>

                <div class="feedback">
                    <div class="title">
                        <svg class="icon-mail">
                            <use xlink:href="#icon-mail"></use>
                        </svg>
                        <span class="anchor dark-link">Написать письмо</span>
                    </div>

                    <ul>
                        <li data-toggle="feedback_header">
                            <div class="icon-wrap">
                                <svg class="icon-phone">
                                    <use xlink:href="#icon-phone"></use>
                                </svg>
                            </div>
                            Обратный звонок
                        </li>
                        <li data-toggle="for-director_header">
                            <div class="icon-wrap">
                                <svg class="icon-people">
                                    <use xlink:href="#icon-people"></use>
                                </svg>
                            </div>
                            Руководству
                        </li>
                        <li data-toggle="new-question_header">
                            <div class="icon-wrap">
                                <svg class="icon-help-circled">
                                    <use xlink:href="#icon-help-circled"></use>
                                </svg>
                            </div>
                            Задать вопрос
                        </li>
                    </ul>
                </div>

                <?php if ($main->price) { ?>
                    <div class="sign-in">
                        <a href="<?= $main->getFileUrl('price') ?>" class="anchor dark-link" target="_blank">Скачать Прайс-лист</a>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="small-12 columns">

            <?php $this->widget('app.widgets.menu.MenuWidget'); ?>

            <div class="row">
                <div class="small-12 columns">
                    <form action="/search" class="search-filed">
                        <div class="input-group">
                            <input class="input-group-field" type="text"
                                   placeholder="Поиск товаров по названию или артикулу" name="q">

                            <div class="input-group-button">
                                <button>
                                    <svg class="icon-search center-icon">
                                        <use xlink:href="#icon-search"></use>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</header>