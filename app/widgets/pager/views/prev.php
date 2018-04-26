<?php
/**
 * @var $this PagerWidget
 * @var $page integer, number page
 * @var $url string, link
 */
?>

<?php if ($page == 0) { ?>
    <li class="pagination-previous disabled">
        <svg class="icon-arrow-paginator center-icon">
            <use xlink:href="#icon-arrow-paginator"></use>
        </svg>
    </li>
<?php } else { ?>
    <li class="pagination-previous disabled">
        <a href="<?= $url ?>" aria-label="Prev page">
            <svg class="icon-arrow-paginator center-icon">
                <use xlink:href="#icon-arrow-paginator"></use>
            </svg>
        </a>
    </li>
<?php } ?>