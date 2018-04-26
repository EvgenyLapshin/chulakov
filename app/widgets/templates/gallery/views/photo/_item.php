<?php
/**
 * @var $this GalleryWidget
 * @var $model GalleryItem
 */
?>

<div class="gallery_album_item_image" data-src="<?= $model->getFileUrl("file", "1000x800") ?>"><?= $model->title ?></div>