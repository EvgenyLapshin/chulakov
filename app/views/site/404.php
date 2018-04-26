<?php
/* @var SiteController $this */
?>

<!doctype html>
<html lang="ru">
<head>
    <?php $this->renderPartial('/layouts/_global'); ?>
</head>

<body class="app">

<?php include('dist/img/icons/icons.svg'); ?>

<div class="wrapper">
    <?php $this->renderPartial('/layouts/_header'); ?>

    <main class="main error-page">
        <div class="row">
            <div class="small-7 columns">
                <div class="code">404</div>
                <div class="description">Страница не найдена</div>
            </div>
            <div class="small-5 columns">
                <a href="/" class="go-home button large white">Вернуться на главную</a>
            </div>
        </div>
    </main>

    <?php $this->renderPartial('/layouts/_footer'); ?>
</div>

<script src="/dist/js/core.js"></script>
<script src="/dist/js/app.js"></script>

</body>
