<?php

class ProfileController extends FrontendController
{
    public $layout = 'application.modules.admin.views.layouts.common';

    public function actions()
    {
        return array(
            'uploadFile' => array(
                'class' => 'laco.uploader.ModelUploaderAction',
                'modelName' => 'UserProfile'
            )
        );
    }

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules()
    {
        return array(
            array('deny', // deny all guests
                'users' => array('?'),
            ),
            array('allow', // allow all authenticated users
                'users' => array('@'),
            ),
        );
    }

    public function actionCreate()
    {
        $model = new User();
        $this->performAjaxValidation($model->rProfile);
        $this->performAjaxValidation($model, $model->rProfile->formId);

        if (!empty($_POST['User']) && !empty($_POST['UserProfile'])) {
            if ($model->save()) {
                $profile = new UserProfile();
                $profile->user_id = $model->id;
                $profile->save();
                $this->redirect('update');
            }
        }

        $this->render('update', array('model' => $model));
    }

    public function actionUpdate()
    {
        /** @var User $model */
        $model = $this->loadModel('User', Yii::app()->user->id, array('with' => array('profile')));

        $this->performAjaxValidation($model);
        $this->performAjaxValidation($model, $model->formId);

        if (!empty($_POST['User']) && !empty($_POST['UserProfile'])) {

            if (($model->rProfile->soc_id) && (!$model->rProfile->username_is_changed) && ($_POST['User']['username'] != $model->username) ) {
                $model->rProfile->username_is_changed = 1;
            } else {
                unset($_POST['User']['username']);
            }

            $model->attributes = $_POST['User'];
            $model->rProfile->attributes = $_POST['UserProfile'];

            $model->save();
            $model->rProfile->save();
        }

        $model->unsetAttributes(array('password', 'newPassword', 'passwordConfirm'));
        $this->render('update', array('model' => $model));
    }
}