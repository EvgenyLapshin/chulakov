<?php
/**
 * @var PageController $this
 * @var Page $model
 * @var integer $number
 * @var string $classActive
 */
?>

<li class="tabs-title<?= $classActive; ?>"><a href="#panel<?= $number; ?>" aria-selected="true"><?= $model->page_title; ?></a></li>