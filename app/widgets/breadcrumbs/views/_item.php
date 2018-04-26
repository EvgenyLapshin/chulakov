<?php
/**
 * @var $this BreadcrumbsWidget
 * @var $item array
 */
?>

<?php if (!empty($item['url'])) { ?>

    <li><a href="<?= $item['url']; ?>"><?= $item['title']; ?></a></li>

<?php } else { ?>

    <li><?= $item['title']; ?></li>

<?php } ?>