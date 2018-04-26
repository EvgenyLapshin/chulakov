<?php
/* @var MenuWidget $this */
/* @var Page $model */
?>

<?php if ($this->activeId == $model->id) { ?>

    <li><a class="active" href="<?= $model->url ?>"><?= $model->page_title ?></a></li>

<?php } else { ?>

    <li><a href="<?= $model->url ?>"><?= $model->page_title ?></a></li>

<?php } ?>