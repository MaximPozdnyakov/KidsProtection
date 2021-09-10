<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

class Users extends Section implements Initializable
{
    protected $checkAccess = false;
    protected $title = 'Пользователи';

    public function initialize()
    {
        $this->addToNavigation()->setIcon('fas fa-user')->setPriority(0);
    }

    public function onDisplay()
    {
        $display = AdminDisplay::datatablesAsync()->setColumns([
            AdminColumn::text('id', 'Id'),
            AdminColumn::text('fio', 'ФИО'),
            AdminColumn::text('email', 'Email'),
            AdminColumn::text('emailVerified', 'Подтвержден email'),
        ]);
        $display->paginate(15);
        return $display;
    }
}
