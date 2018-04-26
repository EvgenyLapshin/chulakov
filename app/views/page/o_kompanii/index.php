<?php
/* @var PageController $this */
/* @var Page $model */

$docs = $model->getBlocks(4);
$docs = array_chunk($docs, 2);
$main = $this->getPage(1);
?>

<!doctype html>
<html lang="ru">
<head>
    <?php $this->renderPartial('/layouts/_global'); ?>
</head>

<body class="app">

<?php include('dist/img/icons/icons.svg'); ?>

<div class="wrapper">
    <?php $this->renderPartial('/layouts/_header'); ?>

    <main class="main">
        <div class="row">
            <div class="small-12 columns">
                <?php $this->widget('app.widgets.breadcrumbs.BreadcrumbsWidget', array(
                    'list' => array(
                        array('title' => $model->page_title)
                    )
                )); ?>

                <div class="about-heading">
                    <div class="about-text-widget">
                        <div class="red">
                            <h1 class="title"><?= $model->title; ?></h1>
                            <div class="text"><?= $model->description; ?></div>
                        </div>

                        <div class="white">
                            <div class="item">
                                <div class="number">
                                    <span><?= $model->companyExperience; ?></span>лет
                                </div>
                                <div class="label">опыт <br>компании</div>
                            </div>
                            <div class="item">
                                <div class="number">
                                    <span><?= $model->leadershipExperience; ?></span>лет
                                </div>
                                <div class="label">опыт <br>руководства</div>
                            </div>
                            <div class="item">
                                <span data-tooltip aria-haspopup="true" class="i has-tip top" data-v-offset="25"
                                      title="<?= $model->tooltip; ?>">i</span>
                                <div class="number">
                                    <span><?= $model->leadershipExperience; ?></span>человек
                                </div>
                                <div class="label">штат <br>сотрудников</div>
                            </div>
                        </div>
                    </div>

                    <div class="about-requisites">
                        <div class="wrap">
                            <div class="title">Реквизиты компании</div>

                            <button class="button red large expanded" data-toggle="new-question">Запросить</button>

                            <div class="reveal" id="new-question" data-animation-in="slide-in-down"
                                 data-animation-out="slide-out-up" data-reveal>
                                <div class="heading">
                                    Запросить реквизиты
                                    <button class="close-button" data-close aria-label="Close modal" type="button">
                                        <svg class="icon-close">
                                            <use xlink:href="#icon-close"></use>
                                        </svg>
                                    </button>
                                </div>

                                <form class="ajax-form" action="/site/requestDetails" novalidate method="post">
                                    <input type="hidden" name="firstName">
                                    <input type="hidden" name="subject" value="Запрос реквизитов">
                                    <input type="hidden" name="pageUrl" value="<?= $model->absoluteUrl; ?>">
                                    <input type="hidden" name="pageTitle" value="<?= $model->page_title; ?>">

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
                                                <div class="button-label-text float-left mt-15 large"><?= $main->phoneHeader; ?></div>
                                                <button class="button large alert float-right no-bot-margin mt-15"
                                                        type="submit">Отправить
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ajax-form__message">
                                        <h4>Ваше заявка принята</h4>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <img class="about-head-img" src="/dist/img/about-header.png">

                <div class="content"><?= $model->content; ?></div>
            </div>
        </div>

        <div class="about-quote">
            <div class="wrap">
                <div class="text">
                    <?= $model->quote; ?>
                    <svg class="icon-quote">
                        <use xlink:href="#icon-quote"></use>
                    </svg>
                </div>
                <div class="role">руководитель</div>
                <div class="name">
                    Торопченкова <br>
                    Анна Ильинична
                </div>
            </div>
        </div>

        <div class="about-awards">
            <div class="wrap">
                <div class="item">
                    <img src="/example-content/about/about-award-1.png" alt="">
                    <div class="text">
                        <div class="name">Орден №688</div>
                        «За заслуги перед химической
                        индустрией России» II степени
                    </div>
                </div>
                <div class="item">
                    <img src="/example-content/about/about-award-2.png" alt="">
                    <div class="text">
                        <div class="name">Член совета директоров</div>
                        Некоммерческой организации
                        «Росхимреактив»
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="small-12 columns">
                <h2>Сертификаты и лицензии компании</h2>

                <div class="about-foot">

                    <div class="slider-content">
                        <div class="slick-slider slick-popup">
                            <?php
                            foreach ($docs as $slide) {
                                $this->renderPartial($model->rTemplate->name . '/_doc', array(
                                    'slide' => $slide
                                ));
                            }
                            ?>
                        </div>
                        <div class="reveal expanded" id="about-popup" data-animation-in="slide-in-down"
                             data-animation-out="slide-out-up" data-reveal style="width: 495px;">
                            <button class="close-button" data-close aria-label="Close modal" type="button">
                                <svg class="icon-close">
                                    <use xlink:href="#icon-close"></use>
                                </svg>
                            </button>

                            <img src="" alt="" style="width: 495px; height: 680px;">
                        </div>
                    </div>

                    <div class="about-card">
                        <?php $this->widget('app.widgets.partner.PartnerWidget', array('model' => $model)); ?>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <?php $this->renderPartial('/layouts/_footer'); ?>
</div>

<script src="/dist/js/core.js?index=<?= param('resetSuffix'); ?>"></script>
<script src="/dist/js/app.js?index=<?= param('resetSuffix'); ?>"></script>
<script src="/dist/js/slick.js"></script>
<script src="/dist/js/pages/about.js?index=<?= param('resetSuffix'); ?>"></script>

</body>

</html>