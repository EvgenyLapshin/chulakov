<?php

/**
 * This is the model class for table "catalog_country_manufacturer".
 *
 * The followings are the available columns in table 'catalog_country_manufacturer':
 * @property string $id
 * @property string $name
 * @property string $is_published
 *
 * The followings are the available model relations:
 * @property CatalogProduct[] $rCatalogProducts
 *
 * The followings are the available model scopes:
 * @method CatalogCountryManufacturer sPublished()
 */
class CatalogCountryManufacturer extends SActiveRecord
{
    public $t = ''; // Префикс для таблицы

    public function tableName()
    {
        return 'catalog_country_manufacturer';
    }

    public function rules()
    {
        return array(
            array('name', 'length', 'max' => 100),
            array('is_published', 'boolean', 'falseValue' => 0, 'trueValue' => 1),
            array('name', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
            'rCatalogProducts' => array(self::HAS_MANY, 'CatalogProduct', 'catalog_country_manufacturer_id'),
        );
    }

    public function scopes()
    {
        if (!$this->t) {
            $this->t = $this->getTableAlias();
        }

        return array(
            'sPublished' => array(
                'condition' => $this->t . '.is_published = 1',
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Название',
            'is_published' => 'Опубликована',
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('name', $this->name, true);
        $criteria->order = 'name ASC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20
            )
        ));
    }

    /**
     * @param string $className
     * @return self
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}