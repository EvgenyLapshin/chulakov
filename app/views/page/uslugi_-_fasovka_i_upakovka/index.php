<?php
/* @var PageController $this */
/* @var Page $model */

$parent = $model->parent()->find();
$galleryList = $model->children()->findAll();
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

                <div class="packaging-header">
                    <div class="left">
                        <div class="red">
                            <div class="text">Мы предоставляем услуги <br>
                                по фасовке и упаковке
                            </div>
                            <div class="title">Сухих и жидких реактивов</div>
                        </div>
                        <div class="white">
                            <div class="title"><?= $model->titleWhite; ?></div>
                            <div class="text"><?= $model->descriptionWhite; ?></div>
                            <?php if ($model->fileWhite) { ?>
                                <a href="<?= $model->getFileUrl('fileWhite'); ?>"
                                   class="decor text-medium"><?= $model->fileTitleWhite; ?></a>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="right">
                        <div class="packaging">
                            <div class="title">Свои производственные участки <br>фасовки и комплектации</div>
                            <div class="link">
                                <a href="#example" data-tab-href="#panel1-label" class="anchor-to-block anchor-to-tab decor text-medium">Фотографии оборудования <br></a>
                                <a href="#example" data-tab-href="#panel2-label" class="anchor-to-block anchor-to-tab decor text-medium">и образцов фасовок</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="packaging-example">
            <div class="row">
                <div class="small-12 columns">
                    <div class="content">
                        <h2 class="extend_h1">Мы собираем наборы химических реактивов <br>для школ и лабораторий</h2>
                        <div class="link">
                            <a href="#example" data-tab-href="#panel0-label" class="anchor-to-block anchor-to-tab decor text-medium">Примеры упаковки <br> наборов</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="img"></div>

            <div class="row">
                <div class="small-12 columns">
                    <?php $this->renderPartial($model->rTemplate->name . '/galleryTabs', array(
                        'list' => $galleryList,
                        'model' => $model
                    )); ?>
                </div>
            </div>

            <?php $this->renderPartial('/partials/service-form', array('model' => $model)); ?>

            <div class="row">
                <div class="small-12 columns">
                    <div class="content packaging-example__footer">
                        <h1><?= $model->titleBottom; ?></h1>
                        <?= $model->contentBottom; ?>
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
<script src="/dist/js/jquery.custom-scrollbar.min.js"></script>
<script src="/dist/js/pages/packaging.js?index=<?= param('resetSuffix'); ?>"></script>

</body>

</html>