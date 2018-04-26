<?php
/* @var PageController $this */
/* @var Page $model */
/* @var boolean $isActive */

$contacts = $model->getBlocks(11);
?>

<div class="tabs-panel<?= $isActive ? ' is-active' : ''; ?>" id="panel<?= $model->id; ?>">
    <div class="row">
        <div class="contacts-address-wrap columns">
            <div class="contacts-address">
                <div class="red">
                    <div class="title">Адрес</div>

                    <p><?= nl2br($model->address); ?></p>
                </div>

                <div>
                    <div class="title">Основные средства связи</div>
                    <?php foreach ($contacts as $contact) { ?>
                        <div class="item">
                            <?= $contact->title; ?>
                            <span><?= $contact->content; ?></span>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php if ($model->titleRightBlock && $model->contentRightBlock) { ?>
            <div class="contacts-managers-wrap columns">
                <div class="contacts-managers toggle-content">
                    <div class="title"><?= $model->titleRightBlock; ?></div>
                    <div class="content">
                        <?= $model->contentRightBlock; ?>
                    </div>
                    <div class="show-btn" data-text="Свернуть">
                        <svg class="icon-arrow-list">
                            <use xlink:href="#icon-arrow-list"></use>
                        </svg>
                        <span>Показать всех</span>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="contacts-map" data-points='
                    {
                        "coords": "<?= $model->coords; ?>",
                        "baloon": "<strong>Широта</strong><br>55°47′56″N (55.799026)<br><strong>Долгота</strong><br>38°11′3″E (38.184095)"
                    }
                    '></div>

    <div class="row">
        <div class="small-12 columns line-helper">
            <button class="button red large mb-bot-none" data-toggle="new-question">Запросить реквизиты</button>

            <?php if ($model->file) { ?>
                <div class="div">
                    <a href="<?= $model->getFileUrl('file'); ?>" class="anchor blue contacts-download" download>
                        <svg class="icon-download-scheme">
                            <use xlink:href="#icon-download-scheme"></use>
                        </svg>
                        Скачать схему проезда
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>