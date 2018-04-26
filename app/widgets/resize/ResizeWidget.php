<?php

/**
 * Class ResizeWidget
 *
 * @property Pagination $pages The pagination information.
 *
 * @author Lapshin Evgeny (Jonikru) <info@laco.pro>
 * @copyright 2013-2016 Laco
 * @link http://laco.pro
 */
class ResizeWidget extends CBasePager
{
    public $header = 'Показывать по';
    public $footer;
    public $route = '';

    public function run()
    {
        $items = $this->generateItems();
        $this->render('index', array('items' => $items));
    }

    protected function generateItems()
    {
        $items = '';
        foreach ($this->pages->pageSizeVariants as $count) {
            $params = array_replace($_GET, array($this->pages->pageSizeVar => $count));

            if (isset($params[$this->pages->pageVar])) {
                unset($params[$this->pages->pageVar]);
            }

            if ($count == $this->pages->pageSize) {
                $items .= $this->render('current', array(
                    'url' => url($this->owner->route, $params),
                    'count' => $count
                ), true);
            } else {
                $items .= $this->render('_item', array(
                    'url' => url($this->owner->route, $params),
                    'count' => $count
                ), true);
            }
        }

        $_GET[$this->pages->pageSizeVar] = $this->pages->pageSize;

        return $items;
    }

    /**
     * Creates the default pagination.
     * This is called by {@link getPages} when the pagination is not set before.
     * @return Pagination the default pagination instance.
     */
    protected function createPages()
    {
        return new Pagination;
    }
}