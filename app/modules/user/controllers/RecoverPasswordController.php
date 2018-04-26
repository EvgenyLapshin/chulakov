<?php

/**
 * Created by Mandarin.
 * @author: dou
 * Date: 01.03.13
 * Time: 5:50
 */
class RecoverPasswordController extends UController
{
    public $layout = 'application.modules.admin.views.layouts.common';

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
     * Запрос на восстановление пароля
     * Генерит токен и отправляет письмо со ссылкой активации
     */
    public function actionIndex()
    {

        $model = new RecoverPasswordForm('recoverRequest');

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'RecoverPasswordForm') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['RecoverPasswordForm'])) {
            $model->attributes = $_POST['RecoverPasswordForm'];
            // validate user input and redirect to the previous page if valid
            if (!$model->validate()) {
                Yii::app()->end();
            }

            $user = $model->getUser();

            $token = ConfirmToken::model()->createToken($user->id, 'recoverPassword');

            $url = $this->createAbsoluteUrl('confirm', array('uid' => $user->id, 'token' => $token));

            $message = $this->renderPartial('emailPasswordRecover', array('url' => $url), true);

            mailer()->AddAddress($model->email);
            mailer()->Subject = 'Восстановление пароля на сайте ' . Yii::app()->name;
            mailer()->MsgHTML($message);
            mailer()->Send();

            $this->render('checkMailbox', array('model' => $model));
            Yii::app()->end();
        }

        if (!Yii::app()->request->isAjaxRequest) {
            $this->render('recover', array('model' => $model));
        }
    }

    /**
     * Подтверждение смены пароля
     * Сюда попадаем по ссылке из письма
     * Если все хорошо, то редирект на экшн смены пароля
     */
    public function actionConfirm($uid, $token)
    {
        $token = trim($token);
        $uid = intval($uid);

        $token = ConfirmToken::model()->findToken($uid, 'recoverPassword', $token);
        if (empty($token)) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        $token->markAsConfirmed();

        // автологин
        user()->login(UserIdentity::createAuthenticatedIdentity($token->user->id, $token->user->username));

        //Отметим, что юзер может поменять пароль
        $token->user->saveAttributes(array('requires_new_password' => 1));
        $this->redirect($this->createUrl('changePassword'));
    }

    /**
     * Смена пароля.
     * Возможно только после перехода по ссылке восстановления пароля
     */
    public function actionChangePassword()
    {
        if (user()->isGuest) {
            throw new CHttpException(400, 'Invalid request  ٩(͡๏̯͡๏)۶');
        }

        if (!user()->model->requires_new_password) {
            throw new CHttpException(400, 'Invalid request  ٩(͡๏̯͡๏)۶');
        }

        $model = new RecoverPasswordForm('changePassword');

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'changePasswordForm') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['RecoverPasswordForm'])) {
            $model->attributes = $_POST['RecoverPasswordForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate()) {
                user()->model->newPassword = $model->password;
                user()->model->passwordConfirm = $model->passwordConfirm;
                user()->model->requires_new_password = 0;
                user()->model->save();

                $this->redirect($this->createUrl('changePasswordSuccess'));
            }
        }

        $this->render('changePasswordForm', array('model' => $model));
    }

    /**
     * Говорим что успешно поменяли пароль
     */
    public function actionChangePasswordSuccess()
    {
        $this->render('changePasswordSuccess');
    }
}