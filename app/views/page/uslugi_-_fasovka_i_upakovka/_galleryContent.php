<?php
/**
 * @var PageController $this
 * @var Page $model
 * @var integer $number
 * @var string $classActive
 */

$blockGallery = $model->getBlocks(8);
?>

<div class="tabs-panel<?= $classActive; ?>" id="panel<?= $number; ?>">
    <div class="content"><?= $model->description; ?></div>

    <div class="gallery-widget">
        <div class="inner">
            <div class="slider-content">

                <?php foreach($blockGallery as $image) { ?>
                    <img src="<?= $image->getImageUrl('image', 'big'); ?>" alt="<?= $image->image; ?>" data-thumb="<?= $image->getFileUrl('image', 'small'); ?>">
                <?php } ?>

            </div>

            <div class="thumbs-container">
                <div class="thumbs"></div>
            </div>
        </div>
    </div>
</div>