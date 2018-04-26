<?php

/**
 * Class PreOrderForm
 *
 * @author Lapshin Evgeny (Jonikru) <info@laco.pro>
 * @copyright 2012-2017 Laco
 * @link http://laco.pro
 *
 */
class PreOrderForm extends SFormModel
{
    public $name;
    public $email;
    public $phone;
    public $product;

    public $emailId = 13;

    public function rules()
    {
        return array(
            array('phone, name', 'required'),
            array('email, pageTitle, pageUrl, product', 'safe'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'name' => 'Имя',
            'email' => 'Email',
            'phone' => 'Телефон',
            'product' => 'Товар'
        );
    }
}