<?php

/**
 * Created by Mandarin.
 * @author: Nikolay Lapshin (dou)
 * Date: 22.11.12
 * Time: 23:47
 */
class RegisterController extends UController
{
    public $layout = 'application.modules.admin.views.layouts.common';

    /**
     * @return array actions
     */
    public function actions()
    {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
                'foreColor' => 0x0099CC,
            ),
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Регистрация пользователя.
     * Генерация токена для активации
     * Отправка письма активации
     */
    public function actionIndex()
    {
        $model = new RegisterForm();

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'registerForm') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['RegisterForm'])) {
            $model->attributes = $_POST['RegisterForm'];

            // Создаем юзера.
            if ($model->save()) {

                //Сгенерим токен для подтверждения аккаунта и отправим на email
                $token = ConfirmToken::model()->createToken($model->id, 'userRegistration');

                $url = $this->createAbsoluteUrl('activation',
                    array('uid' => $model->id, 'token' => $token->token)
                );
                $message = $this->renderPartial('emailActivation', array('url' => $url), true);

                Yii::app()->mailer->AddAddress($model->email);
                Yii::app()->mailer->Subject = 'Активация на сайте ' . Yii::app()->name;
                Yii::app()->mailer->MsgHTML($message);
                Yii::app()->mailer->Send();

                $this->redirect($this->createAbsoluteUrl('success'));
            }
        }

        if (!Yii::app()->request->isAjaxRequest) {
            $this->render('register', array('model' => $model));
        }
    }

    /**
     * Активация пользователя по ссылке из письма.
     * Проверка токена. Автологин.
     *
     * @param $uid - GET параметр ID пользователя
     * @param $token - GET параметр token
     * @throws CHttpException
     */
    public function actionActivation($uid, $token)
    {
        $token = trim($token);
        $uid = intval($uid);

        $token = ConfirmToken::model()->findToken($uid, 'userRegistration', $token);

        if (empty($token)) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        //Отмечаем найденый токен как подтвержденный
        $token->markAsConfirmed();

        // активируем юзера
        $token->user->status = 'active';
        $token->user->save(false);

        // автологин
        Yii::app()->user->login(UserIdentity::createAuthenticatedIdentity($token->user->id, $token->user->username));

        // идем в профиль пользователя
        $this->redirect('/cabinet');
    }

    /**
     * Говорим что активировались успешно
     */
    public function actionSuccess()
    {
        $this->render('success');
    }
}
