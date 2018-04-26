<?php

/**
 * This is the model class for table "article_category".
 *
 * The followings are the available columns in table 'article_category':
 * @property string $id
 * @property string $name
 * @property integer $is_published
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
 * @property Article[] $rArticles
 *
 * The followings are the available model scopes:
 * @method ArticleCategory sPublished()
 *
 * The followings are Behaviors:
 * @mixin SeoBehavior
 * @mixin MSortableBehavior
 * @mixin ModelUploaderBehavior
 */
class ArticleCategory extends SActiveRecord
{
    protected $_pageId = 13;

    private $_url;
    private $_absoluteUrl;

    public $t = ''; // Префикс для таблицы

    public function tableName()
    {
        return 'article_category';
    }

    public function behaviors()
    {
        return array(
            'Seo' => array(
                'class' => 'SeoBehavior',
                'title' => 'name'
            ),

            'sortable' => array(
                'class' => 'MSortableBehavior',
                'sortColumnName' => 'sort_order'
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
                    )
                )
            )
        );
    }

    public function rules()
    {
        return array(
            array('name, alias', 'required'),
            array('is_published, sort_order', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 50),
            array('alias, meta_title, meta_keywords, meta_description', 'length', 'max' => 255),
            array('meta_title', 'length', 'max' => 1000),
            array('meta_keywords, meta_description', 'length', 'max' => 3000),
            array('meta_image', 'length', 'max' => 300),

            array('name, is_published, sort_order', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
            'rArticles' => array(self::HAS_MANY, 'Article', 'category_id'),
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
            'is_published' => 'Опубликована?',
            'alias' => 'Alias',
            'meta_title' => 'Meta Title',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
            'meta_image' => 'Meta Image',
            'sort_order' => 'Сортировка',
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('name', $this->name, true);
        $criteria->compare('is_published', $this->is_published);
        $criteria->compare('sort_order', $this->sort_order);

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

        return $this->_url = url('article/all', $params);
    }

    public function getAbsoluteUrl()
    {
        return $this->_absoluteUrl = $this->url ? app()->createAbsoluteUrl('/') . $this->url : '';
    }
}