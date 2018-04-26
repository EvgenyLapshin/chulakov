<?php
/** @var RecoverPasswordController $this */
/** @var string $url */
cs()->registerCssFile($this->module->getAssetsUrl() . '/css/user.css');
?>

<div class="z-depth-4 card-panel">
    <div class="outside-form outside-form--text">
        <h4>Запрос на смену пароля</h4>

        <p>
            Вы запросили смену пароля на сайте «<?= Yii::app()->name; ?>».<br>
            Для смены пароля пройдите по следующей <a href="<?= $url ?>">ссылке</a>.<br>
            Если вы не запрашивали смену пароля, то просто проигнорируйте данное письмо.
        </p>
    </div>
</div>