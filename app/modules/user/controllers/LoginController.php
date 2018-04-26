<?php

/**
 * Created by Mandarin.
 * @author: Nikolay Lapshin (dou)
 * Date: 22.11.12
 * Time: 21:51
 */
class LoginController extends UController
{
    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'users' => array('*'),
            )
        );
    }

    /**
     * Displays the login page
     */
    public function actionIndex()
    {
        $this->layout = 'application.modules.admin.views.layouts.common';

        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'loginForm') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                $this->redirect(app()->user->returnUrl);
            }
        }

        if (!Yii::app()->request->isAjaxRequest) {
            $this->render('login', array('model' => $model));
        }
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}