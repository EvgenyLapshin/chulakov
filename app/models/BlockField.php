<?php

/**
 * This is the model class for table "block_field".
 *
 * The followings are the available columns in table 'block_field':
 * @property string $id
 * @property string $name
 * @property string $label
 * @property string $type
 * @property integer $block_field_order
 * @property string $block_template_id
 * @property string $default_value
 * @property string $possible_values
 * @property integer $is_multi_lang
 * @property string $settings
 * @property string $show_in_grid
 *
 * The followings are the available model relations:
 * @property BlockTemplate $rBlockTemplate
 * @property BlockFieldValue $rValues
 * @property BlockFieldValue $rFieldValue
 * @property Block $rBlocks
 */
class BlockField extends SActiveRecord
{
    const TYPE_INPUT = 'input';
    const TYPE_REDACTOR = 'redactor';
    const TYPE_FILE = 'file';
    const TYPE_TEXT_AREA = 'textArea';
    const TYPE_CHECKBOX = 'checkbox';
    const TYPE_CHECKBOX_LIST = 'checkboxList';
    const TYPE_DROP_DOWN_LIST = 'dropDownList';
    const TYPE_IMAGE = 'image';
    const TYPE_LINK = 'link';
    const TYPE_VIDEO = 'video';
    const TYPE_TABLE = 'table';
    const TYPE_SLIDE = 'slide';
    const TYPE_YANDEX = 'yandex';
    const TYPE_PHONE = 'phone';
    const TYPE_DATE = 'date';
    const TYPE_TIME = 'time';
    const TYPE_DATETIME = 'datetime';

    public $uploader;
    public $resetValues = false; // при редактировании, если нужно сбросить все значения, ранее созранённые в этом поле
    private $_oldBlockTemplateId;

    public function tableName()
    {
        return 'block_field';
    }

    public function behaviors()
    {
        return array(
            'sortable' => array(
                'class' => 'MSortableBehavior',
                'sortColumnName' => 'block_field_order',
                'parentColumnName' => 'block_template_id'
            )
        );
    }

    public function rules()
    {
        return array(
            array('name, label, block_template_id', 'required'),
            array('name, label', 'length', 'max' => 50),
            array('block_template_id', 'exist', 'className' => 'BlockTemplate', 'attributeName' => 'id', 'allowEmpty' => false),
            array('name', 'validatorAttribute'),
            array('type', 'in', 'range' => array_keys(self::getTypeList()), 'allowEmpty' => false),
            array('default_value, possible_values, settings, uploader', 'safe'),
            array('block_field_order, is_multi_lang, block_template_id, show_in_grid', 'numerical', 'integerOnly' => true),
            array('block_field_order', 'length', 'max' => 6),
            array('resetValues', 'boolean'),

            array('block_template_id', 'safe', 'on' => 'search'),
        );
    }


    public function validatorAttribute($attr)
    {
        $model = BlockField::model()->find(
            'block_template_id = :template_id AND name = :name AND id <> :id',
            array(
                ':template_id' => $this->block_template_id,
                ':name' => $this->$attr,
                ':id' => $this->id
            )
        );

        if ($model)
            $this->addError($attr, 'Такое имя, в выбранном шаблоне блока, уже существует.');
    }

    public function relations()
    {
        return array(
            'rBlockTemplate' => array(self::BELONGS_TO, 'BlockTemplate', 'block_template_id'),
            'rValues' => array(self::HAS_MANY, 'BlockFieldValue', 'block_field_id'),
            'rBlockFieldValue' => array(self::HAS_ONE, 'BlockFieldValue', 'block_field_id'),
            'rBlocks' => array(self::HAS_MANY, 'Block', array('block_template_id' => 'block_template_id')),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'template_id' => 'Шаблон',
            'name' => 'Имя',
            'label' => 'Название',
            'type' => 'Тип',
            'position' => 'Позиция',
            'default_value' => 'Значение по умолчанию',
            'possible_values' => 'Возможные значения',
            'is_multi_lang' => 'Это поле мультиязычное',
            'settings' => 'Настройки',
            'block_template_id' => 'Шаблон блока',
            'block_field_order' => 'Сортировка',
            'resetValues' => 'Сбросить значения',
            'show_in_grid' => 'Отображать в гриде?'
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('block_template_id', $this->block_template_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => false
        ));
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function beforeSave()
    {
        $this->prepareSettingsForSave();
        return parent::beforeSave();
    }

    public function afterSave()
    {
        if ($this->_oldBlockTemplateId !== $this->block_template_id) {
            $this->_updateValues();
        }

        if ($this->resetValues) {
            $this->_resetValues();
        }

        $this->prepareSettingsAfterSave();

        parent::afterSave();
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->_oldBlockTemplateId = $this->block_template_id;
        $this->prepareSettingsAfterSave();
    }

    public function beforeDelete()
    {
        BlockFieldValue::model()->deleteAll('block_field_id = ' . $this->id);
        return parent::beforeDelete();
    }

    /**
     * Получить список лейблов типов
     * @return array
     */
    public static function getTypeList()
    {
        return array(
            self::TYPE_INPUT => 'Текстовое поле',
            self::TYPE_REDACTOR => 'Редактор',
            self::TYPE_FILE => 'Файл',
            self::TYPE_IMAGE => 'Изображение',
            self::TYPE_TEXT_AREA => 'TextArea',
            self::TYPE_CHECKBOX => 'Checkbox',
            self::TYPE_CHECKBOX_LIST => 'Checkbox List',
            self::TYPE_DROP_DOWN_LIST => 'Выпадающий список',
            self::TYPE_LINK => 'Ссылка',
            self::TYPE_VIDEO => 'Видео',
            self::TYPE_TABLE => 'Таблица',
            self::TYPE_YANDEX => 'Yandex карта',
            self::TYPE_PHONE => 'Телефон',
            self::TYPE_DATE => 'Дата',
            self::TYPE_TIME => 'Время',
            self::TYPE_DATETIME => 'Дата и время'
        );
    }

    /**
     * Получить лейбл типа
     *
     * @param $name
     * @return string
     */
    public function getTypeLabel($name)
    {
        $label = 'Неверный тип';
        $list = $this->getTypeList($this->rBlockTemplate->type);
        if (array_key_exists($name, $list))
            $label = $list[$name];

        return $label;
    }

    /**
     * При смене шаблона, удаляем старые значения(из модели PageFieldValue) для текущего поля и создаём новые
     * значения для всех страниц(модель Page) пренадлежащих новому шаблону.
     */
    private function _updateValues()
    {
        if (!$this->isNewRecord) {
            BlockFieldValue::model()->deleteAll('block_field_id = :id', array(':id' => $this->id));
        }

        $this->getRelated('rBlocks', $refresh = true);
        foreach ($this->rBlocks as $mBlock) {
            $mBlockFieldValue = new BlockFieldValue();
            $mBlockFieldValue->block_field_id = $this->id;
            $mBlockFieldValue->block_id = $mBlock->id;
            $mBlockFieldValue->value = ($this->default_value) ?: '';
            $mBlockFieldValue->save();
        }
    }

    /**
     * Сбросить все значения, ранее сохранённые у текущего поля
     */
    private function _resetValues()
    {
        $list = BlockFieldValue::model()->findAll('block_field_id = :id', array(':id' => $this->id));
        foreach ($list as $value) {
            $value->value = ($this->default_value) ?: '';
            $value->save();
        }
    }

    /**
     * Распарсить и подготовить к работе свойство settings
     *
     * @param array $settings , настройки поля
     * @param string $possibleValues , возможные значения
     * @return array
     */
    public static function processPossibleValues($settings, $possibleValues)
    {
        $result = array();

        if (!empty($settings['data'])) {
            $result = eval('return ' . $settings['data'] . ';');
        } elseif ($possibleValues) {
            $list = explode('||', $possibleValues);
            foreach ($list as $item) {
                $item = explode('==', $item);
                if (!empty($item[0]) && !empty($item[1])) {
                    $result[$item[0]] = $item[1];
                }
            }
        }

        return $result;
    }

    protected function prepareSettingsForSave()
    {
        if (is_string($this->settings)) {
            $this->settings = eval('return ' . $this->settings . ';');
        }

        $this->settings = serialize($this->settings);
    }

    protected function prepareSettingsAfterSave()
    {
        $this->settings = unserialize($this->settings);
    }
}