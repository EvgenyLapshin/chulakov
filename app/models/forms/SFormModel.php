<?php

/**
 * Created by Laco.
 * @author: Nikolay Lapshin (dou)
 * Date: 04.12.2015
 * Time: 11:50
 */
class SFormModel extends CFormModel
{
    public $pageUrl;
    public $pageTitle;
    public $logErrors = true;
    public $emailId;
    public $firstName;

    public function init()
    {
        $this->validatorList->add(CValidator::createValidator('validateFirstName', $this, 'firstName'));
    }

    public function afterValidate()
    {
        if ($this->logErrors && $this->hasErrors()) {
            $this->logErrors();
        }
    }

    public function logErrors()
    {
        Yii::log('Ошибка валидации ' . get_class($this) . ' ' . print_r($this->getErrors(), true), CLogger::LEVEL_INFO, 'formValidateErrors');
    }

    /**
     * Этот метод сделан для банальной защиты от самых тупых ботов.
     * Суть в том, чтобы поле firstName прилетало всегда не заполненным.
     */
    public function validateFirstName()
    {
        if ($this->firstName) {
            $this->addError('firstName', 'invalid');
        }
    }
}