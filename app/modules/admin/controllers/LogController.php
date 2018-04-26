<?php

class LogController extends AController
{
    public function actions()
    {
        return array();
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Log;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Log'])) {
            $model->attributes = $_POST['Log'];
            if ($model->save()) {
                $this->redirect(array('index'));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel('Log', $id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Log'])) {
            $model->attributes = $_POST['Log'];
            if ($model->save()) {
                $this->redirect(array('index'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model = new Log('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Log'])) {
            $model->attributes = $_GET['Log'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Очистить таблицу с логами
     * @throws CDbException
     */
    public function actionDelete()
    {
        app()->db->createCommand('TRUNCATE ' . Log::model()->tableName())->execute();
        $this->redirect('index');

    }


}