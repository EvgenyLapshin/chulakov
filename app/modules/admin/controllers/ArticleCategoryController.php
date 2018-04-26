<?php

class ArticleCategoryController extends AController
{
    public function actions()
    {
        return array(
            'editColumn' => array(
                'class' => 'materialize.components.MEditableColumnAction',
                'modelName' => 'ArticleCategory'
            ),
            'uploadFile' => array(
                'class' => 'laco.uploader.ModelUploaderAction',
                'modelName' => 'ArticleCategory'
            ),
            'deleteFile' => array(
                'class' => 'laco.uploader.ModelUploaderDeleteAction',
                'modelName' => 'ArticleCategory'
            ),
            'sortable' => array(
                'class' => 'materialize.components.MSortableAction',
                'modelName' => 'ArticleCategory'
            )
        );
    }

	public function actionCreate()
	{
		$model = new ArticleCategory;

        $this->performAjaxValidation($model);

		if (isset($_POST['ArticleCategory'])) {
			$model->attributes = $_POST['ArticleCategory'];
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
        /** @var  $model ArticleCategory */
		$model = $this->loadModel('ArticleCategory',$id);

		 $this->performAjaxValidation($model);

		if (isset($_POST['ArticleCategory'])) {
			$model->attributes = $_POST['ArticleCategory'];
            $model->save();
            if (!$model->hasErrors() && button()->isSaveButton()) {
                $this->redirect(array('/admin/page/update', 'id' => $model->page->id));
            }
		}

        $article = new Article('search');
        $article->unsetAttributes();
        if (isset($_GET['Article'])) {
            $article->attributes = $_GET['Article'];
        }
        $article->category_id = $model->id;
        $this->render('update', array(
            'model' => $model,
            'article' => $article
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
        $model = new ArticleCategory('search');
        $model->unsetAttributes();
        if (isset($_GET['ArticleCategory'])) {
            $model->attributes = $_GET['ArticleCategory'];
        }

        return $model;
    }

    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            $this->loadModel('ArticleCategory', $id)->delete();

            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }
}