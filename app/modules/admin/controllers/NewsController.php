<?php

class NewsController extends AController
{
    public function actions()
    {
        return array(
            'editColumn' => array(
                'class' => 'materialize.components.MEditableColumnAction',
                'modelName' => 'News'
            ),
            'uploadFile' => array(
                'class' => 'laco.uploader.ModelUploaderAction',
                'modelName' => 'News'
            ),
            'deleteFile' => array(
                'class' => 'laco.uploader.ModelUploaderDeleteAction',
                'modelName' => 'News'
            ),
        );
    }

    public function actionCreate()
    {
        $model = new News;

        $this->performAjaxValidation($model);

        if (isset($_POST['News'])) {
            $model->attributes = $_POST['News'];
            $model->save();
            if (!$model->hasErrors()) {
                if (button()->isSaveButton()) {
                    $this->redirect(array('/admin/page/update', 'id' => $model->page->id));
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
        /** @var News $model */
        $model = $this->loadModel('News', $id);

        $this->performAjaxValidation($model);

        if (isset($_POST['News'])) {
            $model->attributes = $_POST['News'];
            $model->save();
            if (!$model->hasErrors() && button()->isSaveButton()) {
                $this->redirect(array('/admin/page/update', 'id' => $model->page->id));
            }
        }

        $this->render('update', array(
            'model' => $model
        ));
    }

    public function actionIndex()
    {
        $model = $this->getIndexModel();

        $this->render('index', array(
            'model' => $model
        ));
    }

    public function getTabsIndex()
    {
        $model = $this->getIndexModel();

        return array(
            array(
                'label' => 'Список',
                'content' => $this->renderPartial('_tabIndex', array('model' => $model), true),
                'active' => true
            )
        );
    }

    public function getIndexModel()
    {
        $model = new News('search');
        $model->unsetAttributes();
        if (isset($_GET['News'])) {
            $model->attributes = $_GET['News'];
        }
        return $model;
    }

	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest) {
			$this->loadModel('News', $id)->delete();

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
        /** @var News $model */
        if ($model = $this->loadModel('News', $id)) {
            $model->status = News::STATUS_DELETED;
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
        /** @var News $model */
        if ($model = $this->loadModel('News', $id)) {
            $model->status = News::STATUS_PENDING;
            $model->save();
        }

        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : $_SERVER['HTTP_REFERER']);
        }
    }
}