<?php
/**
 * @var $this GalleryWidget
 * @var $model Gallery
 */
?>

<div class="content3d">
    <div class="content3d_top"></div>
    <div class="content3d_middle">
        <div class="content3d_center">
            <h1 class="content_caption" id="gallery_caption">Видео</h1>

            <div id="gallery_items">

                <?php
                foreach ($model->items as $item)
                    $this->render('video/_item', array('model' => $item));
                ?>

            </div>

            <?php $this->render('application.views.layouts._moreButton', array('label' => 'Подробнее')) ?>

        </div>
    </div>
    <div class="content3d_bottom"></div>
</div>