<?php

/**
 * Class MoreLinkWidget
 *
 * @author Lapshin Evgeny (Jonikru) <info@laco.pro>
 * @copyright 2013-2016 Laco
 * @link http://laco.pro
 */
class MoreLinkWidget extends CWidget
{
    public $url;
    public $return = false;

    public function run()
    {
        return $this->render('index', array(), $this->return);
    }
}