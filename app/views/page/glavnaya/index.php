<?php
/* @var PageController $this */
/* @var Page $model */

$slider = $model->getBlocks(12);

$packaging = Page::model()->resetScope()->findByPk(7);
$delivery = Page::model()->resetScope()->findByPk(12);

$solvents = CatalogCategory::model()->findByPk(254);
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
        <div class="home-slider-wrap" id="home-slider-wrap">
            <div class="home-slider-content" id="home-slider-content">
                <?php
                foreach ($slider as $slide) {
                    $this->renderPartial($model->rTemplate->name . '/_slide', array('model' => $slide));
                }
                ?>
            </div>

            <div class="row controls"></div>
        </div>

        <div class="row">
            <div class="small-12 columns home-catalog-items">
                <div class="small-12 columns">
                    <div class="row">

                        <div class="small-6 columns row">
                            <a class="home-catalog-item" href="<?= $solvents->url ?>">
                                <div id="химреактивы_hype_container"
                                     style="margin:auto;position:relative;width:100%;height:276px;overflow:hidden;"
                                     aria-live="polite">
                                    <script type="text/javascript" charset="utf-8"
                                            src="/dist/home/chemical_reagents/chemical_reagents_hype_generated_script.js"></script>
                                </div>

                                <span><?= $solvents->name ?></span>
                            </a>
                        </div>

                        <div class="small-3 columns row">
                            <a class="home-catalog-item" href="/catalog/himicheskaya-laborotornaya-posuda-i-prinadleghnosti">
                                <div id="посуда_hype_container"
                                     style="margin:auto;position:relative;width:550px;height:276px;overflow:hidden;"
                                     aria-live="polite">
                                    <script type="text/javascript" charset="utf-8"
                                            src="/dist/home/dishes/dishes_hype_generated_script.js"></script>
                                </div>

                                <span>Лабораторная посуда <br> и принадлежности</span>
                            </a>
                        </div>

                        <div class="small-3 columns row">
                            <a class="home-catalog-item" href="/catalog/moyuschie-i-chistyaschie-sredstva">
                                <div id="моющие_hype_container" style="margin:auto;position:relative;width:550px;height:276px;overflow:hidden;" aria-live="polite">
                                    <script type="text/javascript" charset="utf-8" src="/dist/home/detergent/detergent_hype_generated_script.js"></script>
                                </div>
                                <span>Моющие и чистящие <br> средства</span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="small-12 columns">
                <div class="home-service">
                    <img src="/dist/img/home-service.png" alt="">

                    <div class="wrap">
                        <a class="item" href="<?= $delivery->url; ?>">
                            <div class="img-wrap">
                                <img src="/example-content/home/Векторный-смарт-объект1.png" alt="">
                            </div>

                            <div class="text">
                                <span>01</span>
                                Перевозка <br>
                                опасных <br>
                                грузов
                            </div>
                        </a>

                        <a class="item" href="<?= $delivery->url; ?>">
                            <div class="img-wrap">
                                <img src="/example-content/home/Векторный-смарт-объект91.png" alt="">
                            </div>

                            <div class="text">
                                <span>02</span>
                                Своя <br>
                                доставка
                            </div>
                        </a>

                        <a class="item" href="<?= $packaging->url; ?>">
                            <div class="img-wrap">
                                <img src="/example-content/home/Векторный-смарт-объект81.png" alt="">
                            </div>

                            <div class="text">
                                <span>03</span>
                                Фасовка <br>
                                и упаковка
                            </div>
                        </a>

                        <div class="item">
                            <div class="img-wrap">
                                <img src="/example-content/home/Векторный-смарт-объект41.png" alt="">
                            </div>

                            <div class="text">
                                <span>04</span>
                                Собственный <br>
                                склад
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="small-12 columns">
                <div class="home-about">
                    <div class="items">
                        <div class="item">
                            <div><?= $model->about; ?></div>
                        </div>
                        <div class="item">
                            <div><?= $model->production; ?></div>
                        </div>
                        <img src="/dist/img/home-about.png" alt="">
                    </div>
                    <div class="home-card">
                        <?php $this->widget('app.widgets.partner.PartnerWidget'); ?>
                    </div>
                </div>
            </div>

            <div class="small-12 columns">
                <?php $this->widget('app.widgets.news.NewsWidget'); ?>
            </div>
        </div>
    </main>

    <?php $this->renderPartial('/layouts/_footer'); ?>
</div>

<script src="/dist/js/core.js?index=<?= param('resetSuffix'); ?>"></script>
<script src="/dist/js/app.js?index=<?= param('resetSuffix'); ?>"></script>
<script src="/dist/js/slick.js"></script>
<script src="/dist/js/progressbar.js"></script>
<script src="/dist/js/liteaccordion.jquery.min.js"></script>
<script src="/dist/js/pages/home.js?index=<?= param('resetSuffix'); ?>"></script>

</body>

</html>