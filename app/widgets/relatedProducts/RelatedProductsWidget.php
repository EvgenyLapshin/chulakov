<?php

/**
 * Class RelatedProductsWidget
 *
 * @property CatalogProduct $model, товар для которого подобрать похожие товары
 *
 * @author Lapshin Evgeny (Jonikru) <info@laco.pro>
 * @copyright 2013-2016 Laco
 * @link http://laco.pro
 */
class RelatedProductsWidget extends CWidget
{
    public $model;

    public function run()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('t.id <> ' . $this->model->id);
        $criteria->compare('catalog_category_id', $this->model->rCatalogCategory->id);
        $criteria->scopes = array('sPublished');
        $criteria->limit = 12;

        $list = CatalogProduct::model()->findAll($criteria);

        $this->render('index', array(
            'list' => $list
        ));
    }
}