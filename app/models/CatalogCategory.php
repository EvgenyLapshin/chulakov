<?php

/**
 * This is the model class for table "catalog_category".
 *
 * The followings are the available columns in table 'catalog_category':
 * @property string $id
 * @property string $name
 * @property integer $is_published
 * @property string $alias
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $meta_image
 * @property string $parent_id
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
 * @property integer $root
 *
 * @property string url, сссылка на текущий продукт (относительная)
 * @property string absoluteUrl, сссылка на текущий продукт (абсолютная)
 *
 * The followings are the available model relations:
 * @property CatalogProduct $rProducts
 * @property CatalogCategory $rParent
 *
 * The followings are the available model scopes:
 * @method CatalogCategory sPublished()
 *
 * The followings are Behaviors:
 * @mixin SeoBehavior
 * @mixin BlockBehavior
 * @mixin ModelUploaderBehavior
 * @mixin NestedSetsBehavior
 */
class CatalogCategory extends SActiveRecord
{
    protected $_pageId = 19;

    private $_url;
    private $_absoluteUrl;

    public function tableName()
    {
        return 'catalog_category';
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
            ),

            'NestedSetsBehavior' => array(
                'class' => 'laco.behaviors.NestedSetsBehavior',
                'hasManyRoots' => true
            )
        );
    }

    public function rules()
    {
        return array(
            array('name', 'required'),
            array('name, alias', 'length', 'max' => 255),
            array('parent_id', 'exist', 'className' => 'CatalogCategory', 'attributeName' => 'id', 'allowEmpty' => true),
            array('is_published', 'boolean', 'falseValue' => 0, 'trueValue' => 1),
            array('meta_image', 'length', 'max' => 300),
            array('meta_title', 'length', 'max' => 1000),
            array('meta_keywords, meta_description', 'length', 'max' => 3000),

            array('id, name, is_published', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
            'rProducts' => array(self::HAS_MANY, 'CatalogProduct', 'catalog_category_id'),
            'rParent' => array(self::BELONGS_TO, 'CatalogCategory', 'parent_id'),
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
            'name' => 'Название',
            'is_published' => 'Опубликована',
            'alias' => 'Alias',
            'meta_title' => 'Meta Title',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
            'meta_image' => 'Meta Image',
            'parent_id' => 'Parent ID',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'level' => 'Level',
            'root' => 'Root',
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('name', $this->name, true);
        $criteria->compare('is_published', $this->is_published);

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
        $params = array();
        if ($this->alias) {
            $params = array('alias' => $this->alias);
        }

        return $this->_url = url('catalog/all', $params);
    }

    public function getAbsoluteUrl()
    {
        return $this->_absoluteUrl = $this->url ? app()->createAbsoluteUrl('/') . $this->url : '';
    }

    public function getBreadCrumbs()
    {
        $list = $this->getAncestorsBreadcrumbs();
        $this->addCurrentCategoryBreadCrumbs($list);
        $this->addPageCatalogBreadCrumbs($list);

        return $list;
    }

    public function getAncestorsBreadcrumbs()
    {
        /** @var self $ancestors [] */
        $ancestors = array();
        if ($this->isLeaf()) {
            $ancestors = $this->ancestors()->findAll();
        }

        $list = array();
        foreach ($ancestors as $model) {
            $list[] = array(
                'title' => $model->name,
                'url' => $model->url
            );
        }

        return $list;
    }

    public function addCurrentCategoryBreadCrumbs(&$list, $url = false)
    {
        if (!$this->getIsNewRecord()) {
            $current['title'] = $this->name;

            if ($url) {
                $current['url'] = $this->url;
            }

            $list[] = $current;
        }
    }

    public function addPageCatalogBreadCrumbs(&$list)
    {
        $catalog = array('title' => $this->page->page_title);
        array_unshift($list, $catalog);
    }

    public static function getListForAC()
    {
        /** @var CatalogCategory[] $list */
        $list = CatalogCategory::model()->findAll();
        $categories = array();
        foreach ($list as $key => $model) {
            $categories[$key] = array(
                'label' => $model->getNameWithParent(),
                'value' => $model->id
            );
        }

        return $categories;
    }

    public function getNameWithParent()
    {
        $parent = $this->parent()->find();
        $name = $this->name;
        if ($parent) {
            $name .= ' (' . $parent->name . ')';
        }

        return $name;
    }

    public function getDescendantsIds()
    {
        /** @var CatalogCategory[] $descendants */
        $descendants = $this->descendants()->findAll();
        $result[] = $this->id;
        foreach ($descendants as $model) {
            $result[] = $model->id;
        }

        return $result;
    }
}