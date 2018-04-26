<?php

/**
 * @author Lapshin Evgeny
 * @copyright 2012-2015 Laco
 * @link http://loco.ru/materials/247-yii-search-using-zend-lucene
 */
class SearchController extends FrontendController
{
    /**
     * @var string index dir as alias path from <b>application.</b>  , default to <b>runtime.search</b>
     */
    private $_indexFiles = 'runtime.search';

    public function init()
    {
        Yii::import('app.vendor.*');
        require_once('Zend/Search/Lucene.php');

        setlocale(LC_CTYPE, 'ru_RU.UTF-8');
        Zend_Search_Lucene_Search_QueryParser::setDefaultEncoding('utf-8');
        Zend_Search_Lucene_Analysis_Analyzer::setDefault(
            new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8_CaseInsensitive ()
        );

        parent::init();
    }

    /**
     * Search index creation
     */
    public function create()
    {
        if (!settings()->get('searchUpdate'))
            return;

        $index = new Zend_Search_Lucene(Yii::getPathOfAlias('app.' . $this->_indexFiles), true);

        /** Таблица Page */
        $pages = Page::model()->findAll();
        foreach ($pages as $model) {

            $doc = new Zend_Search_Lucene_Document();

            $doc->addField(Zend_Search_Lucene_Field::UnIndexed('title', CHtml::encode($model->page_title, 'UTF-8'), 'UTF-8'));
            $doc->addField(Zend_Search_Lucene_Field::UnIndexed('link', CHtml::encode(mb_strtolower($model->url, 'UTF-8')), 'UTF-8'));
            $content = $this->clean_content(mb_strtolower($model->page_title, 'UTF-8'));
            $doc->addField(Zend_Search_Lucene_Field::Text('content', $content, 'UTF-8'));

            $index->addDocument($doc);

            foreach ($model->dynamicAttributes as $value) {
                $doc = new Zend_Search_Lucene_Document();

                $doc->addField(Zend_Search_Lucene_Field::UnIndexed('title', CHtml::encode($model->page_title, 'UTF-8'), 'UTF-8'));
                $doc->addField(Zend_Search_Lucene_Field::UnIndexed('link', CHtml::encode(mb_strtolower($model->url, 'UTF-8')), 'UTF-8'));
                $content = $this->clean_content(mb_strtolower($value, 'UTF-8'));
                $doc->addField(Zend_Search_Lucene_Field::Text('content', $content, 'UTF-8'));

                $index->addDocument($doc);
            }
        }

        /** Таблица BlockFieldValue */
         $mBlockList = Block::model()->with(array('rBlockTemplate'))->findAll();
         foreach ($mBlockList as $mBlock) {

             // @var SActiveRecord $class
             $class = $mBlock->rBlockTemplate->entity_name;
             $model = $class::model()->findByPk($mBlock->entity_id);
             if (!$model) {
                 continue;
             }

             $title = '';
             if (!empty($model->title)) {
                 $title = $model->title;
             } elseif (!empty($model->page_title)) {
                 $title = $model->page_title;
             } elseif (!empty($model->name)) {
                 $title = $model->name;
             }

             foreach ($mBlock->dynamicAttributes as $value) {
                 $doc = new Zend_Search_Lucene_Document();

                 $doc->addField(Zend_Search_Lucene_Field::UnIndexed('title', CHtml::encode($title, 'UTF-8'), 'UTF-8'));
                 $doc->addField(Zend_Search_Lucene_Field::UnIndexed('link', CHtml::encode(mb_strtolower($model->url, 'UTF-8')), 'UTF-8'));
                 $content = $this->clean_content(mb_strtolower($value, 'UTF-8'));
                 $doc->addField(Zend_Search_Lucene_Field::Text('content', $content, 'UTF-8'));

                 $index->addDocument($doc);
             }
         }

        /** Сущности из конфига */
        foreach (param('search') as $entity) {
            if (empty($entity['relation'])) {
                $list = $entity['class']::model()->findAll();
            } else {
                $list = $entity['class']::model()->with($entity['relation']['name'])->findAll();
            }

            foreach ($list as $model) {
                foreach ($entity['fields'] as $field) {
                    if (empty($entity['relation'])) {
                        $title = $model->$entity['title'];
                        $link = $model->url;
                    } else {
                        $title = $model->$entity['relation']['name']->$entity['relation']['title'];
                        $link = $model->$entity['relation']['name']->url;
                    }

                    $content = $this->clean_content($model->$field, 'UTF-8');

                    $doc = new Zend_Search_Lucene_Document();
                    $doc->addField(Zend_Search_Lucene_Field::UnIndexed('title', CHtml::encode($title, 'UTF-8'), 'UTF-8'));
                    $doc->addField(Zend_Search_Lucene_Field::UnIndexed('link', CHtml::encode($link, 'UTF-8'), 'UTF-8'));
                    $doc->addField(Zend_Search_Lucene_Field::Text('content', CHtml::encode($content, 'UTF-8'), 'UTF-8'));
                    $index->addDocument($doc);
                }
            }
        }

        $index->optimize();
        $index->commit();
    }

    protected function searchProducts($term)
    {
        $criteria = new CDbCriteria;

        $criteria->compare('name', $term, true, 'OR');
        $criteria->compare('name_synonym', $term, true, 'OR');
        $criteria->compare('kit', $term, true, 'OR');
        $criteria->compare('content', $term, true, 'OR');
        $criteria->scopes = array('sPublished');
        $list = CatalogProduct::model()->findAll($criteria);

        return $list;
    }


    protected function searchEvents($term)
    {
        $criteria = new CDbCriteria;

        $criteria->compare('title', $term, true, 'OR');
        $criteria->compare('description', $term, true, 'OR');
        $criteria->compare('content', $term, true, 'OR');

        return array_merge(News::model()->findAll($criteria), Article::model()->findAll($criteria));
    }

    public function actionIndex()
    {
        if (settings()->get('searchUpdate')){
            $this->create();
            settings()->set('searchUpdate', 0);
        }

        $results = array();
        $query = null;
        $events = array();
        $products = array();

        if ($term = Yii::app()->getRequest()->getParam('q', '')) {
            $index = new Zend_Search_Lucene(Yii::getPathOfAlias('app.' . $this->_indexFiles));
            $results = $index->find($term);
            $query = Zend_Search_Lucene_Search_QueryParser::parse($term);

            $events = $this->searchEvents($term);
            $products = $this->searchProducts($term);
        }

        $this->render('index', array(
            'results' => $results,
            'term' => $term,
            'query' => $query,
            'events' => $events,
            'products' => $products
        ));
    }

    /**
     * Function for returning a preview of the content:
     * The preview is the first XXX characters.
     *
     * @param $data
     * @param int $limit
     * @return string
     */
    private function preview_content($data, $limit = 1000)
    {
        return substr($data, 0, $limit) . '...';
    }

    /**
     * Function for stripping junk out of content:
     *
     * @param $data
     * @return string
     */
    private function clean_content($data)
    {
        return strip_tags($data);
    }
}