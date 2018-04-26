<?php

/**
 * This is the model class for table "block_template".
 *
 * The followings are the available columns in table 'block_template':
 * @property string $id
 * @property string $name
 * @property string $entity_name
 * @property string $entity_template_name
 * @property string $entity_template_id
 * @property integer $limit_blocks
 * @property string $type
 * @property integer $block_template_order
 *
 * The followings are the available model relations:
 * @property SActiveRecord $entityTemplate
 * @property BlockField[] $rBlockFields
 *
 * @property Block[] $blocks
 */
class BlockTemplate extends SActiveRecord
{
    const TYPE_TABLE = 'table';
    const TYPE_GALLERY = 'gallery';

    public $countBlocks = 0;
    public $_entityTemplate = array();
    private $_blocks = array();

    public function tableName()
    {
        return 'block_template';
    }

    public function behaviors()
    {
        return array(
            'sortable' => array(
                'class' => 'MSortableBehavior',
                'sortColumnName' => 'block_template_order',
                'parentColumnName' => 'entity_template_id'
            )
        );
    }

    public function rules()
    {
        return array(
            array('name, entity_name', 'required'),
            array('limit_blocks, block_template_order', 'numerical', 'integerOnly' => true),
            array('limit_blocks, block_template_order', 'length', 'max' => 6),
            array('name, entity_name, entity_template_name', 'length', 'max' => 50),
            array('type', 'in', 'range' => array_keys(self::getTypeList())),
            array('entity_template_id', 'validatorExistEntityTemplateId'),

            array('entity_name, entity_template_id', 'safe', 'on' => 'search'),
        );
    }

    public function validatorExistEntityTemplateId()
    {
        if (!$this->entity_template_name) return;

        if (!$this->entity_template_id) {
            $this->addError($this->entity_template_id, 'Шаблон сущности не указан.');
        }

        /** @var SActiveRecord $template */
        $template = new $this->entity_template_name;
        if (!$template->findByPk($this->entity_template_id)) {
            $this->addError($this->entity_template_id, 'Такого шаблона сущности не существует.');
        }
    }

    public function relations()
    {
        return array(
            'rBlockFields' => array(self::HAS_MANY, 'BlockField', 'block_template_id'),
        );
    }

    public function beforeDelete()
    {
        foreach (Block::model()->with('rBlockTemplate')->findAll('t.block_template_id = ' . $this->id) as $mBlock) {
            $mBlock->delete();
        }

        foreach (BlockField::model()->findAll('t.block_template_id = ' . $this->id) as $mField) {
            $mField->delete();
        }

        return parent::beforeDelete();
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Название',
            'entity_name' => 'Название модели сущности',
            'entity_template_name' => 'Название модели шаблона сущности',
            'entity_template_id' => 'Шаблон сущности',
            'limit_blocks' => 'Количество блоков (0 - неограниченно)',
            'type' => 'Тип',
            'block_template_order' => 'Сортировка'
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('entity_name', $this->entity_name, true);
        $criteria->compare('entity_template_id', $this->entity_template_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => false
        ));
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function getEntityTemplate($refresh = false)
    {
        if (!$this->_entityTemplate || $refresh)
            $this->setEntityTemplate();

        return $this->_entityTemplate;
    }

    public function setEntityTemplate()
    {
        /** @var SActiveRecord $templateName */
        $templateName = $this->entity_template_name;
        if (!$templateName) return;
        $this->_entityTemplate = $templateName::model()->findByPk($this->entity_template_id);
    }

    public function getBlocks()
    {
        return $this->_blocks;
    }

    public function setBlocks($entityId)
    {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array(
                't.block_template_id' => $this->id,
                't.entity_id' => $entityId
        ));
        $criteria->order = 't.block_order ASC';

        $this->_blocks = Block::model()->findAll($criteria);

        $this->countBlocks = count($this->_blocks);
    }

    /**
     * Получить список типов и их лейблов
     * @return array
     */
    public static function getTypeList()
    {
        return array(
            self::TYPE_TABLE => 'Таблица',
            self::TYPE_GALLERY => 'Галерея'
        );
    }

    /**
     * Получить лейбл типа
     *
     * @param $typeId
     * @return string
     */
    public static function getTypeLabel($typeId)
    {
        $label = 'Неверный тип';
        $list = self::getTypeList();
        if (array_key_exists($typeId, $list))
            $label = $list[$typeId];

        return $label;
    }

    /**
     * Проверить, можно ли добавить ещё блок.
     *
     * @params integer $entityId
     * @return boolean
     */
    public function canCreateBlock()
    {
        if ($this->limit_blocks) {
            return $this->countBlocks < $this->limit_blocks;
        } else {
            return true;
        }
    }
}
