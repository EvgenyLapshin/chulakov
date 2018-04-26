<?php

class ArticleController extends AController
{
    public function actions()
    {
        return array(
            'editColumn' => array(
                'class' => 'materialize.components.MEditableColumnAction',
                'modelName' => 'Article'
            ),
            'uploadFile' => array(
                'class' => 'laco.uploader.ModelUploaderAction',
                'modelName' => 'Article'
            ),
            'deleteFile' => array(
                'class' => 'laco.uploader.ModelUploaderDeleteAction',
                'modelName' => 'Article'
            ),
        );
    }

    public function actionCreate($category_id)
    {
        $model = new Article;

        $this->performAjaxValidation($model);
        $model->rCategory = $this->loadModel('ArticleCategory', $category_id);
        $model->category_id = $model->rCategory->id;

        if (isset($_POST['Article'])) {
            $model->attributes = $_POST['Article'];
            $model->save();
            if (!$model->hasErrors()) {
                if (button()->isSaveButton()) {
                    $this->redirect(array('/admin/articleCategory/update', 'id' => $model->rCategory->id));
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
        /** @var Article $model */
        $model = $this->loadModel('Article', $id);

        $this->performAjaxValidation($model);

        if (isset($_POST['Article'])) {
            $model->attributes = $_POST['Article'];
            $model->save();
            if (!$model->hasErrors() && button()->isSaveButton()) {
                $this->redirect(array('/admin/articleCategory/update', 'id' => $model->rCategory->id));
            }
        }

        $this->render('update', array(
            'model' => $model
        ));
    }

    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            $this->loadModel('Article', $id)->delete();

            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    /**
     * Set status deleted. Only role 'admin'.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     *
     * @param integer $id the ID of the model to be deleted
     * @throws CHttpException
     */
    public function actionSetStatusDeleted($id)
    {
        /** @var Article $model */
        if ($model = $this->loadModel('Article', $id)) {
            $model->status = Article::STATUS_DELETED;
            $model->save();
        }

        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : $_SERVER['HTTP_REFERER']);
        }
    }

    /**
     * Set status pending. Only role 'admin'.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     *
     * @param integer $id the ID of the model to be pending
     * @throws CHttpException
     */
    public function actionSetStatusPending($id)
    {
        /** @var Article $model */
        if ($model = $this->loadModel('Article', $id)) {
            $model->status = Article::STATUS_PENDING;
            $model->save();
        }

        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : $_SERVER['HTTP_REFERER']);
        }
    }
}