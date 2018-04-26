<?php

class PageUpdateWidget extends CWidget
{
    public $id;
    public $tabsEntities;

    public function run()
    {
        /** @var PageController $cPage */
        $cPage = app()->createController('/admin/page');
        $cPage[0]->renderPage($this->id, $this->tabsEntities, $this->getOwner());
    }

    /**
     * Performs the AJAX validation.
     * @param SActiveRecord $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'page-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}