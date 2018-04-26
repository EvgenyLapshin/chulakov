<?php
/** @var FilterWidget $this */
/** @var array $selections */
?>

<form class="filter-container " id="news-filter" action="" method="get">

    <?php
    foreach($this->listFilters as $year => $months) {
        $selectionsMonths = array();
        if (!empty($selections[$year])) {
            $selectionsMonths = $selections[$year];
        }
        $this->render('_year', array('year' => $year, 'months' => $months, 'selections' => $selectionsMonths));
    }
    ?>

    <div class="action">
        <span class="reset-filter anchor"><span>+</span>Сбросить все фильтры</span>

        <button class="button expanded large red" type="submit">Применить</button>
    </div>
</form>