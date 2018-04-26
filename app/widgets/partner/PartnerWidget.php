<?php

/**
 * Class PartnerWidget
 *
 * @property Page $model
 *
 * @author Lapshin Evgeny (Jonikru) <info@laco.pro>
 * @copyright 2013-2016 Laco
 * @link http://laco.pro
 */
class PartnerWidget extends CWidget
{
    public $model;

    public function init()
    {
        if (!$this->model) {
            $this->model = Page::model()->findByPk(3);
        }
    }

    public function run()
    {
        $this->render('index');
    }
}