<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

/**
 * Class Phones
 *
 * @property \App\Models\Phone $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Phones extends Section implements Initializable
{
    protected $checkAccess = false;
    protected $title = 'Заблокированные телефоны';

    public function initialize()
    {
        $this->addToNavigation()->setIcon('fas fa-phone')->setPriority(8);
    }

    public function onDisplay()
    {
        $display = AdminDisplay::datatablesAsync()->setColumns([
            AdminColumn::text('id', 'Id'),
            AdminColumn::text('phone', 'Телефон'),
            AdminColumn::text('child', 'Id ребенка'),
            AdminColumn::text('parent', 'Id родителя'),
        ]);
        $display->paginate(15);
        return $display;
    }
}
