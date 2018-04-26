<?php
/* @var NewsWidget $this */
/* @var News[] $list */
?>

<div id="home-accordion" class="home-accordion">
    <ul class="accordion">
        <?php
        foreach ($list as $news) {
            $this->render('_item', array('model' => $news));
        }
        ?>
    </ul>
    <noscript>
        <p>Please enable JavaScript to get the full experience.</p>
    </noscript>
</div>