<?php
/* @var $this SettingsController */
/* @var $form MActiveForm */
/* @var $comingSoonPageList Page[] */

$this->pageTitle = 'Настройки';

$this->breadcrumbs = array(
    $this->pageTitle
);

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => $this->pageTitle
));

$form = $this->beginWidget('materialize.widgets.MActiveForm', array(
    'id' => 'email-template-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data')
));

echo MHtml::toggle('Settings[siteOpen]', settings()->get('siteOpen'), '', 'Сайт', array('label' => false, 'uncheckValue' => 0));

echo MHtml::textFieldRow('Settings[emailSupport]', settings()->get('emailSupport'), array('label' => 'Email технической поддержки сайта', 'prepend' => MHtml::icon('email')));

echo MHtml::textFieldRow('Settings[yandexMetrika]', settings()->get('yandexMetrika'), array('label' => 'Yandex Metrika (номер счётчика)', 'prepend' => MHtml::icon('poll')));

echo MHtml::textFieldRow('Settings[googleAnalytics]', settings()->get('googleAnalytics'), array('label' => 'Google Analytics (номер счётчика)', 'prepend' => MHtml::icon('poll')));

echo MHtml::textAreaRow('Settings[loginForm]', settings()->get('loginForm'), array('label' => 'Текст в форме входа.'));

echo MHtml::dropDownListRow(
    'Settings[comingSoonPageId]',
    settings()->get('comingSoonPageId'),
    MHtml::listData($comingSoonPageList, 'id', 'page_title'),
    array(
        'label' => 'Страница для Заглушки',
        'empty' => ''
    )
);

$this->endWidget();
$this->endWidget();