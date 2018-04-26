<?php
/**
 * @var $this GalleryWidget
 * @var $model Gallery
 */
?>

<div class="gallery_album_item">
    <img class="gallery_album_item_cover" src="<?= $model->getFileUrl("preview", "254x170") ?>" alt=""/>
    <div class="gallery_album_item_caption"><?= $model->title ?></div>

    <div class="gallery_album_item_images">

        <?php
        foreach($model->items as $item)
            $this->render('photo/_item', array('model' => $item));
        ?>

    </div>
</div>