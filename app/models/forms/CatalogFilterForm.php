<?php

/**
 * Class CatalogFilterForm
 *
 * @property CActiveDataProvider $searchDataProvider
 * @property CatalogCategory $category
 * @property ActiveDataProvider|InfiniteActiveDataProvider $dataProvider
 *
 * @author Lapshin Evgeny (Jonikru) <info@laco.pro>
 * @copyright 2013-2016 Laco
 * @link http://laco.pro
 */
class CatalogFilterForm extends CFormModel
{
    public $minPrice = 0;
    public $maxPrice = 100000;
    public $isSale;
    public $isStock;
    public $manufacturer = array();

    public $category;

    private $_dataProvider;

    public function rules()
    {
        return array(
            array('minPrice, maxPrice, isSale, isStock', 'numerical', 'integerOnly' => true, 'allowEmpty' => true),
            array('manufacturer', 'validatorManufacturer'),
        );
    }

    public function validatorManufacturer($attribute, $params)
    {
        if (!is_array($this->{$attribute})) {
            $this->addError($attribute, 'Производители должны передоваться в массиве.');
        }

        foreach ($this->{$attribute} as $key => $value) {
            if (!CatalogCountryManufacturer::model()->countByAttributes(array('id' => $value))) {
                unset($this->{$attribute}[$key]);
                $this->addError($attribute, 'Неправльное значение в поле Производитель.');
            }
        }
    }

    public function attributeLabels()
    {
        return array(
            'minPrice' => 'Минимальная цена',
            'maxPrice' => 'Максимальная цена',
            'isSale' => 'Только акционный товар',
            'isStock' => 'Есть на складе',
            'manufacturer' => 'Производитель',
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria();
        $criteria->compare('catalog_category_id', $this->category->getDescendantsIds());
        $criteria = $this->applyFilter($criteria);

        $modelClass = 'CatalogProduct';
        $params = array(
            'criteria' => $criteria,
            'sort' => array(
                'attributes' => array(
                    'name'
                ),
                'defaultOrder' => 't.name ASC'
            ),
            'pagination' => array(
                'defaultPageSize' => 12,
                'pageSizeVariants' => array(12, 24, 48)
            )
        );

        if (app()->request->isAjaxRequest) {
            $dataProvider = new InfiniteActiveDataProvider($modelClass, $params);
        } else {
            $dataProvider = new ActiveDataProvider($modelClass, $params);
        }

        $dataProvider->getData();

        return $dataProvider;
    }

    /**
     * Get criteria for front-end CatalogProduct
     *
     * @param CDbCriteria $criteria
     * @return CDbCriteria
     */
    public function applyFilter($criteria)
    {
        $criteria->distinct = true;

        if ($this->manufacturer) {
            $criteria->addInCondition('catalog_country_manufacturer_id', $this->manufacturer);
        }

        $criteria->scopes[] = 'sPublished';

        return $criteria;
    }

    public function getManufacturerList()
    {
        $criteria = new CDbCriteria();

        $criteria->distinct = true;

        $criteria->compare('rCatalogProducts.catalog_category_id', $this->category->getDescendantsIds());

        $productScopes = array('sPublished');

        $criteria->with = array('rCatalogProducts' => array('scopes' => $productScopes));

        return CatalogCountryManufacturer::model()->sPublished()->findAll($criteria);
    }

    /**
     * @return ActiveDataProvider|InfiniteActiveDataProvider
     */
    public function getDataProvider()
    {
        if (!$this->_dataProvider) {
            $this->setDataProvider($this->search());
        }
        return $this->_dataProvider;
    }

    /**
     * @param $dataProvider ActiveDataProvider|InfiniteActiveDataProvider
     */
    public function setDataProvider($dataProvider)
    {
        $this->_dataProvider = $dataProvider;
    }
}