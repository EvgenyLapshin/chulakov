<?php
/**
 * @var $this PageController
 * @var $slide Block[]
 */
?>

<div class="slide">
    <?php foreach($slide as $doc) { ?>
        <img data-large-img="<?= $doc->getImageUrl('image', 'basic'); ?>" src="<?= $doc->getImageUrl('image', 'small'); ?>" alt="<?= $doc->image; ?>">
    <?php } ?>
</div>