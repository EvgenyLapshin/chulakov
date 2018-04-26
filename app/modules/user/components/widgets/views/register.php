<?php
/**
 * Created by Mandarin.
 * @author: dou
 * Date: 10.02.13
 * Time: 16:56
 */
?>
<?php $model = new RegisterForm(); ?>
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'Register')); ?>

    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h4>Регистрация на <?= Yii::app()->name ?></h4>
    </div>

    <div class="modal-body">
        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'action' => Yii::app()->createAbsoluteUrl('user/register'),
            'id' => 'registerForm',
            'enableClientValidation' => true,
            'enableAjaxValidation' => true,
            'clientOptions' => array(
                'validationUrl' => Yii::app()->createAbsoluteUrl('user/register'),
                'validateOnSubmit' => true,
                'beforeValidate' => 'js:function(form){$("#registerButton").button("loading");return true;}',
                'afterValidate' => 'js:function(form, data, hasError){
                if(hasError){
                    $("#registerButton").button("reset");
                    return false;
                }
                return true;
                }'
            )
            // 'htmlOptions'=>array('class'=>'well'),
        )); ?>

        <?php echo $form->textFieldRow($model, 'username', array('class' => 'span3')); ?>
        <?php echo $form->textFieldRow($model, 'email', array('class' => 'span3')); ?>
        <?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span3')); ?>
        <?php echo $form->passwordFieldRow($model, 'passwordConfirm', array('class' => 'span3')); ?>


    </div>

    <div class="modal-footer">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => 'Регистрация',
            'loadingText' => ' <i class="icon-spinner icon-spin"></i> Регистрируем...',
            //'url'=>'#',
            'htmlOptions' => array('id' => 'registerButton'),
        )); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Передумал...',
            'url' => '#',
            'htmlOptions' => array('data-dismiss' => 'modal'),
        )); ?>
    </div>
<?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>