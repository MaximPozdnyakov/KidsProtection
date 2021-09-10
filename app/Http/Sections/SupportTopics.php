<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

/**
 * Class SupportTopics
 *
 * @property \App\Models\SupportTopic $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class SupportTopics extends Section implements Initializable
{
    protected $checkAccess = false;
    protected $title = 'Темы поддержки';

    public function initialize()
    {
        $this->addToNavigation()->setIcon('fas fa-question-circle')->setPriority(3);
    }

    public function onDisplay()
    {
        $display = AdminDisplay::datatablesAsync()->setColumns([
            AdminColumn::text('id', 'Id'),
            AdminColumn::text('name', 'Тема'),
        ]);
        $display->paginate(15);
        return $display;
    }
}
