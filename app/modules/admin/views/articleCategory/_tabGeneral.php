<?php
/* @var ArticleCategoryController $this */
/* @var ArticleCategory $model */
/* @var MActiveForm $form */

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => 'Основные поля'
));

echo $form->textFieldRow($model, 'name');

echo $form->checkBoxRow($model, 'is_published');

$this->endWidget();