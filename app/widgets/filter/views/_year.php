<?php
/** @var FilterWidget $this */
/** @var string $year */
/** @var array $months */
/** @var array $selections */
?>

<div class="filter filter-small open">
    <div class="name">
        <span class="icon"><svg class="icon-arrow-list"><use xlink:href="#icon-arrow-list"></use></svg></span>
        <span><?= $year; ?></span>
    </div>

    <div class="wrap">
        <div class="items">
            <div class="checkbox-group">
                <?php
                foreach ($months as $number => $name) {
                    $this->render('_month', array(
                        'year' => $year,
                        'name' => $name,
                        'number' => $number,
                        'checked' => (in_array($number, $selections)) ? ' checked="checked"' : ''
                    ));
                }
                ?>
            </div>

            <span class="toggle-checkbox-group anchor">Показать ещё</span>
        </div>
    </div>
</div>