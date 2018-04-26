<?php
/* @var PageController $this */
/* @var Block $model */
?>

<div class="home-slider-content__slide">
    <img src="<?= $model->getImageUrl('image', 'basic'); ?>" alt="<?= $model->image; ?>">

    <div class="row">
        <div class="small-12 columns">
            <div class="white">
                <div class="title"><?= $model->title; ?></div>

                <div class="text"><?= $model->description; ?></div>

                <?php if ($model->link) { ?>
                    <a href="<?= $model->link; ?>" class="button large red">Узнать больше</a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>