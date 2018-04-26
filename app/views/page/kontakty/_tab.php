<?php
/* @var PageController $this */
/* @var Page $model */
/* @var boolean $isActive */
?>

<li class="tabs-title<?= $isActive ? ' is-active' : ''; ?>"><a href="#panel<?= $model->id; ?>"<?= $isActive ? ' aria-selected="true"' : ''; ?>><?= $model->page_title; ?></a></li>