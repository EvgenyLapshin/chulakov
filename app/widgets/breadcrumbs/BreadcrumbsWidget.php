<?php

/**
 * Class BreadcrumbsWidget
 *
 * @property array $list, список вложенностей array('title' => '', 'url' => '')
 *
 * @author Lapshin Evgeny (Jonikru) <info@laco.pro>
 * @copyright 2013-2016 Laco
 * @link http://laco.pro
 */
class BreadcrumbsWidget extends CWidget
{
    public $list = array();

    public function run()
    {
        $this->render('index');
    }
}