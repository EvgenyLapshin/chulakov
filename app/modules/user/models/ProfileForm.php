<?php

class ProfileForm extends User
{
    public $verifyCode;

    public function rules()
    {
        return array(
            array('email,username', 'required'),
            array('email', 'unique', 'message' => Yii::t('validation', 'Email уже зарегистрирован.')),
            array('email', 'email'),
            array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u', 'message' => Yii::t('validation', "Только латинские буквы и цифры.")),
            array('username, email', 'unique'),
            array('passwordConfirm', 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('validation', "Пароли не совпадают.")),
            array('password, password_strategy ', 'length', 'max' => 50, 'min' => 6),
            array('username ', 'length', 'max' => 45, 'min' => 3),
            array('email, salt', 'length', 'max' => 255),
            array('requires_new_password', 'numerical', 'integerOnly' => true),
            array('update_time', 'safe'),
            // array('verifyCode', 'captcha'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, password, salt, password_strategy , requires_new_password , email', 'safe', 'on' => 'search'),
        );
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


}
