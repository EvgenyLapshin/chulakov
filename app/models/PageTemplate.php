<?php

/**
 * This is the model class for table "page_template".
 *
 * The followings are the available columns in table 'page_template':
 * @property string $id
 * @property string $title
 * @property boolean $to_display
 * @property string $name
 * @property string $child_id
 *
 * The followings are the available model relations:
 * @property Page[] $rPages
 * @property BlockTemplate[] $rBlockTemplates
 * @property PageField[] $rFields
 */
class PageTemplate extends SActiveRecord
{
    private $_oldTitle;

    public function tableName()
    {
        return 'page_template';
    }

    public function rules()
    {
        return array(
            array('title', 'required'),
            array('title', 'length', 'max' => 255),
            array('to_display', 'boolean', 'falseValue' => 0, 'trueValue' => 1),
            array('child_id', 'default', 'setOnEmpty' => true, 'value' => null),
            array('child_id', 'exist', 'allowEmpty' => true, 'attributeName' => 'id', 'className' => 'PageTemplate'),
        );
    }

    public function relations()
    {
        return array(
            'rPages' => array(self::HAS_MANY, 'Page', 'template_id'),
            'rFields' => array(self::HAS_MANY, 'PageField', 'template_id'),
            'rBlockTemplates' => array(self::HAS_MANY, 'BlockTemplate', 'entity_template_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Название',
            'to_display' => 'Будет ли шаблон отображаться?',
            'name' => 'Уникальное имя шаблона',
            'child_id' => 'Дочерний шаблон'
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;

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
        if ($this->_oldTitle !== $this->title)
            $this->_setName();
        return parent::beforeSave();
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->_oldTitle = $this->title;
    }

    public function afterDelete()
    {
        PageField::model()->deleteAll('template_id = ' . $this->id);
        foreach(Page::model()->findAll('template_id = ' . $this->id) as $mPage) {
            $mPage->deleteNode();
        }

        parent::afterDelete();
    }

    /**
     * Заполнить поле name
     */
    private function _setName()
    {
        $name = $this->name = mb_strtolower(HText::translit($this->title));

        $count = 1;
        while (!$this->_isUniqueName()) {
            $this->name = $name . '_' . $count;
            $count++;
        }

        if ($this->to_display) {
            $this->_createViewDirectory();
        }
    }

    /**
     * Проверить поле name на уникальность
     */
    private function _isUniqueName()
    {
        return (self::find('name = :name AND id != :id', array(':name' => $this->name, ':id' => $this->id))) ? false : true;
    }

    /**
     * Создать каталог (в качестве имени, использовать свойство $this->name) для view-файлов на frontend'е
     */
    private function _createViewDirectory()
    {
        $dir = Yii::getPathOfAlias('application') . '/views/page/' . $this->name;
        if (!is_dir($dir)) {
            mkdir($dir);
        }

        $code = "<?php\n/**\n * @var \$this PageController\n * @var \$model Page\n */\n?>";
        $file = fopen($dir . '/index.php', "w");
        fwrite($file, $code);
        fclose($file);
    }
}
