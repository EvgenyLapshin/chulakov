<?php
/* @var $this SearchController */
/* @var $model CatalogProduct */
?>

<div class="product-inline" data-product="<?= $model->getJsonData(); ?>">
    <a href="<?= $model->url; ?>">
        <span class="float-left description">
        <span class="name"><?= $model->name; ?></span>
    </span>

        <span class="price-box text-right">
        <span class="label">заказать</span>
    </span>
    </a>

    <span class="add-to-cart add-product" data-toggle="pre-order">
        <svg class="icon-basket">
            <use xlink:href="#icon-basket"></use>
        </svg>
    </span>
</div>