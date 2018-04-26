<?php

class PageFieldController extends AController
{
    public function actions()
    {
        return array(
            'sortable' => array(
                'class' => 'MSortableAction',
                'modelName' => 'PageField'
            ),
            'editColumn' => array(
                'class' => 'materialize.components.MEditableColumnAction',
                'modelName' => 'PageField'
            )
        );
    }

    public function actionCreate($template)
    {
        $model = new PageField;
        $model->template_id = $template;

        $this->performAjaxValidation($model);

        if (isset($_POST['PageField'])) {
            // для мультиязычных полей, создадим копии поля на всех языках
            if (app()->urlManager->multiLanguageEnabled && $_POST['PageField']['is_multi_lang']) {
                foreach (param('languagesAdminList') as $langSuffix => $langName) {
                    $model = new PageField;
                    $model->attributes = $_POST['PageField'];
                    $model->name = $_POST['PageField']['name'] . '_' . $langSuffix;
                    $model->isNewRecord = true;
                    $model->save();
                }
            } else {
                $model->attributes = $_POST['PageField'];
                $model->save();
            }
            if (!$model->hasErrors()) {
                if (button()->isSaveButton()) {
                    $this->redirect(array('/admin/pageTemplate/update', 'id' => $model->template_id));
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
        /** @var PageField $model */
        $model = $this->loadModel('PageField', $id);
        $this->performAjaxValidation($model);

        if (isset($_POST['PageField'])) {
            $model->attributes = $_POST['PageField'];
            $model->save();
            if (!$model->hasErrors() && button()->isSaveButton()) {
                $this->redirect(array('/admin/pageTemplate/update', 'id' => $model->template_id));
            }
        }

        $model->settings = var_export($model->settings, true);

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            $this->loadModel('PageField', $id)->delete();

            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }
}