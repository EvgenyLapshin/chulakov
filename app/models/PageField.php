<?php

/**
 * This is the model class for table "page_field".
 *
 * При создании нового поля, мы привязываем его к шаблону и создаем пустое значение в таблице PageFieldValue для всех
 * страниц (модель Page), принадлежащих данному шаблону.
 *
 * The followings are the available columns in table 'page_field':
 * @property string $id
 * @property string $template_id
 * @property string $name
 * @property string $attribute
 * @property string $type
 * @property int $position
 * @property int $is_multi_lang
 * @property string $default_value
 * @property string $possible_values
 * @property array $settings
 *
 * The followings are the available model relations:
 * @property PageTemplate $rTemplate
 * @property PageFieldValue $rValues
 * @property PageFieldValue $rFieldValue
 * @property Page $rPages
 */
class PageField extends SActiveRecord
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
    const TYPE_YANDEX = 'yandex';
    const TYPE_PHONE = 'phone';
    const TYPE_DATE = 'date';
    const TYPE_TIME = 'time';
    const TYPE_DATETIME = 'datetime';

    public $resetValues = false; // при редактировании, если нужно сбросить все значения, ранее сохранённые в этом поле
    private $_oldTemplateId;

    public function tableName()
    {
        return 'page_field';
    }

    public function behaviors()
    {
        return array(
            'sortable' => array(
                'class' => 'MSortableBehavior',
                'sortColumnName' => 'position',
                'parentColumnName' => 'template_id'
            )
        );
    }

    public function rules()
    {
        return array(
            array('template_id, label, name', 'required'),
            array('label, name', 'length', 'max' => 50),
            array('template_id', 'exist', 'className' => 'PageTemplate', 'attributeName' => 'id', 'allowEmpty' => false),
            array('name', 'validatorAttribute'),
            array('type', 'in', 'range' => array_keys(self::getTypeList()), 'allowEmpty' => false),
            array('default_value, possible_values, settings, uploader', 'safe'),
            array('position, is_multi_lang, template_id', 'numerical'),
            array('position', 'length', 'max' => 4),
            array('resetValues', 'boolean'),

            array('template_id', 'safe', 'on' => 'search'),
        );
    }

    public function validatorAttribute($attr)
    {
        $model = PageField::model()->find(
            'template_id = :template_id AND name = :name AND id <> :id',
            array(
                ':template_id' => $this->template_id,
                ':name' => $this->$attr,
                ':id' => $this->id
            )
        );

        if ($model) {
            $this->addError($attr, 'Такое имя, в выбранном шаблоне, уже существует.');
        }
    }

    public function relations()
    {
        return array(
            'rTemplate' => array(self::BELONGS_TO, 'PageTemplate', 'template_id'),
            'rValues' => array(self::HAS_MANY, 'PageFieldValue', 'field_id'),
            'rFieldValue' => array(self::HAS_ONE, 'PageFieldValue', 'field_id'),
            'rPages' => array(self::HAS_MANY, 'Page', array('template_id' => 'template_id')),
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
            'resetValues' => 'Сбросить все сохранённые значения'
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('template_id', $this->template_id);
        $criteria->with = array('rTemplate');

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
        if ($this->_oldTemplateId !== $this->template_id) {
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
        $this->_oldTemplateId = $this->template_id;
        $this->prepareSettingsAfterSave();
    }

    public function afterDelete()
    {
        PageFieldValue::model()->deleteAll('field_id = ' . $this->id);
        return parent::afterDelete();
    }

    /**
     * Получить список типов
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
            self::TYPE_YANDEX => 'Яндекс карта',
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
        $list = $this->getTypeList();
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
            PageFieldValue::model()->deleteAll('field_id = :field_id', array(':field_id' => $this->id));
        }

        $this->getRelated('rPages', $refresh = true);
        foreach ($this->rPages as $mPage) {
            $mFieldValue = new PageFieldValue();
            $mFieldValue->field_id = $this->id;
            $mFieldValue->page_id = $mPage->id;
            $mFieldValue->value = ($this->default_value) ?: '';
            $mFieldValue->save();
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
     * Обработать возможные значение для поля
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