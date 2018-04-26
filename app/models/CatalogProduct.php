<?php

/**
 * This is the model class for table "catalog_product".
 *
 * The followings are the available columns in table 'catalog_product':
 * @property string $id
 * @property string $catalog_category_id
 * @property string $image
 * @property string $name
 * @property string $name_synonym
 * @property string $content
 * @property string $kit
 * @property string $catalog_country_manufacturer_id
 * @property integer $is_published
 * @property integer $view_count
 * @property string $alias
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $meta_image
 * @property integer $sort_order
 *
 * @property string url, сссылка на текущий продукт (относительная)
 * @property string absoluteUrl, сссылка на текущий продукт (абсолютная)
 *
 * The followings are the available model relations:
 * @property CatalogCountryManufacturer $rCatalogCountryManufacturer
 * @property CatalogCategory $rCatalogCategory
 *
 * The followings are Behaviors:
 * @mixin SeoBehavior
 * @mixin BlockBehavior
 * @mixin ModelUploaderBehavior
 *
 * Scopes:
 * @method CatalogProduct sPublished()
 */
class CatalogProduct extends SActiveRecord
{
    private $_url;
    private $_absoluteUrl;

    public function tableName()
    {
        return 'catalog_product';
    }

    public function behaviors()
    {
        return array(
            'Seo' => array(
                'class' => 'SeoBehavior',
                'title' => 'name'
            ),

            'Block' => array(
                'class' => 'BlockBehavior'
            ),

            'uploader' => array(
                'class' => 'laco.uploader.ModelUploaderBehavior',
                'attrList' => array(
                    'image' => array(
                        'convertOptions' => array(
                            'thumb' => array('h' => 150, 'q' => 95, 'f' => 'jpeg'),
                            'basic' => array('w' => 240, 'h' => 161, 'zc' => 1, 'q' => 95, 'f' => 'jpeg')
                        ),
                        'validateRules' => array(
                            'typeAndSize' => array(
                                'allowEmpty' => false,
                                'mimeTypes' => 'image/jpeg,image/png,image/gif',
                                'wrongMimeType' => 'Данный тип файла загружать нельзя'
                            ),
                        ),
                        'uploadType' => 'image'
                    ),
                    'content' => array(
                        'uploadType' => 'redactor'
                    ),
                    'kit' => array(
                        'uploadType' => 'redactor'
                    ),
                    'meta_image' => array(
                        'convertOptions' => array(
                            'thumb' => array('h' => 150),
                            'basic' => array('f' => 'jpeg', 'q' => 95),
                        ),
                        'validateRules' => array(
                            'dimension' => array('maxWidth' => 1980, 'maxHeight' => 1200, 'minWidth' => 200, 'minHeight' => 200)
                        ),
                        'uploadType' => 'image'
                    ),
                )
            )
        );
    }

    public function rules()
    {
        return array(
            array('view_count, is_published, catalog_country_manufacturer_id', 'numerical', 'integerOnly' => true),
            array('catalog_category_id, catalog_country_manufacturer_id', 'length', 'max' => 11),
            array('catalog_country_manufacturer_id', 'default', 'value' => NULL),
            array('catalog_country_manufacturer_id', 'exist', 'className' => 'CatalogCountryManufacturer', 'attributeName' => 'id', 'allowEmpty' => true),
            array('catalog_category_id', 'exist', 'className' => 'CatalogCategory', 'attributeName' => 'id', 'allowEmpty' => false),
            array('image, meta_image', 'length', 'max' => 300),
            array('name, name_synonym, alias', 'length', 'max' => 255),
            array('content, kit', 'safe'),
            array('meta_title', 'length', 'max' => 1000),
            array('meta_description, meta_keywords', 'length', 'max' => 3000),

            array('content, image, catalog_category_id, name, catalog_country_manufacturer_id, is_published', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
            'rCatalogCountryManufacturer' => array(self::BELONGS_TO, 'CatalogCountryManufacturer', 'catalog_country_manufacturer_id'),
            'rCatalogCategory' => array(self::BELONGS_TO, 'CatalogCategory', 'catalog_category_id'),
        );
    }

    public function scopes()
    {
        $alias = $this->getTableAlias();

        return array(
            'sPublished' => array(
                'condition' => $alias . '.is_published = 1',
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'catalog_category_id' => 'Категория',
            'image' => 'Изображение',
            'name' => 'Название',
            'name_synonym' => 'Название (синоним)',
            'content' => 'Содержание',
            'kit' => 'Состав товара',
            'catalog_country_manufacturer_id' => 'Страна производитель',
            'is_published' => 'Опубликован',
            'view_count' => 'Количество просмотров',
            'alias' => 'Alias',
            'meta_title' => 'Meta Title',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
            'meta_image' => 'Meta Image',
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('catalog_category_id', $this->catalog_category_id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('catalog_country_manufacturer_id', $this->catalog_country_manufacturer_id);
        $criteria->compare('view_count', $this->view_count);

        if ($this->is_published === "0") {
            $criteria->addCondition('t.is_published IS NULL OR t.is_published = ""');
        } elseif ($this->is_published === "1") {
            $criteria->addCondition('t.is_published IS NOT NULL AND t.is_published <> ""');
        }

        if ($this->content === "0") {
            $criteria->addCondition('t.content IS NULL OR t.content = ""');
        } elseif ($this->content === "1") {
            $criteria->addCondition('t.content IS NOT NULL AND t.content <> ""');
        }

        if ($this->image === "0") {
            $criteria->addCondition('t.image IS NULL OR t.image = ""');
        } elseif ($this->image == "1") {
            $criteria->addCondition('t.image IS NOT NULL AND t.image <> ""');
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20
            ),
            'sort' => array(
                'defaultOrder' => 't.name ASC'
            )
        ));
    }

    /**
     * @param string $className
     * @return CatalogProduct
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Получить ссылку на документ
     * @return mixed
     */
    public function getUrl()
    {
        if (!$this->_url) {
            $this->setUrl();
        }
        return $this->_url;
    }

    /**
     * Установить ссылку на документ
     */
    public function setUrl()
    {
        return $this->_url = url('catalog/product/', array('alias' => $this->alias));
    }

    public function getAbsoluteUrl()
    {
        return $this->_absoluteUrl = $this->url ? app()->createAbsoluteUrl('/') . $this->url : '';
    }

    public function getBreadCrumbs()
    {
        $list = $this->rCatalogCategory->getAncestorsBreadcrumbs();
        $this->rCatalogCategory->addPageCatalogBreadCrumbs($list);
        $this->rCatalogCategory->addCurrentCategoryBreadCrumbs($list, true);
        $list[] = array('title' => $this->name);

        return $list;
    }

    public function getData()
    {
        return array(
            'id' => $this->id,
            'name' => $this->name,
            'url' => $this->absoluteUrl,
        );
    }

    public function getJsonData()
    {
        return CHtml::encode(json_encode($this->getData(), JSON_NUMERIC_CHECK));
    }
}