<?php

/**
 * Class AController
 *
 * @author Lapshin Evgeny (Jonikru) <info@laco.pro>
 * @copyright 2012-2015 Laco
 * @link http://laco.pro
 *
 * @property $mPlugin MPlugin
 */
class AController extends BackendController
{
    /**
     * Получить блоки в Табе
     *
     * @param $model SActiveRecord
     * @param $template string|SActiveRecord
     * @return array
     * @throws CException
     */
    public function blockTabs($model, $template = '')
    {
        $tabs = array();
        $condition = ($template)
            ? 'entity_template_name = "' . get_class($template) . '" AND entity_template_id = ' . $template->id
            : 'entity_name = "' . get_class($model) . '"';
        $mBlockTemplates = BlockTemplate::model()->findAll($condition);

        $blockController = app()->createController('/admin/block');

        foreach ($mBlockTemplates as $mBlockTemplate) {
            $mBlock = new Block();
            $mBlock->entity_id = $model->id;
            $mBlock->includeDynamicAttributes($mBlockTemplate->id);
            $mBlockTemplate->setBlocks($mBlock->entity_id);

            $label = (user()->isAdmin)
                ? $mBlockTemplate->name . ' <small>(id: ' . $mBlockTemplate->id . ')</small>'
                : $mBlockTemplate->name;

            $tabs[] = array(
                'label' => $label,
                'content' => $blockController[0]->renderPartial($mBlockTemplate->type . '/_blocks', array(
                    'mBlockTemplate' => $mBlockTemplate,
                    'mBlock' => $mBlock
                ), true)
            );
        }

        return $tabs;
    }
}