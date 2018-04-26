<?php

/**
 * Class ActionsMenuWidget
 *
 * @property int $currentId, Id текущего документа
 */
class ActionsMenuWidget extends CWidget
{
    public $activeId = 0;

    public function run()
    {
        $list = CategoryAction::model()->findAll('is_published = 1');
        $all = new CategoryAction();
        $all->name = 'Все';

        array_unshift($list, $all);

        $this->render('index', array(
            'list' => $list
        ));
    }

}