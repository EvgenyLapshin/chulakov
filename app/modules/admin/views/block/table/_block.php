<?php
/**
 * @var $this BlockController
 * @var $model Block
 * @var $mBlockTemplate BlockTemplate
 * @var $countBlocks integer
 */
?>

<div class="blocks-content-container">
    <?php
    $this->renderPartial('fields/_hidden',
        array(
            'model' => $model,
            'attribute' => 'id',
            'name' => ($model->isNewRecord)
                ? ''
                : get_class($model) . '[' . $model->block_template_id . '][' . $model->block_order . '][id]'
        )
    );

    $this->renderPartial('fields/_hidden',
        array(
            'model' => $model,
            'attribute' => 'block_template_id',
            'name' => ($model->isNewRecord)
                ? ''
                : get_class($model) . '[' . $model->block_template_id . '][' . $model->block_order . '][block_template_id]'
        )
    );

    $this->renderPartial('fields/_hidden',
        array(
            'model' => $model,
            'attribute' => 'block_order',
            'name' => ($model->isNewRecord)
                ? ''
                : get_class($model) . '[' . $model->block_template_id . '][' . $model->block_order . '][block_order]'
        )
    );

    $this->renderPartial('fields/_hidden',
        array(
            'model' => $model,
            'attribute' => 'isDeleted',
            'name' => ($model->isNewRecord)
                ? ''
                : get_class($model) . '[' . $model->block_template_id . '][' . $model->block_order . '][isDeleted]'
        )
    );

    foreach ($model->dynamicAttributesInfo as $attribute) {
        $this->renderPartial('fields/_' . $attribute['type'],
            array(
                'model' => $model,
                'attribute' => $attribute,
                'name' => ($model->isNewRecord)
                    ? ''
                    : get_class($model) . '[' . $model->block_template_id . '][' . $model->block_order . '][' . $attribute['name'] . ']'
            )
        );
    }
    ?>

</div>