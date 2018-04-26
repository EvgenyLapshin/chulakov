<?php

/**
 * Class ModelUploader
 *
 * @author Evgeny Lapshin (Jonikru)
 * @copyright 2012-2016 Laco <info@laco.pro>
 * @link http://laco.pro
 */
class BlockController extends AController
{
    public function actions()
    {
        return array(
            'uploadFile' => array(
                'class' => 'laco.uploader.ModelUploaderAction',
                'modelName' => 'Block'
            ),
            'deleteFile' => array(
                'class' => 'laco.uploader.ModelUploaderDeleteAction',
                'modelName' => 'Block'
            ),
        );
    }
}