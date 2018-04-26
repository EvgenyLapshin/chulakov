<?php
/* @var NewsWidget $this */
/* @var News $model */
?>

<li<?= $model->is_important ? ' class="accent"' : ''; ?>>
    <div class="heading">
        <div class="date">
            <div class="month"><?= Yii::app()->dateFormatter->format('MMMM', $model->pub_date); ?></div>
            <div class="day"><?= Yii::app()->dateFormatter->format('d', $model->pub_date); ?></div>
        </div>

        <div class="title"><?= $model->title; ?></div>
    </div>
    <div class="card">
        <div class="card-content">
            <div class="content"><?= $model->description; ?></div>

            <a href="<?= $model->url; ?>" class="decor">Подробности</a>
        </div>
        <div class="toggle-btn">
            <svg class="icon-arrow">
                <?php if ($model->is_important) { ?>
                    <div class="toggle-btn"><span>ВАЖНО</span></div>
                <?php } else { ?>
                    <use xlink:href="#icon-arrow"></use>
                <?php } ?>
            </svg>
        </div>
    </div>
</li>