<?php

/**
 * Class NewsWidget
 *
 * @author Lapshin Evgeny (Jonikru) <info@laco.pro>
 * @copyright 2013-2016 Laco
 * @link http://laco.pro
 */
class NewsWidget extends CWidget
{
    public function run()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('status', News::STATUS_PUBLISHED);
        $criteria->order = 't.pub_date DESC';
        $criteria->limit = 4;

        $list = News::model()->findAll($criteria);

        $this->render('index', array(
            'list' => $list
        ));
    }
}