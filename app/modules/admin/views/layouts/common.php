<?php
/**
 * @var AController $this
 * @var string $content
 */
?>

<!doctype html>
<html lang="ru">

<head>
    <base href="<?= app()->getBaseUrl(true); ?>/"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1024, initial-scale=1.0"/>

    <title>Laco CMS - Студийная CMS от «Laco» digital agency</title>

    <?php
    cs()->registerCoreScript('jquery');
    cs()->registerCoreScript('jquery.ui');
    cs()->registerCoreScript('bbq');

    Yii::import('materialize.components.MRegisterScript');
    $materialize = new MRegisterScript();
    $materialize->registerScripts();
    ?>
</head>
<body>

<?= $content ?>

</body>
</html>
