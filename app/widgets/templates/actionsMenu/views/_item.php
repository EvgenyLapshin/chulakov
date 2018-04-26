<?php
/**
 * @var $this ActionsMenuWidget
 * @var $model CategoryAction
 */
?>

<?php if ($this->activeId == $model->id) { ?>
    <li class="active"><span><?= $model->name ?></span></li>
<?php } else { ?>
    <li><a href="<?= $model->url ?>"><?= $model->name ?></a></li>
<?php } ?>