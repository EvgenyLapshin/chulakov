<?php

class CatalogCountryManufacturerController extends AController
{
    public function actions()
    {
        return array(
            'editColumn' => array(
                'class' => 'materialize.components.MEditableColumnAction',
                'modelName' => 'CatalogCountryManufacturer'
            )
        );
    }

    public function actionCreate()
    {
        $model = new CatalogCountryManufacturer;

        $this->performAjaxValidation($model);

        if (isset($_POST['CatalogCountryManufacturer'])) {
            $model->attributes = $_POST['CatalogCountryManufacturer'];
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
            'model' => $model
        ));
    }

    public function actionUpdate($id)
    {
        /** @var CatalogCountryManufacturer $model */
        $model = $this->loadModel('CatalogCountryManufacturer', $id);

        $this->performAjaxValidation($model);

        if (isset($_POST['CatalogCountryManufacturer'])) {
            $model->attributes = $_POST['CatalogCountryManufacturer'];
            $model->save();
            if (!$model->hasErrors() && button()->isSaveButton()) {
                $this->redirect(array('index'));
            }
        }

        $this->render('update', array(
            'model' => $model
        ));
    }

    public function actionIndex()
    {
        $model = new CatalogCountryManufacturer('search');
        $model->unsetAttributes();

        if (isset($_GET['CatalogCountryManufacturer'])) {
            $model->attributes = $_GET['CatalogCountryManufacturer'];
        }

        $this->render('index', array(
            'model' => $model
        ));
    }

    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            $this->loadModel('CatalogCountryManufacturer', $id)->delete();

            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }
}