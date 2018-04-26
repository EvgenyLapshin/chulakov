<?php

/**
 * This is the model class for table "confirm_token".
 *
 * The followings are the available columns in table 'confirm_token':
 * @property string $token
 * @property string $type
 * @property string $user_id
 * @property string $create_time
 * @property string $confirm_time
 * @property string $ip_created
 * @property string $ip_confirmed
 * @property string $data
 * @property integer $is_confirmed
 *
 * The followings are the available model relations:
 * @property User $user
 */
class ConfirmToken extends SActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ConfirmToken the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'confirm_token';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('type', 'required'),
            array('is_confirmed', 'numerical', 'integerOnly' => true),
            array('token', 'length', 'max' => 64),
            array('type', 'length', 'max' => 20),
            array('user_id', 'length', 'max' => 11),
            array('ip_created, ip_confirmed', 'length', 'max' => 10),
            array('create_time, confirm_time, data', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('token, type, user_id, create_time, confirm_time, ip_created, ip_confirmed, data, is_confirmed', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'token' => 'Token',
            'type' => 'Type',
            'user_id' => 'User',
            'create_time' => 'Create Time',
            'confirm_time' => 'Confirm Time',
            'ip_created' => 'Ip Created',
            'ip_confirmed' => 'Ip Confirmed',
            'data' => 'Data',
            'is_confirmed' => 'Is Confirmed',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('token', $this->token);
        $criteria->compare('type', $this->type);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('create_time', $this->create_time);
        $criteria->compare('confirm_time', $this->confirm_time);
        $criteria->compare('ip_created', $this->ip_created);
        $criteria->compare('ip_confirmed', $this->ip_confirmed);
        $criteria->compare('data', $this->data);
        $criteria->compare('is_confirmed', $this->is_confirmed);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function beforeSave()
    {
        if ($this->ip_created)
            $this->ip_created = ip2long($this->ip_created);
        if ($this->ip_confirmed)
            $this->ip_confirmed = ip2long($this->ip_confirmed);
        if ($this->isNewRecord)
            $this->token = sha1($this->token);

        return parent::beforeSave();
    }

    public function afterFind()
    {
        if ($this->ip_created)
            $this->ip_created = long2ip($this->ip_created);
        if ($this->ip_confirmed)
            $this->ip_confirmed = long2ip($this->ip_confirmed);

        return parent::afterFind();
    }

    /**
     * Создать токен
     * @param $userId int ID юзера
     * @param $type string тип создаваемого токена
     * @param $data mixed любые дополнительные данные которые надо сохранить.
     * @param $shortToken bool Короткий токен для ручного ввода юзером например.
     * @return ConfirmToken - модель созданного токена
     */
    public function createToken($userId, $type, $data = null, $shortToken = false)
    {
        if (!$this->isNewRecord) {
            $this->setIsNewRecord(true);
            $this->unsetAttributes();
        }

        if (!empty($data) && is_array($data)) {
            $data = serialize($data);
        }

        $this->user_id = $userId;
        $this->type = $type;
        $this->data = $data;
        $this->ip_created = app()->getRequest()->userHostAddress;
        $this->token = $token = $this->generateToken($shortToken);

        $this->save();

        return $token;
    }


    /**
     * Генерим уникальный Token
     * @param $shortToken bool Короткий токен для ручного ввода юзером например.
     * @return string
     */
    private function generateToken($shortToken)
    {
        return ($shortToken) ? mt_rand(100000, 999999) : bin2hex(openssl_random_pseudo_bytes(16));
    }


    /**
     * Найти токен
     * @param $userId int id юзера
     * @param $type string тип токена
     * @param $token string токен
     * @return ConfirmToken|null
     */
    public function findToken($userId, $type, $token)
    {
        $cr = new CDbCriteria();
        $cr->compare('token', sha1($token));
        $cr->compare('user_id', $userId);
        $cr->compare('type', $type);
        $cr->compare('is_confirmed', 0);

        return $this->find($cr);
    }

    /**
     * Отметить токен как подтвержденный
     * @throws CException
     */
    public function markAsConfirmed()
    {
        $this->confirm_time = date("Y-m-d H:i:s");
        $this->ip_confirmed = app()->getRequest()->userHostAddress;
        $this->is_confirmed = 1;
        $this->save(false);
    }
}