<?php
/* @var MenuWidget $this */
/* @var Page $model */

$children = $model->children()->findAll();
?>

<li>
    <span><?= $model->page_title; ?></span>
    <ul>
        <?php
        foreach ($children as $child) {
            $this->render('_item', array('model' => $child));
        }
        ?>
    </ul>
</li>