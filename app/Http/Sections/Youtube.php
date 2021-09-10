<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

/**
 * Class Youtube
 *
 * @property \App\Models\Youtube $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Youtube extends Section implements Initializable
{
    protected $checkAccess = false;
    protected $title = 'Заблокированные youtube каналы';

    public function initialize()
    {
        $this->addToNavigation()->setIcon('fab fa-youtube')->setPriority(6);
    }

    public function onDisplay()
    {
        $display = AdminDisplay::datatablesAsync()->setColumns([
            AdminColumn::text('id', 'Id'),
            AdminColumn::text('channel', 'Канал'),
            AdminColumn::text('child', 'Id ребенка'),
            AdminColumn::text('parent', 'Id родителя'),
        ]);
        $display->paginate(15);
        return $display;
    }
}
