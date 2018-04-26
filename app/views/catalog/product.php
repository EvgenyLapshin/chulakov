<?php
/* @var $this CatalogController */
/* @var $model CatalogProduct */
/* @var $files Block[] */
/* @var $info Block[] */
/* @var $backUrl string */
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
                    'list' => $model->getBreadCrumbs()
                )); ?>

                <div class="row">
                    <div class="content-partial-medium small-9 columns" id="content">
                        <div class="card card-product" id="card-product" data-name="<?= CHtml::encode($model->name); ?>" data-alt-name="<?= CHtml::encode($model->name_synonym); ?>">
                            <div class="card-content card-content-large">
                                <h1 class="text-normal"><?= $model->name; ?>
                                    <span class="product-alt-name"><?= $model->name_synonym; ?></span>
                                </h1>

                                <ul class="product-params">
                                    <?php if ($model->rCatalogCountryManufacturer) { ?>
                                        <li>
                                            <span>Производитель</span><span><?= $model->rCatalogCountryManufacturer->name; ?></span>
                                        </li>
                                    <?php } ?>

                                    <?php
                                    foreach ($info as $itemInfo) {
                                        $this->renderPartial('_info', array('model' => $itemInfo));
                                    }
                                    ?>
                                </ul>

                                <div class="content"><?= $model->content; ?></div>

                                <?php if ($files) { ?>
                                    <div class="doc-attachment">
                                        <?php
                                        foreach ($files as $file) {
                                            $this->renderPartial('_file', array('model' => $file));
                                        }
                                        ?>
                                    </div>
                                <?php } ?>
                                <div class="content">
                                    <?php if ($model->kit) { ?>
                                        <p><strong>Состав набора</strong></p>
                                        <?= $model->kit; ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <?php $this->widget('app.widgets.siblingsCategories.SiblingsCategoriesWidget', array('model' => $model->rCatalogCategory)); ?>

                        <?php $this->widget('app.widgets.relatedProducts.RelatedProductsWidget', array('model' => $model)); ?>
                    </div>

                    <div class="aside-medium small-3 columns">
                        <div class="sticky-container" data-sticky-container>
                            <div class="sticky" data-sticky data-margin-top="0" data-anchor="content">

                                <div class="card card-small product-info">
                                    <div class="card-content">
                                        <img src="<?= $model->getImageUrl('image', 'basic'); ?>" alt="<?= CHtml::encode($model->name); ?>">
                                        <div class="pre-packing-container"><div class="pre-packing"></div></div>
                                        <button class="button expanded large red" id="add-product" data-toggle="pre-order">Заказать</button>
                                    </div>
                                </div>

                                <?php $this->renderPartial('/partials/forms/preOrder', array('model' => $model)); ?>
                                <?php $this->renderPartial('/partials/forms/manager'); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <?php $this->renderPartial('/layouts/_footer'); ?>
</div>

<script src="/dist/js/core.js"></script>
<script src="/dist/js/app.js"></script>
<script src="/dist/js/slick.js"></script>
<script src="/dist/js/pages/product.js"></script>

</body>

</html>