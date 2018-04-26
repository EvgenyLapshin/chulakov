<?php

class CatalogProductController extends AController
{
    public function actions()
    {
        return array(
            'editColumn' => array(
                'class' => 'materialize.components.MEditableColumnAction',
                'modelName' => 'CatalogProduct'
            ),
            'uploadFile' => array(
                'class' => 'laco.uploader.ModelUploaderAction',
                'modelName' => 'CatalogProduct'
            ),
            'deleteFile' => array(
                'class' => 'laco.uploader.ModelUploaderDeleteAction',
                'modelName' => 'CatalogProduct'
            )
        );
    }

    public function actionCreate($catalog_category_id)
    {
        $model = new CatalogProduct;

        $this->performAjaxValidation($model);
        $model->rCatalogCategory = $this->loadModel('CatalogCategory', $catalog_category_id);
        $model->catalog_category_id = $model->rCatalogCategory->id;

        if (isset($_POST['CatalogProduct'])) {
            $model->attributes = $_POST['CatalogProduct'];
            $model->save();
            if (!$model->hasErrors()) {
                if (button()->isSaveButton()) {
                    $this->redirect(array('/admin/catalogCategory/update', 'id' => $model->rCatalogCategory->id));
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
        /** @var CatalogProduct $model */
        $model = $this->loadModel('CatalogProduct', $id);

        $this->performAjaxValidation($model);

        if (isset($_POST['CatalogProduct'])) {
            $model->attributes = $_POST['CatalogProduct'];
            $model->save();
            if (!$model->hasErrors() && button()->isSaveButton()) {
                $this->redirect(array('/admin/catalogCategory/update', 'id' => $model->rCatalogCategory->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionIndex()
    {
        $model = new CatalogProduct('search');
        $model->unsetAttributes();
        if (isset($_GET['CatalogProduct'])) {
            $model->attributes = $_GET['CatalogProduct'];
        }

        $this->render('index', array(
            'model' => $model
        ));
    }

    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            $this->loadModel('CatalogProduct', $id)->delete();

            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }
}