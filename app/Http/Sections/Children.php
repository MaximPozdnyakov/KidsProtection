<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

/**
 * Class Children
 *
 * @property \App\Models\Child $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Children extends Section implements Initializable
{
    protected $checkAccess = false;
    protected $title = 'Дети';

    public function initialize()
    {
        $this->addToNavigation()->setIcon('fas fa-child')->setPriority(2);
    }

    public function onDisplay()
    {
        $display = AdminDisplay::datatablesAsync()->setColumns([
            AdminColumn::text('id', 'Id'),
            AdminColumn::text('name', 'Имя'),
            AdminColumn::text('year', 'Год рождения'),
            AdminColumn::text('parent', 'Id родителя'),
        ]);
        $display->paginate(15);
        return $display;
    }
}
