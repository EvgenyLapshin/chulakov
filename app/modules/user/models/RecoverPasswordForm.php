<?php

/**
 * Created by Mandarin.
 * @author: dou
 * Date: 28.02.13
 * Time: 9:13
 */
class RecoverPasswordForm extends CFormModel
{
    public $email;
    public $password;
    public $passwordConfirm;
    private $_user;

    /**
     * Model rules
     * @return array
     */
    public function rules()
    {
        return array(
            array('email', 'required', 'on' => 'recoverRequest'),
            array('email', 'email', 'on' => 'recoverRequest'),
            array('email', 'length', 'max' => 255, 'on' => 'recoverRequest'),
            array('email', 'exist', 'className' => 'User', 'on' => 'recoverRequest'),

            array('password', 'required', 'on' => 'changePassword'),
            array('password', 'length', 'max' => 50, 'min' => 6, 'on' => 'changePassword'),
            array('passwordConfirm', 'compare',
                'compareAttribute' => 'password',
                'message' => Yii::t('validation', "Пароли не совпадают."),
                'on' => 'changePassword'
            ),

        );
    }

    /**
     * Returns attribute labels
     * @return array
     */
    public function attributeLabels()
    {
        return array(
            'email' => Yii::t('labels', 'Ваш Email (указанный при регистрации)'),
            'password' => Yii::t('labels', 'Новый пароль'),
            'passwordConfirm' => Yii::t('labels', 'Подтверждение нового пароля'),
        );
    }

    /**
     * Returns
     * @return null
     */
    public function getUser()
    {
        if (empty($this->_user)) {
            $this->_user = User::model()->findByAttributes(array('email' => $this->email));
        }
        return $this->_user;
    }


}