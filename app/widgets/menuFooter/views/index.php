<?php
/* @var MenuFooterWidget $this */
/* @var Page[] $about */
/* @var Page $services */
/* @var Page[] $pressCenter */
?>

<div class="footer-nav">
    <div class="title">О компании</div>

    <ul>
        <?php
        foreach ($about as $model) {
            $this->render('_item', array('model' => $model));
        }
        ?>
    </ul>
</div>

<div class="footer-nav">
    <div class="title">Наши услуги</div>

    <ul>
        <?php
        foreach ($services->children()->findAll() as $model) {
            $this->render('_item', array('model' => $model));
        }
        ?>
    </ul>
</div>

<div class="footer-nav">
    <div class="title">Пресс-центр</div>

    <ul>
        <?php
        foreach ($pressCenter as $model) {
            $this->render('_item', array('model' => $model));
        }
        ?>
    </ul>
</div>