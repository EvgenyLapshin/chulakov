<?php
/**
 * @var $this PageFieldController
 * @var $model PageField
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

echo $form->dropDownListRow($model, 'template_id', CHtml::listData(PageTemplate::model()->findAll(), 'id', 'title'));

echo $form->textFieldRow($model, 'name', array('label' => 'Имя атрибута ($model->attributeName;)'));

echo $form->textFieldRow($model, 'label');

echo $form->dropDownListRow($model, 'type', $model->getTypeList());

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

<?php

echo $form->textFieldRow($model, 'default_value');

echo $form->textAreaRow($model, 'possible_values');

echo $form->checkBoxRow($model, 'resetValues');

$this->endWidget();
$this->endWidget();