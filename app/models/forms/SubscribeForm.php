<?php

/**
 * Class SubscribeForm
 *
 * @author Lapshin Evgeny (Jonikru) <info@laco.pro>
 * @copyright 2012-2016 Laco
 * @link http://laco.pro
 *
 */
class SubscribeForm extends SFormModel
{
    public $email;

    public $emailId = 1;

    public function rules()
    {
        return array(
            array('email', 'required')
        );
    }

    public function attributeLabels()
    {
        return array(
            'email' => 'Email'
        );
    }
}