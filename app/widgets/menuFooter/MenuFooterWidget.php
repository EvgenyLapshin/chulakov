<?php

/**
 * Class MenuFooterWidget
 *
 * @property int $activeId, id текущего документа
 *
 * @author Lapshin Evgeny (Jonikru) <info@laco.pro>
 * @copyright 2013-2016 Laco
 * @link http://laco.pro
 */
class MenuFooterWidget extends CWidget
{
    public $activeId = 0;

    public function run()
    {
        $criteria = new CDbCriteria();
        $criteria->addInCondition('t.id', array(3,15,16));
        $criteria->order = 'FIELD(t.id,3,15,16)';
        $about = Page::model()->findAll($criteria);

        $services = Page::model()->findByPk(4);

        $criteria = new CDbCriteria();
        $criteria->addInCondition('t.id', array(14,13));
        $criteria->order = 'FIELD(t.id,14,13)';
        $pressCenter = Page::model()->findAll($criteria);

        $this->render('index', array(
            'about' => $about,
            'services' => $services,
            'pressCenter' => $pressCenter,
        ));
    }
}