<?php

/**
 * Class GetPhoneWidget
 *
 * @property int $year, год запуска сайта
 */
class GetPhoneWidget extends CWidget
{
    public function init()
    {
        $phone = $this->owner->page->phone;
        $phone = explode(')', $phone);
        if (count($phone) == 2)
            echo '<div class="phone"> ' . $phone[0] . ') <span> ' . $phone[1] . '</span></div>';
    }

    public function run()
    {
        // этот метод будет вызван внутри CBaseController::endWidget()
    }

}