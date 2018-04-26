<?php

class BlockTemplateController extends AController
{
    public function actions()
    {
        return array_merge(parent::actions(), array(
            'sortable' => array(
                'class' => 'MSortableAction',
                'modelName' => 'BlockTemplate'
            ),
            'editColumn' => array(
                'class' => 'materialize.components.MEditableColumnAction',
                'modelName' => 'BlockTemplate'
            )
        ));
    }

    public function actionCreate()
    {
        $model = new BlockTemplate;
        $this->performAjaxValidation($model);

        if (isset($_POST['BlockTemplate'])) {
            $model->attributes = $_POST['BlockTemplate'];
            $model->save();
            if (!$model->hasErrors()) {
                if (button()->isSaveButton()) {
                    $this->redirect(array('index'));
                } else {
                    $this->redirect(array('update', 'id' => $model->id));
                }
            }
        } else {
            $model->attributes = $_GET;
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id)
    {
        /** @var BlockTemplate $model */
        $model = $this->loadModel('BlockTemplate', $id);

        $this->performAjaxValidation($model);

        if (isset($_POST['BlockTemplate'])) {
            $model->attributes = $_POST['BlockTemplate'];
            $model->save();
            if (!$model->hasErrors() && button()->isSaveButton()) {
                // todo: Здесь есть проблема с редиректом на родительскую сущность. Например, в Event несколько типов (Новости, Акции, События), в какой конкретно возвращаться?
                if ($model->entity_template_name) {
                    $this->redirect(array(lcfirst($model->entity_template_name) . '/update', 'id' => $model->entity_template_id));
                } else {
                    $this->redirect(array(lcfirst($model->entity_name) . '/index'));
                }
            }
        }

        $mBlockField = new BlockField('search');
        $mBlockField->unsetAttributes(); // clear any default values
        if (isset($_GET['PageField'])) {
            $mBlockField->attributes = $_GET['PageField'];
        }

        $mBlockField->block_template_id = $model->id;

        $blockFieldController = app()->createController('/admin/blockField');
        $blockFieldController = $blockFieldController[0];

        $this->render('update', array(
            'model' => $model,
            'mBlockField' => $mBlockField,
            'blockFieldController' => $blockFieldController
        ));
    }

    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            $this->loadModel('BlockTemplate', $id)->delete();

            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    public function actionIndex($entityTemplate = '')
    {
        $model = new BlockTemplate('search');
        $model->unsetAttributes();
        $model->entity_template_id = $entityTemplate;
        if (isset($_GET['BlockTemplate'])) {
            $model->attributes = $_GET['BlockTemplate'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }
}