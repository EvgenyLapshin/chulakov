<?php
/* @var ArticleController $this */
/* @var $model Article */
?>

<div class="card news-widget news-widget-with-image">
    <div class="card-title"><a href="<?= $model->url; ?>"><?= $model->title; ?></a></div>
    <div class="card-content">
        <div class="news-widget-text"><?= $model->description; ?></div>

        <?php if ($model->image) { ?>
            <div class="news-widget-image">
                <img src="<?= $model->getImageUrl('image', 'preview'); ?>" alt="<?= $model->image; ?>">
            </div>
        <?php } ?>

        <div class="article-info">
            <span class="date"><?= Yii::app()->dateFormatter->format("dd MMMM yyyy", $model->pub_date); ?></span>
            <span class="visits-count">
            <span class="wrap-icon">
                <svg class="icon-news-eye center-icon">
                    <use xlink:href="#icon-news-eye"></use>
                </svg>
            </span>
            <?= $model->view_count; ?>
            </span>
        </div>
    </div>
</div>