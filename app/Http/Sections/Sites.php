<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

/**
 * Class Sites
 *
 * @property \App\Models\Site $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Sites extends Section implements Initializable
{
    protected $checkAccess = false;
    protected $title = 'Заблокированные сайты';

    public function initialize()
    {
        $this->addToNavigation()->setIcon('fas fa-firefox')->setPriority(5);
    }

    public function onDisplay()
    {
        $display = AdminDisplay::datatablesAsync()->setColumns([
            AdminColumn::text('id', 'Id'),
            AdminColumn::text('site', 'Сайт'),
            AdminColumn::text('child', 'Id ребенка'),
            AdminColumn::text('parent', 'Id родителя'),
        ]);
        $display->paginate(15);
        return $display;
    }
}
