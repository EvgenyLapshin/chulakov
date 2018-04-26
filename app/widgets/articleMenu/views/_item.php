<?php
/* @var $this ArticleMenuWidget */
/* @var $model ArticleCategory */
?>

<?php if ($this->activeId == $model->id) { ?>
    <li class="tabs-title is-active"><a href="#" aria-selected="true" role="tab"><?= $model->name ?></a></li>
<?php } else { ?>
    <li class="tabs-title"><a href="<?= $model->url ?>"><?= $model->name ?></a></li>
<?php } ?>
