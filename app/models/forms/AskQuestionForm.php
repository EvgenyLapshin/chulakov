<?php

/**
 * Class AskQuestionForm
 *
 * @author Lapshin Evgeny (Jonikru) <info@laco.pro>
 * @copyright 2012-2016 Laco
 * @link http://laco.pro
 *
 */
class AskQuestionForm extends SFormModel
{
    public $name;
    public $email;
    public $phone;
    public $question;

    public $emailId = 5;

    public function rules()
    {
        return array(
            array('phone, name, question', 'required'),
            array('email, pageTitle, pageUrl', 'safe')
        );
    }

    public function attributeLabels()
    {
        return array(
            'name' => 'Имя',
            'email' => 'Email',
            'phone' => 'Телефон',
            'question' => 'Вопрос'
        );
    }
}