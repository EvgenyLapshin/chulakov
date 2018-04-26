<?php
/**
 * @var $this BlockFieldController
 * @var $model BlockField
 * @var $form MActiveForm
 */

$this->beginWidget('materialize.widgets.MCard', array(
    'wrappedInRow' => false
));

$form = $this->beginWidget('materialize.widgets.MActiveForm', array(
    'id' => $model->formId,
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true
    )
));

echo $form->dropDownListRow($model, 'block_template_id',
    CHtml::listData(
        BlockTemplate::model()->findAll('entity_name = :entity_name', array(':entity_name' => $model->rBlockTemplate->entity_name)),
        'id',
        'name'
    ),
    array('empty' => ''));


echo $form->textFieldRow($model, 'name', array('label' => 'Имя атрибута ($model->*****;)'));

echo $form->textFieldRow($model, 'label');

echo $form->dropDownListRow($model, 'type', $model->getTypeList($model->rBlockTemplate->type), array('empty' => ''));
?>

    <div class="section no-pad row">
        <div class="col s12">
            <?= $form->label($model, 'settings') ?>
            <div class="input-field">
                <?php
                $this->widget('app.modules.admin.widgets.codemirror.Codemirror',
                    array(
                        'model' => $model,
                        'attribute' => 'settings',
                        'options' => array('lineNumbers' => true, 'mode' => 'text/x-php')
                    )
                );

                $this->renderPartial('_settingsDefault');
                ?>

            </div>
        </div>
    </div>

<?php if (app()->urlManager->multiLanguageEnabled) { ?>
    <div class="section no-pad row">
        <div class="col s12">
            <label for="PageField_default_value"><?= $model->getAttributeLabel('is_multi_lang') ?></label>

            <div class="input-field">
                <?php $this->widget('yiiwheels.widgets.switch.WhSwitch', array(
                    'model' => $model,
                    'attribute' => 'is_multi_lang'
                ));
                ?>
            </div>
        </div>
    </div>
<?php
}

echo $form->textFieldRow($model, 'default_value');

echo $form->textAreaRow($model, 'possible_values');

echo $form->checkBoxRow($model, 'show_in_grid');

echo $form->checkBoxRow($model, 'resetValues');

$this->endWidget();
$this->endWidget();