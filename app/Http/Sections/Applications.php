<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

/**
 * Class Applications
 *
 * @property \App\Models\Application $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Applications extends Section implements Initializable
{
    protected $checkAccess = false;
    protected $title = 'Приложения';

    public function initialize()
    {
        $this->addToNavigation()->setIcon('fab fa-app-store-ios')->setPriority(10);
    }

    public function onDisplay()
    {
        $display = AdminDisplay::datatablesAsync()->setColumns([
            AdminColumn::text('id', 'Id'),
            AdminColumn::text('name', 'Название'),
            AdminColumn::text('limit', 'Ограничение по времени'),
            AdminColumn::text('from', 'Время начала доступа'),
            AdminColumn::text('to', 'Время окончания доступа'),
            AdminColumn::text('user', 'Id ребенка'),
        ]);
        $display->paginate(15);
        return $display;
    }
}
