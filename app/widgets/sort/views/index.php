<?php
/* @var SortWidget $this */
/* @var string $items */
?>

<div class="<?= $this->cssClass; ?>">
    <?= $this->header === null ? Yii::t('zii', 'Sort by: ') : $this->header; ?>
    <?= $items; ?>
    <?= $this->footer; ?>
</div>