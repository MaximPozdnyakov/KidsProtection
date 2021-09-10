<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

/**
 * Class Geolocation
 *
 * @property \App\Models\Geolocation $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Geolocation extends Section implements Initializable
{
    protected $checkAccess = false;
    protected $title = 'Местоположения';

    public function initialize()
    {
        $this->addToNavigation()->setIcon('fas fa-map-marker-alt')->setPriority(7);
    }

    public function onDisplay()
    {
        $display = AdminDisplay::datatablesAsync()->setColumns([
            AdminColumn::text('id', 'Id'),
            AdminColumn::text('latitude', 'Широта'),
            AdminColumn::text('longitude', 'Долгота'),
            AdminColumn::text('address', 'Адрес'),
            AdminColumn::text('date', 'Дата'),
            AdminColumn::text('child', 'Id ребенка'),
        ]);
        $display->paginate(15);
        return $display;
    }
}
