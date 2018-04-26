<?php
/** @var CatalogFilterWidget $this */
?>

<form class="filter-container catalog-filter" id="catalog-filter" action="<?= $this->form->dataProvider->pagination->getCurrentPageUrl($this->getOwner()); ?>" method="get">
    <div class="filter open">
        <div class="name">
            <span class="icon">
                <svg class="icon-arrow-list">
                    <use xlink:href="#icon-arrow-list"></use>
                </svg>
            </span>
            <span>Фильтры</span>
        </div>

        <div class="wrap">
            <div class="items">
                <div class="checkbox-group">

                    <div class="checkbox">
                        <?= CHtml::activeCheckBox($this->form, 'isSale', array('uncheckValue' => NULL)); ?>
                        <?= CHtml::activeLabel($this->form, 'isSale'); ?>
                    </div>

                    <div class="checkbox">
                        <?= CHtml::activeCheckBox($this->form, 'isStock', array('uncheckValue' => NULL)); ?>
                        <?= CHtml::activeLabel($this->form, 'isStock'); ?>
                    </div>

                </div>

                <span class="toggle-checkbox-group anchor">Показать ещё</span>
            </div>
        </div>
    </div>

    <div class="filter open">
        <div class="name">
            <span class="icon">
                <svg class="icon-arrow-list">
                    <use xlink:href="#icon-arrow-list"></use>
                </svg>
            </span>
            <span>Цена</span>
        </div>

        <div class="wrap">
            <div class="items">
                <div class="clearfix">
                    <input class="small auto-width float-left" type="number" id="price_min" name="<?= CHtml::activeName($this->form, 'minPrice'); ?>">
                    <input class="small auto-width float-right" type="number" id="price_max" name="<?= CHtml::activeName($this->form, 'maxPrice'); ?>">
                </div>

                <div class="slider" data-slider data-start="0" data-end="100000" data-initial-start="<?= $this->form->minPrice; ?>" data-initial-end="<?= $this->form->maxPrice; ?>" data-step="100" data-decimal="5">
                    <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="price_min"></span>
                    <span class="slider-fill" data-slider-fill></span>
                    <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="price_max"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="filter open">
        <div class="name">
            <span class="icon">
                <svg class="icon-arrow-list">
                    <use xlink:href="#icon-arrow-list"></use>
                </svg>
            </span>
            <span>Производители</span>
        </div>

        <div class="wrap">
            <div class="items">
                <div class="checkbox-group">
                    <?= CHtml::activeCheckBoxList(
                        $this->form,
                        'manufacturer',
                        CHtml::listData($this->form->getManufacturerList(), 'id', 'name'),
                        array(
                            'template' => '<div class="checkbox">{input} {label}</div>',
                            'separator' => ' ',
                            'uncheckValue' => NULL
                        )
                    ); ?>
                </div>

                <span class="toggle-checkbox-group anchor">Показать ещё</span>
            </div>
        </div>
    </div>

    <div class="action">
        <span class="reset-filter anchor"><span>+</span>Сбросить все фильтры</span>

        <button class="button expanded large red" type="submit">Применить фильтр</button>
    </div>
</form>