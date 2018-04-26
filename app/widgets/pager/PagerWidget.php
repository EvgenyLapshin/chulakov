<?php

/**
 * Class PagerWidget
 *
 * @author Lapshin Evgeny (Jonikru) <info@laco.pro>
 * @copyright 2013-2016 Laco
 * @link http://laco.pro
 */
class PagerWidget extends CBasePager
{
    public $view = 'index';
    public $itemView = 'item';
    public $currentView = 'current';
    public $prevView = 'prev';
    public $nextView = 'next';
    public $firstView = '';
    public $lastView = '';

    /**
     * @var integer maximum number of page buttons that can be displayed. Defaults to 10.
     */
    public $maxButtonCount = 10;

    public function run()
    {
        $this->generatePager();
    }

    protected function generatePager()
    {
        if (($pageCount = $this->getPageCount()) <= 1) {
            return;
        }

        $this->render($this->view, array(
            'first' => $this->generateFirstPage(),
            'prev' => $this->generatePrevPage(),
            'items' => $this->generateInternalPages(),
            'next' => $this->generateNextPage(),
            'last' => $this->generateLastPage(),
        ));
    }

    protected function generateFirstPage()
    {
        $first = '';
        if ($this->firstView) {
            $first = $this->renderPage(0, $this->firstView);
        }

        return $first;
    }

    protected function generatePrevPage()
    {
        $prev = '';
        if ($this->prevView) {
            if (($page = $this->currentPage - 1) < 0) {
                $page = 0;
            }
            $prev = $this->renderPage($page, $this->prevView);
        }

        return $prev;
    }

    protected function generateInternalPages()
    {
        list($beginPage, $endPage) = $this->getPageRange();

        $items = '';
        for ($i = $beginPage; $i <= $endPage; ++$i) {
            $items .= ($i == $this->currentPage)
                ? $this->renderPage($i, $this->currentView)
                : $this->renderPage($i, $this->itemView);
        }

        return $items;
    }

    protected function generateNextPage()
    {
        $next = '';
        if ($this->nextView) {
            if (($page = $this->currentPage + 1) > $this->pageCount) {
                $page = 0;
            }
            $next = $this->renderPage($page, $this->nextView);
        }

        return $next;
    }

    protected function generateLastPage()
    {
        $last = '';
        if ($this->lastView) {
            $last = $this->renderPage($this->pageCount - 1, $this->lastView);
        }

        return $last;
    }

    /**
     * Creates a page button.
     * You may override this method to customize the page buttons.
     * @param integer $page the page number
     * @param string $view
     * @return string the generated button
     */
    protected function renderPage($page, $view)
    {
        return $this->render($view, array(
            'page' => $page,
            'url' => $this->createPageUrl($page - 1)
        ), true);
    }

    /**
     * @return array the begin and end pages that need to be displayed.
     * @author Qiang Xue <qiang.xue@gmail.com>
     */
    protected function getPageRange()
    {
        $currentPage = $this->getCurrentPage() + 1;
        $pageCount = $this->getPageCount();

        $beginPage = max(1, $currentPage - (int)($this->maxButtonCount / 2));
        if (($endPage = $beginPage + $this->maxButtonCount - 1) >= $pageCount) {
            $endPage = $pageCount;
            $beginPage = max(1, $endPage - $this->maxButtonCount + 1);
        }
        return array($beginPage, $endPage);
    }
}