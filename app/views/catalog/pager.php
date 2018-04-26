<?php
/* @var CatalogController $this */
/* @var ActiveDataProvider|InfiniteActiveDataProvider $dataProvider */
?>

<div class="ajax-pager-wrap clearfix">
    <?= $this->widget('app.widgets.pager.PagerWidget', array(
        'pages' => $dataProvider->pagination
    ), true); ?>

    <?php if ($dataProvider->hasNextPage()) { ?>
        <div class="float-right">
            <a class="button-with-icon large ajax-pagination-button"
               href="<?= $dataProvider->pagination->getNextPageUrl($this); ?>">
            <span class="wrap-icon">
                 <svg class="icon-arrow-paginator center-icon transform-270">
                     <use xlink:href="#icon-arrow-paginator"></use>
                 </svg>
            </span>
                <span class="text">Показать ещё</span>
            </a>
        </div>
    <?php } ?>
</div>
