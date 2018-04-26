<?php

/**
 * This is the model class for table "block".
 *
 * The followings are the available columns in table 'block':
 * @property string $id
 * @property string $entity_id
 * @property string $block_template_id
 * @property integer $block_order
 *
 * The followings are the available model relations:
 * @property Page $page
 * @property BlockTemplate $rBlockTemplate
 * @property BlockField[] $rBlockFieldsWithValue
 * @property BlockFieldValue[] $rValueWithField
 *
 * @mixin ModelUploaderBehavior
 */
class Block extends SActiveRecord
{
    public $dynamicAttributes = array();
    public $dynamicAttributesInfo = array();
    public $isDeleted = 0; // установить флаг, если нужно удалить блок

    public function tableName()
    {
        return 'block';
    }

    public function behaviors()
    {
        return array(
            'uploader' => array(
                'class' => 'laco.uploader.ModelUploaderBehavior'
            )
        );
    }

    public function rules()
    {
        return array(
            array('entity_id, block_template_id', 'required'),
            array('block_order', 'numerical', 'integerOnly' => true),
            array('entity_id, block_template_id', 'length', 'max' => 11),
            array('entity_id', 'validatorExistEntityId'),
            array('block_template_id', 'exist', 'className' => 'BlockTemplate', 'attributeName' => 'id', 'allowEmpty' => false),
            array('block_order', 'length', 'max' => 6),

            array('entity_id, block_template_id, block_order', 'safe', 'on' => 'search'),
        );
    }

    public function defaultScope()
    {
        return array(
            'with' => 'rValueWithField'
        );
    }

    public function validatorExistEntityId()
    {
        /** @var SActiveRecord $entity */
        $entity = new $this->rBlockTemplate->entity_name;
        if (!$entity->findByPk($this->entity_id))
            $this->addError($this->entity_id, "В модели {$this->rBlockTemplate->entity_name} не найдена запись с id {$this->entity_id}.");
    }

    public function relations()
    {
        return array(
            'rBlockTemplate' => array(self::BELONGS_TO, 'BlockTemplate', 'block_template_id'),
            'rBlockFields' => array(self::HAS_MANY, 'BlockField', array('block_template_id' => 'block_template_id')),
            'rBlockFieldsWithValue' => array(self::HAS_MANY, 'BlockField', array('block_template_id' => 'block_template_id'),
                'with' => array('rBlockFieldValue' => array('on' => 'rBlockFieldValue.block_id = ' . $this->getTableAlias() . '.id')),
                'order' => 'rBlockFieldsWithValue.block_field_order DESC'
            ),
            'rValueWithField' => array(self::HAS_MANY, 'BlockFieldValue', 'block_id', 'with' => 'rBlockField'),
            'rValueWithFieldInner' => array(self::HAS_MANY, 'BlockFieldValue', 'block_id', 'with' => 'rBlockFieldInner', 'joinType' => 'INNER JOIN', 'select' => false)
        );
    }

    public function afterSave()
    {
        $this->includeDynamicAttributes($this->block_template_id);
        $this->saveDynamicAttributes();

        parent::afterSave();
    }

    public function afterFind()
    {
        $this->addDynamicAttributes();
        parent::afterFind();
    }

    public function beforeDelete()
    {
        BlockFieldValue::model()->deleteAll('block_id = ' . $this->id);
        return parent::beforeDelete();
    }

    public function attributeLabels()
    {
        return array_merge(array(
            'id' => 'ID',
            'entity_id' => 'Страница',
            'block_template_id' => 'Шаблон блока',
            'block_order' => 'Сортировка',
        ), $this->getDynamicAttributeLabels());
    }

    public function search()
    {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array(
            't.block_template_id' => $this->block_template_id,
            't.entity_id' => $this->entity_id
        ));

        $criteria->order = 't.block_order ASC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => false
        ));
    }

    public function getGridColumns()
    {
        $columns = array();
        foreach ($this->dynamicAttributesInfo as $attribute) {
            if ($attribute['show_in_grid']) {
                $columns[] = array(
                    'name' => $attribute['label'],
                    'value' => '$data->getGridColumnValue($data, "' . $attribute['name'] . '")',
                    'type' => 'html',
                    'headerHtmlOptions' => array(
                        'data-attribute' => $attribute['name']
                    )
                );
            }
        }

        return $columns;
    }

    /**
     * @param self $model
     * @param string $attribute
     * @return string
     */
    public function getGridColumnValue($model, $attribute)
    {
        if (is_array($model->$attribute)) {
            $attributeInfo = $model->getDynamicAttributeInfo($attribute);
            $data = BlockField::processPossibleValues($attributeInfo['settings'], $attributeInfo['possible_values']);
            $result = array();
            foreach ($model->$attribute as $value) {
                if (array_key_exists($value, $data)) {
                    $result[] = $data[$value];
                }
            }
            $result = implode(', ', $result);
        } elseif ($model->getDynamicAttributeInfo($attribute)['type'] === 'checkbox') {
            if ($model->$attribute) {
                $result = MHtml::icon('done');
            } else {
                $result = MHtml::icon('check_box_outline_blank');
            }
        } elseif ($model->getDynamicAttributeInfo($attribute)['type'] === 'redactor') {
            $value = strip_tags($model->$attribute);
            if (mb_strlen($value) > 43) {
                $result = mb_substr($value, 0, 40, 'UTF-8') . '...';
            } else {
                $result = $value;
            }
        } elseif ($model->getDynamicAttributeInfo($attribute)['type'] === 'image'){
            $result = MHtml::image($model->getImageUrl($attribute, 'thumb'));
        } else {
            $result = strip_tags($model->$attribute);
        }

        return $result;
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function __get($name)
    {
        if ($this->canGetDynamicLanguageAttribute($name)) {
            return $this->getDynamicLanguageAttribute($name);
        } elseif ($this->canGetDynamicAttribute($name)) {
            return $this->getDynamicAttribute($name);
        }

        return parent::__get($name);
    }

    public function __set($name, $value)
    {
        if ($this->canSetDynamicAttribute($name)) {
            $this->setDynamicAttribute($name, $value);
        } else {
            parent::__set($name, $value);
        }
    }

    public function canGetDynamicAttribute($name)
    {
        return array_key_exists($name, $this->dynamicAttributes);
    }

    public function canGetDynamicAttributeInfo($name)
    {
        return array_key_exists($name, $this->dynamicAttributesInfo);
    }

    public function canGetDynamicLanguageAttribute($name)
    {
        $name .= '_' . app()->language;

        return app()->urlManager->multiLanguageEnabled && $this->canGetDynamicAttribute($name) && $this->dynamicAttributesInfo[$name]['is_multi_lang'];
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
        if ($this->canGetDynamicAttribute($name)) {
            return $this->dynamicAttributes[$name];
        }

        return null;
    }

    public function getDynamicAttributeInfo($name)
    {
        if ($this->canGetDynamicAttribute($name)) {
            return $this->dynamicAttributesInfo[$name];
        }

        return null;
    }

    public function getDynamicLanguageAttribute($name)
    {
        $name .= '_' . app()->language;

        if ($this->canGetDynamicAttribute($name)) {
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

    public function canSetDynamicAttribute($name)
    {
        return array_key_exists($name, $this->dynamicAttributes);
    }

    public function setDynamicAttribute($name, $value)
    {
        if ($this->canSetDynamicAttribute($name)) {
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
        if ($this->hasRelated('rValueWithField')) {
            foreach ($this->rValueWithField as $mBlockFieldValue) {
                $mBlockFieldValue->prepareAttributesForUse();
                $attributes = array_merge($mBlockFieldValue->rBlockField->attributes, array('settings' => unserialize($mBlockFieldValue->rBlockField->settings)));
                $this->addDynamicAttribute($attributes, $mBlockFieldValue->value);
            }
        }
    }

    /**
     * Сохранить все значения дополнительных полей
     */
    public function saveDynamicAttributes()
    {
        foreach ($this->dynamicAttributesInfo as $field) {
            $mBlockFieldValue = BlockFieldValue::model()->findByPk(array('block_field_id' => $field['id'], 'block_id' => $this->id));
            if (!$mBlockFieldValue) {
                $mBlockFieldValue = new BlockFieldValue();
                $mBlockFieldValue->block_field_id = $field['id'];
                $mBlockFieldValue->block_id = $this->id;
            }
            $mBlockFieldValue->value = $field['value'];

            if ($mBlockFieldValue->save()) {
                $this->setDynamicAttribute($field['name'], $mBlockFieldValue->value);
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
        if ($mTemplate = BlockTemplate::model()->with('rBlockFields')->findByPk($templateId)) {
            $this->block_template_id = $mTemplate->id;
            foreach ($mTemplate->rBlockFields as $mField)
                $this->addDynamicAttribute($mField->attributes);
        }
    }

    /**
     * Переопределяем в ModelUploaderBehavior метод формирования пути для сохранения файлов
     */
    public function setPathUpload()
    {
        return '/' . $this->rBlockTemplate->entity_name . '/' . $this->entity_id;
    }
}
