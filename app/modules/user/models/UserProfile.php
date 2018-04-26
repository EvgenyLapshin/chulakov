<?php

/**
 * This is the model class for table "user_profile".
 *
 * The followings are the available columns in table 'user_profile':
 * @property string $user_id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $phone
 * @property string $monitor_organization_id
 * @property string $position
 * @property int $soc_id
 * @property string $soc_type
 * @property boolean $username_is_changed
 * @property string $fullName
 *
 * The followings are the available model relations:
 * @property User $user
 * @property MonitorOrganization $rMonitorOrganization
 *
 * @mixin ModelUploaderBehavior
 */
class UserProfile extends SActiveRecord
{
    public $_fullName;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'user_profile';
    }

    public function behaviors()
    {
        return array(
            'uploader' => array(
                'class' => 'laco.uploader.ModelUploaderBehavior',
                'attrList' => array(
                    'avatar' => array(
                        'convertOptions' => array(
                            'thumb' => array('h' => 150),
                            'basic' => array('w' => 50, 'h' => 50, 'zc' => 'c', 'f' => 'jpeg', 'q' => 95)
                        ),
                        'validateRules' => array(
                            'typeAndSize' => array(
                                'allowEmpty' => false,
                                'mimeTypes' => 'image/jpeg,image/png,image/gif',
                                'wrongMimeType' => 'Данный тип файла загружать нельзя'
                            ),
                        ),
                        'uploadType' => 'image'
                    )
                )
            )
        );

    }

    public function rules()
    {
        return array(
            array('avatar', 'length', 'max' => 255),
            array('fullName', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'rMonitorOrganization' => array(self::BELONGS_TO, 'MonitorOrganization', 'monitor_organization_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'user_id' => 'User ID',
            'first_name' => 'Имя',
            'middle_name' => 'Отчество',
            'last_name' => 'Фамилия',
            'phone' => 'Телефон',
            'fullName' => 'Ф.И.О.',
            'monitor_organization_id' => 'Организация',
            'position' => 'Должность',
            'avatar' => 'Аватар'
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('first_name', $this->fullName, true);
        $criteria->compare('middle_name', $this->fullName, true);
        $criteria->compare('last_name', $this->fullName, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getFullName()
    {
        if (!$this->_fullName) {
            $this->setFullName();
        }

        return $this->_fullName;
    }

    public function setFullName()
    {
        $this->_fullName = $this->last_name . ' ' . $this->first_name . ' ' . $this->middle_name;
    }

    public function getInitials()
    {
        return $this->last_name . ' ' . mb_strtoupper(mb_substr($this->first_name, 0, 1)) . '. ' . mb_strtoupper(mb_substr($this->middle_name, 0, 1)) . '.';
    }
}