<?php

/**
 * This is the model class for table "block_field_value".
 *
 * The followings are the available columns in table 'block_field_value':
 * @property string $block_field_id
 * @property string $block_id
 * @property string $value
 *
 * The followings are the available model relations:
 * @property Block $rBlock
 * @property BlockField $rBlockField
 * @property BlockField $rBlockFieldInner
 */
class BlockFieldValue extends SActiveRecord
{

    public function tableName()
    {
        return 'block_field_value';
    }

    public function rules()
    {
        return array(
            array('block_id', 'exist', 'className' => 'Block', 'attributeName' => 'id', 'allowEmpty' => false),
            array('block_field_id', 'exist', 'className' => 'BlockField', 'attributeName' => 'id', 'allowEmpty' => false),
            array('value', 'safe'),

            array('block_field_id, block_id', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
            'rBlock' => array(self::BELONGS_TO, 'Block', 'block_id'),
            'rBlockField' => array(self::BELONGS_TO, 'BlockField', 'block_field_id'),
            'rBlockFieldInner' => array(self::BELONGS_TO, 'BlockField', 'block_field_id', 'joinType' => 'INNER JOIN', 'select' => false),
        );
    }

    public function attributeLabels()
    {
        return array(
            'block_field_id' => 'Поле',
            'block_id' => 'Блок',
            'value' => 'Значение',
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('block_field_id', $this->block_field_id);
        $criteria->compare('block_id', $this->block_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => false
        ));
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function beforeValidate()
    {
        $this->prepareAttributesForSave();
        return parent::beforeValidate();
    }

    public function afterSave()
    {
        $this->prepareAttributesForUse();
        parent::afterSave();
    }

    public function afterFind()
    {
        $this->prepareAttributesForUse();
        parent::afterFind();
    }

    public function prepareAttributesForSave()
    {
        switch ($this->rBlockField->type)
        {
            case BlockField::TYPE_REDACTOR:
                $this->purifyHTML();
                break;
            case BlockField::TYPE_CHECKBOX_LIST:
                $this->jsonEncode();
                break;
        }
    }

    public function prepareAttributesForUse()
    {
        if ($this->rBlockField->type === BlockField::TYPE_CHECKBOX_LIST) {
            $this->jsonDecode();
        }
    }

    public function jsonEncode()
    {
        if (!$this->value) {
            $this->value = array();
        }
        $this->value = json_encode($this->value);
    }

    public function jsonDecode()
    {
        if (is_string($this->value)) {
            $this->value = json_decode($this->value);
        }
    }

    public function purifyHTML()
    {
        $purifier = new CHtmlPurifier;
        $purifier->options = array(
            'AutoFormat.Linkify' => false,
            'AutoFormat.RemoveEmpty' => true,
            'HTML.SafeEmbed' => true,
            'HTML.TidyLevel' => 'none',
            'Filter.YouTube' => true,
            'CSS.AllowedFonts' => array(),
            'CSS.ForbiddenProperties' => array(
                'color',
                'background',
                'background-color',
                'background-image',
                'font-size',
                'font-family'
            )
        );

        $this->value = $purifier->purify($this->value);
    }
}
