<?php

class SiteController extends FrontendController
{
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules()
    {
        return array(
            array('allow', 'users' => array('*'))
        );
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            elseif ($error['code'] == 404 && !user()->isAdmin)
                $this->render('404');
            else
                $this->renderPartial('/site/error', $error);
        }
    }

    public function actionJsError()
    {
        Yii::log("\nСтраница: " . app()->request->getParam('url') . "\nОшибка в JS:\n" . app()->request->getParam('log'), 'error', 'js');
    }

    public function actionSubscribe()
    {
        $form = $this->getValidatedFormModel('SubscribeForm');
        if (!$form->hasErrors()) {
            Email::sendForm($form);
        }

        response()->showResponse();
    }

    public function actionFeedback()
    {
        $form = $this->getValidatedFormModel('FeedbackForm');
        if (!$form->hasErrors()) {
            Email::sendForm($form);
        }

        response()->showResponse();
    }

    public function actionService()
    {
        $form = $this->getValidatedFormModel('ServiceForm');
        if (!$form->hasErrors()) {
            Email::sendForm($form);
        }

        response()->showResponse();
    }

    public function actionRequestDetails()
    {
        $form = $this->getValidatedFormModel('RequestDetailsForm');
        if (!$form->hasErrors()) {
            Email::sendForm($form);
        }

        response()->showResponse();
    }

    public function actionAskQuestion()
    {
        $form = $this->getValidatedFormModel('AskQuestionForm');
        if (!$form->hasErrors()) {
            Email::sendForm($form);
        }

        response()->showResponse();
    }

    public function actionManager()
    {
        $form = $this->getValidatedFormModel('ManagerForm');
        if (!$form->hasErrors()) {
            Email::sendForm($form);
        }

        response()->showResponse();
    }

    public function actionPreOrder()
    {
        $form = $this->getValidatedFormModel('PreOrderForm');
        if (!$form->hasErrors()) {
            Email::sendForm($form);
        }

        response()->showResponse();
    }

    public function actionForDirector()
    {
        $form = $this->getValidatedFormModel('ForDirectorForm');
        if (!$form->hasErrors()) {
            Email::sendForm($form);
        }

        response()->showResponse();
    }
}