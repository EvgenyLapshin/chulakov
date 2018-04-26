<?php

/**
 * Class ArticleMenuWidget
 *
 * @property int $currentId, Id текущего документа
 *
 * @author Lapshin Evgeny (Jonikru) <info@laco.pro>
 * @copyright 2013-2016 Laco
 * @link http://laco.pro
 */
class ArticleMenuWidget extends CWidget
{
    public $activeId = 0;

    public function run()
    {
        $list = ArticleCategory::model()->findAll('is_published = 1');
        $all = new ArticleCategory();
        $all->name = 'Все';

        array_unshift($list, $all);

        $this->render('index', array(
            'list' => $list
        ));
    }
}