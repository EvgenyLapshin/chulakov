<?php
class GalleryWidget extends CWidget
{
    public $type = Gallery::TYPE_PHOTO;
    public $limit = -1;

    public function init()
    {
        if(isset($_GET['type']) && $_GET['type'])
            $this->type = (in_array($_GET['type'], Gallery::getTypeList())) ? $_GET['type'] : Gallery::TYPE_PHOTO;

        $criteria = new CDbCriteria();
        $criteria->condition = 'type = :type';
        $criteria->limit = $this->limit;
        $criteria->with = array('items');
        $criteria->params = array(
            ':type' => $this->type
        );

        if($this->type === Gallery::TYPE_PHOTO)
            $this->render('photo/index', array('mList' => Gallery::model()->findAll($criteria)));
        else
            $this->render('video/index', array('model' => Gallery::model()->find($criteria)));
    }

    public function run()
    {
        // этот метод будет вызван внутри CBaseController::endWidget()
    }
}