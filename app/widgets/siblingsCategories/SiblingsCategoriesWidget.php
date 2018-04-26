<?php

/**
 * Class SiblingsCategoriesWidget
 *
 * @property CatalogCategory $model, текущая категория
 *
 * @author Lapshin Evgeny (Jonikru) <info@laco.pro>
 * @copyright 2013-2016 Laco
 * @link http://laco.pro
 */
class SiblingsCategoriesWidget extends CWidget
{
    public $model;

    public function run()
    {
        if ($parent = $this->model->parent()->find()) {
            $list = $parent->children()->findAll();
        } else {
            $list = CatalogCategory::model()->roots()->findAll();
        }

        $this->render('index', array(
            'list' => $list
        ));
    }
}