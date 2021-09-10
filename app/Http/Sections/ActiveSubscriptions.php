<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

/**
 * Class ActiveSubscriptions
 *
 * @property \App\Models\ActiveSubscription $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class ActiveSubscriptions extends Section implements Initializable
{
    protected $checkAccess = false;
    protected $title = 'Активные подписки';

    public function initialize()
    {
        $this->addToNavigation()->setIcon('fas fa-money-check-alt')->setPriority(1);
    }

    public function onDisplay()
    {
        $display = AdminDisplay::datatablesAsync()->setColumns([
            AdminColumn::text('id', 'Id'),
            AdminColumn::text('subscribe', 'Подписка'),
            AdminColumn::text('fromDate', 'Дата активации'),
            AdminColumn::text('endDate', 'Дата окончания'),
            AdminColumn::text('user', 'Id Пользователя'),
        ]);
        $display->paginate(15);
        return $display;
    }
}
