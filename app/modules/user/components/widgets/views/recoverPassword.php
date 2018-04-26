<?php
/**
 * Created by Mandarin.
 * @author: dou
 * Date: 28.02.13
 * Time: 9:11
 */
?>
<?php $model = new RecoverPasswordForm(); ?>
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'RecoverPassword')); ?>

    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h4>Восстановление пароля</h4>
    </div>

    <div class="modal-body">
        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'action' => Yii::app()->createAbsoluteUrl('user/recoverPassword'),
            'id' => 'RecoverPasswordForm',
            'enableAjaxValidation' => true,
            'clientOptions' => array(
                'validationUrl' => Yii::app()->createAbsoluteUrl('user/recoverPassword'),
                'validateOnSubmit' => true
            )
        )); ?>

        <?php echo $form->textFieldRow($model, 'email', array('class' => 'span3')); ?>

    </div>

    <div class="modal-footer">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => 'Восстановить',
            //'url'=>'#',
            //'htmlOptions'=>array('data-target'=>'#Register'),
        )); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Передумал...',
            'url' => '#',
            'htmlOptions' => array('data-dismiss' => 'modal'),
        )); ?>
    </div>
<?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>