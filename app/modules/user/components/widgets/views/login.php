<?php
/**
 * Created by Mandarin.
 * @author: dou
 * Date: 10.02.13
 * Time: 16:46
 */
?>
<?php $model = new LoginForm(); ?>
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'Login', 'options' => array('remote' => false))); ?>

    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h4>Вход на <?= Yii::app()->name ?></h4>
    </div>

    <div class="modal-body">
        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'action' =>Yii::app()->createAbsoluteUrl('user/login'),
            'id' => 'loginForm',
            'enableAjaxValidation' => true,
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validationUrl' => Yii::app()->createAbsoluteUrl('user/login'),
                'validateOnSubmit' => true,
                'beforeValidate' => 'js:function(form){$("#loginButton").button("loading");return true;}',
                'afterValidate' => 'js:function(form, data, hasError){
                    if(hasError){
                        $("#loginButton").button("reset");
                        return false;
                    }
                    return true;
                }'
            )
        )); ?>

        <?php echo $form->textFieldRow($model, 'username', array('class' => 'span3')); ?>
        <?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span3')); ?>
        <?php echo $form->checkboxRow($model, 'rememberMe'); ?>

    </div>

    <div class="modal-footer">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'type' => 'inverse',
            'label' => 'Я забыл пароль',
            'size' => 'mini',
            //'url'=>'#',
            'htmlOptions' => array('data-dismiss' => 'modal', 'class' => 'pull-left',
                'onclick' => "$('#RecoverPassword').modal({'show':true});"
            ),
        )); ?>

        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => 'Войти',
            'loadingText' => ' <i class="icon-spinner icon-spin"></i> Входим...',
            //'url'=>'#',
            'htmlOptions' => array('id' => 'loginButton'),
        )); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Передумал...',
            'url' => '#',
            'htmlOptions' => array('data-dismiss' => 'modal'),
        )); ?>
    </div>
<?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>