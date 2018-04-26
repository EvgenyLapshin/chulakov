<?php

/**
 * Class ArticleController
 */
class ArticleController extends FrontendController
{
    public $pageSize = 5;
    public $defaultAction = 'all';

    public function actionAll($alias = '')
    {
        $category = $this->getCategory($alias);

        if (app()->request->isAjaxRequest) {
            $this->renderCategoryAjax($category);
        } else {
            $this->renderCategory($category);
        }
    }

    protected function getCategory($alias = '')
    {
        if ($alias && $alias != 'all') {
            $category = ArticleCategory::model()->sPublished()->find('BINARY t.alias = :alias', array(':alias' => $alias));
            if (!$category) {
                throw new CHttpException(404, 'Unable to find the requested object.');
            }
        } else {
            $category = new ArticleCategory();
        }

        return $category;
    }

    protected function renderCategoryAjax($category)
    {
        $dataProvider = $this->getDataProvider($category);
        $pager = $this->getPager($dataProvider);

        $loop = $this->renderPartial('_loop', array(
            'loop' => $dataProvider->getData(),
            'dataProvider' => $dataProvider
        ), true);

        echo json_encode(array('items' => $loop, 'pager' => $pager));
        app()->end();
    }

    /**
     * @param ArticleCategory $category
     */
    protected function renderCategory($category)
    {
        $dataProvider = $this->getDataProvider($category);
        $pager = $this->getPager($dataProvider);

        if ($category->isNewRecord) {
            $this->setSeoFields($category->page);
        } else {
            $this->setSeoFields($category);
        }


        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'category' => $category,
            'pager' => $pager
        ));
    }

    protected function getDataProvider($category)
    {
        $modelClass = 'Article';
        $params = array(
            'criteria' => $this->getCriteriaByCategory($category),
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

    protected function getCriteriaByCategory($category)
    {
        $filter = app()->request->getParam('filter', array());
        $criteria = Article::searchFrontend($category, $filter);

        return $criteria;
    }

    /**
     * Get pager
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
            $criteria->scopes = 'sPublished';
        }
        $criteria->compare('BINARY t.alias', $alias);
        $criteria->with = 'rCategory:sPublished';

        $model = Article::model()->find($criteria);
        if (!$model) {
            throw new CHttpException(404, 'Unable to find the requested object.');
        }
        Article::model()->updateCounters(array('view_count' => 1), 'id = :id', array(':id' => $model->id));

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
        $url = url('article');
        if (!empty($_SERVER['HTTP_REFERER'])) {
            if (strpos($_SERVER['HTTP_REFERER'], '/article') && !strpos($_SERVER['HTTP_REFERER'], '/article/view')) {
                $url = $_SERVER['HTTP_REFERER'];
            }
        }

        return $url;
    }
}