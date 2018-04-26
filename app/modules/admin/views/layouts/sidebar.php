<?php
/**
 * @var $this AController
 * @var $content string
 */
?>

    <h6>Дерево сайта:</h6>

<?php
$pageController = app()->createController('admin/page');
/** @var PageController $pageController */
$pageController = $pageController[0];
$this->widget('materialize.widgets.MJsTreeWidget', array(
    'items' => $pageController::getTree(),
    'pluginOptions' => array(
        'core' => array(
            'check_callback' => true,
        ),
        'contextmenu' => array(
            'show_at_node' => false,
            'items' => 'js:MainTree.menu()'
        ),
        'dnd' => array(
            'is_draggable' => true
        ),
        'plugins' => array('contextmenu', 'dnd', 'types')
    ),
    'events' => array(
        'select_node.jstree' => 'js:MainTree.selectNode',
        'move_node.jstree' => 'js:MainTree.moveNode',
        'ready.jstree' => 'js:MainTree.ready',
    )
)); ?>


    <div class="divider"></div>

    <h6>Категории каталога:</h6>

<?php
$catalogCategoryController = app()->createController('admin/catalogCategory');
/** @var CatalogCategoryController $catalogCategoryController */
$catalogCategoryController = $catalogCategoryController[0];
$this->widget('materialize.widgets.MJsTreeWidget', array(
    'items' => $catalogCategoryController::getTree(),
    'pluginOptions' => array(
        'core' => array(
            'check_callback' => true,
        ),
        'contextmenu' => array(
            'show_at_node' => false,
            'items' => 'js:MainTree.menu()'
        ),
        'dnd' => array(
            'is_draggable' => true
        ),
        'plugins' => array('contextmenu', 'dnd', 'types')
    ),
    'events' => array(
        'select_node.jstree' => 'js:MainTree.selectNode',
        'move_node.jstree' => 'js:MainTree.moveNode',
        'ready.jstree' => 'js:MainTree.ready',
    )
)); ?>

<!-- <a href="<?/*= url('/admin/catalogCategory/create') */?>" title="Добавить категорию"><i class="tiny material-icons">add_circle_outline</i>Добавить</a>-->
    <div class="divider"></div>

<?php $this->widget('zii.widgets.CMenu', array(
    'encodeLabel' => false,
    'htmlOptions' => array(
        'class' => 'aside__links aside-links'
    ),
    'items' => array(
        array('label' => MHtml::icon('view_module') . 'Товары', 'url' => array('/admin/catalogProduct/index')),
        array('label' => MHtml::icon('flag') . 'Страны производители', 'url' => array('/admin/catalogCountryManufacturer/index')),
        array('label' => MHtml::icon('people') . 'Пользователи', 'url' => array('/user/user/index'), 'visible' => user()->isAdmin),
        array('label' => MHtml::icon('lock') . 'Права', 'url' => array('/auth/assignment/index'), 'visible' => user()->isAdmin),
        array('label' => MHtml::icon('email') . 'Письма', 'url' => array('/admin/email/index')),
        array('label' => MHtml::icon('settings') . 'Настройки', 'url' => array('/admin/settings/index')),
        array('label' => MHtml::icon('web') . 'Шаблоны страниц', 'url' => array('/admin/pageTemplate/index'), 'visible' => user()->isAdmin),
        array('label' => MHtml::icon('view_stream') . 'Шаблоны блоков', 'url' => array('/admin/blockTemplate/index'), 'visible' => user()->isAdmin),
        array('label' => MHtml::icon('event_note') . 'Логи', 'url' => array('/admin/log/index'), 'visible' => user()->isAdmin)
    )
)); ?>