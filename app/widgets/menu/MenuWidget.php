<?php

/**
 * Class MenuWidget
 *
 * @property int $activeId, id текущего документа
 *
 * @author Lapshin Evgeny (Jonikru) <info@laco.pro>
 * @copyright 2013-2016 Laco
 * @link http://laco.pro
 */
class MenuWidget extends CWidget
{
    public $activeId = 0;
    public $activeParentId = 0;

    public function run()
    {
        $criteria = new CDbCriteria();
        $criteria->addInCondition('t.id', array(3,4,14,13,16));
        $criteria->order = 'FIELD(t.id,3,4,14,13,16)';
        $list = Page::model()->resetScope()->findAll($criteria);

        $catalog = Page::model()->resetScope()->findByPk(19);

        $this->render('index', array(
            'list' => $list,
            'catalog' => $catalog
        ));
    }

    public function generateCatalogMenu()
    {
        $output = '';
        $list = CatalogCategory::model()->findAll(array('order' => 'root,lft'));
        $level = 0;

        foreach ($list as $model) {

            if ($model->level == $level) {
                $output .= CHtml::closeTag('li') . "\n";
            } elseif ($model->level > $level) {
                $params = array();
                if ($level === 0) {
                    $params = array('class' => 'catalog-nav-menu');
                }
                $output .= CHtml::openTag('ul', $params) . "\n";
            } else {
                $output .= CHtml::closeTag('li') . "\n";

                for ($i = $level - $model->level; $i; $i--) {
                    $output .= CHtml::closeTag('ul') . "\n";
                    $output .= CHtml::closeTag('li') . "\n";
                }
            }

            $params = array();
            if ($model->id == 1) {
                $params = array('class' => 'active');
            }
            $output .= CHtml::openTag('li', $params) . "\n";
            $output .= CHtml::openTag('a', array('href' => $model->url));
            $output .= CHtml::encode($model->name);
            $output .= CHtml::closeTag('a') . "\n";

            $level = $model->level;
        }

        for ($i = $level; $i; $i--) {
            $output .= CHtml::closeTag('li') . "\n";
            $output .= CHtml::closeTag('ul') . "\n";
        }

        return $output;
    }
}