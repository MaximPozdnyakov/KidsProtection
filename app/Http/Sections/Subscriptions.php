<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

/**
 * Class Subscriptions
 *
 * @property \App\Models\Subscription $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Subscriptions extends Section implements Initializable
{
    protected $checkAccess = false;
    protected $title = 'Подписки';

    public function initialize()
    {
        $this->addToNavigation()->setIcon('fas fa-money-check-alt')->setPriority(1);
    }

    public function onDisplay()
    {
        $display = AdminDisplay::datatablesAsync()->setColumns([
            AdminColumn::text('id', 'Id'),
            AdminColumn::text('name', 'Наименование'),
            AdminColumn::text('device', 'Количество устройств'),
            AdminColumn::text('price', 'Цена'),
            AdminColumn::text('freeMonth', 'Количество бесплатных месяцев'),
        ]);
        $display->paginate(15);
        return $display;
    }
}
