<?php
/**
 * @var $this PagerWidget
 * @var $first string
 * @var $prev string
 * @var $items string
 * @var $next string
 * @var $last string
 */
?>

<div class="float-left">
    <nav class="pagination-with-more">
        <ul class="pagination" role="navigation" aria-label="Pagination">
            <?= $prev ?>
            <?= $items ?>
            <?= $next ?>
        </ul>
    </nav>
</div>