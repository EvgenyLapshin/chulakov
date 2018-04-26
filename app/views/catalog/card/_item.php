<?php
/* @var CatalogController $this */
/* @var $model CatalogProduct */
?>

<div class="small-3 columns">
    <div class="product-card"  data-product="<?= $model->getJsonData(); ?>">
        <a href="<?= $model->url; ?>">
            <img src="<?= $model->getImageUrl('image', 'basic'); ?>" alt="<?= $model->name; ?>">

            <span class="info">
            <span class="name"><?= $model->name; ?></span>
        </span>
        </a>

        <button class="action add-product" data-toggle="pre-order">

            <div class="price-wrapper">
                <svg class="icon-basket">
                    <use xlink:href="#icon-basket"></use>
                </svg>
                <span class="price">заказать</span>
            </div>

        </button>
    </div>
</div>