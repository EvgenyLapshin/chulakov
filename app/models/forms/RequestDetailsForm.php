<?php

/**
 * Class RequestDetailsForm
 *
 * @author Lapshin Evgeny (Jonikru) <info@laco.pro>
 * @copyright 2012-2016 Laco
 * @link http://laco.pro
 *
 */
class RequestDetailsForm extends SFormModel
{
    public $name;
    public $email;
    public $phone;

    public $emailId = 4;

    public function rules()
    {
        return array(
            array('phone, name', 'required'),
            array('email, pageTitle, pageUrl', 'safe'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'name' => 'Имя',
            'email' => 'Email',
            'phone' => 'Телефон'
        );
    }
}