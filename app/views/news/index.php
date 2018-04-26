<?php
/* @var NewsController $this */
/* @var $dataProvider CActiveDataProvider|InfiniteActiveDataProvider */
/* @var $pager string */
/* @var $model News */
?>

<!doctype html>
<html lang="ru">
<head>
    <?php $this->renderPartial('/layouts/_global'); ?>

    <?php if ($dataProvider->pagination->currentPage != 1) { ?>
        <meta name="robots" content="noindex,follow" />
    <?php } ?>
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
                        array('title' => $model->page->title)
                    )
                )); ?>

                <h1><?= $model->page->title; ?></h1>

                <div class="row">

                    <div class="content-partial-small small-9 columns">
                        <div id="ajax-load-container" class="news-list">
                            <?php $this->renderPartial('_loop', array(
                                'loop' => $dataProvider->getData(),
                                'dataProvider' => $dataProvider
                            ));
                            ?>
                        </div>

                        <?= $pager; ?>

                    </div>

                    <div class="aside-small small-3 columns">
                        <?php $this->renderPartial('/partials/forms/askQuestionButton') ?>

                        <div class="news-filter">
                            <div class="title">История</div>
                            <?php $this->widget('app.widgets.filter.FilterWidget', array('model' => $model)); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <?php $this->renderPartial('/layouts/_footer'); ?>
</div>

<script src="/dist/js/core.js?index=<?= param('resetSuffix'); ?>"></script>
<script src="/dist/js/app.js?index=<?= param('resetSuffix'); ?>"></script>
<script src="/dist/js/pages/news.js?index=<?= param('resetSuffix'); ?>"></script>

</body>

</html>