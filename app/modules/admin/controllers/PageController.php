<?php

class PageController extends AController
{
    public $templateId;
    public $parentId;

    public function actions()
    {
        return array(
            'editColumn' => array(
                'class' => 'materialize.components.MEditableColumnAction',
                'modelName' => 'Page'
            ),
            'uploadFile' => array(
                'class' => 'laco.uploader.ModelUploaderAction',
                'modelName' => 'Page'
            ),
            'deleteFile' => array(
                'class' => 'laco.uploader.ModelUploaderDeleteAction',
                'modelName' => 'Page'
            )
        );
    }

    public function init()
    {
        if (!empty($_GET['template']))
            $this->templateId = $_GET['template'];
        elseif (!empty($_POST['Page']['template_id']))
            $this->templateId = $_POST['Page']['template_id'];

        if (!empty($_GET['parent']))
            $this->parentId = $_GET['parent'];
        elseif (!empty($_POST['Page']['parentId']))
            $this->parentId = $_POST['Page']['parentId'];

        parent::init();
    }

    public function actionCreate()
    {
        $model = new Page('create');

        /** @var Page $mParent */
        if ($this->parentId) {
            $mParent = Page::model()->with('rTemplate')->findByPk($this->parentId);
            $model->template_id = $mParent->rTemplate->child_id;
            $model->parentId = $mParent->id;
        }

        if (!$model->template_id) $model->template_id = $this->templateId;
        $model->includeDynamicAttributes($model->template_id);

        $this->performAjaxValidation($model);

        if (isset($_POST['Page'])) {
            $model->attributes = $_POST['Page'];
            if (!empty($mParent->id)) {
                $model->appendTo($mParent);
            } else {
                $model->saveNode();
            }

            if (!$model->hasErrors()) {
                if (button()->isSaveButton()) {
                    $this->redirect(array('/admin'));
                } else {
                    $this->redirect(array('update', 'id' => $model->id));
                }
            }
        }

        $this->render('create', array(
            'model' => $model,
            'tabsEntities' => array()
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->_update($id);
        $tabEntities = array();

        if ($model->entity) {
            $cEntity = app()->createController('/admin/' . $model->entity);
            $tabEntities = $cEntity[0]->getTabsIndex($model->entity_params);
        }

        $this->render('update', array(
            'model' => $model,
            'tabsEntities' => $tabEntities
        ));
    }

    public function renderPage($id, $tabsEntities = array())
    {
        $this->renderPartial('update', array(
            'model' => $this->_update($id),
            'tabsEntities' => $tabsEntities,
        ));
    }

    private function _update($id)
    {
        /** @var Page $model */
        $model = $this->loadModel('Page', $id);

        if ($parent = $model->parent()->find()) {
            $model->parentId = $parent->id;
        }

        $this->performAjaxValidation($model);

        if (isset($_POST['Page'])) {
            $model->attributes = $_POST['Page'];
            $model->saveNode();

            if (!$model->hasErrors() && button()->isSaveButton()) {
                $this->redirect('/admin');
            }
        }

        return $model;
    }

    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            $success = ($this->loadModel('Page', $id)->deleteNode()) ? true : false;

            if (Yii::app()->request->isAjaxRequest) {
                echo json_encode(array('success' => $success));
            } else {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin/index'));
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    public function actionIndex()
    {
        $model = new Page('search');
        $model->unsetAttributes();
        if (isset($_GET['Page'])) {
            $model->attributes = $_GET['Page'];
        }
        $model->template_id = $this->templateId;

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionMove($id)
    {
        $nextId = (!empty($_POST['nextId']) && is_numeric($_POST['nextId'])) ? $_POST['nextId'] : false;
        $prevId = (!empty($_POST['prevId']) && is_numeric($_POST['prevId'])) ? $_POST['prevId'] : false;
        $parentId = (!empty($_POST['parentId']) && is_numeric($_POST['parentId'])) ? $_POST['parentId'] : false;

        /** @var Page $model */
        $model = $this->loadModel('Page', $id);

        if ($prevId) {
            $previous = $this->loadModel('Page', $prevId);
            $model->moveAfter($previous);
        } elseif ($nextId) {
            $next = $this->loadModel('Page', $nextId);
            $model->moveBefore($next);
        } elseif ($parentId) {
            $parent = $this->loadModel('Page', $parentId);
            $model->moveAsFirst($parent);
        } elseif (!$model->isRoot()) //if moved/copied node is not Root)
            $model->moveAsRoot();

        echo json_encode(array('success' => true));
        exit;
    }

    public function actionGetTree()
    {
        self::getTree();
    }

    public static function getTree()
    {
        $output = '';
        /** @var Page[] $mPageList */
        $mPageList = Page::model()->resetScope()->with('rTemplate')->findAll(array('order' => 'root,lft'));
        $level = 0;

        foreach ($mPageList as $mPage) {

            if ($mPage->level == $level) {
                $output .= CHtml::closeTag('li') . "\n";
            } elseif ($mPage->level > $level) {
                $output .= CHtml::openTag('ul') . "\n";
            } else {
                $output .= CHtml::closeTag('li') . "\n";

                for ($i = $level - $mPage->level; $i; $i--) {
                    $output .= CHtml::closeTag('ul') . "\n";
                    $output .= CHtml::closeTag('li') . "\n";
                }
            }

            $data = array(
                'url' => $mPage->url,
                'createChildUrl' => url('/admin/page/create', array('parent' => $mPage->id)),
                'updateUrl' => url('/admin/page/update', array('id' => $mPage->id)),
                'deleteUrl' => url('/admin/page/delete', array('id' => $mPage->id)),
                'moveUrl' => url('/admin/page/move', array('id' => $mPage->id)),
                'icon' => ($mPage->isLeaf()) ? 'jstree-file' : 'jstree-folder',
                'toDisplay' => (bool) $mPage->rTemplate->to_display,
                'createChild' => (user()->isAdmin || (bool) $mPage->rTemplate->child_id)
            );

            $data['selected'] = (app()->request->requestUri === $data['updateUrl']);

            $liHtmlOptions = array(
                'id' => $mPage->id,
                'rel' => $mPage->page_title,
                'data-jstree' => CJSON::encode($data)
            );

            if ($data['selected']) {
                $liHtmlOptions['class'] = 'jstree-active';
            }

            $output .= CHtml::openTag('li', $liHtmlOptions);
            $output .= CHtml::openTag('a', array('href' => '#'));
            $output .= CHtml::encode($mPage->page_title);
            if (user()->isAdmin) {
                $output .= CHtml::openTag('small', array('class' => 'muted'));
                $output .= CHtml::encode(' (' . $mPage->id . ')');
                $output .= CHtml::closeTag('small');
            }
            $output .= CHtml::closeTag('a');

            $level = $mPage->level;
        }

        for ($i = $level; $i; $i--) {
            $output .= CHtml::closeTag('li') . "\n";
            $output .= CHtml::closeTag('ul') . "\n";
        }

        return $output;
    }

    public function actionMEditableColumn()
    {
        if (!Yii::app()->request->isAjaxRequest) {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }

        if (!empty($_POST['class']) || !empty($_POST['attribute']) || isset($_POST['value']) || !empty($_POST['value']) || !empty($_GET['pk'])) {
            $class = $_POST['class'];
            $attribute = $_POST['attribute'];
            $value = filter_var($_POST['value'], FILTER_VALIDATE_BOOLEAN);
            $pk = $_GET['pk'];
        } else {
            throw new CHttpException(400, 'Invalid request. Required params: model, attribute, value, pk.');
        }

        /** @var SActiveRecord $model */
        $model = $class::model()->findByPk($pk);

        if (!$model) {
            throw new CHttpException(404, 'Unable to find the requested object.');
        }

        $model->$attribute = $value;

        if ($model->saveNode()) {
            response()->addResult($attribute, $model->$attribute);
        } else {
            response()->addErrors($model->getErrors());
        }

        response()->showResponse();
    }
}