<?php
/**
 * @var $this PagerWidget
 * @var $page integer, number page
 * @var $url string, link
 */
?>

<?php if ($page == 0) { ?>
    <li class="pagination-next disabled">
        <svg class="icon-arrow-paginator center-icon transform-180">
            <use xlink:href="#icon-arrow-paginator"></use>
        </svg>
    </li>
<?php } else { ?>
    <li class="pagination-next">
        <a href="<?= $url ?>" aria-label="Next page">
            <svg class="icon-arrow-paginator center-icon transform-180">
                <use xlink:href="#icon-arrow-paginator"></use>
            </svg>
        </a>
    </li>
<?php } ?>