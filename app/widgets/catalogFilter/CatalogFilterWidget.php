<?php

/**
 * Class CatalogFilterWidget
 *
 * @property CatalogFilterForm $form
 *
 * @author Lapshin Evgeny (Jonikru) <info@laco.pro>
 * @copyright 2013-2016 Laco
 * @link http://laco.pro
 */
class CatalogFilterWidget extends CWidget
{
    public $form;

    public function run()
    {
        $this->render('index');
    }
}