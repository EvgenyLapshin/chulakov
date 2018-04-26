<?php

/**
 * Class CopyrightWidget
 *
 * @property int $year, год запуска сайта
 *
 *
 * @author Lapshin Evgeny (Jonikru) <info@laco.pro>
 * @copyright 2013-2016 Laco
 * @link http://laco.pro
 */
class CopyrightWidget extends CWidget
{
    public $year;
    public $company;

    public function init()
    {
        if (!$this->year)
            $this->year = date('Y');

        if (!$this->company)
            $this->company = Yii::app()->name;
    }

    public function run()
    {
        $till = '';
        if (date('Y') != $this->year) {
            $till = ' - ' . date('Y');
        }

        $copyright = $this->company . ' &copy; ' . $this->year . ' ' . $till;
        echo  $copyright;
    }

}