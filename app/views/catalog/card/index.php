<?php
/* @var CatalogController $this */
/* @var ActiveDataProvider|InfiniteActiveDataProvider $dataProvider */
?>

<div class="catalog catalog-view-card">
    <div class="small-12 columns" id="ajax-load-container">
        <?php
        $this->renderPartial($this->viewType . '/_loop', array(
            'loop' => $dataProvider->getData(),
            'dataProvider' => $dataProvider
        ));
        ?>
    </div>
</div>