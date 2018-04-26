<?php

class PageTemplateController extends AController
{
    public $pageTitle = 'Шаблоны';

    public function actions()
    {
        return array(
            'editColumn' => array(
                'class' => 'materialize.components.MEditableColumnAction',
                'modelName' => 'PageTemplate'
            )
        );
    }

    public function actionCreate()
    {
        $model = new PageTemplate;

        $this->performAjaxValidation($model);

        if (isset($_POST['PageTemplate'])) {
            $model->attributes = $_POST['PageTemplate'];
            $model->save();
            if (!$model->hasErrors()) {
                if (button()->isSaveButton()) {
                    $this->redirect(array('index'));
                } else {
                    $this->redirect(array('update', 'id' => $model->id));
                }
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel('PageTemplate', $id);

        $this->performAjaxValidation($model);

        if (isset($_POST['PageTemplate'])) {
            $model->attributes = $_POST['PageTemplate'];
            $model->save();
            if (!$model->hasErrors() && button()->isSaveButton()) {
                $this->redirect(array('index'));
            }
        }

        $mField = new PageField('search');
        $mField->unsetAttributes();
        if (isset($_GET['PageField'])) {
            $mField->attributes = $_GET['PageField'];
        }

        $mField->template_id = $model->id;

        $pageFieldController = Yii::app()->createController('/admin/pageField');
        $pageFieldController = $pageFieldController[0];

        $this->render('update', array(
            'model' => $model,
            'mField' => $mField,
            'pageFieldController' => $pageFieldController
        ));
    }

    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            $this->loadModel('PageTemplate', $id)->delete();

            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    public function actionIndex()
    {
        $model = new PageTemplate('search');
        $model->unsetAttributes();
        if (isset($_GET['PageTemplate'])) {
            $model->attributes = $_GET['PageTemplate'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }
}