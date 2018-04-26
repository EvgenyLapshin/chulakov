<?php
/**
 * @var $this PageTemplateController
 * @var $model BlockTemplate
 * @var $form MActiveForm
 */

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => 'Шаблон блока',
    'wrappedInRow' => false,
    'collWrapperCss' => array(MHtml::MOBILE_COLUMN_12, MHtml::DESKTOP_COLUMN_6)
));

$form = $this->beginWidget('materialize.widgets.MActiveForm', array(
    'id' => $model->formId,
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true
    )
));

echo $form->textFieldRow($model, 'name', array('column' => MHtml::MOBILE_COLUMN_12));

echo $form->dropDownListRow($model, 'type', BlockTemplate::getTypeList(), array('column' => MHtml::MOBILE_COLUMN_12));

echo $form->textFieldRow($model, 'limit_blocks', array('column' => MHtml::MOBILE_COLUMN_12));

echo $form->textFieldRow($model, 'entity_name', array('column' => MHtml::MOBILE_COLUMN_12));

/** @var SActiveRecord $template */
$template = $model->entity_template_name;
if ($template) {
    echo $form->textFieldRow($model, 'entity_template_name', array('column' => MHtml::MOBILE_COLUMN_12));
    echo $form->dropDownListRow($model, 'entity_template_id',
        CHtml::listData($template::model()->findAll(), 'id', 'title'),
        array('empty' => '', 'column' => MHtml::MOBILE_COLUMN_12)
    );
}

$this->endWidget();

$this->endWidget();