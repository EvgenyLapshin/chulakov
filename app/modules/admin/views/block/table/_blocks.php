<?php
/**
 * @var $this BlockController
 * @var $mBlockTemplate BlockTemplate
 * @var $mBlock Block
 */

$dataProvider = $mBlock->search();
$disabledAddButton = '';
if (($mBlockTemplate->limit_blocks != 0) && ($mBlockTemplate->limit_blocks <= $dataProvider->itemCount)) {
    $disabledAddButton = ' disabled';
}
?>

<div class="blocks">

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
    ));

    $this->widget('materialize.widgets.grid.MGridView', array(
        'id' => $mBlock->gridId,
        'dataProvider' => $dataProvider,
        'enableSorting' => false,
        'htmlOptions' => array('class' => 'block-grid-view grid-view highlight'),
        'rowHtmlOptionsExpression' => 'array("class" => "blocks-block")',
        'summaryText' => 'Количество элементов: <span class="blocks-count">{count}</span>' . (($mBlockTemplate->limit_blocks) ? (' из ' . ' <span class="blocks-limit">' . $mBlockTemplate->limit_blocks) . '</span>' : ''),
        'columns' => array_merge(
            $mBlock->getGridColumns(),
            array(
                array(
                    'class' => 'materialize.widgets.grid.MButtonColumn',
                    'template' => '{sortable} {update} {delete}',
                    'deleteButtonUrl' => '#',
                    'updateButtonUrl' => '#',
                    'buttons' => array(
                        'sortable' => array(
                            'label' => MHtml::icon('swap_vert', array('class' => 'sortable-column-handler'))
                        )
                    )
                ),
                array(
                    'value' => '$this->grid->controller->renderPartial("' . $mBlockTemplate->type . '/_block", array(
                        "model" => $data
                    ))',
                    'htmlOptions' => array(
                        'class' => 'blocks-content'
                    )
                )
            )
        )
    ));
    ?>

    <div id="block-template-field" style="display: none">
        <?php
        $this->renderPartial($mBlockTemplate->type . '/_block', array(
            'model' => $mBlock,
            'blockNumber' => false,
            'mBlockTemplate' => $mBlockTemplate
        ))
        ?>
    </div>

    <?php $this->endWidget(); ?>
</div>