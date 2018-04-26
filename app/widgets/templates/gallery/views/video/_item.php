<?php
/**
 * @var $this GalleryWidget
 * @var $model GalleryItem
 */
?>

<div class="gallery_video_item">
    <div class="gallery_video_item_player">
        <?= $model->code ?>
    </div>
    <div class="gallery_video_item_caption"><?= $model->title ?></div>
</div>