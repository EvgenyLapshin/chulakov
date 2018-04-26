<?php

class PageController extends FrontendController
{
    public function actionIndex()
    {
        if ($alias = app()->request->getParam('alias')) {
            $model = Page::model()->with('rTemplate')->find('BINARY t.alias = :alias AND t.is_published = 1', array(':alias' => $alias));
        } else {
            $model = Page::model()->with('rTemplate')->findByPk(1);
        }

        if (!$model) {
            throw new CHttpException(404, 'Unable to find the requested object.');
        }

        $this->activeMenuItem = $model->alias;
        $this->setSeoFields($model);

        $this->render($model->rTemplate->name . '/index', array(
            'model' => $model
        ));
    }

    public function actionGSearch()
    {
        if (isset($_POST['keywords']) && $_POST['keywords'])
            Yii::app()->request->redirect('http://www.google.com/search?sitesearch=' . $_SERVER['HTTP_HOST'] . '&q=' . $_POST['keywords']);
        elseif (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'])
            Yii::app()->request->redirect($_SERVER['HTTP_REFERER']);
        else
            $this->redirect('index');
    }
}