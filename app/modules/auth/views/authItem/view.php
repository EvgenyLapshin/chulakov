<?php
/* @var $this OperationController|TaskController|RoleController */
/* @var $item CAuthItem */
/* @var $ancestorDp AuthItemDataProvider */
/* @var $descendantDp AuthItemDataProvider */
/* @var $formModel AddAuthItemForm */
/* @var $form MActiveForm */
/* @var $childOptions array */

$this->breadcrumbs = array(
    $this->capitalize($this->getTypeText(true)) => array('index'),
    $item->description,
);

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => CHtml::encode($item->description),
    'description' => $this->getTypeText()
));
?>

<div style="float: right">
    <?php
    echo MHtml::linkButton(Yii::t('AuthModule.main', 'Edit'), array(
        'url' => $this->createUrl('update', array('name' => $item->name))
    ));
    echo '&nbsp';
    echo MHtml::linkButton(MHtml::icon('delete'), array(
        'url' => $this->createUrl('delete', array('name' => $item->name)),
        'confirm' => Yii::t('AuthModule.main', 'Are you sure you want to delete this item?')
    ));
    ?>
</div>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $item,
    'attributes' => array(
        array(
            'name' => 'name',
            'label' => Yii::t('AuthModule.main', 'System name'),
        ),
        array(
            'name' => 'description',
            'label' => Yii::t('AuthModule.main', 'Description'),
        ),
        /*
        array(
            'name' => 'bizrule',
            'label' => Yii::t('AuthModule.main', 'Business rule'),
        ),
        array(
            'name' => 'data',
            'label' => Yii::t('AuthModule.main', 'Data'),
        ),
        */
    ),
));

$this->endWidget();
?>

<div class="row">
    <?php
    $this->beginWidget('materialize.widgets.MCard', array(
        'title' => Yii::t('AuthModule.main', 'Ancestors'),
        'description' => Yii::t('AuthModule.main', 'Permissions that inherit this item'),
        'collWrapperCss' => MHtml::MOBILE_COLUMN_6,
        'wrappedInRow' => false
    ));

    $this->widget('materialize.widgets.grid.MGridView', array(
        'dataProvider' => $ancestorDp,
        'enableSorting' => false,
        'emptyText' => Yii::t('AuthModule.main', 'This item does not have any ancestors.'),
        'template' => "{items}",
        'hideHeader' => true,
        'columns' => array(
            array(
                'class' => 'AuthItemDescriptionColumn',
                'itemName' => $item->name,
            ),
            array(
                'class' => 'AuthItemTypeColumn',
                'itemName' => $item->name,
            ),
            array(
                'class' => 'AuthItemRemoveColumn',
                'itemName' => $item->name,
            )
        )
    ));

    $this->endWidget();
    ?>

    <?php
    $this->beginWidget('materialize.widgets.MCard', array(
        'title' => Yii::t('AuthModule.main', 'Descendants'),
        'description' => Yii::t('AuthModule.main', 'Permissions granted by this item'),
        'collWrapperCss' => MHtml::MOBILE_COLUMN_6,
        'wrappedInRow' => false
    ));

    $this->widget('materialize.widgets.grid.MGridView', array(
        'dataProvider' => $descendantDp,
        'enableSorting' => false,
        'emptyText' => Yii::t('AuthModule.main', 'This item does not have any descendants.'),
        'template' => "{items}",
        'hideHeader' => true,
        'columns' => array(
            array(
                'class' => 'AuthItemDescriptionColumn',
                'itemName' => $item->name,
            ),
            array(
                'class' => 'AuthItemTypeColumn',
                'itemName' => $item->name,
            ),
            array(
                'class' => 'AuthItemRemoveColumn',
                'itemName' => $item->name,
            ),
        ),
    ));

    $this->endWidget();
    ?>

    <?php if (!empty($childOptions)) { ?>

        <h4><?= Yii::t('AuthModule.main', 'Add child'); ?></h4>

        <?php $form = $this->beginWidget('bootstrap.widgets.MActiveForm'); ?>

        <?= $form->dropDownListRow($formModel, 'items', $childOptions, array('label' => false)); ?>

        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'label' => Yii::t('AuthModule.main', 'Add'),
        )); ?>

        <?php $this->endWidget(); ?>

    <?php } ?>

</div>