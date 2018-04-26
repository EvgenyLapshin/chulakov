<?php

class SettingsController extends AController
{
    public function actionIndex()
    {
        if (!empty($_POST['Settings'])) {
            if (isset($_POST['Settings']['siteOpen'])) {
                settings()->set('siteOpen', $_POST['Settings']['siteOpen']);
            }

            if (isset($_POST['Settings']['yandexMetrika'])) {
                settings()->set('yandexMetrika', $_POST['Settings']['yandexMetrika']);
            }

            if (isset($_POST['Settings']['googleAnalytics'])) {
                settings()->set('googleAnalytics', $_POST['Settings']['googleAnalytics']);
            }

            if (isset($_POST['Settings']['comingSoonPageId'])) {
                settings()->set('comingSoonPageId', $_POST['Settings']['comingSoonPageId']);
            }

            if (isset($_POST['Settings']['emailSupport'])) {
                settings()->set('emailSupport', $_POST['Settings']['emailSupport']);
            }

            if (isset($_POST['Settings']['loginForm'])) {
                settings()->set('loginForm', $_POST['Settings']['loginForm']);
            }

            if (button()->isSaveButton()) {
                $this->redirect(array('/admin'));
            }
        }

        $criteria = new CDbCriteria();
        $criteria->addCondition('t.is_published = 1');
        $criteria->addCondition('rTemplate.to_display = 1');
        $criteria->with = array('rTemplate');
        $criteria->together = true;
        $comingSoonPageList = Page::model()->resetScope()->findAll($criteria);

        $this->render('index', array(
            'comingSoonPageList' => $comingSoonPageList
        ));
    }
}