<?php

/**
 * This is the model class for table "email".
 *
 * The followings are the available columns in table 'email':
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $subject
 * @property string $content
 * @property string $email
 * @property string $placeholders
 */
class Email extends SActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'email';
    }

    public function behaviors()
    {
        return array(
            'uploader' => array(
                'class' => 'laco.uploader.ModelUploaderBehavior',
                'attrList' => array(
                    'content' => array(
                        'uploadType' => 'redactor'
                    )
                )
            )
        );

    }

    public function rules()
    {
        return array(
            array('name, subject, email, placeholders', 'length', 'max' => 255),
            array('description', 'length', 'max' => 1000),
            array('content', 'safe'),

            array('id, name, email, subject', 'safe', 'on' => 'search'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
            'subject' => 'Тема письма',
            'content' => 'Содержание письма',
            'email' => 'Email получателя',
            'placeholders' => 'Плейсхолдеры',
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('email', $this->description, true);
        $criteria->compare('subject', $this->subject, true);
        $criteria->compare('email', $this->content, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => false
        ));
    }

    /**
     * Отправляет письмо
     * @param int $emailTemplateId id письма. Узнать можно в таблице либо посмотреть в админке тут /admin/email/index
     * @param array $placeHolders массив плейсхолдеров для замены array('placeholder_name'=>'value')
     * @param string $toEmailAddress email на который отправляется письмо.
     * По умолчанию отправляет на адрес указанный в настройках письма
     * @return bool
     */
    public static function send($emailTemplateId, $placeHolders = array(), $toEmailAddress = null)
    {
        $Email = self::model()->findByPk($emailTemplateId);
        if (!$Email) {
            return false;
        }

        // заменяем плейсхолдеры в тексте
        if ($placeHolders) {
            foreach ($placeHolders as $search => $replace) {
                $Email->subject = str_replace('*' . $search . '*', $replace, $Email->subject);
                $Email->content = str_replace('*' . $search . '*', $replace, $Email->content);
            }
        }

        if (!$toEmailAddress) {
            $toEmailAddress = $Email->email;
        }

        $toEmailAddress = explode(',', $toEmailAddress);
        mailer()->ClearAddresses();
        foreach ($toEmailAddress as $email) {
            mailer()->AddAddress($email);
        }

        mailer()->Subject = $Email->subject;
        mailer()->MsgHTML($Email->content);

        return mailer()->Send();
    }

    /**
     * Отправить письмо с данными из формы
     *
     * @param SFormModel $form
     * @return bool
     */
    public static function sendForm($form)
    {
        return self::send($form->emailId, $form->attributes);
    }

    /**
     * Заполсняет плейсхолдеры по данным из модели Юзера
     * @param $User - модель с юзером
     * @return array массив плейсхолдеров со значениями
     */
    public static function getUserPlaceHolders($User)
    {
        return array(
            'login' => $User->username,
            'email' => $User->email,
            'name' => ($User->name_full) ? $User->name_full : $User->username,
        );
    }
}