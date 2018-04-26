<?php
/* @var $this RelatedProductsWidget */
/* @var $list CatalogProduct[] */
?>

<div class="extend_h1 product-sub-title">Похожее <a href="<?= $this->model->rCatalogCategory->url; ?>" class="anchor blue">Смотреть всё</a></div>

<div class="product-related">
    <div class="slick" id="related-slider">
        <?php
        foreach ($list as $product) {
            $this->render('_item', array('model' => $product));
        }
        ?>
    </div>

    <div class="control" id="related-slider-control">
        <div class="count"><?= HText::pluralForm(count($list), 'Нашлась', 'Нашлось', 'Нашлось');?> <?= count($list); ?> шт</div>
    </div>
</div>