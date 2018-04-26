<?php
/* @var $this SiblingsCategoriesWidget */
/* @var $list CatalogCategory[] */
?>

<div class="extend_h1 product-sub-title">Категории</div>

<div class="product-category-container">
    <?php
    foreach ($list as $product) {
        $this->render('_item', array('model' => $product));
    }
    ?>
</div>