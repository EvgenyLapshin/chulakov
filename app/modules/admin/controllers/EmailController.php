<?php

class EmailController extends AController
{
    public function actions()
    {
        return array(
            'editColumn' => array(
                'class' => 'materialize.components.MEditableColumnAction',
                'modelName' => 'Email'
            ),
            'uploadFile' => array(
                'class' => 'laco.uploader.ModelUploaderAction',
                'modelName' => 'Email'
            ),
            'deleteFile' => array(
                'class' => 'laco.uploader.ModelUploaderDeleteAction',
                'modelName' => 'Email'
            )
        );
    }

    public function actionCreate()
    {
        $model = new Email;

        $this->performAjaxValidation($model);

        if (isset($_POST['Email'])) {
            $model->attributes = $_POST['Email'];
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
        /** @var Email $model */
        $model = $this->loadModel('Email', $id);

        $this->performAjaxValidation($model);

        if (isset($_POST['Email'])) {
            $model->attributes = $_POST['Email'];
            $model->save();
            if (!$model->hasErrors() && button()->isSaveButton()) {
                $this->redirect(array('index'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            $this->loadModel('Email', $id)->delete();

            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    public function actionIndex()
    {
        $model = new Email('search');
        $model->unsetAttributes();

        if (isset($_GET['Email']))
            $model->attributes = $_GET['Email'];

        $this->render('index', array(
            'model' => $model,
        ));
    }
}
