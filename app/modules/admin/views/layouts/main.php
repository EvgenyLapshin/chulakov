<?php
/**
 * @var $this AController
 * @var $content string
 */
cs()->registerScriptFile($this->getAdminAssetsUrl() . '/js/libs/jquery-ui.min.js', CClientScript::POS_BEGIN);
cs()->registerScriptFile($this->getAdminAssetsUrl() . '/js/page.js', CClientScript::POS_END);
cs()->registerScriptFile($this->getAdminAssetsUrl() . '/js/block.js', CClientScript::POS_END);

$this->beginContent('application.modules.admin.views.layouts.common');

if (!cookies()->get('asideSize', 0)) {
    cookies()->put('asideSize', 300);
}
?>

    <div class="app" id="app">
        <div class="app__aside" style="flex-basis:<?= cookies()->get('asideSize'); ?>px; width: <?= cookies()->get('asideSize'); ?>px;">
            <div class="app__header">
                <div class="brand-container left" id="brand-container">
                    <a class="brand-name" href="/admin"><?= app()->name; ?></a>

                    <div class="user">
                        <a class="user-link clearfix" href="<?= url('/user/manager/update', array('id' => user()->id)); ?>">
                            <div class="user-link-image">
                                <img src="<?= user()->model->rProfile->getImageUrl('avatar', 'basic'); ?>"
                                     class="circle">
                            </div>
                            <div class="user-layout">
                                <span class="user-name"><?= user()->model->rProfile->first_name; ?></span>
                                <span class="user-role"><?= user()->model->username; ?></span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <aside class="aside" id="aside">
                <div class="aside__row">
                    <div class="aside__wrapper">
                        <?php $this->renderPartial('app.modules.admin.views.layouts.sidebar'); ?>
                    </div>

                    <div class="aside__copyright">
                        © 2013 - 2016 Laco.<br>
                        Все права защищены.
                    </div>
                </div>
            </aside>
        </div>

        <div class="app__content">
            <div class="app__header">
                <nav>
                    <div class="nav-wrapper">
                        <ul class="right">
                            <li>
                                <a class="dropdown-button" href="#" data-activates="header-toolbar"
                                   data-alignment="right" data-constrainwidth="false">
                                    <i class="material-icons">more_vert</i>
                                </a>

                                <ul id="header-toolbar" class="dropdown-content">
                                    <li><a href="<?= url('/'); ?>" target="_blank">Перейти на сайт</a></li>
                                    <li class="divider"></li>
                                    <li><a href="<?= url('/user/login/logout'); ?>">Выйти</a></li>
                                </ul>
                            </li>
                        </ul>

                        <?php $this->widget('materialize.widgets.MBreadcrumbs', array(
                            'homeUrl' => '/admin',
                            'links' => $this->breadcrumbs
                        )); ?>
                    </div>
                </nav>

                <div class="app__tabs">
                    <?= $this->tabs; ?>
                </div>
            </div>

            <main class="main" id="main">
                <div class="main__wrapper">
                    <div class="container main__content">
                        <div class="row">
                            <div class="col s12 l12">

                                <?= $content ?>

                            </div>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </div>

    <div id="plupload">
        <div id="plupload__modal" class="modal bottom-sheet modal-fixed-footer">
            <div class="modal-content">
                <h4>Загрузка</h4>

                <div id="plupload__file-list"></div>

            </div>

            <div class="modal-footer">
                <button class=" modal-action waves-effect waves-green btn-flat left" type="button" id="plupload__pick">
                    Выбрать ещё
                </button>
                <button class=" modal-action modal-close waves-effect waves-red btn-flat" type="button">Закрыть</button>
            </div>
        </div>
    </div>

<?php $this->endContent(); ?>