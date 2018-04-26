<?php

/**
 * Created by Mandarin.
 * @author: Nikolay Lapshin (dou)
 * Date: 22.11.12
 * Time: 23:26
 */
class RegisterForm extends User
{
    public $verifyCode;

    public function rules()
    {
        return array(
            array('email,username,password,passwordConfirm', 'required'),
            array('email', 'length', 'max' => 255),
            array('email', 'email'),
            array('username', 'length', 'max' => 45, 'min' => 3),
            array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u', 'message' => Yii::t('validation', "Только латинские буквы и цифры.")),
            array('username, email', 'unique'),
            array('password', 'length', 'max' => 50, 'min' => 6, 'encoding' => 'UTF-8'),
            array('passwordConfirm', 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('validation', "Пароли не совпадают.")),
        );
    }

    public function beforeSave()
    {
        $this->password = CPasswordHelper::hashPassword($this->password);
        return parent::beforeSave();
    }

    public function afterSave()
    {
        //Создадим профиль юзера
        $profile = new UserProfile();
        $profile->user_id = $this->id;
        $profile->save();
        return parent::afterSave();
    }
}
