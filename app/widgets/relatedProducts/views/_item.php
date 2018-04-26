<?php
/* @var $this RelatedProductsWidget */
/* @var $model CatalogProduct */
?>

<div class="slide">
    <a href="<?= $model->url; ?>">
        <img src="<?= $model->getImageUrl('image', 'basic'); ?>" alt="<?= $model->name; ?>">
        <span class="name"><?= $model->name; ?></span>
    </a>
</div>