<?php
/* @var $this SearchController */
/* @var $results */
/* @var $query Zend_Search_Lucene_Search_Query_Boolean */
/* @var $term string */
/* @var $events Article[]|News[] */
/* @var $products CatalogProduct[] */
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
                        array('title' => 'Результаты поиска')
                    )
                )); ?>

                <h1>Результаты поиска</h1>
            </div>
        </div>

        <div class="search-widget">
            <div class="row">
                <div class="small-12 columns">
                    <form action="/search" class="search-filed">
                        <div class="input-group">
                            <input class="input-group-field" type="text" placeholder="Поиск товаров по названию или артикулу" id="search-text" name="q" value="<?= CHtml::encode($term); ?>">

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

        <div class="row">
            <div class="small-12 columns">
                <div class="search-group-result">
                    <h2>Каталог</h2>
                    <?php
                    foreach ($products as $product) {
                        $this->renderPartial('_product', array('model' => $product));
                    }
                    if (!$products) {
                        ?>
                        <p>Ничего не нашлось</p>
                    <?php } ?>
                </div>

                <div class="search-group-result search-mark">
                    <h2>Статьи и новости</h2>
                    <?php
                    foreach ($events as $event) {
                        $this->renderPartial('_event', array('model' => $event));
                    }

                    if (!$events) {
                        ?>
                        <p>Ничего не нашлось</p>
                    <?php } ?>
                </div>

                <div class="search-group-result search-mark">
                    <h2>По сайту</h2>
                    <?php
                    if (!empty($results)) {
                        foreach ($results as $item) {
                            $this->renderPartial('_page', array(
                                'item' => $item,
                                'query' => $query
                            ));
                        }
                    } else {
                        ?>
                        <p>Ничего не нашлось</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>

    <?php $this->renderPartial('/partials/forms/preOrder', array('model' => new CatalogProduct())); ?>
    <?php $this->renderPartial('/layouts/_footer'); ?>
</div>

<script src="/dist/js/core.js?index=<?= param('resetSuffix'); ?>"></script>
<script src="/dist/js/app.js?index=<?= param('resetSuffix'); ?>"></script>
<script src="/dist/js/jquery.mark.js"></script>
<script src="/dist/js/pages/catalog.js?index=<?= param('resetSuffix'); ?>"></script>
<script src="/dist/js/pages/search.js?index=<?= param('resetSuffix'); ?>"></script>

</body>

</html>