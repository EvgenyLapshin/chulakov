<?php
/* @var CatalogController $this */
/* @var $form CatalogFilterForm */
/* @var $pager string */
?>

<!doctype html>
<html lang="ru">
<head>
    <?php $this->renderPartial('/layouts/_global'); ?>

    <?php if ($form->dataProvider->pagination->currentPage != 1) { ?>
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
                    'list' => $form->category->getBreadCrumbs()
                )); ?>

                <h1><?= $form->category->name; ?></h1>

                <div class="row">
                    <div class="small-12 columns">
                        <div class="catalog-options catalog-header-options clearfix">
                            <?php $this->widget('app.widgets.sort.SortWidget', array('sorter' => $form->dataProvider->getSort())); ?>

                            <div class="float-right view-settings">
                                <?php $this->widget('app.widgets.resize.ResizeWidget', array(
                                    'pages' => $form->dataProvider->pagination
                                )); ?>

                                <span class="view-options float-right">
                                    <a class="view-option float-left<?= $this->isViewCardType() ? ' active' : ''; ?>"
                                       href="<?= $this->getViewCardUrl($form->dataProvider); ?>">
                                        <svg class="icon-view-card">
                                            <use xlink:href="#icon-view-card"></use>
                                        </svg>
                                    </a>
                                    <a class="view-option float-left<?= $this->isViewCardType() ? '' : ' active'; ?>"
                                       href="<?= $this->getViewListUrl($form->dataProvider); ?>">
                                        <svg class="icon-list-vid">
                                            <use xlink:href="#icon-list-vid"></use>
                                        </svg>
                                    </a>
                                </span>

                            </div>
                        </div>
                    </div>

                    <div class="small-12 columns" id="#ajax-load-container">

                        <?php
                        $this->renderPartial($this->viewType . '/index', array(
                            'dataProvider' => $form->dataProvider
                        ));
                        ?>

                        <div class="clearfix ajax-pager-wrap">

                            <?= $pager; ?>

                        </div>

                        <div class="catalog-options catalog-footer-options clearfix">
                            <?php $this->widget('app.widgets.sort.SortWidget', array('sorter' => $form->dataProvider->getSort())); ?>

                            <div class="float-right view-settings">
                                <?php $this->widget('app.widgets.resize.ResizeWidget', array(
                                    'pages' => $form->dataProvider->pagination
                                )); ?>

                                <span class="view-options float-right">
                                    <a class="view-option float-left<?= $this->isViewCardType() ? ' active' : ''; ?>" href="<?= $this->getViewCardUrl($form->dataProvider); ?>">
                                        <svg class="icon-view-card">
                                            <use xlink:href="#icon-view-card"></use>
                                        </svg>
                                    </a>
                                    <a class="view-option float-left<?= $this->isViewCardType() ? '' : ' active'; ?>" href="<?= $this->getViewListUrl($form->dataProvider); ?>">
                                        <svg class="icon-list-vid">
                                            <use xlink:href="#icon-list-vid"></use>
                                        </svg>
                                    </a>
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php $this->renderPartial('/partials/forms/preOrder', array('model' => new CatalogProduct())); ?>
    <?php $this->renderPartial('/layouts/_footer'); ?>

</div>

<script src="/dist/js/core.js?index=<?= param('resetSuffix'); ?>"></script>
<script src="/dist/js/app.js?index=<?= param('resetSuffix'); ?>"></script>
<script src="/dist/js/pages/catalog.js?index=<?= param('resetSuffix'); ?>"></script>

</body>

</html>