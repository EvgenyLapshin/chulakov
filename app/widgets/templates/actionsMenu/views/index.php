<?php
/**
 * @var $this ActionsMenuWidget
 * @var $list CategoryAction[]
 */
?>

<nav class="grid_12 pares-nav">
    <ul>
        <?php
        foreach ($list as $model) {
            $this->render('_item', array('model' => $model));
        }
        ?>
    </ul>
</nav>