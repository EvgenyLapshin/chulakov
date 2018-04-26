<?php
/**
 * @var $this GalleryWidget
 * @var $mList array Gallery[]
 */
?>

<div class="content3d">
    <div class="content3d_top"></div>
    <div class="content3d_middle">
        <div class="content3d_center">
            <h1 class="content_caption" id="gallery_caption">Альбомы</h1>

            <div id="gallery_items">

                <?php
                foreach($mList as $model)
                    $this->render('photo/_album', array('model' => $model));
                ?>

            </div>

            <?php $this->render('application.views.layouts._moreButton', array('label' => 'Подробнее')) ?>

        </div>
    </div>
    <div class="content3d_bottom"></div>
</div>