<?php

/**
 * Class CatalogController
 *
 * @property Page $page
 * @property string $viewType
 */
class CatalogController extends FrontendController
{
    const VIEW_TYPE_CARD = 'card';
    const VIEW_TYPE_LIST = 'list';

    public $defaultAction = 'all';
    public $_viewType;

    public function actionAll($alias = '')
    {
        if ($alias) {
            $category = CatalogCategory::model()->sPublished()->find('BINARY t.alias = :alias', array(':alias' => $alias));
            if (!$category) {
                throw new CHttpException(404, 'Unable to find the requested object.');
            }
        } else {
            $category = new CatalogCategory();
        }

        /** @var CatalogFilterForm $form */
        $form = $this->getValidatedFormModel('CatalogFilterForm', app()->request->getParam('CatalogFilterForm', array()));
        $form->category = $category;

        if (app()->request->isAjaxRequest) {
            $this->renderCategoryAjax($form);
        } else {
            $this->renderCategory($form);
        }
    }

    /**
     * @param $form CatalogFilterForm
     */
    protected function renderCategoryAjax($form)
    {
        $dataProvider = $form->search();
        $pager = $this->getPager($dataProvider);

        $loop = $this->renderPartial($this->viewType . '/_loop', array(
            'loop' => $dataProvider->getData(),
            'dataProvider' => $dataProvider
        ), true);

        echo json_encode(array('items' => $loop, 'pager' => $pager));
        app()->end();
    }

    /**
     * @param CatalogFilterForm $form
     */
    protected function renderCategory($form)
    {
        $pager = $this->getPager($form->dataProvider);

        if ($form->category->isNewRecord) {
            $this->setSeoFields($form->category->page);
        } else {
            $this->setSeoFields($form->category);
        }

        $this->render('index', array(
            'form' => $form,
            'pager' => $pager
        ));
    }

    /**
     * Get more link
     *
     * @param ActiveDataProvider|InfiniteActiveDataProvider $dataProvider
     * @return mixed|string
     * @throws CException
     */
    protected function getPager($dataProvider)
    {
        return $this->renderPartial('pager', array('dataProvider' => $dataProvider), true);
    }

    public function actionProduct($alias)
    {
        $criteria = new CDbCriteria;
        if (user()->getIsGuest()) {
            $criteria->scopes = array('sPublished');
        }
        $criteria->compare('BINARY t.alias', $alias);
        if (user()->getIsGuest()) {
            $criteria->compare('rCatalogCategory.is_published', 1);
        }

        $criteria->with = 'rCatalogCategory';

        $model = CatalogProduct::model()->find($criteria);
        if (!$model) {
            throw new CHttpException(404, 'Unable to find the requested object.');
        }
        CatalogProduct::model()->updateCounters(array('view_count' => 1), 'id = :id', array(':id' => $model->id));

        $this->setSeoFields($model);
        $this->title = $model->name . ' купить у производителя – Галерея Химии';

        $files = $model->getBlocks(13);
        $info = $model->getBlocks(14);

        $this->render('product', array(
            'model' => $model,
            'files' => $files,
            'info' => $info,
            'backUrl' => $this->getBackUrl()
        ));
    }

    /**
     * Получить ссылку назад
     *
     * @return string
     * @throws CException
     */
    public function getBackUrl()
    {
        $url = url('catalog');
        if (!empty($_SERVER['HTTP_REFERER']))
            if (strpos($_SERVER['HTTP_REFERER'], '/catalog') && !strpos($_SERVER['HTTP_REFERER'], '/catalog/product'))
                $url = $_SERVER['HTTP_REFERER'];

        return $url;
    }

    public function getViewType()
    {
        return $this->_viewType ?: $this->setViewType();
    }

    public function setViewType()
    {
        if (app()->request->getParam('viewType') === self::VIEW_TYPE_LIST) {
            $this->_viewType = self::VIEW_TYPE_LIST;
        } else {
            $this->_viewType = self::VIEW_TYPE_CARD;
        }

        return $this->_viewType;
    }

    public function isViewCardType()
    {
        return $this->viewType === self::VIEW_TYPE_CARD;
    }

    public function getViewCardUrl($dataProvider)
    {
        if ($this->isViewCardType()) {
            $url = $dataProvider->pagination->getCurrentPageUrl($this);
        } else {
            $_GET['viewType'] = self::VIEW_TYPE_CARD;
            $url = $dataProvider->pagination->getCurrentPageUrl($this);
            unset($_GET['viewType']);
        }

        return $url;
    }

    public function getViewListUrl($dataProvider)
    {
        if ($this->isViewCardType()) {
            $_GET['viewType'] = self::VIEW_TYPE_LIST;
            $url = $dataProvider->pagination->getCurrentPageUrl($this);
            unset($_GET['viewType']);
        } else {
            $url = $dataProvider->pagination->getCurrentPageUrl($this);
        }

        return $url;
    }
}