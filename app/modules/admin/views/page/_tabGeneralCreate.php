<?php
/**
 * @var $this PageController
 * @var $model Page
 * @var $form MActiveForm
 */

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => 'Основные поля'
));

echo $form->textFieldRow($model, 'page_title');

echo $form->dropDownListRow($model, 'template_id',
    CHtml::listData(PageTemplate::model()->findAll(), 'id', 'title'),
    array(
        'empty' => '',
        'disabled' => ($model->template_id) ? 'disabled' : ''
    )
);

echo $form->dropDownListRow($model, 'parentId',
    CHtml::listData(($model->isNewRecord) ? Page::model()->findAll() : Page::model()->findAll('id <> :id', array(':id' => $model->id)), 'id', 'page_title'),
    array(
        'empty' => '',
        'disabled' => ($model->parentId) ? 'disabled' : ''
    )
);

echo $form->dropDownListRow($model, 'type', $model->getTypeList());

echo $form->textFieldRow($model, 'link');

if (user()->getIsAdmin()) {
    echo $form->textFieldRow($model, 'entity');
    echo $form->textFieldRow($model, 'entity_params');
}

if ($model->dynamicAttributesInfo) {
    foreach ($model->dynamicAttributesInfo as $attribute) {
        $this->renderPartial('fields/_' . $attribute['type'],
            array(
                'model' => $model,
                'form' => $form,
                'attribute' => $attribute
            )
        );
    }
}

echo $form->checkBoxRow($model, 'is_published', array('class' => 'filled-in'));

$this->endWidget();