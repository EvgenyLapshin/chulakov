<?php
/**
 * @var $this EmailController
 * @var $model Email
 * @var $form MActiveForm
 */

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => 'Параметры письма'
));

$form = $this->beginWidget('materialize.widgets.MActiveForm', array(
    'id' => $model->formId,
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true
    )
));

echo $form->textFieldRow($model, 'name');

echo $form->textAreaRow($model, 'description');

echo $form->textFieldRow($model, 'subject');

echo $form->textFieldRow($model, 'email', array('label' => 'Email получателя (через запятую можно указать несколько адресов)'));

$this->widget('UploaderRedactorWidget', array('model' => $model, 'attribute' => 'content'));

if (user()->isAdmin) {
    echo $form->textFieldRow($model, 'placeholders', array('label' => 'Плейсхолдеры указываются через запятую'));
} else {
    ?>

    <blockquote>
        В полях «Тема» и «Содержание» возможны плейсхолдеры: <br>
        <?php foreach (explode(',', str_replace(' ', '', $model->placeholders)) as $placeholder) { ?>
            *<?= $placeholder; ?>*
        <?php } ?>
        <br>
        Вместо плейсхолдеров будут подставлены соответствующие значения из заполненной формы.
    </blockquote>

    <?php
}

$this->endWidget();
$this->endWidget();