<!doctype html>
<html lang="ru-RU">

<head>
    <base href="<?= app()->getBaseUrl(true) ?>/"/>

    <title><?= $this->metaTitle ?></title>
    <meta name="keywords" content="<?= $this->metaKeywords ?>">
    <meta name="description" content="<?= $this->metaDescription ?>">
</head>

<body id="page_index">
<?= CHtml::linkButton('Регистрация', array('href' => 'user/register/index')) ?><br><br>
<?= CHtml::linkButton('Вход', array('href' => 'user/login/index')) ?><br><br>
<?= CHtml::linkButton('Выход', array('href' => 'user/login/logout')) ?><br><br>
<?= CHtml::linkButton('Удалить просроченную сессию (более 30 минут)', array('href' => 'user/register/removeOldSession')) ?><br><br>
</body>
</html>