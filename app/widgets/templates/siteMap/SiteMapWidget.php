<?php

class SiteMapWidget extends CWidget
{
    public function init()
    {
        $mPageList = Page::model()->findAll(array('order' => 'root,lft', 'with' => array('template')));
        $level = 0;
        foreach ($mPageList as $mPage) {

            if ($mPage->level == $level)
                echo CHtml::closeTag('li') . "\n";
            else if ($mPage->level > $level)
                echo CHtml::openTag('ul') . "\n";
            else {
                echo CHtml::closeTag('li') . "\n";

                for ($i = $level - $mPage->level; $i; $i--) {
                    echo CHtml::closeTag('ul') . "\n";
                    echo CHtml::closeTag('li') . "\n";
                }
            }

            echo CHtml::openTag('li');
            if ($mPage->template->to_display) {
                echo CHtml::openTag('a', array('href' => $mPage->url));
                echo CHtml::encode($mPage->title);
                echo CHtml::closeTag('a');
            } else {
                echo CHtml::encode($mPage->title);
            }


            $level = $mPage->level;
        }

        for ($i = $level; $i; $i--) {
            echo CHtml::closeTag('li') . "\n";
            echo CHtml::closeTag('ul') . "\n";
        }
    }

    public function run()
    {
        // этот метод будет вызван внутри CBaseController::endWidget()
    }

}