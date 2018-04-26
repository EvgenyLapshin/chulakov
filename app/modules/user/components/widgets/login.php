<?php
/**
 * Created by Mandarin.
 * @author: dou
 * Date: 10.02.13
 * Time: 16:46
 */
/*
* Всплывающее окошко
*/

class login extends CWidget
{
    /*        public $cssFile = '/css/ui.notify.css';
            public $jsFile = '/js/jquery.notify.min.js';
            public $jsFileCustom = '/js/jquery.notify.custom.js';
            public $data = array();*/

    // этот метод будет вызван внутри CBaseController::beginWidget()
    public function init()
    {

        $this->render('recoverPassword');
        $this->render('login');
        //$this->registerClientScript();
    }

    // этот метод будет вызван внутри CBaseController::endWidget()
    public function run()
    {

    }

    protected function registerClientScript()
    {
        $assets = dirname(__FILE__).DIRECTORY_SEPARATOR.'assets/';
        $assets = Yii::app()->assetManager->publish($assets);
        // …подключаем здесь файлы CSS или JavaScript…
        $cs=Yii::app()->clientScript;
        $cs->registerCssFile($assets.$this->cssFile);
        $cs->registerScriptFile($assets.$this->jsFileCustom,CClientScript::POS_BEGIN );
        $cs->registerScriptFile($assets.$this->jsFile,CClientScript::POS_BEGIN );

    }
}