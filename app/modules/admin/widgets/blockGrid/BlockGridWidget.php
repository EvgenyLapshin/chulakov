<?php

class BlockGridWidget extends CWidget
{
    public $entity_name;
    public $entity_template_name;
    public $entity_template_id;

    public function run()
    {
        if (!user()->isAdmin) {
            return;
        }

        $mBlockTemplate = new BlockTemplate('search');
        $mBlockTemplate->unsetAttributes();
        if (isset($_GET['BlockTemplate'])) {
            $mBlockTemplate->attributes = $_GET['BlockTemplate'];
        }

        $mBlockTemplate->entity_name = $this->entity_name;
        $mBlockTemplate->entity_template_name = $this->entity_template_name;
        $mBlockTemplate->entity_template_id = $this->entity_template_id;

        $this->render('index', array(
            'mBlockTemplate' => $mBlockTemplate
        ));
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