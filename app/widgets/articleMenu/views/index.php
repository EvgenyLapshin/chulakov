<?php
/* @var $this ArticleMenuWidget */
/* @var $list ArticleCategory[] */
?>

<ul class="tabs tabs-link" data-tabs id="news-category">
    <?php
    foreach ($list as $model) {
        $this->render('_item', array('model' => $model));
    }
    ?>
</ul>