<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

/**
 * Class SupportAppeals
 *
 * @property \App\Models\SupportAppeal $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class SupportAppeals extends Section implements Initializable
{
    protected $checkAccess = false;
    protected $title = 'Обращения в поддержку';

    public function initialize()
    {
        $this->addToNavigation()->setIcon('fas fa-question-circle')->setPriority(4);
    }

    public function onDisplay()
    {
        $display = AdminDisplay::datatablesAsync()->setColumns([
            AdminColumn::text('id', 'Id'),
            AdminColumn::text('theme', 'Тема'),
            AdminColumn::text('message', 'Сообщение'),
            AdminColumn::text('date', 'Дата обращения'),
            AdminColumn::text('fio', 'ФИО пользователя'),
            AdminColumn::text('email', 'Email пользователя'),
            AdminColumn::text('user', 'Id пользователя'),
        ]);
        $display->paginate(15);
        return $display;
    }
}
