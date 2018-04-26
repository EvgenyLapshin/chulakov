<?php
/* @var $this SearchController */
/* @var $model Article|News */
?>

<a href="<?= $model->url; ?>" class="search-result card card-small">
    <span class="card-title card-title-small"><?= $model->title; ?></span>
    <span class="card-content"><?= $model->description; ?></span>
</a>