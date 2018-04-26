<?php
/** @var FrontendController $this */

$main = Page::model()->findByPk(1);
$about = Page::model()->resetScope()->findByPk(3);
?>

<footer class="footer">
    <div class="row">
        <div class="small-8 columns">
            <div class="row">
                <div class="small-12 columns">
                    <?php $this->widget('app.widgets.menuFooter.MenuFooterWidget'); ?>
                </div>
            </div>
        </div>

        <div class="small-4 columns">
            <form action="/search">
                <div class="input-group">
                    <input class="input-group-field" type="text" placeholder="Поиск по сайту">

                    <div class="input-group-button">
                        <button>
                            <svg class="icon-search center-icon">
                                <use xlink:href="#icon-search"></use>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="small-6 columns">
                    <div class="links">
                        <div>
                            <a data-toggle="subscribe-form">
                                <span class="dark-link">
                                    <svg class="icon-mail">
                                        <use xlink:href="#icon-mail"></use>
                                    </svg>
                                    <span class="anchor dark-link">Подписка на рассылку</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="small-8 columns">
            <div class="row">
                <div class="small-10 columns">
                    <div class="footer-description"><?= $main->textFooter; ?></div>
                </div>
            </div>
        </div>

        <div class="small-4 columns">
            <div class="honors">
                <img src="/dist/img/footer-honors.png" alt="">
                Наши награды на странице <br>
                <a href="<?= $about->url; ?>" class="dark-link">о компании</a>
            </div>
        </div>
    </div>

    <div class="toolbar">
        <div class="row">
            <div class="small-12 columns">
                <div
                    class="left copyright"><?php $this->widget('app.widgets.copyright.CopyRightWidget', array('year' => 2017, 'company' => 'Галерея химии')); ?></div>
                <div class="right developer">Разработано в «<a href="http://v-ba.ru" target="_blank" class="dark-link">Высоко</a>»
                    <svg class="icon-vba-logo">
                        <use xlink:href="#icon-vba-logo"></use>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="to-top button radial" id="to-top">
    <svg class="icon-arrow-list transform-180">
        <use xlink:href="#icon-arrow-list"></use>
    </svg>
</div>

<?php $this->renderPartial('/partials/forms/requestDetails'); ?>

<?php $this->renderPartial('/partials/forms/askQuestion'); ?>

<?php $this->renderPartial('/partials/forms/forDirector'); ?>

<?php $this->renderPartial('/partials/forms/subscribe'); ?>