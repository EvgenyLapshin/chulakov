<?php
/** @var FilterWidget $this */
/** @var string $year */
/** @var string $number */
/** @var array $name */
/** @var array $checked */
?>

<div class="checkbox">
    <input id="checkbox<?= $year . '_' . $number; ?>" type="checkbox"<?= $checked; ?> value="<?= $number; ?>" name="filter[<?= $year; ?>][]">
    <label for="checkbox<?= $year . '_' . $number; ?>"><?= $name; ?></label>
</div>