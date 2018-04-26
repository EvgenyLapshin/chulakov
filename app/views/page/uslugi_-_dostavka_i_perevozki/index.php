<?php
/* @var PageController $this */
/* @var Page $model */

$parent = $model->parent()->find();
$gallery = $model->getBlocks(9);
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
                        array('title' => $parent->page_title),
                        array('title' => $model->page_title)
                    )
                )); ?>

                <h2 class="extend_h1"><?= $model->title; ?></h2>
            </div>
        </div>

        <div class="delivery-header-container">
            <div class="delivery-header-bg"></div>
            <div class="delivery-header-wrap">
                <div class="heading">
                    Все города <br>
                    России
                    <span>И ближнего зарубежья</span>
                </div>
                <div class="delivery-header">
                    <div class="white">
                        <ul>
                            <li>
                                <div class="title"><?= $model->titleLeftWite; ?></div>
                                <div class="text"><?= $model->descriptionLeftWhite; ?></div>
                            </li>
                            <li>
                                <div class="title"><?= $model->titleMiddleWhite; ?></div>
                                <div class="text"><?= $model->descriptionMiddleWhite; ?></div>
                            </li>
                            <li>
                                <div class="title">
                                    <?= $model->titleRightWhite; ?>
                                    <img src="/dist/img/services/delivery/triangle.png" class="triangle" alt="">
                                    <img src="/dist/img/services/delivery/arrow.png" class="arrow" alt="">
                                </div>
                                <div class="text"><?= $model->descriptionRightWhite; ?></div>
                            </li>
                        </ul>
                    </div>
                    <div class="red">
                        <div class="title"><?= $model->titleRed; ?></div>
                        <div class="text"><?= $model->descriptionRed; ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="columns small-12">
                <div class="delivery-slider" id="delivery-slider">
                    <?php foreach ($gallery as $image) { ?>
                        <div><img src="<?= $image->getImageUrl('image', 'basic'); ?>" alt="<?= $image->image; ?>"></div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="service-form delivery-service-form">
            <div class="service-form-inner">
                <div class="row service-form-wrap">
                    <div class="small-12 columns">
                        <h2>Узнать об услуге доставки</h2>

                        <form class="ajax-form" action="/site/service" id="delivery-order-form" novalidate>
                            <div class="ajax-form__elements">
                                <input type="hidden" name="pageUrl" value="<?= $model->absoluteUrl; ?>">
                                <input type="hidden" name="pageTitle" value="<?= $model->page_title; ?>">
                                <input type="hidden" name="firstName">
                                <input type="hidden" name="subject" value="<?= $model->page_title; ?>">
                                <div class="row">
                                    <div class="small-4 columns">
                                        <label for="field-1" class="input-medium">Имя</label>
                                        <div class="input-group">
                                            <input class="input-group-field" id="field-1" type="text"
                                                   placeholder="Введите Ваше имя" name="name">
                                            <span class="input-group-label">
                                            <svg class="icon-people">
                                                <use xlink:href="#icon-people"></use>
                                            </svg>
                                        </span>
                                        </div>
                                        <div class="form-error"></div>
                                    </div>

                                    <div class="small-4 columns">
                                        <label for="field-2" class="input-medium">Телефон</label>
                                        <div class="input-group">
                                            <input class="input-group-field phone-mask" id="field-2" type="text"
                                                   placeholder="Введите Ваш телефон" name="phone">
                                            <span class="input-group-label">
                                        <svg class="icon-phone">
                                            <use xlink:href="#icon-phone"></use>
                                        </svg>
                                    </span>
                                        </div>
                                        <div class="form-error"></div>
                                    </div>

                                    <div class="small-4 columns">
                                        <label for="field-3" class="input-medium">Почта</label>
                                        <div class="input-group">
                                            <input class="input-group-field" id="field-3" type="text"
                                                   placeholder="Введите Ваш email" name="email">
                                            <span class="input-group-label">
                                        <svg class="icon-mail">
                                            <use xlink:href="#icon-mail"></use>
                                        </svg>
                                    </span>
                                        </div>
                                        <div class="form-error"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="ajax-form__message">
                                <h4>
                                    Сообщение отправлено! <br>
                                    Мы свяжемся в Вами в ближайшее время.
                                </h4>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row service-form-wrap">
                <div class="column">
                    <button form="delivery-order-form"
                            class="button large alert float-right delivery-service-button button-out-form"
                            type="submit">
                        Отправить заявку
                    </button>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="small-12 columns">
                <h1 class="extend_h2"><?= $model->titleBottom; ?></h1>

                <div class="dot-text" data-height="75">
                    <div class="text content"><?= $model->contentBottom; ?></div>

                    <span class="show" data-alt-text="Свернуть"><span class="anchor">Читать полный текст</span>
                        <svg class="icon-arrow-list">
                            <use xlink:href="#icon-arrow-list"></use>
                        </svg>
                    </span>
                </div>
            </div>
        </div>

    </main>

    <?php $this->renderPartial('/layouts/_footer'); ?>
</div>

<script src="/dist/js/core.js?index=<?= param('resetSuffix'); ?>"></script>
<script src="/dist/js/app.js?index=<?= param('resetSuffix'); ?>"></script>
<script src="/dist/js/slick.js"></script>
<script>
    $(document).ready(function () {
        kupavnaApp.dotText();

        $('#delivery-slider').slick({
            centerMode: true,
            slideToShow: 1,
            dots: true,
            variableWidth: true,
            prevArrow: '<div class="slick-prev slick-arrow"><svg class="icon-arrow"><use xlink:href="#icon-arrow"></use></svg></div>',
            nextArrow: '<div class="slick-next slick-arrow"><svg class="icon-arrow transform-180"><use xlink:href="#icon-arrow"></use></svg></div>',
        })
    });
</script>

</body>

</html>