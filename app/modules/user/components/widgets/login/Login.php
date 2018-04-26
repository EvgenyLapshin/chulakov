<?php

class Login extends CWidget
{
    public function init()
    {

        if(Yii::app()->user->isGuest){
            Yii::import('application.modules.user.models.*');
            $params=array(
                'loginForm'=>new LoginForm,
                'registerForm'=>new RegisterForm,
                'recoverPassword'=> new RecoverPasswordForm('recoverRequest')
            );
            $this->render('login',$params);
        } else {


            $username = Yii::app()->user->display_name;

            $avatar = Yii::app()->user->avatar62x62;

            $params=array(
                'username'=>$username,
                'avatar'=>$avatar,
            );
            $this->render('logout',$params);
        }



        // этот метод будет вызван внутри CBaseController::beginWidget()
    }

    public function run()
    {
        // этот метод будет вызван внутри CBaseController::endWidget()
    }
}