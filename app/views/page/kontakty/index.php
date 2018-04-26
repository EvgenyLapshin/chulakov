<?php
/* @var PageController $this */
/* @var Page $model */

$addresses = $model->children()->findAll();
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

    <main class="main">
        <div class="row">
            <div class="small-12 columns">
                <nav role="navigation">
                    <?php $this->widget('app.widgets.breadcrumbs.BreadcrumbsWidget', array(
                        'list' => array(
                            array('title' => $model->page_title)
                        )
                    )); ?>

                    <h1><?= $this->metaTitle ?></h1>

                    <ul class="tabs" data-tabs id="contacts">
                        <?php
                        foreach ($addresses as $key => $address) {
                            $this->renderPartial($model->rTemplate->name . '/_tab', array(
                                'model' => $address,
                                'isActive' => !$key
                            ));
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="tabs-content" data-tabs-content="contacts">

            <?php
            foreach ($addresses as $key => $address) {
                $this->renderPartial($model->rTemplate->name . '/_address', array(
                    'model' => $address,
                    'isActive' => !$key
                ));
            }
            ?>
        </div>

        <?php $this->renderPartial($model->rTemplate->name . '/requestDetails',array('model' => $model)); ?>

    </main>

    <?php $this->renderPartial('/layouts/_footer'); ?>

</div>

<script src="/dist/js/core.js?index=<?= param('resetSuffix'); ?>"></script>
<script src="/dist/js/app.js?index=<?= param('resetSuffix'); ?>"></script>
<script src="/dist/js/pages/contacts.js?index=<?= param('resetSuffix'); ?>"></script>
<script type="text/javascript" src="//api-maps.yandex.ru/2.1/?lang=ru_RU&onload=kupavnaContacts.map"></script>

</body>

</html>
