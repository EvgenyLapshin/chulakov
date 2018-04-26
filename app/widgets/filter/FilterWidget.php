<?php

/**
 * Class FilterWidget
 *
 * @author Lapshin Evgeny (Jonikru) <info@laco.pro>
 * @copyright 2013-2016 Laco
 * @link http://laco.pro
 */
class FilterWidget extends CWidget
{
    public $category;
    public $model;
    public $listFilters;

    public function init()
    {
        if (!$this->model) {
            $this->listFilters =  Article::getYearsWhitMonths($this->category);
        } else {
            $model = $this->model;
            $this->listFilters =  $model::getYearsWhitMonths();
        }
    }

    public function run()
    {
        $selections = app()->request->getParam('filter', array());
        $this->render('index', array(
            'selections' => $selections
        ));
    }
}