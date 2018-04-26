<?php
/**
 * @var CatalogController $this
 * @var ActiveDataProvider|InfiniteActiveDataProvider $dataProvider
 * @var Article[] $loop
 */
?>

<div class="loop row row-small"
     data-pagination="<?= $dataProvider->pagination->currentPage; ?>/<?= $dataProvider->pagination->pageCount; ?>"
     data-scroll="<?= $dataProvider->pagination->currentPage; ?>"
     data-url="<?= $dataProvider->pagination->getCurrentPageUrl($this); ?>"
>

    <?php
    foreach ($loop as $model) {
        $this->renderPartial($this->viewType . '/_item', array('model' => $model));
    }
    ?>

</div>