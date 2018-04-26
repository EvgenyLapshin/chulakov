<?php
/**
 * @var $this BreadcrumbsWidget
 */
?>

<nav role="navigation">
    <ul class="breadcrumbs">
        <li><a href="/">Главная</a></li>

        <?php
        foreach ($this->list as $item) {
            $this->render('_item', array('item' => $item));
        }
        ?>
    </ul>
</nav>