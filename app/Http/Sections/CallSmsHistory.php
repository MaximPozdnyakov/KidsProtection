<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

/**
 * Class CallSmsHistory
 *
 * @property \App\Models\CallSmsHistory $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class CallSmsHistory extends Section implements Initializable
{
    protected $checkAccess = false;
    protected $title = 'Звонки и смс';

    public function initialize()
    {
        $this->addToNavigation()->setIcon('fas fa-sms')->setPriority(9);
    }

    public function onDisplay()
    {
        $display = AdminDisplay::datatablesAsync()->setColumns([
            AdminColumn::text('id', 'Id'),
            AdminColumn::text('phone', 'Телефон'),
            AdminColumn::text('isCall', 'Звонок'),
            AdminColumn::text('input', 'Входящий'),
            AdminColumn::text('message', 'Сообщение'),
            AdminColumn::text('date', 'Дата'),
            AdminColumn::text('child', 'Id ребенка'),
        ]);
        $display->paginate(15);
        return $display;
    }
}
