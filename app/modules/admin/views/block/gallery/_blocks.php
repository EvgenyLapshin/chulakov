<?php
/**
 * @var $this BlockController
 * @var $mBlockTemplate BlockTemplate
 * @var $mBlock Block
 */
$disabledAddButton = '';
if (($mBlockTemplate->limit_blocks != 0) && ($mBlockTemplate->limit_blocks <= count($mBlockTemplate->blocks))) {
    $disabledAddButton =  ' disabled';
}
?>

<div class="blocks blocks--gallery">

    <?php $this->beginWidget('materialize.widgets.MCard', array(
        'title' => $mBlockTemplate->name,
        'buttons' => array(
            array(
                'htmlOptions' => array(
                    'url' => '#',
                    'class' => 'btn-floating blocks-add card-btn' . $disabledAddButton
                )
            ),
            array(
                'htmlOptions' => array(
                    'title' => 'Перейти в шаблон блока',
                    'url' => url('/admin/blockTemplate/update', array('id' => $mBlockTemplate->id)),
                    'icon' => MHtml::icon('view_stream'),
                ),
                'visible' => user()->isAdmin
            )
        )
    )); ?>

    <div class="grid-view">

        <div class="blocks-gallery">

            <?php foreach ($mBlockTemplate->blocks as $key => $model) { ?>
                <div class="blocks-photo">

                    <div class="blocks-photo-layout">
                        <img src="<?= $model->getImageUrl('image', 'thumb'); ?>">

                        <div class="blocks-photo-toolbar">
                            <a class="delete" title="Удалить" href="#"><i class="material-icons">delete</i></a>
                            <a class="edit" title="Редактировать" href="#"><i class="material-icons">edit</i></a>
                        </div>

                        <div class="blocks-photo-name"><?= $model->image; ?></div>
                    </div>

                    <div class="blocks-content">
                        <div class="blocks-content-container">
                            <?php $this->renderPartial($mBlockTemplate->type . '/_block', array(
                                'model' => $model,
                                'blockNumber' => $key
                            )); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>

        <div class="blocks-photo blocks-template">

            <div class="blocks-photo-layout">
                <img src="">

                <div class="blocks-photo-toolbar">
                    <a class="delete" title="Удалить" href="#"><i class="material-icons">delete</i></a>
                    <a class="edit" title="Редактировать" href="#"><i class="material-icons">edit</i></a>
                </div>

                <div class="blocks-photo-name"></div>
            </div>

            <div class="blocks-content">
                <div class="blocks-content-container">
                    <?php $this->renderPartial($mBlockTemplate->type . '/_block', array(
                        'model' => $mBlock,
                        'blockNumber' => false
                    )); ?>
                </div>
            </div>

        </div>

        <?php if ($mBlockTemplate->limit_blocks) { ?>
            <div class="right">
                <div class="summary">
                    Количество элементов:
                    <span class="blocks-count"><?= $mBlockTemplate->countBlocks; ?></span>
                    из
                    <span class="blocks-limit"><?= $mBlockTemplate->limit_blocks; ?></span>
                </div>
            </div>
        <?php } ?>

        <div class="clearfix"></div>

    </div>

    <?php $this->endWidget(); ?>

    <div class="clearfix"></div>
</div>