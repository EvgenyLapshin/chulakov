<?php

/**
 * Class NewsController
 *
 * @property $page Page
 */
class NewsController extends FrontendController
{
    public $pageSize = 5;

    public function actionIndex()
    {
        if (app()->request->isAjaxRequest) {
            $this->renderIndexAjax();
        } else {
            $this->renderIndex();
        }
    }

    protected function renderIndexAjax()
    {
        $dataProvider = $this->getDataProvider();
        $pager = $this->getPager($dataProvider);

        $loop = $this->renderPartial('_loop', array(
            'loop' => $dataProvider->getData(),
            'dataProvider' => $dataProvider
        ), true);

        echo json_encode(array('items' => $loop, 'pager' => $pager));
        app()->end();
    }

    protected function renderIndex()
    {
        $model = new News();

        $dataProvider = $this->getDataProvider();
        $pager = $this->getPager($dataProvider);

        $this->setSeoFields($model->page);

        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'pager' => $pager,
            'model' => $model
        ));
    }

    protected function getDataProvider()
    {
        $modelClass = 'News';
        $params = array(
            'criteria' => $this->getCriteria(),
            'pagination' => array(
                'pageSize' => $this->pageSize
            )
        );

        if (app()->request->isAjaxRequest) {
            $dataProvider = new InfiniteActiveDataProvider($modelClass, $params);
        } else {
            $dataProvider = new ActiveDataProvider($modelClass, $params);
        }

        $dataProvider->getData();

        return $dataProvider;
    }

    protected function getCriteria()
    {
        $filter = app()->request->getParam('filter', array());
        $criteria = News::searchFrontend($filter);

        return $criteria;
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

    public function actionView($alias)
    {
        $criteria = new CDbCriteria;
        if (user()->getIsGuest()) {
            $criteria->compare('t.status', News::STATUS_PUBLISHED);
        }
        $criteria->compare('BINARY t.alias', $alias);

        $model = News::model()->find($criteria);
        if (!$model) {
            throw new CHttpException(404, 'Unable to find the requested object.');
        }
        News::model()->updateCounters(array('view_count' => 1), 'id = :id', array(':id' => $model->id));

        $this->setSeoFields($model);

        $this->render('view', array(
            'model' => $model,
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
        $url = url('news');
        if (!empty($_SERVER['HTTP_REFERER']))
            if (strpos($_SERVER['HTTP_REFERER'], '/news') && !strpos($_SERVER['HTTP_REFERER'], '/news/view'))
                $url = $_SERVER['HTTP_REFERER'];

        return $url;
    }
}