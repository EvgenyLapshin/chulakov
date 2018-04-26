<?php

class ManagerController extends UController
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
                'actions' => array('*'),
                'roles' => array('admin'),
            ),
            array('allow',
                'users' => array('root'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actions()
    {
        return array(
            'editColumn' => array(
                'class' => 'materialize.components.MEditableColumnAction',
                'modelName' => 'UserProfile'
            ),
            'uploadFile' => array(
                'class' => 'laco.uploader.ModelUploaderAction',
                'modelName' => 'UserProfile'
            ),
            'deleteFile' => array(
                'class' => 'laco.uploader.ModelUploaderDeleteAction',
                'modelName' => 'UserProfile'
            )
        );
    }

    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel('User', $id),
        ));
    }

    public function actionCreate()
    {
        $user = new RegisterForm();
        $userProfile = new UserProfile();

        if (isset($_POST['RegisterForm']) && isset($_POST['UserProfile'])) {
            $user->attributes = $_POST['RegisterForm'];
            $userProfile->attributes = $_POST['UserProfile'];

            $transaction = Yii::app()->db->beginTransaction();
            try {
                if (!$user->save()) {
                    throw new Exception();
                }

                $userProfile->user_id = $user->id;
                if (!$userProfile->save()) {
                    throw new Exception();
                }
                $transaction->commit();

                if (!$user->hasErrors() && !$userProfile->hasErrors()) {
                    if (button()->isSaveButton()) {
                        $this->redirect(array('index'));
                    } else {
                        $this->redirect(array('update', 'id' => $user->id));
                    }
                }
            } catch (Exception $e) {
                $transaction->rollback();
            }
        }

        $this->render('create', array(
            'user' => $user,
            'userProfile' => $userProfile
        ));
    }

    public function actionUpdate($id)
    {
        /** @var $user User */
        $user = $this->loadModel('User', $id);
        $userProfile = $user->rProfile;

        if (isset($_POST['UserProfile'])) {
            $userProfile->attributes = $_POST['UserProfile'];
        }

        if (isset($_POST['User'])) {
            $user->attributes = $_POST['User'];
            $user->save();
            $userProfile->save();
            if (!$user->hasErrors() && !$userProfile->hasErrors() && button()->isSaveButton()) {
                $this->redirect(array('index'));
            }
        }

        $this->render('update', array(
            'user' => $user,
            'userProfile' => $userProfile
        ));
    }

    public function actionDelete($id)
    {
        /** @var $model User */
        $model = $this->loadModel('User', $id);
        if ($model->username != 'root' || $model->username != 'admin'){
            $model->status = User::STATUS_DELETE;
            $model->save();
        }

        $this->redirect(array('index'));
    }

    public function actionIndex()
    {
        $model = new User('search');
        $model->unsetAttributes();
        if (isset($_GET['User'])) {
            $model->attributes = $_GET['User'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }
}