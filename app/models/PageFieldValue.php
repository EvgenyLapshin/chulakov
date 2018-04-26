<?php

/**
 * This is the model class for table "page_field_value".
 *
 * The followings are the available columns in table 'page_field_value':
 * @property string $field_id
 * @property string $page_id
 * @property string $value
 *
 * @property PageField $rField
 */
class PageFieldValue extends SActiveRecord
{
    public function tableName()
    {
        return 'page_field_value';
    }

    public function rules()
    {
        return array(
            array('field_id', 'exist', 'className' => 'PageField', 'attributeName' => 'id', 'allowEmpty' => false),
            array('page_id', 'exist', 'className' => 'Page', 'attributeName' => 'id', 'allowEmpty' => false),
            array('value', 'safe'),
        );
    }

    public function relations()
    {
        return array(
            'rField' => array(self::BELONGS_TO, 'PageField', 'field_id'),
            'rPage' => array(self::BELONGS_TO, 'Page', 'page_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'field_id' => 'Поле',
            'page_id' => 'Страница',
            'value' => 'Значение',
        );
    }

    /**
     * @param string $className
     * @return self
     */
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
        switch ($this->rField->type)
        {
            case PageField::TYPE_REDACTOR:
                $this->purifyHTML();
                break;
            case PageField::TYPE_CHECKBOX_LIST:
                $this->jsonEncode();
                break;
        }
    }

    public function prepareAttributesForUse()
    {
        if ($this->rField->type === PageField::TYPE_CHECKBOX_LIST) {
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