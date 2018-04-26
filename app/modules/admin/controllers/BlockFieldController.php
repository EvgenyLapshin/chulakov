<?php

class BlockFieldController extends AController
{
    public function actions()
    {
        return array(
            'sortable' => array(
                'class' => 'MSortableAction',
                'modelName' => 'BlockField'
            ),
            'editColumn' => array(
                'class' => 'materialize.components.MEditableColumnAction',
                'modelName' => 'BlockField'
            )
        );
    }

    public function actionCreate($blockTemplate)
    {
        $model = new BlockField;
        $this->performAjaxValidation($model);
        $model->block_template_id = $blockTemplate;

        if (isset($_POST['BlockField'])) {
            // для мультиязычных полей, создадим копии поля на всех языках
            if (app()->urlManager->multiLanguageEnabled && $_POST['BlockField']['is_multi_lang']) {
                foreach (param('languagesAdminList') as $langSuffix => $langName) {
                    $model = new BlockField;
                    $model->attributes = $_POST['BlockField'];
                    $model->name = $_POST['BlockField']['name'] . '_' . $langSuffix;
                    $model->isNewRecord = true;
                    $model->save();
                }
            } else {
                $model->attributes = $_POST['BlockField'];
                $model->save();
            }
            if (!$model->hasErrors()) {
                if (button()->isSaveButton()) {
                    $this->redirect(array('/admin/blockTemplate/update', 'id' => $model->block_template_id));
                } else {
                    $this->redirect(array('update', 'id' => $model->id));
                }
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id)
    {
        /** @var BlockField $model */
        $model = $this->loadModel('BlockField', $id);
        $this->performAjaxValidation($model);

        if (isset($_POST['BlockField'])) {
            $model->attributes = $_POST['BlockField'];
            $model->save();
            if (!$model->hasErrors() && button()->isSaveButton()) {
                $this->redirect(array('/admin/blockTemplate/update', 'id' => $model->block_template_id));
            }
        }

        $model->settings = var_export($model->settings, true);

        $this->render('update', array(
            'model' => $model
        ));
    }

    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            $this->loadModel('BlockField', $id)->delete();

            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    public function actionIndex($blockTemplate)
    {
        $model = new BlockField('search');
        $model->unsetAttributes();
        $model->block_template_id = $blockTemplate;
        if (isset($_GET['BlockField'])) {
            $model->attributes = $_GET['BlockField'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }
}