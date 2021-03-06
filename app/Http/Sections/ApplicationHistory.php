<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

/**
 * Class ApplicationHistory
 *
 * @property \App\Models\ApplicationHistory $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class ApplicationHistory extends Section implements Initializable
{
    protected $checkAccess = false;
    protected $title = 'История использования приложений';

    public function initialize()
    {
        $this->addToNavigation()->setIcon('fab fa-app-store-ios')->setPriority(10);
    }

    public function onDisplay()
    {
        $display = AdminDisplay::datatablesAsync()->setColumns([
            AdminColumn::text('id', 'Id'),
            AdminColumn::text('app', 'Приложение'),
            AdminColumn::text('day', 'Дата начала использования'),
            AdminColumn::text('time', 'Время использования в минутах'),
            AdminColumn::text('user', 'Id ребенка'),
        ]);
        $display->paginate(15);
        return $display;
    }
}
