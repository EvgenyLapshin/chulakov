<?php
/**
 * @var $this PageController
 * @var $model Page
 * @var $form MActiveForm
 */

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => 'Основные поля',
    'buttonVisible' => user()->isAdmin,
    'buttonHtmlOptions' => array(
        'icon' => MHtml::icon('web'),
        'color' => MHtml::COLOR_PINK,
        'color-shade' => MHtml::COLOR_SHADE_ACCENT_2,
        'size' => MHtml::SIZE_MEDIUM,
        'class' => 'btn-floating card-btn',
        'url' => url('/admin/pageTemplate/update', array('id' => $model->template_id)),
        'title' => 'Перейти в шаблон'
    )
));

echo $form->hiddenField($model, 'id');

echo $form->textFieldRow($model, 'page_title');

if (user()->getIsAdmin()) {
    echo $form->dropDownListRow($model, 'type', $model->getTypeList());

    echo $form->textFieldRow($model, 'link');

    echo $form->textFieldRow($model, 'entity');

    echo $form->textFieldRow($model, 'entity_params');

    echo $form->checkBoxRow($model, 'is_published');

    echo "<br>";
}

foreach ($model->dynamicAttributesInfo as $attribute) {
    $this->renderPartial('fields/_' . $attribute['type'],
        array(
            'model' => $model,
            'form' => $form,
            'attribute' => $attribute
        )
    );
}

$this->endWidget();