<?php
/** @var $this ProfileController */
/** @var $model User */
/** @var $form MActiveForm */

cs()->registerCssFile($this->module->getAssetsUrl() . '/css/user.css');
cs()->registerCoreScript('jquery');
Yii::import('materialize.widgets.MActiveForm');
Yii::import('materialize.components.MRegisterScript');
$materialize = new MRegisterScript();
$materialize->registerScripts();
?>

<div class="z-depth-4 card-panel">
    <div class="outside-form outside-form--profile">
        <h4 class="center">Профиль</h4>

        <?php $form = $this->beginWidget('MActiveForm', array(
            'id' => $model->formId,
            'enableAjaxValidation' => true,
            'enableClientValidation' => true,
            'addSaveButton' => false,
        ));
        ?>

        <div class="outside-form__fields">
            <div>
                <?php
                $this->widget('UploaderWidget', array(
                    'model' => $model->rProfile,
                    'attribute' => 'avatar'
                ));
                ?>
            </div>
            <div>
                <?php
                echo $form->textFieldRow($model, 'username', array('disabled' => 'disabled', 'column' => MHtml::MOBILE_COLUMN_12, 'prepend' => MHtml::icon('person_outline')));

                if (!$model->rProfile->soc_id) {
                    echo $form->passwordFieldRow($model, 'newPassword', array('column' => MHtml::MOBILE_COLUMN_12, 'prepend' => MHtml::icon('lock_outline')));
                    echo $form->passwordFieldRow($model, 'passwordConfirm', array('column' => MHtml::MOBILE_COLUMN_12, 'prepend' => MHtml::icon('lock_outline')));
                    echo $form->textFieldRow($model, 'email', array('column' => MHtml::MOBILE_COLUMN_12, 'prepend' => MHtml::icon('email')));
                }
                ?>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <?= MHtml::submitButton('Сохранить', array(
                    'color' => MHtml::COLOR_PINK,
                    'color-shade' => MHtml::COLOR_SHADE_ACCENT_2,
                    'class' => 'col s12'
                )); ?>
            </div>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>