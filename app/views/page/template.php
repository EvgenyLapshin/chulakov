<?php
/**
 * @var $this PageController
 * @var $model Page
 */

$parent = $model->parent()->find();
$children = $model->children()->findAll();
$blocks = $model->getBlocks(1);
$blocksWithCriteria = $model->getBlocks(1, array('limit' => 8, 'order' => 'rand()'));
?>

<?php $this->renderPartial('/layouts/_header'); ?>
<?php $this->widget('app.widgets.menu.MenuWidget', array('activeId' => $model->id)); ?>

<?= Yii::app()->dateFormatter->format("d.MM.yyyy", $model->date) ?>
<?= app()->numberFormatter->format("#,##0", $model->price) ?>
<?= $page->getFileUrl('preview', 'basic') ?>
<?= HText::replaceTextLink($model->page_title, $model->url) ?>

<?php
foreach ($blocks as $block) {
    $this->renderPartial($model->template->name . '/_item', array('model' => $block));
}
?>