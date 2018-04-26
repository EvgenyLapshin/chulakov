<?php
/* @var PartnerWidget $this */
?>

<div class="img">
    <img src="/example-content/about/logo.jpg" alt="">
</div>
<div class="title"><?= $this->model->partnerTitle; ?></div>
<div class="text"><?= $this->model->partnerDescription; ?></div>

<a href="<?= $this->model->partnerLink; ?>" target="_blank" class="decor">Партнёрство</a>