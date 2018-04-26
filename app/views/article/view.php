<?php
/* @var ArticleController $this */
/* @var Article $model */
/* @var string $backUrl */
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
                        array('title' => $model->rCategory->page->page_title, 'url' => $model->rCategory->page->url),
                        array('title' => $model->rCategory->name, 'url' => $model->rCategory->url),
                        array('title' => $model->title),
                    )
                )); ?>

                <h1><?= $model->title; ?></h1>

                <div class="row">
                    <div class="small-8 columns">
                        <div class="content article-content">
                            <img src="<?= $model->getImageUrl('image', 'basic'); ?>" alt="<?= $model->image; ?>">
                            <?= $model->content; ?>
                        </div>
                    </div>
                </div>

                <div class="article-back">
                    <a class="button-with-icon large" href="<?= $backUrl; ?>">
                        <span class="wrap-icon">
                             <svg class="icon-arrow-paginator center-icon hack-position">
                                 <use xlink:href="#icon-arrow-paginator"></use>
                             </svg>
                        </span>
                        <span class="text">Вернуться к новостям</span>
                    </a>
                </div>

                <div class="article-info">
                    <span class="date"><?= Yii::app()->dateFormatter->format("d.MM.yyyy", $model->pub_date) ?></span>
                    <span class="visits-count">
                        <span class="wrap-icon">
                            <svg class="icon-news-eye center-icon"><use xlink:href="#icon-news-eye"></use></svg>
                        </span>
                        <?= $model->view_count; ?>
                    </span>
                </div>
            </div>
        </div>
    </main>

    <?php $this->renderPartial('/layouts/_footer'); ?>
</div>

<script src="/dist/js/core.js"></script>
<script src="/dist/js/app.js"></script>

</body>

</html>