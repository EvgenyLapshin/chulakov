<?php
/**
 * @var PageController $this
 * @var Page[] $list
 * @var Page $model
 */
?>
    <ul class="tabs" data-tabs id="example">
        <?php
        foreach($list as $number => $pageGallery) {
            $this->renderPartial($model->rTemplate->name . '/_galleryHeaderItem', array(
                'model' => $pageGallery,
                'number' => $number,
                'classActive' => (!$number) ? ' is-active' : ''
            ));
        }
        ?>
    </ul>

    <div class="tabs-content" id="example-tabs" data-tabs-content="example">
        <?php
        foreach($list as $number => $pageGallery) {
            $this->renderPartial($model->rTemplate->name . '/_galleryContent', array(
                'model' => $pageGallery,
                'number' => $number,
                'classActive' => (!$number) ? ' is-active' : ''
            ));
        }
        ?>
    </div>