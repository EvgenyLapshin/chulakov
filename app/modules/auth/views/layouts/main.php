<?php
/* @var $this AuthController */
/* @var $content string */
?>

<?php $this->beginContent($this->module->appLayout); ?>

    <div class="row">
        <div class="col s12 l3">
            <div class="collection">
                <a href="<?= url('/auth/assignment/index'); ?>"
                   class="collection-item <?= ($this instanceof AssignmentController) ? ' active' : ''; ?>">
                    <?= Yii::t('AuthModule.main', 'Assignments'); ?>
                </a>
                <a href="<?= url('/auth/role/index'); ?>"
                   class="collection-item <?= ($this instanceof RoleController) ? ' active' : ''; ?>">
                    <?= $this->capitalize($this->getItemTypeText(CAuthItem::TYPE_ROLE, true)); ?>
                </a>
                <a href="<?= url('/auth/task/index'); ?>"
                   class="collection-item <?= ($this instanceof TaskController) ? ' active' : ''; ?>">
                    <?= $this->capitalize($this->getItemTypeText(CAuthItem::TYPE_TASK, true)); ?>
                </a>
                <a href="<?= url('/auth/operation/index'); ?>"
                   class="collection-item <?= ($this instanceof OperationController) ? ' active' : ''; ?>">
                    <?= $this->capitalize($this->getItemTypeText(CAuthItem::TYPE_OPERATION, true)); ?>
                </a>
            </div>
        </div>
    </div>
<?= $content; ?>


<?php $this->endContent(); ?>