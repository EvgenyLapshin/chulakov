<?php

/**
 * Class LoginForm
 * @property User $user модель пользователя
 */
class LoginForm extends CFormModel
{

    // maximum number of login attempts before display captcha
    const MAX_LOGIN_ATTEMPTS = 3;
    public $sessionLifeTime = 2592000; //3600 * 24 * 30   30 days;

    public $username;
    public $password;
    public $email;
    public $rememberMe;
    public $verifyCode;
    /** @var  $_identity UserIdentity */
    private $_identity;
    private $_user = null;

    /**
     * Model rules
     * @return array
     */
    public function rules()
    {
        return array(
            array('username, password', 'required'),
            array('password', 'authenticate'),
            array('rememberMe', 'boolean'),
        );
    }


    /**
     * Returns attribute labels
     * @return array
     */
    public function attributeLabels()
    {
        return array(
            'username' => Yii::t('labels', 'Имя пользователя или E-mail'),
            'password' => Yii::t('labels', 'Пароль'),
            'rememberMe' => Yii::t('labels', 'Запомнить меня'),
        );
    }

    /**
     * Authenticates user input against DB
     * @param $attribute
     * @param $params
     */
    public function authenticate($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $this->getUser();
            $this->_identity = new UserIdentity($this->username, $this->password);
            if (!$this->_identity->authenticate()) {
                if ($this->user !== null && $this->user->login_attempts < self::MAX_LOGIN_ATTEMPTS)
                    $this->user->saveCounters(array('login_attempts' => 1));

                $this->addError('username', Yii::t('errors', 'Не правильный логин или пароль.'));
                $this->addError('password', Yii::t('errors', 'Не правильный логин или пароль.'));
            } else {
                $this->user->saveAttributes(array('login_attempts' => 0));
                switch ($this->user->status) {
                    case User::STATUS_ACTIVE:
                        //все хорошо :)
                        break;
                    case User::STATUS_PENDING:
                        $this->addError('username', Yii::t('errors', 'Пользователь не активирован.'));
                        break;
                    case User::STATUS_BANNED:
                        $this->addError('username', Yii::t('errors', 'Пользователь заблокирован.'));
                        break;
                    case User::STATUS_DELETE:
                        $this->addError('username', Yii::t('errors', 'Пользователь удален.'));
                        break;
                }
            }
        }
    }

    /**
     * Validates captcha code
     * @param $attribute
     * @param $params
     */
    public function validateCaptcha($attribute, $params)
    {
        if ($this->getRequireCaptcha())
            CValidator::createValidator('captcha', $this, $attribute, $params)->validate($this);
    }

    /**
     * Login
     * @return bool
     */
    public function login()
    {
        if ($this->_identity->getIsAuthenticated()) {
            $duration = $this->rememberMe ? $this->sessionLifeTime : 0;
            user()->login($this->_identity, $duration);
            return true;
        }
        return false;
    }

    /**
     * Получить модель пользователя
     * @return null
     */
    public function getUser()
    {
        if ($this->_user === null) {
            $attribute = strpos($this->username, '@') ? 'email' : 'username';
            $this->setUser(User::model()->find(array('condition' => $attribute . '=:loginname', 'params' => array(':loginname' => $this->username))));
        }
        return $this->_user;
    }

    /**
     * Установить модель пользователя
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Returns whether it requires captcha or not
     * @return bool
     */
    public function getRequireCaptcha()
    {
        return ($user = $this->user) !== null && $user->login_attempts >= self::MAX_LOGIN_ATTEMPTS;
    }

}
