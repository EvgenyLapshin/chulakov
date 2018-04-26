<?php

/**
 * Class ServiceForm
 *
 * @author Lapshin Evgeny (Jonikru) <info@laco.pro>
 * @copyright 2012-2016 Laco
 * @link http://laco.pro
 *
 */
class ServiceForm extends SFormModel
{
    public $name;
    public $phone;
    public $email;
    public $subject;
    public $message;

    public $emailId = 3;

    public function rules()
    {
        return array(
            array('subject, email, name, phone', 'required'),
            array('message, pageUrl, pageTitle', 'safe')
        );
    }

    public function attributeLabels()
    {
        return array(
            'name' => 'Имя',
            'phone' => 'Телефон',
            'email' => 'Email',
            'subject' => 'Тема',
            'message' => 'Сообщение'
        );
    }
}