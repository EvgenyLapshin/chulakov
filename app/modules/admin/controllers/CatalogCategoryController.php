<?php

class CatalogCategoryController extends AController
{
    public function actions()
    {
        return array(
            'editColumn' => array(
                'class' => 'materialize.components.MEditableColumnAction',
                'modelName' => 'CatalogCategory'
            ),
            'uploadFile' => array(
                'class' => 'laco.uploader.ModelUploaderAction',
                'modelName' => 'CatalogCategory'
            ),
            'deleteFile' => array(
                'class' => 'laco.uploader.ModelUploaderDeleteAction',
                'modelName' => 'CatalogCategory'
            ),
        );
    }

	public function actionCreate($parentId = '')
	{
        $model = new CatalogCategory();

        if ($parentId) {
            $model->parent_id = $parentId;
        }

        $this->performAjaxValidation($model);

        if (isset($_POST['CatalogCategory'])) {
            $model->attributes = $_POST['CatalogCategory'];
            if (!empty($model->rParent)) {
                $model->appendTo($model->rParent);
            } else {
                $model->saveNode();
            }

            if (!$model->hasErrors()) {
                if (button()->isSaveButton()) {
                    $this->redirect(array('/admin/page/update', 'id' => $model->page->id));
                } else {
                    $this->redirect(array('update', 'id' => $model->id));
                }
            }
        }

        $this->render('create', array(
            'model' => $model
        ));
	}

	public function actionUpdate($id)
	{
        /** @var  $model CatalogCategory */
		$model = $this->loadModel('CatalogCategory',$id);

		 $this->performAjaxValidation($model);

		if (isset($_POST['CatalogCategory'])) {
			$model->attributes = $_POST['CatalogCategory'];
            $model->saveNode();

            if (!$model->hasErrors() && button()->isSaveButton()) {
                $this->redirect(array('/admin/page/update', 'id' => $model->page->id));
            }
		}

        $catalogProduct = new CatalogProduct('search');
        $catalogProduct->unsetAttributes();
        if (isset($_GET['CatalogProduct'])) {
            $catalogProduct->attributes = $_GET['CatalogProduct'];
        }
        $catalogProduct->catalog_category_id = $model->id;

        $this->render('update', array(
            'model' => $model,
            'catalogProduct' => $catalogProduct
        ));
	}

    public function actionMove($id)
    {
        $nextId = (!empty($_POST['nextId']) && is_numeric($_POST['nextId'])) ? $_POST['nextId'] : false;
        $prevId = (!empty($_POST['prevId']) && is_numeric($_POST['prevId'])) ? $_POST['prevId'] : false;
        $parentId = (!empty($_POST['parentId']) && is_numeric($_POST['parentId'])) ? $_POST['parentId'] : false;

        /** @var Page $model */
        $model = $this->loadModel('CatalogCategory', $id);

        if ($prevId) {
            $previous = $this->loadModel('CatalogCategory', $prevId);
            $model->moveAfter($previous);
        } elseif ($nextId) {
            $next = $this->loadModel('CatalogCategory', $nextId);
            $model->moveBefore($next);
        } elseif ($parentId) {
            $parent = $this->loadModel('CatalogCategory', $parentId);
            $model->moveAsFirst($parent);
        } elseif (!$model->isRoot()) //if moved/copied node is not Root)
            $model->moveAsRoot();

        echo json_encode(array('success' => true));
        exit;
    }

    public function actionIndex()
    {
        $model = $this->getIndexModel();

        $this->render('index', array(
            'model' => $model
        ));
    }

    public function getTabsIndex()
    {
        $model = $this->getIndexModel();

        $catalogCountryManufacturer = new CatalogCountryManufacturer('search');
        $catalogCountryManufacturer->unsetAttributes();
        if (isset($_GET['CatalogCountryManufacturer'])) {
            $catalogCountryManufacturer->attributes = $_GET['CatalogCountryManufacturer'];
        }

        $catalogCountryManufacturerController = app()->createController('/admin/catalogCountryManufacturer');
        /** @var CatalogCountryManufacturerController $catalogCountryManufacturerController */
        $catalogCountryManufacturerController = $catalogCountryManufacturerController[0];

        return array(
            array(
                'label' => 'Категории',
                'content' => $this->renderPartial('_tabIndex', array(
                    'model' => $model
                ), true),
                'active' => true
            ),
            array(
                'label' => 'Производитель',
                'content' => $this->renderPartial('_tabCountryManufacturer', array(
                    'model' => $catalogCountryManufacturer,
                    'controller' => $catalogCountryManufacturerController
                ), true)
            )
        );
    }

    public function getIndexModel()
    {
        $model = new CatalogCategory('search');
        $model->unsetAttributes();
        if (isset($_GET['CatalogCategory'])) {
            $model->attributes = $_GET['CatalogCategory'];
        }

        return $model;
    }

    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            $success = ($this->loadModel('CatalogCategory', $id)->deleteNode()) ? true : false;

            if (Yii::app()->request->isAjaxRequest) {
                echo json_encode(array('success' => $success));
            } else {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin/index'));
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    public function actionEditColumn()
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

    public function actionGetTree()
    {
        self::getTree();
    }

    public static function getTree()
    {
        $output = '';
        $list = CatalogCategory::model()->findAll(array('order' => 'root,lft'));
        $level = 0;

        foreach ($list as $model) {

            if ($model->level == $level) {
                $output .= CHtml::closeTag('li') . "\n";
            } elseif ($model->level > $level) {
                $output .= CHtml::openTag('ul') . "\n";
            } else {
                $output .= CHtml::closeTag('li') . "\n";

                for ($i = $level - $model->level; $i; $i--) {
                    $output .= CHtml::closeTag('ul') . "\n";
                    $output .= CHtml::closeTag('li') . "\n";
                }
            }

            $data = array(
                'url' => $model->url,
                'createChildUrl' => url('/admin/catalogCategory/create', array('parentId' => $model->id)),
                'updateUrl' => url('/admin/catalogCategory/update', array('id' => $model->id)),
                'deleteUrl' => url('/admin/catalogCategory/delete', array('id' => $model->id)),
                'moveUrl' => url('/admin/catalogCategory/move', array('id' => $model->id)),
                'icon' => ($model->isLeaf()) ? 'jstree-file' : 'jstree-folder',
                'toDisplay' => true,
                'createChild' => true
            );

            $data['selected'] = (app()->request->requestUri === $data['updateUrl']);

            $liHtmlOptions = array(
                'id' => $model->id,
                'rel' => $model->name,
                'data-jstree' => CJSON::encode($data)
            );

            if ($data['selected']) {
                $liHtmlOptions['class'] = 'jstree-active';
            }

            $output .= CHtml::openTag('li', $liHtmlOptions);
            $output .= CHtml::openTag('a', array('href' => '#'));
            $output .= CHtml::encode($model->name);
            if (user()->isAdmin) {
                $output .= CHtml::openTag('small', array('class' => 'muted'));
                $output .= CHtml::encode(' (' . $model->id . ')');
                $output .= CHtml::closeTag('small');
            }
            $output .= CHtml::closeTag('a');

            $level = $model->level;
        }

        for ($i = $level; $i; $i--) {
            $output .= CHtml::closeTag('li') . "\n";
            $output .= CHtml::closeTag('ul') . "\n";
        }

        return $output;
    }
}