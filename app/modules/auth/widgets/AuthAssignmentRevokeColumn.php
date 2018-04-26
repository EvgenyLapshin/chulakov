<?php
/**
 * AuthAssignmentRevokeColumn class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package auth.widgets
 */

/**
 * Grid column for displaying the revoke link for an assignment row.
 */
class AuthAssignmentRevokeColumn extends AuthAssignmentColumn
{
    /**
     * Initializes the column.
     */
    public function init()
    {
        if (isset($this->htmlOptions['class']))
            $this->htmlOptions['class'] .= ' actions-column';
        else
            $this->htmlOptions['class'] = 'actions-column';
    }

    /**
     * Renders the data cell content.
     * @param integer $row the row number (zero-based).
     * @param mixed $data the data associated with the row.
     */
    protected function renderDataCellContent($row, $data)
    {
        if ($this->userId !== null) {
            /* @var $controller AuthItemController */
            $controller = $this->grid->getController();
            echo MHtml::linkButton(MHtml::icon('delete', array('class' => MHtml::ALIGN_LEFT)), array(
                    'url' => $controller->createUrl('revoke', array('itemName' => $data['name'], 'userId' => $this->userId)),
                    'tooltip' => 'Удалить право',
                    'class' => 'btn-flat'
                )
            );
        }
    }
}
