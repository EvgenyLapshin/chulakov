<?php

/**
 * Class SortWidget
 *
 * @property CSort $sorter The sortable information
 *
 * @author Lapshin Evgeny (Jonikru) <info@laco.pro>
 * @copyright 2013-2016 Laco
 * @link http://laco.pro
 */
class SortWidget extends CWidget
{
    public $header = 'Сортировать по';
    public $footer;
    public $cssClass = 'float-left sortable';

    private $_sorter;

    /**
     * Returns the sortable information used by this sorter.
     * @return CSort the sortable information
     */
    public function getSorter()
    {
        if ($this->_sorter === null) {
            $this->_sorter = $this->createSorter();
        }
        return $this->_sorter;
    }

    /**
     * Set the sortable information used by this sorter.
     * @param CSort $sorter
     * @return CSort the sortable information
     */
    public function setSorter($sorter)
    {
        $this->_sorter = $sorter;
    }

    /**
     * Creates the default sorter.
     * This is called by {@link getSorter} when the sortable is not set before.
     * @return CSort the default sortable instance.
     */
    protected function createSorter()
    {
        return new CSort;
    }

    public function run()
    {
        $items = $this->renderItems();
        $this->render('index', array('items' => $items));
    }

    public function renderItems()
    {
        $items = '';
        foreach ($this->getSorter()->attributes as $name => $label) {
            $attribute = $this->getNameAttribute($name, $label);
            $items .= $this->render($this->getViewName($attribute), array(
                'name' => $name,
                'label' => $label,
                'link' => $this->getSorter()->link($attribute)
            ), true);
        }

        return $items;
    }

    public function getNameAttribute($name, $label)
    {
        if (is_integer($name)) {
            $attribute = $label;
        } else {
            $attribute = $name;
        }

        return $attribute;
    }

    public function getViewName($attribute)
    {
        $result = '_item';
        $direction = $this->getSorter()->getDirection($attribute);

        if (isset($direction)) {
            if ($direction) {
                $result .= 'Desc';
            } else {
                $result .= 'Asc';
            }
        }

        return $result;
    }
}