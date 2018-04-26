<?php

/**
 * Class FeedbackForm
 *
 * @author Lapshin Evgeny (Jonikru) <info@laco.pro>
 * @copyright 2012-2016 Laco
 * @link http://laco.pro
 *
 */
class FeedbackForm extends SFormModel
{
    public $name;
    public $email;
    public $subject;
    public $message;

    public $emailId = 2;

    public function rules()
    {
        return array(
            array('email, name', 'required'),
            array('subject, message, pageTitle, pageUrl', 'safe')
        );
    }

    public function attributeLabels()
    {
        return array(
            'name' => 'Имя',
            'email' => 'Email',
            'subject' => 'Тема',
            'message' => 'Сообщение'
        );
    }
}