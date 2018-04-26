<?php

class SeoTabWidget extends CWidget
{
    public $model;
    public $form;

    public function run()
    {
        $view = (app()->urlManager->multiLanguageEnabled) ? 'multilingual' : 'singleLanguage';
        $this->render($view, array('model' => $this->model, 'form' => $this->form));
    }
}