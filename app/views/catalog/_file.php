<?php
/* @var $this CatalogController */
/* @var $model Block */
?>
<div>
    <a href="<?= $model->getFileUrl('file'); ?>" class="anchor blue" target="_blank">
        <svg class="icon-doc">
            <use xlink:href="#icon-doc"></use>
        </svg>
        <?= $model->name; ?>
    </a>
</div>