<div class="login">
    <a class="loginLink overlayLink" href="#loginBox"><span class="icon"></span>Войти</a>

    <div id="loginBox" class="overlayBox">
        <a class="close overlayClose" href="#"></a>

        <div class="head">
            <a class="loginBut lB active" href="#loginCenter">Войти</a>
            <a class="regBut lB" href="#registerCenter">Регистрация</a>
        </div>
        <div class="contentBox">

            <div class="log">
                <span class="text">Войти через -</span>
                <ul class="socialLink clearfix">
                    <li><a href="#" data-social_type="Twitter" class="loginButton tw hover"></a></li>
                    <li><a href="#" data-social_type="Facebook" class="loginButton fb hover"></a></li>
                    <li><a href="#" data-social_type="Vkontakte" class="loginButton vk hover"></a></li>
                </ul>
            </div>

            <div id="loginCenter" class="logboxcent visible">

                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'user-login',
                    'action' => 'user/login',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                        'beforeValidate' => 'js:function(){
                           submitStart("Login");
                           return true;
                      }',
                        'afterValidate' => 'js:function(form, data, hasError){
                      if(hasError) submitEnd("Login");
                      return true;
                        }'
                    ),

                )); ?>


                <?php echo $form->error($loginForm, 'username'); ?>
                <?php echo $form->textField($loginForm, 'username', array('placeholder' => 'Логин')) ?>

                <?php echo $form->error($loginForm, 'password'); ?>
                <?php echo $form->passwordField($loginForm, 'password', array('placeholder' => 'Пароль')) ?>

                <?php echo CHtml::submitButton('войти', array('id' => 'buttonLoginSubmit')); ?>
                <div class="" id="loaderLoginSubmit"></div>

                <?php $this->endWidget(); ?>

            </div>

            <div id="registerCenter" class="logboxcent">

                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'user-register',
                    'action' => 'user/register',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                        'beforeValidate' => 'js:function(){
                           submitStart("Register");
                           return true;
                      }',
                        'afterValidate' => 'js:function(form, data, hasError){
                      if(hasError) submitEnd("Register");
                      return true;
                        }'
                    ),
                )); ?>

                <?php echo $form->error($registerForm, 'username'); ?>
                <?php echo $form->textField($registerForm, 'username', array('placeholder' => 'Логин')) ?>

                <?php echo $form->error($registerForm, 'password'); ?>
                <?php echo $form->passwordField($registerForm, 'password', array('placeholder' => 'Пароль')) ?>

                <?php echo $form->error($registerForm, 'passwordConfirm'); ?>
                <?php echo $form->passwordField($registerForm, 'passwordConfirm', array('placeholder' => 'Повторите пароль')) ?>

                <?php echo $form->error($registerForm, 'email'); ?>
                <?php echo $form->textField($registerForm, 'email', array('placeholder' => 'Email')) ?>

                <?php echo CHtml::submitButton('Зарегистрироваться', array('id' => 'buttonRegisterSubmit')); ?>
                <div class="" id="loaderRegisterSubmit"></div>

                <?php $this->endWidget(); ?>

            </div>

            <a class="forgotPass" id="openRecoveryPassword" href="#">Забыли пароль?</a>
        </div>
        <div class="forgotBox contentBox">


            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'user-recover-password',
                'action' => 'user/recoverPassword',
                'enableAjaxValidation' => true,
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'beforeValidate' => 'js:function(){
                           submitStart("Recovery");
                           return true;
                      }',
                    'afterValidate' => 'js:function(form, data, hasError){
                      submitEnd("Recovery")
                     if(hasError){
                     } else{
                        $("#recoveryInputs").hide();
                        $("#recoverySuccess").show();
                        return false;
                     }
                 }'
                ),
            )); ?>


            <div id="recoveryInputs">
                <?php echo $form->error($recoverPassword, 'email'); ?>
                <?php echo $form->textField($recoverPassword, 'email', array('placeholder' => 'Email')) ?>

                <?php echo CHtml::submitButton('Восстановить', array('id' => 'buttonRecoverySubmit')); ?>
            </div>

            <div class="" id="loaderRecoverySubmit"></div>
            <div id="recoverySuccess">На Ваш почтовый ящик отправлено письмо со ссылкой восстановления пароля</div>

            <?php $this->endWidget(); ?>

        </div>
    </div>
</div>