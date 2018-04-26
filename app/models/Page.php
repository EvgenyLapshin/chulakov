<?php

/**
 * This is the model class for table "page".
 *
 * The followings are the available columns in table 'page':
 * @property string $id
 * @property string $page_title
 * @property int $template_id
 * @property boolean $is_published
 * @property string $alias
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $meta_title
 * @property string $meta_image
 * @property int $lft
 * @property int $rgt
 * @property int $level
 * @property int $root
 * @property string $type ('link', 'document')
 * @property string $link, можно указать либо url, либо id документа, на который ведёт ссылка
 * @property string $entity, адрес для редактирования в админке
 * @property string $entity_params, адрес для редактирования в админке
 *
 * @property string $url, Сссылка на текущий продукт (относительная)
 * @property string $absoluteUrl, Сссылка на текущий продукт (абсолютная)
 *
 * The followings are the available model relations:
 * @property PageTemplate $rTemplate
 * @property PageField[] $rFields
 * @property PageField[] $rFieldsWithValue
 * @property PageFieldValue[] $rValuesWithField
 *
 * @property Page[] $children
 * @property Page $parent
 *
 * @method PageField fieldsWithValue()
 *
 * @mixin SeoBehavior
 * @mixin ModelUploaderBehavior
 * @mixin NestedSetsBehavior
 * @mixin BlockBehavior
 */
class Page extends SActiveRecord
{
    const TYPE_DOCUMENT = 'document';
    const TYPE_LINK = 'link';

    public $fieldsValue = array();
    public $parentId;

    private $_url;
    private $_absoluteUrl;

    public $dynamicAttributes = array();
    public $dynamicAttributesInfo = array();

    public function tableName()
    {
        return 'page';
    }

    public function behaviors()
    {
        return array(
            'Seo' => array(
                'class' => 'SeoBehavior',
                'title' => 'page_title'
            ),
            'uploader' => array(
                'class' => 'laco.uploader.ModelUploaderBehavior',
                'attrList' => array(
                    'meta_image' => array(
                        'convertOptions' => array(
                            'thumb' => array('h' => 150),
                            'basic' => array('f' => 'png', 'q' => 95),
                        ),
                        'uploadType' => 'image'
                    ),
                )
            ),
            'NestedSetsBehavior' => array(
                'class' => 'laco.behaviors.NestedSetsBehavior',
                'hasManyRoots' => true
            ),
            'Block' => array(
                'class' => 'BlockBehavior'
            )
        );
    }

    public function rules()
    {
        return array(
            array('template_id', 'unsafe', 'on' => 'update'),
            array('page_title, template_id', 'required'),
            array('is_published', 'boolean', 'falseValue' => 0, 'trueValue' => 1),
            array('template_id', 'exist', 'className' => 'PageTemplate', 'attributeName' => 'id', 'allowEmpty' => false),
            array('page_title, alias, meta_image, link', 'length', 'max' => 255),
            array('meta_title', 'length', 'max' => 1000),
            array('meta_keywords, meta_description', 'length', 'max' => 3000),
            array('entity, entity_params', 'length', 'max' => 50),
            array('alias', 'unique'),
            array('parentId', 'numerical', 'integerOnly' => true),
            array('type', 'in', 'range' => array_keys(self::getTypeList())),
        );
    }

    public function defaultScope()
    {
        return array(
            'with' => 'rValuesWithField'
        );
    }

    public function relations()
    {
        return array(
            'rTemplate' => array(self::BELONGS_TO, 'PageTemplate', 'template_id'),
            'rFields' => array(self::HAS_MANY, 'PageField', array('template_id' => 'template_id')),
            'rFieldsWithValue' => array(self::HAS_MANY, 'PageField', array('template_id' => 'template_id'),
                'with' => array('rFieldValue' => array('on' => 'rFieldValue.page_id = t.id')),
                'order' => 'rFieldsWithValue.position DESC'
            ),
            'rValuesWithField' => array(self::HAS_MANY, 'PageFieldValue', 'page_id', 'with' => 'rField')
        );
    }

    public function afterSave()
    {
        $this->includeDynamicAttributes($this->template_id);
        $this->saveDynamicAttributes();

        return parent::afterSave();
    }

    public function afterFind()
    {
        $this->addDynamicAttributes();
        parent::afterFind();
    }

    public function afterDelete()
    {
        PageFieldValue::model()->deleteAll('page_id = ' . $this->id);
        parent::afterDelete();
    }

    public function attributeLabels()
    {
        return array_merge(array(
            'id' => 'ID',
            'page_title' => 'Название страницы',
            'template_id' => 'Шаблон',
            'is_published' => 'Опубликовать',
            'alias' => 'Alias',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
            'meta_title' => 'Meta Title',
            'parentId' => 'Родительский документ',
            'type' => 'Тип',
            'link' => 'Ссылка для просмотра на фронтенде',
            'entity' => 'Название сущности',
            'entity_params' => 'Параметры при обращении к методу getTabsIndex(). Через запятую.'
        ), $this->getDynamicAttributeLabels());
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => false
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

    public function __get($name)
    {
        if ($this->canGetDynamicLanguageAttribute($name)) {
            return $this->getDynamicLanguageAttribute($name);
        } elseif ($this->hasDynamicAttribute($name)) {
            return $this->getDynamicAttribute($name);
        }

        return parent::__get($name);
    }

    public function __set($name, $value)
    {
        if ($this->hasDynamicAttribute($name)) {
            $this->setDynamicAttribute($name, $value);
        } else {
            parent::__set($name, $value);
        }
    }

    public function canGetDynamicLanguageAttribute($name)
    {
        $name .= '_' . app()->language;

        return app()->urlManager->multiLanguageEnabled && $this->hasAttribute($name) && $this->dynamicAttributesInfo[$name]['is_multi_lang'];
    }

    public function hasAttribute($name)
    {
        if ($this->hasDynamicAttribute($name)) {
            return true;
        } else {
            return parent::hasAttribute($name);
        }
    }

    public function hasDynamicAttribute($name)
    {
        return array_key_exists($name, $this->dynamicAttributes);
    }

    public function getAttributes($names = true)
    {
        $attrList = array();
        foreach ($this->dynamicAttributes as $name => $value) {
            $attrList[$name] = $value;
        }

        return array_merge(parent::getAttributes($names), $attrList);
    }

    public function getDynamicAttribute($name)
    {
        if ($this->hasDynamicAttribute($name)) {
            return $this->dynamicAttributes[$name];
        }

        return null;
    }

    public function getDynamicLanguageAttribute($name)
    {
        $name .= '_' . app()->language;

        if ($this->hasDynamicAttribute($name)) {
            return $this->getDynamicAttribute($name);
        }

        return null;
    }

    public function getDynamicAttributeLabels()
    {
        $dynamicLabels = array();

        foreach ($this->dynamicAttributesInfo as $attribute) {
            $dynamicLabels[$attribute['name']] = $attribute['label'];
        }

        return $dynamicLabels;
    }

    public function setAttributes($values, $safeOnly = true)
    {
        foreach ($values as $name => $value) {
            $this->setDynamicAttribute($name, $value);
        }

        parent::setAttributes($values, $safeOnly = true);
    }

    public function setDynamicAttribute($name, $value)
    {
        if ($this->hasDynamicAttribute($name)) {
            $this->dynamicAttributes[$name] = $this->dynamicAttributesInfo[$name]['value'] = $value;
        }
    }

    /**
     * Добавить дополнительное поле в модель
     * Добавление в настройки Uploader параметров из дополнительных полей
     * Добавление в настройки Uploader параметров из мультиполей
     *
     * @param $field
     * @param $value
     */
    public function addDynamicAttribute($field, $value = '')
    {
        if (!array_key_exists($field['name'], $this->dynamicAttributes)) {
            $this->dynamicAttributesInfo[$field['name']] = $field;
            $this->dynamicAttributesInfo[$field['name']]['value'] = $this->dynamicAttributes[$field['name']] = ($this->isNewRecord) ? $field['default_value'] : $value;

            if (!empty($field['settings']['uploader'])) {
                $this->attrList = array_merge($this->attrList, array($field['name'] => $field['settings']['uploader']));
            }
        }
    }

    public function addDynamicAttributes()
    {
        if ($this->hasRelated('rValuesWithField')) {
            foreach ($this->rValuesWithField as $value) {
                $value->prepareAttributesForUse();
                $attributes = array_merge($value->rField->attributes, array('settings' => unserialize($value->rField->settings)));
                $this->addDynamicAttribute($attributes, $value->value);
            }
        }
    }

    /**
     * Сохранить все значения дополнительных полей
     */
    public function saveDynamicAttributes()
    {
        foreach ($this->dynamicAttributesInfo as $field) {
            $mFieldValue = PageFieldValue::model()->findByPk(array('field_id' => $field['id'], 'page_id' => $this->id));
            if (!$mFieldValue) {
                $mFieldValue = new PageFieldValue();
                $mFieldValue->field_id = $field['id'];
                $mFieldValue->page_id = $this->id;
            }
            $mFieldValue->value = $field['value'];

            if ($mFieldValue->save()) {
                $this->setDynamicAttribute($field['name'], $mFieldValue->value);
            } else {
                $this->addError($field['name'], 'Ошибка при сохранении поля ' . $field['label']);
            }
        }
    }

    /**
     *  Удалить дополнительное поле из модели
     */
    public function removeDynamicAttribute($name)
    {
        if (array_key_exists($name, $this->dynamicAttributes)) {
            unset($this->dynamicAttributes[$name]);
            unset($this->dynamicAttributesInfo[$name]);
        }
    }

    /**
     * Подключить дополнительные поля
     *
     * @param $templateId string
     */
    public function includeDynamicAttributes($templateId)
    {
        if ($mTemplate = PageTemplate::model()->with('rFields')->findByPk($templateId)) {
            $this->template_id = $mTemplate->id;
            foreach ($mTemplate->rFields as $mField) {
                $this->addDynamicAttribute(array_merge($mField->attributes, array('settings' => $mField->settings)));
            }
        }
    }

    /**
     * Получить ссылку на документ
     *
     * @return mixed
     */
    public function getUrl()
    {
        if (!$this->_url)
            $this->setUrl();

        return $this->_url;
    }

    /**
     * Установить ссылку на документ
     */
    public function setUrl()
    {
        $url = '';
        if ($this->type === self::TYPE_DOCUMENT)
            $url = app()->createUrl('/page/index', array('alias' => $this->alias));
        elseif ($this->type === self::TYPE_LINK)
            $url = $this->link;

        return $this->_url = $url;
    }

    public function getAbsoluteUrl()
    {
        return $this->_absoluteUrl = $this->url ? app()->createAbsoluteUrl('/') . $this->url : '';
    }

    /**
     * Получить ссылку на документ по id дока
     *
     * @param $id integer id документа
     * @return mixed
     */
    public function getUrlById($id)
    {
        $model = $this->findByPk($id);
        return $model ? $model->url : null;
    }

    /**
     * Получить лейбл типа
     *
     * @param $typeId
     * @return string
     */
    public function getTypeLabel($typeId)
    {
        $label = 'Неверный тип';
        $list = $this->getTypeList();
        if (array_key_exists($typeId, $list))
            $label = $list[$typeId];

        return $label;
    }

    /**
     * Получить список типов
     *
     * @return array
     */
    public static function getTypeList()
    {
        return array(
            self::TYPE_DOCUMENT => 'Документ',
            self::TYPE_LINK => 'Ссылка'
        );
    }
}