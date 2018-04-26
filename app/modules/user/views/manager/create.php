<?php
/**
 * @var $this ManagerController
 * @var $user User
 * @var $userProfile UserProfile
 */

$this->breadcrumbs = array(
    'Пользователи' => array('index'),
    'Добавить'
);

$this->renderPartial('_form', array('user' => $user, 'userProfile' => $userProfile));