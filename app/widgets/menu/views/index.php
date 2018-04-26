<?php
/* @var MenuWidget $this */
/* @var $list Page[] */
/* @var $catalog Page */
$main = Page::model()->findByPk(1);
?>

<div class="row">
    <div class="menu small-10 columns">
        <div class="catalog-nav" id="catalog-nav-header">
        <span class="btn">
            <div class="icon">
                <svg class="icon-menu-catalog center-icon">
                    <use xlink:href="#icon-menu-catalog"></use>
                </svg>
            </div>
            <div class="label"><?= $catalog->page_title; ?></div>
        </span>

            <div class="catalog-nav-wrap">
                <?= $this->generateCatalogMenu(); ?>
                <div class="catalog-nav-show"></div>
            </div>
        </div>

        <ul class="header-nav" id="header-nav">
            <?php
            foreach ($list as $model) {
                if ($model->id == 4) { //- Услуги
                    $this->render('_sub', array('model' => $model));
                } else {
                    $this->render('_item', array('model' => $model));
                }
            }
            ?>
        </ul>
    </div>

    <div class="small-2 columns">

        <div class="cart-widget" data-toggle="login-form">

            <div class="contacts">
                <div class="phone">
                    <svg class="icon-phone">
                        <use xlink:href="#icon-phone"></use>
                    </svg>
                    <?= $main->phoneHeader; ?>
                </div>
                <div class="email"><a href="mailto:<?= $main->emailHeader; ?>"><?= $main->emailHeader; ?></a></div>
            </div>

        </div>
    </div>
</div>