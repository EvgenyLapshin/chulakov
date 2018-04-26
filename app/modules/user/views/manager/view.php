<?php
/**
 * @var $this ManagerController
 * @var $user User
 * @var $userProfile UserProfile
 */

$this->breadcrumbs = array(
    'Пользователи' => array('index'),
    'Просмотр'
);

$this->beginWidget('materialize.widgets.MCard', array(
    'title' => $model->username,
    'description' => 'Подробная информация о пользователе',
    'wrappedInRow' => false,
    'collWrapperCss' => array(MHtml::MOBILE_COLUMN_12, MHtml::DESKTOP_COLUMN_6)
));

echo CHtml::image($model->rProfile->getImageUrl('avatar'));

$this->widget('materialize.widgets.MDetailView', array(
    'data' => $model,
    'attributes' => array(
        'email:email',
        'profile.last_name',
        'profile.first_name',
        'profile.middle_name',
    ),
));

$this->endWidget();