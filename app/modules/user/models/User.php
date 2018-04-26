<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $password
 * @property string $email
 * @property string $username
 * @property string $login_ip
 * @property integer $login_attempts
 * @property string $login_time
 * @property string $create_id
 * @property string $create_time
 * @property string $update_id
 * @property string $update_time
 * @property string $delete_id
 * @property string $delete_time
 * @property string $status
 * @property string $requires_new_password
 *
 * @property string $statusList
 *
 * The followings are the available model relations:
 * @property AuthAssignment $authItems
 * @property UserProfile $rProfile
 */
class User extends SActiveRecord
{
    const STATUS_ACTIVE = 'active';
    const STATUS_PENDING = 'pending';
    const STATUS_DELETE = 'deleted';
    const STATUS_BANNED = 'banned';

    const ROLE_MANAGER = 'manager';
    const ROLE_CURATOR = 'curator';

    public $fullName;
    public $role;
    public $t = ''; // Префикс для таблицы

    /**
     * @var string attribute used for new passwords on user's edition
     */
    public $newPassword;
    /**
     * @var string attribute used to confirmation fields
     */
    public $passwordConfirm;

    private $_roles = array(
        'manager' => 'Менеджер',
        'moderator' => 'Модератор',
        'admin' => 'Администратор'
    );

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return array(
            array('email', 'required', 'on' => 'checkout'),
            array('email', 'uniqueValidator', 'on' => 'checkout', 'message' => Yii::t('validation', 'Email уже зарегистрирован.')),
            array('email', 'email'),
            array('username, email', 'uniqueValidator'),
            array('passwordConfirm', 'compare', 'compareAttribute' => 'newPassword', 'message' => Yii::t('validation', "Пароли не совпадают.")),
            array('newPassword, password', 'length', 'max' => 255, 'min' => 6, 'encoding' => 'UTF-8'),
            array('email', 'length', 'max' => 255),
            array('status', 'in', 'range' => array_keys($this->statusList)),

            array('requires_new_password, login_attempts', 'numerical', 'integerOnly' => true),
            array('role', 'in', 'range' => array_keys($this->getRoles())),

            array('id, password, requires_new_password , email', 'safe', 'on' => 'search'),

        );
    }

    public function uniqueValidator($attribute, $params)
    {
        $criteria = new CDbCriteria();
        if (!$this->isNewRecord) {
            $criteria->condition = 'id <> ' . $this->id;
        }
        $criteria->addCondition($attribute . '= :' . $attribute);
        $criteria->params = array(
            ':' . $attribute => $this->$attribute
        );
        if (self::model()->resetScope(false)->exists($criteria)) {
            $this->addError($attribute, 'Такой ' . $this->getAttributeLabel($attribute) . ' уже существует');
        }
    }

    public function relations()
    {
        return array(
            'authItems' => array(self::HAS_MANY, 'AuthAssignment', 'userid'),
            'rProfile' => array(self::HAS_ONE, 'UserProfile', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'password' => 'Пароль',
            'newPassword' => 'Новый пароль',
            'passwordConfirm' => 'Еще раз пароль',
            'email' => 'Email',
            'username' => 'Логин',
            'login_ip' => 'Login Ip',
            'login_attempts' => 'Login Attempts',
            'login_time' => 'Входил',
            'create_id' => 'Create',
            'create_time' => 'Создан',
            'update_id' => 'Update',
            'update_time' => 'Отредактирован',
            'delete_id' => 'Delete',
            'delete_time' => 'Удалён',
            'status' => 'Статус',
            'role' => 'Роль',
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('login_ip', $this->login_ip, true);
        $criteria->compare('login_attempts', $this->login_attempts);
        $criteria->compare('login_time', $this->login_time, true);
        $criteria->compare('create_id', $this->create_id, true);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('update_id', $this->update_id, true);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->compare('delete_id', $this->delete_id, true);
        $criteria->compare('delete_time', $this->delete_time, true);
        $criteria->compare('status', $this->status, true);

        //$criteria->addCondition('username<>"root"');

        $criteria->with = array('rProfile');

        $criteria->together = true;
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => false
        ));
    }

    /**
     * Makes sure usernames are lowercase
     * (emails by standard can have uppercase letters)
     * @return parent::beforeValidate
     */
    public function beforeValidate()
    {
        if (!empty($this->username)) {
            $this->username = strtolower($this->username);
        }

        return parent::beforeValidate();
    }

    public function beforeSave()
    {
        $this->update_time = date('Y-m-d H:i:s');
        if ($this->passwordConfirm) {
            $this->password = CPasswordHelper::hashPassword($this->passwordConfirm);
        }

        return parent::beforeSave();
    }

    public function getStatusList()
    {
        return array(
            self::STATUS_PENDING => 'В ожидании',
            self::STATUS_ACTIVE => 'Активный',
            self::STATUS_DELETE => 'Удалён',
            self::STATUS_BANNED => 'Заблокирован',
        );
    }

    public function getStatusLabel($status)
    {
        $label = 'Неверный тип';
        $list = self::getStatusList();
        if (array_key_exists($status, $list))
            $label = $list[$status];

        return $label;
    }

    /**
     * Получить возможные роли
     * @return array
     */
    public function getRoles()
    {
        return $this->_roles;
    }

    /**
     * Получить названме роли
     * @return array
     */
    public function getRoleName()
    {
        return ($this->authItems) ? $this->_roles[$this->authItems[0]->itemname] : '';
    }

    public function checkAccess($rule)
    {
        foreach ($this->authItems as $items) {
            if ($items->itemname === $rule) {
                return true;
            }
        }

        return false;
    }

    public function assignRole($role)
    {
        /** @var CDbAuthManager $auth */
        $auth = Yii::app()->authManager;
        $auth->assign($role, $this->id);
    }

    public function revokeRole($role)
    {
        /** @var CDbAuthManager $auth */
        $auth = Yii::app()->authManager;
        $auth->revoke($role, $this->id);
    }

    public function getHTMLLinkToViewProfile()
    {
        if ($this->id == 1 || $this->checkAccess('admin')) {
            return $this->username;
        } elseif ($this->checkAccess('manager')) {
            return CHtml::link($this->rProfile->getInitials(), app()->createUrl('/monitor/manager/view', array('id' => $this->id)), array('target' => '_blank'));
        } elseif ($this->checkAccess(self::ROLE_CURATOR)) {
            return
                CHtml::link($this->rProfile->rMonitorOrganization->name, app()->createUrl('/monitor/monitorOrganization/view', array('id' => $this->rProfile->rMonitorOrganization->id)), array('target' => '_blank'))
                . '<br>' .
                CHtml::link($this->rProfile->getInitials(), app()->createUrl('/monitor/curator/view', array('id' => $this->id)), array('target' => '_blank'));
        } else {
            return '';
        }
    }

    public function getLinkToViewProfile()
    {
        if ($this->checkAccess('admin')) {
            $route = '/user/manager/view';
        } elseif ($this->checkAccess('manager')) {
            $route = '/monitor/manager/view';
        } elseif ($this->checkAccess(self::ROLE_CURATOR)) {
            $route = '/monitor/curator/view';
        } else {
            $route = '/user/manager/view';
        }

        return app()->createUrl($route, array('id' => $this->id));
    }
}